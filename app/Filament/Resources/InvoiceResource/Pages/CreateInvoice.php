<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Order;
use Filament\Notifications\Notification;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $invoice = $this->record;
        
        $order = Order::createFromInvoice($invoice);
        
        Notification::make()
            ->title('Invoice and Order Created Successfully')
            ->body("Invoice {$invoice->invoice_number} and Order {$order->order_id} have been created.")
            ->success()
            ->send();
    }
}
