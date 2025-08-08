<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropForeign(['invoice_id']);
            $table->dropTimestamps();
            $table->dropColumn([
                'invoice_id',
                'order_code',
                'status',
            ]);
            // Add relationship to invoice
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');
            
            // Add order fields (same as invoice but with order-specific fields)
            $table->string('order_id')->unique(); // Unique long order ID
            $table->text('to_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gstin')->nullable();
            $table->date('order_date');
            $table->string('lead_time')->nullable();
            $table->string('shipping_methods')->nullable();
            $table->text('description')->nullable();
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('vat', 12, 2)->default(0);
            $table->decimal('shipping_charges', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('processing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};