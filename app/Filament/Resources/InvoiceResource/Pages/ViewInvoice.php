<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\OrderResource;
use App\Models\Invoice;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;


class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function (Invoice $record) {
                        return InvoiceResource::downloadInvoicePdf($record);
                }),
            
            // Actions\Action::make('create_order')
            //     ->label('Create Order')
            //     ->icon('heroicon-o-shopping-cart')
            //     ->color('info')
            //     ->visible(fn() => !$this->record->order)
            //     ->action(function () {
            //         $order = Order::createFromInvoice($this->record);
                    
            //         Notification::make()
            //             ->title('Order Created Successfully')
            //             ->body("Order {$order->order_id} has been created from this invoice.")
            //             ->success()
            //             ->send();
                        
            //         return redirect()->to(OrderResource::getUrl('view', ['record' => $order]));
            //     }),
        ];
    }
}