<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationResource\Pages;
use App\Filament\Resources\QuotationResource\RelationManagers;
use App\Models\Quotation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\QuotationItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\CustomProduct;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationResource extends Resource
{
    protected static ?string $model = Quotation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Quotation Information')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        TextInput::make('quotation_number')
                                            ->label('Quotation Number')
                                            ->dehydrated()
                                            ->default(fn() => Quotation::generateQuotationNumber()),

                                        DatePicker::make('quotation_date')
                                            ->label('Quotation Date')
                                            ->default(now())
                                            ->required(),

                                        TextInput::make('lead_time')
                                            ->label('Lead Time')
                                            ->placeholder('e.g., 2 weeks'),

                                        TextInput::make('shipping_methods')
                                            ->label('Shipping Methods')
                                            ->placeholder('e.g., Air, Courier'),
                                        TextInput::make('currency')
                                            ->label('Currency')
                                            ->placeholder('e.g., &dollar;, &euro;, &pound;,')
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
                                                $set('name', $user->name);
                                                $set('email', $user->email);
                                                $set('company', $user->company ?? '');
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

                                        TextInput::make('company')
                                            ->label('Company')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Enter company name'),

                                        TextInput::make('email')
                                            ->label('Email')
                                            ->required()
                                            ->email(),
                                    ]),
                                TextInput::make('vat_number')
                                    ->label('VAT Number')
                                    ->placeholder('e.g., 27ABCDE1234F1Z5'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Quotation Summary')
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
                        Repeater::make('quotationItems')
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

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3),
                        
                        Textarea::make('payment_terms')
                            ->label('Payment Terms')
                            ->rows(2),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quotation_number')
                    ->label('Quotation Number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quotation_date')
                    ->label('Quotation Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Client Email')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Amount')
                    ->formatStateUsing(fn ($state, $record) => $record->currency . ' ' . number_format($state, 2))
                    ->sortable(),
            ])
            ->paginated([5, 10, 20])
            ->emptyStateHeading('No records found')
            ->emptyStateDescription('You have to generate/add Quotation!')
            ->emptyStateIcon('heroicon-o-document-text')
            ->defaultPaginationPageOption(5)
            ->filters([
                
                Tables\Filters\Filter::make('quotation_date')
                    ->form([
                        DatePicker::make('from')->label('From Date'),
                        DatePicker::make('until')->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('quotation_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('quotation_date', '<=', $date),
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
                    ->action(function (Quotation $record) {
                        return static::downloadQuotationPdf($record);
                    }),

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


    public static function downloadQuotationPdf(Quotation $quotation)
    {
        try {

            $pdf = Pdf::loadView('quotations.pdf', ['quotation' => $quotation]);
            
            $safeFilename = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $quotation->quotation_number);
            
            return Response::streamDownload(
                fn() => print($pdf->output()),
                "quotation-{$safeFilename}.pdf"
            );
        } catch (\Exception $e) {
            Notification::make()
                ->title($e->getMessage())
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
            'index' => Pages\ListQuotations::route('/'),
            'create' => Pages\CreateQuotation::route('/create'),
            'view' => Pages\ViewQuotation::route('/{record}'),
            'edit' => Pages\EditQuotation::route('/{record}/edit'),
        ];
    }
}