<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_date',
        'invoice_number',
        'lead_time',
        'shipping_methods',
        'description',
        'sub_total',
        'vat',
        'shipping_charges',
        'grand_total',
        'customer_po',
        'country_of_departure',
        'country_of_destination',
        'currency',
        'ship_to_company',
        'ship_to_address',
        'ship_to_phone',
        'ship_to_email',
        'ship_to_tax_id',
        'bill_to_different',
        'bill_to_company',
        'bill_to_address',
        'bill_to_phone',
        'bill_to_email',
        'bill_to_tax_id',
        'payment_terms',
        'payment_method',
        'bank_name',
        'swift_bic',
        'iban',
        'reference_number',
    ];

    protected $casts = [
        'invoice_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = self::generateInvoiceNumber();
            }
            if (empty($invoice->invoice_date)) {
                $invoice->invoice_date = now()->toDateString();
            }
        });

        static::saved(function ($invoice) {
            $invoice->calculateTotals();
        });
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function generateInvoiceNumber()
    {
        $year = now()->year;
        $month = now()->format('m');
        
        $lastInvoice = self::whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', $month)
                          ->orderBy('id', 'desc')
                          ->first();

        if ($lastInvoice) {
            $lastNumber = explode('/', $lastInvoice->invoice_number);
            $sequence = isset($lastNumber[3]) ? intval($lastNumber[3]) + 1 : 1;
        } else {
            $sequence = 1;
        }

        return "INS/{$year}/{$month}/" . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function calculateTotals()
    {
        $this->sub_total = $this->invoiceItems()->sum('total');
        $this->grand_total = $this->sub_total + $this->vat + $this->shipping_charges;
        
        $this->updateQuietly([
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total
        ]);
    }

}