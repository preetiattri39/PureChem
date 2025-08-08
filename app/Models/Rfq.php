<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rfq extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function getProductDetailsAttribute()
    {
        $structure = '<ul>';
        $structure .=  $this->items->map(function ($item) {
            $productName = $item->product->name ?? 'N/A';
            $variantName = $item->quantity ?? 'N/A';
            return "<li>{$productName} : <strong>{$variantName}</strong></li>";
        })->implode('');
        $structure .= '</ul>';

        return $structure;
    }

    public function getRfqUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getRfqUserEmailAttribute()
    {
        return $this->user->email;
    }

    public function getProductCountAttribute()
    {
        return $this->items->count();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(RfqItem::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

