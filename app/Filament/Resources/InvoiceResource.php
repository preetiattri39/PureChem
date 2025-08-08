<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Sales';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Invoice Information')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        TextInput::make('invoice_number')
                                            ->label('Invoice Number')
                                            ->dehydrated()
                                            ->default(fn() => Invoice::generateInvoiceNumber()),

                                        DatePicker::make('invoice_date')
                                            ->label('Invoice Date')
                                            ->default(now())
                                            ->required(),

                                        TextInput::make('lead_time')
                                            ->label('Lead Time')
                                            ->placeholder('e.g., 2 weeks'),

                                        TextInput::make('shipping_methods')
                                            ->label('Shipping Methods')
                                            ->placeholder('e.g., Air, Courier'),
                                    ]),
                            ]),

                        Forms\Components\Section::make('Client Information')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Client')
                                    ->options(function () {
                                        return \App\Models\User::where('role', 'user')->get()->mapWithKeys(function ($user) {
                                            return [$user->id => $user->name . ' (' . $user->email . ')'];
                                        });
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($state) {
                                            $user = \App\Models\User::find($state);
                                            if ($user) {
                                                $set('name', $user->name);
                                                $set('email', $user->email);
                                                $set('phone', $user->phone ?? '');
                                            }
                                        }
                                    }),
                                Textarea::make('to_address')
                                    ->label('To (Address)')
                                    ->rows(3)
                                    ->required(),

                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Name')
                                            ->required(),

                                        TextInput::make('phone')
                                            ->label('Phone')
                                            ->tel(),

                                        TextInput::make('email')
                                            ->label('Email')
                                            ->required()
                                            ->email(),
                                    ]),
                                TextInput::make('gstin')
                                    ->label('GSTIN')
                                    ->placeholder('e.g., 27ABCDE1234F1Z5'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Invoice Summary')
                            ->schema([
                                TextInput::make('sub_total')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('vat')
                                    ->label('VAT')
                                    ->numeric()
                                    ->prefix('$')
                                    ->default(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        static::updateGrandTotal($state, $set, $get, 'vat');
                                    }),

                                TextInput::make('shipping_charges')
                                    ->label('Shipping Charges')
                                    ->numeric()
                                    ->prefix('$')
                                    ->default(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        static::updateGrandTotal($state, $set, $get, 'shipping_charges');
                                    }),

                                TextInput::make('grand_total')
                                    ->label('Grand Total')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated(),

                                // Select::make('status')
                                //     ->label('Status')
                                //     ->options([
                                //         'draft' => 'Draft',
                                //         'sent' => 'Sent',
                                //         'paid' => 'Paid',
                                //         'cancelled' => 'Cancelled',
                                //     ])
                                //     ->default('draft')
                                //     ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

                Forms\Components\Section::make('Products')
                    ->schema([
                        Repeater::make('invoiceItems')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->options(Product::pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\Grid::make(4)
                                    ->schema([
                                        TextInput::make('purity')
                                            ->label('Purity')
                                            ->placeholder('e.g., 99%'),

                                        TextInput::make('quantity')
                                            ->label('Quantity')
                                            ->numeric()
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, $set, $get) {
                                                static::calculateItemTotal($state, $set, $get, 'quantity');
                                            }),

                                        TextInput::make('units')
                                            ->label('Units')
                                            ->placeholder('mg, g, kg etc.')
                                            ->required(),

                                        TextInput::make('price')
                                            ->label('Price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, $set, $get) {
                                                static::calculateItemTotal($state, $set, $get, 'price');
                                            }),
                                    ]),

                                TextInput::make('total')
                                    ->label('Total')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->columns(1)
                            ->minItems(1)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                static::updateSubtotalAndGrandTotal($state, $set, $get);
                            })
                            ->addActionLabel('Add Product')
                            ->reorderable(false),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice Number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('invoice_date')
                    ->label('Invoice Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Client Email')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Amount')
                    ->money('INR')
                    ->sortable(),

                // Tables\Columns\BadgeColumn::make('status')
                //     ->label('Status')
                //     ->colors([
                //         'secondary' => 'draft',
                //         'warning' => 'sent',
                //         'success' => 'paid',
                //         'danger' => 'cancelled',
                //     ]),
            ])
            ->paginated([5, 10, 20])
            ->emptyStateHeading('No records found')
            ->emptyStateDescription('You have to generate/add invoice!')
            ->emptyStateIcon('heroicon-o-document-text')
            ->defaultPaginationPageOption(5)
            ->filters([
                // Tables\Filters\SelectFilter::make('status')
                //     ->options([
                //         'draft' => 'Draft',
                //         'sent' => 'Sent',
                //         'paid' => 'Paid',
                //         'cancelled' => 'Cancelled',
                //     ]),
                
                Tables\Filters\Filter::make('invoice_date')
                    ->form([
                        DatePicker::make('from')->label('From Date'),
                        DatePicker::make('until')->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('invoice_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('invoice_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'From ' . \Carbon\Carbon::parse($data['from'])->toFormattedDateString();
                        }
                        if ($data['until'] ?? null) {
                            $indicators['until'] = 'Until ' . \Carbon\Carbon::parse($data['until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function (Invoice $record) {
                        return static::downloadInvoicePdf($record);
                    }),

                // Action::make('create_order')
                //     ->label('Create Order')
                //     ->icon('heroicon-o-shopping-cart')
                //     ->color('info')
                //     ->visible(fn(Invoice $record) => !$record->order)
                //     ->requiresConfirmation()
                //     ->modalDescription('This will create a new order based on this invoice.')
                //     ->action(function (Invoice $record) {
                //         try {
                //             $order = Order::createFromInvoice($record);
                            
                //             Notification::make()
                //                 ->title('Order Created Successfully')
                //                 ->body("Order {$order->order_id} has been created from this invoice.")
                //                 ->success()
                //                 ->send();
                //         } catch (\Exception $e) {
                //             Notification::make()
                //                 ->title('Error Creating Order')
                //                 ->body('Failed to create order. Please try again.')
                //                 ->danger()
                //                 ->send();
                //         }
                //     }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Calculate item total when quantity or price changes
     */
    protected static function calculateItemTotal($state, $set, $get, $field): void
    {
        $quantity = floatval($get('quantity') ?? 0);
        $price = floatval($get('price') ?? 0);
        
        if ($quantity > 0 && $price > 0) {
            $set('total', $price);
        }
    }

    /**
     * Update subtotal and grand total when repeater items change
     */
    protected static function updateSubtotalAndGrandTotal($state, $set, $get): void
    {
        if (!$state) return;
        
        $subtotal = collect($state)->sum(function ($item) {
            return floatval($item['total'] ?? 0);
        });
        
        $set('sub_total', round($subtotal, 2));
        
        // Recalculate grand total
        $vat = floatval($get('vat') ?? 0);
        $shipping = floatval($get('shipping_charges') ?? 0);
        $set('grand_total', round($subtotal + $vat + $shipping, 2));
    }

    /**
     * Update grand total when VAT or shipping changes
     */
    protected static function updateGrandTotal($state, $set, $get, $field): void
    {
        $subtotal = floatval($get('sub_total') ?? 0);
        $vat = floatval($get('vat') ?? 0);
        $shipping = floatval($get('shipping_charges') ?? 0);
        
        $set('grand_total', round($subtotal + $vat + $shipping, 2));
    }


    public static function downloadInvoicePdf(Invoice $invoice)
    {
        try {

            $pdf = Pdf::loadView('invoices.pdf', ['invoice' => $invoice]);
            
            $safeFilename = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $invoice->invoice_number);
            
            return Response::streamDownload(
                fn() => print($pdf->output()),
                "invoice-{$safeFilename}.pdf"
            );
        } catch (\Exception $e) {
            Notification::make()
                ->title('PDF Generation Failed')
                ->body('Could not generate PDF. Please try again.')
                ->danger()
                ->send();
                
            return null;
        }
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}