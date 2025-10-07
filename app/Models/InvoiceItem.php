<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'purity',
        'quantity',
        'units',
        'price',
        'total',
        'is_custom_product',
        'custom_product_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            // $item->total = $item->quantity * $item->price;
            $item->total = $item->price;
        });

        static::saved(function ($item) {
            $item->invoice->calculateTotals();
        });

        static::deleted(function ($item) {
            $item->invoice->calculateTotals();
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class);
    }
}