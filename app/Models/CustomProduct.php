<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomProduct extends Model
{
    use HasFactory;

    protected $table = 'custom_products';

    protected $fillable = [
        'molecule_name',
        'purity',
        'molecular_formula',
        'unit',
        'quantity',
        'structure_uploaded',
        'structure_file',
        'upload_method',
    ];

    public function synthesisSubmission()
    {
        return $this->hasOne(CustomSynthesisSubmission::class, 'custom_product_id');
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }
}
