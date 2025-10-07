<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\InvoiceItem; 
use App\Models\Order;
use App\Models\Product;
use App\Models\CustomProduct;
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
use Filament\Forms\Components\Checkbox;
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

                                        TextInput::make('customer_po')
                                            ->label('Customer PO')
                                            ->placeholder('Enter customer PO number'),

                                        TextInput::make('country_of_departure')
                                            ->label('Country of Departure')
                                            ->placeholder('e.g., Finland'),

                                        TextInput::make('country_of_destination')
                                            ->label('Country of Destination')
                                            ->placeholder('e.g., Canada'),

                                        TextInput::make('shipping_methods')
                                            ->label('Shipping Methods')
                                            ->placeholder('e.g., Air, Courier'),

                                        TextInput::make('currency')
                                            ->label('Currency')
                                            ->placeholder('e.g., &dollar;, &euro;, &pound;,')
                                            ->default('$')
                                            ->required(),
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
                                                $set('ship_to_company', $user->company ?? $user->name);
                                                $set('ship_to_email', $user->email);
                                                $set('ship_to_phone', $user->phone ?? '');
                                                
                                                $set('bill_to_company', $user->company ?? $user->name);
                                                $set('bill_to_email', $user->email);
                                                $set('bill_to_phone', $user->phone ?? '');
                                            }
                                        }
                                    }),
                            ]),

                        Forms\Components\Section::make('Ship To Address')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        TextInput::make('ship_to_company')
                                            ->label('Company Name')
                                            ->required(),

                                        TextInput::make('ship_to_email')
                                            ->label('Email')
                                            ->required()
                                            ->email(),

                                        Textarea::make('ship_to_address')
                                            ->label('Address')
                                            ->rows(3)
                                            ->required()
                                            ->columnSpanFull(),

                                        TextInput::make('ship_to_phone')
                                            ->label('Phone')
                                            ->tel(),

                                        TextInput::make('ship_to_tax_id')
                                            ->label('Tax ID / GSTIN')
                                            ->placeholder('e.g., 27ABCDE1234F1Z5'),
                                    ]),
                            ]),

                        Forms\Components\Section::make('Bill To Address (if different from Ship To)')
                            ->schema([
                                Checkbox::make('bill_to_different')
                                    ->label('Bill to a different address')
                                    ->live()
                                    ->default(false),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        TextInput::make('bill_to_company')
                                            ->label('Company Name')
                                            ->required(fn ($get) => $get('bill_to_different')),

                                        TextInput::make('bill_to_email')
                                            ->label('Email')
                                            ->email()
                                            ->required(fn ($get) => $get('bill_to_different')),

                                        Textarea::make('bill_to_address')
                                            ->label('Address')
                                            ->rows(3)
                                            ->required(fn ($get) => $get('bill_to_different'))
                                            ->columnSpanFull(),

                                        TextInput::make('bill_to_phone')
                                            ->label('Phone')
                                            ->tel(),

                                        TextInput::make('bill_to_tax_id')
                                            ->label('Tax ID / GSTIN')
                                            ->placeholder('e.g., 27ABCDE1234F1Z5'),
                                    ])
                                    ->visible(fn ($get) => $get('bill_to_different')),
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
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('vat')
                                    ->label('VAT')
                                    ->numeric()
                                    ->default(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        static::updateGrandTotal($state, $set, $get, 'vat');
                                    }),

                                TextInput::make('shipping_charges')
                                    ->label('Shipping Charges')
                                    ->numeric()
                                    ->default(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        static::updateGrandTotal($state, $set, $get, 'shipping_charges');
                                    }),

                                TextInput::make('grand_total')
                                    ->label('Grand Total')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

                Forms\Components\Section::make('Products')
                    ->schema([
                        Repeater::make('invoiceItems')
                            ->relationship()
                            ->schema([
                                Checkbox::make('is_custom_product')
                                    ->label('Is it a custom product?')
                                    ->live()
                                    ->default(false)
                                    ->afterStateUpdated(function ($state, $set) {
                                        $set('product_id', null);
                                        $set('custom_product_id', null);
                                    }),

                                Select::make('product_id')
                                    ->label('Product')
                                    ->options(Product::pluck('name', 'id'))
                                    ->required(fn ($get) => !$get('is_custom_product'))
                                    ->searchable()
                                    ->preload()
                                    ->visible(fn ($get) => !$get('is_custom_product')),

                                Select::make('custom_product_id')
                                    ->label('Custom Product')
                                    ->options(CustomProduct::pluck('molecule_name', 'id'))
                                    ->required(fn ($get) => $get('is_custom_product'))
                                    ->searchable()
                                    ->preload()
                                    ->visible(fn ($get) => $get('is_custom_product'))
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($state) {
                                            $customProduct = CustomProduct::find($state);
                                            if ($customProduct) {
                                                $set('purity', $customProduct->purity);
                                                $set('units', $customProduct->unit);
                                                $set('quantity', $customProduct->quantity);
                                                if ($customProduct->price) {
                                                    $set('price', $customProduct->price);
                                                }
                                            }
                                        }
                                    }),

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
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, $set, $get) {
                                                static::calculateItemTotal($state, $set, $get, 'price');
                                            }),
                                    ]),

                                TextInput::make('total')
                                    ->label('Total')
                                    ->numeric()
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

                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Textarea::make('payment_terms')
                                    ->label('Payment Terms')
                                    ->rows(2)
                                    ->placeholder('e.g., Payment upon delivery'),

                                TextInput::make('payment_method')
                                    ->label('Payment Method')
                                    ->placeholder('e.g., Bank Transfer'),

                                TextInput::make('bank_name')
                                    ->label('Bank Name')
                                    ->default('Nordea Finland'),

                                TextInput::make('swift_bic')
                                    ->label('SWIFT/BIC')
                                    ->default('NDEAFIHH'),

                                TextInput::make('iban')
                                    ->label('IBAN')
                                    ->default('FI39 1544 3000 0826 31'),

                                TextInput::make('reference_number')
                                    ->label('Reference Number')
                                    ->placeholder('Enter reference number'),
                            ]),
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

                Tables\Columns\TextColumn::make('ship_to_email')
                    ->label('Client Email')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Amount')
                    ->formatStateUsing(fn ($state, $record) => ($record->currency ?? 'USD') . ' ' . number_format($state, 2))
                    ->sortable(),
            ])
            ->paginated([5, 10, 20])
            ->emptyStateHeading('No records found')
            ->emptyStateDescription('You have to generate/add invoice!')
            ->emptyStateIcon('heroicon-o-document-text')
            ->defaultPaginationPageOption(5)
            ->filters([
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
                Tables\Actions\EditAction::make(), 
                
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function (Invoice $record) {
                        return static::downloadInvoicePdf($record);
                    }),

                Action::make('create_order')
                    ->label('Create Order')
                    ->icon('heroicon-o-shopping-cart')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalDescription('This will create a new order based on this invoice.')
                    ->action(function (Invoice $record) {
                        try {
                            $order = Order::createFromInvoice($record);
                            
                            Notification::make()
                                ->title('Order Created Successfully')
                                ->body("Order {$order->order_id} has been created from this invoice.")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error Creating Order')
                                ->body('Failed to create order. Please try again.')
                                ->danger()
                                ->send();
                        }
                    }),

                Tables\Actions\DeleteAction::make()
                ->visible(fn (Invoice $record): bool => !Order::where('invoice_id', $record->id)->exists()),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function calculateItemTotal($state, $set, $get, $field): void
    {
        $quantity = floatval($get('quantity') ?? 0);
        $price = floatval($get('price') ?? 0);
        
        if ($quantity > 0 && $price > 0) {
            $set('total', $price);
        }
    }

    protected static function updateSubtotalAndGrandTotal($state, $set, $get): void
    {
        if (!$state) return;
        
        $subtotal = collect($state)->sum(function ($item) {
            return floatval($item['total'] ?? 0);
        });
        
        $set('sub_total', round($subtotal, 2));
        
        $vat = floatval($get('vat') ?? 0);
        $shipping = floatval($get('shipping_charges') ?? 0);
        $set('grand_total', round($subtotal + $vat + $shipping, 2));
    }

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
        return [];
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