<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'product_id',
        'custom_product_id',
        'is_custom_product',
        'purity',
        'quantity',
        'units',
        'price', 
        'total',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            // $item->total = $item->quantity * $item->price;
            $item->total = $item->price;
        });

        static::saved(function ($item) {
            $item->quotation->calculateTotals();
        });

        static::deleted(function ($item) {
            $item->quotation->calculateTotals();
        });
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
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
