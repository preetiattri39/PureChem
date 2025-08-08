<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {

            $table->dropForeign(['rfq_id']);
            $table->dropTimestamps();
            $table->dropColumn([
                'rfq_id',
                'total',
                'status',
            ]);
            $table->text('to_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gstin')->nullable();
            $table->date('invoice_date');
            $table->string('invoice_number')->unique();
            $table->string('lead_time')->nullable();
            $table->string('shipping_methods')->nullable();
            $table->text('description')->nullable();
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('vat', 12, 2)->default(0);
            $table->decimal('shipping_charges', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'to_address', 'phone', 'email', 'gstin', 'invoice_date',
                'invoice_number', 'lead_time', 'shipping_methods', 'description',
                'subtotal', 'vat', 'shipping_charges', 'grand_total',
            ]);
        });
    }
};