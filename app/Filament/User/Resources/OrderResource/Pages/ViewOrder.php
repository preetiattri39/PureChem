<?php

namespace App\Filament\User\Resources\OrderResource\Pages;

use App\Filament\User\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Order Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('order_id')
                                    ->label('Order ID'),
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'gray',
                                        'processing' => 'warning',
                                        'shipped' => 'info',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'secondary',
                                    }),
                                TextEntry::make('invoice.currency')
                                    ->label('Currency'),
                            ])
                    ]),

                Section::make('Shipping Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('invoice.ship_to_company')
                                    ->label('Company'),
                                TextEntry::make('invoice.ship_to_email')
                                    ->label('Email'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('invoice.ship_to_phone')
                                    ->label('Phone'),
                                TextEntry::make('invoice.ship_to_tax_id')
                                    ->label('Tax ID'),
                            ]),
                        TextEntry::make('invoice.ship_to_address')
                            ->label('Address')
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('invoice.country_of_departure')
                                    ->label('Country of Departure'),
                                TextEntry::make('invoice.country_of_destination')
                                    ->label('Country of Destination'),
                            ]),
                        TextEntry::make('invoice.shipping_methods')
                            ->label('Shipping Method'),
                    ]),

                Section::make('Billing Information')
                    ->schema([
                        TextEntry::make('invoice.bill_to_different')
                            ->label('Different Billing Address')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                            ->visible(fn ($record) => $record->invoice?->bill_to_different),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('invoice.bill_to_company')
                                    ->label('Company'),
                                TextEntry::make('invoice.bill_to_email')
                                    ->label('Email'),
                            ])
                            ->visible(fn ($record) => $record->invoice?->bill_to_different),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('invoice.bill_to_phone')
                                    ->label('Phone'),
                                TextEntry::make('invoice.bill_to_tax_id')
                                    ->label('Tax ID'),
                            ])
                            ->visible(fn ($record) => $record->invoice?->bill_to_different),
                        TextEntry::make('invoice.bill_to_address')
                            ->label('Address')
                            ->columnSpanFull()
                            ->visible(fn ($record) => $record->invoice?->bill_to_different),
                    ])
                    ->visible(fn ($record) => $record->invoice?->bill_to_different),

                Section::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('invoice.invoiceItems')
                            ->label('')
                            ->schema([
                                Grid::make(6)
                                    ->schema([
                                       TextEntry::make('product.name')
                                            ->label('Product')
                                            ->state(function ($record) {
                                                if ($record->is_custom_product) {
                                                    return $record->customProduct?->molecule_name ?? 'Custom Product';
                                                }
                                                return $record->product?->name ?? 'Product';
                                            }),
                                        TextEntry::make('purity')
                                            ->label('Purity'),
                                        TextEntry::make('quantity')
                                            ->label('Quantity')
                                            ->formatStateUsing(fn ($state, $record) => $state . ' ' . $record->units),
                                        TextEntry::make('price')
                                            ->label('Price')
                                            ->money('USD', true)
                                    ]),
                            ]),
                    ]),

                Section::make('Payment Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('invoice.payment_method')
                                    ->label('Payment Method'),
                                TextEntry::make('invoice.reference_number')
                                    ->label('Reference Number'),
                                TextEntry::make('invoice.payment_terms')
                                    ->label('Payment Terms'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('invoice.bank_name')
                                    ->label('Bank Name'),
                                TextEntry::make('invoice.swift_bic')
                                    ->label('SWIFT/BIC'),
                                TextEntry::make('invoice.iban')
                                    ->label('IBAN'),
                            ]),
                        TextEntry::make('invoice.description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Order Summary')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('invoice.sub_total')
                                    ->label('Subtotal')
                                    ->money('USD', true),
                                TextEntry::make('invoice.vat')
                                    ->label('VAT')
                                    ->money('USD', true),
                                TextEntry::make('invoice.shipping_charges')
                                    ->label('Shipping Charges')
                                    ->money('USD', true),
                            ]),
                        TextEntry::make('invoice.grand_total')
                            ->label('Grand Total')
                            ->money('USD', true)
                            ->weight('bold')
                            ->size('lg'),
                    ]),
            ]);
    }
}