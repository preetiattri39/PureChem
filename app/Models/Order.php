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
        'status'
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public static function generateOrderId()
    {
        $lastOrder = self::orderBy('id', 'desc')->first();

        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;

        $orderId = 'ORD' . now()->format('YmdHis') . '-' .$nextId;

        return $orderId;
    }

    public static function createFromInvoice(Invoice $invoice)
    {
        $order = self::create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user_id,
            'order_id' => self::generateOrderId(),
            'status' => 'pending'
        ]);

        return $order;
    }
}