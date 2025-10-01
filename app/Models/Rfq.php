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
        'type'
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

    public function getCustomProductDetailsAttribute()
    {
        $product = $this->customSynthesisSubmission?->customProduct;

        if (!$product) {
            return 'N/A';
        }

        $productName = $product->molecule_name ?? 'N/A';
        $variantName = $product->quantity 
            ? $product->quantity . ' ' . $product->unit 
            : 'N/A';

        $structure  = '<ul>';
        $structure .= "<li>{$productName} : <strong>{$variantName}</strong></li>";
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

    public function getRfqUserCompanyAttribute()
    {
        return $this->user->company;
    }

    public function getProductCountAttribute()
    {
        return $this->items->count();
    }

    public function getCustomProductCountAttribute()
    {
        return $this->CustomSynthesisSubmission->CustomProduct ? 1 : 0;
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

     public function CustomSynthesisSubmission(): HasOne
    {
        return $this->hasOne(CustomSynthesisSubmission::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

