<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_id',
        'order_id',
        'to_address',
        'phone',
        'name',
        'email',
        'gstin',
        'order_date',
        'lead_time',
        'shipping_methods',
        'description',
        'sub_total',
        'vat',
        'shipping_charges',
        'grand_total',
        'status'
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($order) {
    //         if (empty($order->order_id)) {
    //             $order->order_id = self::generateOrderId();
    //         }
    //         if (empty($order->order_date)) {
    //             $order->order_date = now()->toDateString();
    //         }
    //     });

    //     static::saved(function ($order) {
    //         $order->calculateTotals();
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public static function generateOrderId()
    {
        do {
            $orderId = 'ORD' . now()->format('YmdHis') . strtoupper(Str::random(6));
        } while (self::where('order_id', $orderId)->exists());

        return $orderId;
    }

    public function calculateTotals()
    {
        $subtotal = $this->orderItems()->sum(\DB::raw('quantity * price'));
        
        $this->update([
            'sub_total' => $subtotal,
            'grand_total' => $subtotal + $this->vat + $this->shipping_charges
        ]);
    }

    public static function createFromInvoice(Invoice $invoice)
    {
        $order = self::create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user_id,
            'order_id' => self::generateOrderId(),
            'name' => $invoice->name,
            'to_address' => $invoice->to_address,
            'phone' => $invoice->phone,
            'email' => $invoice->email,
            'gstin' => $invoice->gstin,
            'order_date' => now()->toDateString(),
            'lead_time' => $invoice->lead_time,
            'shipping_methods' => $invoice->shipping_methods,
            'description' => $invoice->description,
            'vat' => $invoice->vat,
            'shipping_charges' => $invoice->shipping_charges,
            'sub_total' => $invoice->sub_total,
            'grand_total' => $invoice->grand_total,
            'status' => 'pending'
        ]);

        // Copy invoice items to order items
        foreach ($invoice->invoiceItems as $invoiceItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $invoiceItem->product_id,
                'purity' => $invoiceItem->purity,
                'quantity' => $invoiceItem->quantity,
                'units' => $invoiceItem->units,
                'price' => $invoiceItem->price,
                'total' => $invoiceItem->total
            ]);
        }

        return $order;
    }
}