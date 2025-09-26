<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSynthesisSubmission extends Model
{
    use HasFactory;

    protected $table = 'custom_synthesis_submissions';

    protected $fillable = [
        'user_id',
        'rfq_id',
        'custom_product_id',
        'company',
        'usage',
        'usage_other',
        'address',
        'special_instructions',
        'terms_accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rfq()
    {
        return $this->belongsTo(Rfq::class);
    }

    public function customProduct()
    {
        return $this->belongsTo(CustomProduct::class, 'custom_product_id');
    }
}
