<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'to_address',
        'company',
        'email',
        'currency',
        'vat_number',
        'quotation_date',
        'quotation_number',
        'lead_time', 
        'shipping_methods',
        'description',
        'payment_terms',
        'sub_total',
        'vat',
        'shipping_charges',
        'grand_total',
    ];

    protected $casts = [
        'quotation_date' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            if (empty($quotation->quotation_number)) {
                $quotation->quotation_number = self::generateQuotationNumber();
            }
            if (empty($quotation->quotation_date)) {
                $quotation->quotation_date = now()->toDateString();
            }
        });

        static::saved(function ($quotation) {
            $quotation->calculateTotals();
        });
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function generateQuotationNumber()
    {
        $lastQuotation = self::orderBy('id', 'desc')->first();

        if ($lastQuotation) {
            $lastNumber = intval($lastQuotation->quotation_number);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 200001;
        }
        return str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    }

    public function calculateTotals()
    {
        $this->sub_total = $this->quotationItems()->sum('total');
        $this->grand_total = $this->sub_total + $this->vat + $this->shipping_charges;
        
        $this->updateQuietly([
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total
        ]);
    }
}
