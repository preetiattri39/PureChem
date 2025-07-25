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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('quantity')->after('product_variant_id');
            $table->string('cas_number')->nullable()->after('quantity');
            $table->string('product_name')->nullable()->after('cas_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'cas_number', 'product_name']);
        });
    }
};
