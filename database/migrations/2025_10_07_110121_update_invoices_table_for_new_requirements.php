<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropTimestamps();
            
            if (Schema::hasColumn('invoices', 'lead_time')) {
                $table->dropColumn('lead_time');
            }
            if (Schema::hasColumn('invoices', 'to_address')) {
                $table->dropColumn('to_address');
            }
            if (Schema::hasColumn('invoices', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('invoices', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('invoices', 'gstin')) {
                $table->dropColumn('gstin');
            }
            if (Schema::hasColumn('invoices', 'name')) {
                $table->dropColumn('name');
            }
            $table->string('customer_po')->nullable()->after('invoice_date');
            $table->string('country_of_departure')->nullable()->after('customer_po');
            $table->string('country_of_destination')->nullable()->after('country_of_departure');
            $table->string('currency')->default('$')->after('country_of_destination');
            
            $table->string('ship_to_company')->nullable()->after('user_id');
            $table->text('ship_to_address')->nullable()->after('ship_to_company');
            $table->string('ship_to_phone')->nullable()->after('ship_to_address');
            $table->string('ship_to_email')->nullable()->after('ship_to_phone');
            $table->string('ship_to_tax_id')->nullable()->after('ship_to_email');
            
            $table->boolean('bill_to_different')->default(false)->after('ship_to_tax_id');
            $table->string('bill_to_company')->nullable()->after('bill_to_different');
            $table->text('bill_to_address')->nullable()->after('bill_to_company');
            $table->string('bill_to_phone')->nullable()->after('bill_to_address');
            $table->string('bill_to_email')->nullable()->after('bill_to_phone');
            $table->string('bill_to_tax_id')->nullable()->after('bill_to_email');
            
            $table->text('payment_terms')->nullable()->after('description');
            $table->string('payment_method')->nullable()->after('payment_terms');
            $table->string('bank_name')->default('Nordea Finland')->after('payment_method');
            $table->string('swift_bic')->default('NDEAFIHH')->after('bank_name');
            $table->string('iban')->default('FI39 1544 3000 0826 31')->after('swift_bic');
            $table->string('reference_number')->nullable()->after('iban');

            $table->timestamps();
        });

        Schema::table('invoice_items', function (Blueprint $table) {
            
            $table->boolean('is_custom_product')->default(false)->after('invoice_id');
            $table->unsignedBigInteger('custom_product_id')->nullable()->after('product_id');
            
            $table->unsignedBigInteger('product_id')->nullable()->change();
            
            $table->foreign('custom_product_id')->references('id')->on('custom_products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
