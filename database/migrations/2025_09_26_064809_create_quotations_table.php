<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('to_address')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('vat_number')->nullable();
            $table->date('quotation_date');
            $table->string('quotation_number')->unique();
            $table->string('lead_time')->nullable();
            $table->string('shipping_methods')->nullable();
            $table->text('description')->nullable();
            $table->text('payment_terms')->nullable();
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('vat', 12, 2)->default(0);
            $table->decimal('shipping_charges', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop tables in the reverse order of creation to avoid foreign key constraint issues
        Schema::dropIfExists('quotation_items');
        Schema::dropIfExists('quotations');
    }
};