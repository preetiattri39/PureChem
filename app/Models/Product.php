<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'product_code',
        'compound_family',
        'name',
        'structure',
        'category_id',
        'synonym',
        'molecular_formula',
        'molecular_weight',
        'cas_number',
        'purity',
        'storage',
        'aspect',
        'patents',
        'uses',
        'out_of_stock',
    ];
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
