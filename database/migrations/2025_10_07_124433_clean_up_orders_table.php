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
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'to_address')) {
                $table->dropColumn('to_address');
            }
            if (Schema::hasColumn('orders', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('orders', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('orders', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('orders', 'gstin')) {
                $table->dropColumn('gstin');
            }
            if (Schema::hasColumn('orders', 'order_date')) {
                $table->dropColumn('order_date');
            }
            if (Schema::hasColumn('orders', 'lead_time')) {
                $table->dropColumn('lead_time');
            }
            if (Schema::hasColumn('orders', 'shipping_methods')) {
                $table->dropColumn('shipping_methods');
            }
            if (Schema::hasColumn('orders', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('orders', 'sub_total')) {
                $table->dropColumn('sub_total');
            }
            if (Schema::hasColumn('orders', 'vat')) {
                $table->dropColumn('vat');
            }
            if (Schema::hasColumn('orders', 'shipping_charges')) {
                $table->dropColumn('shipping_charges');
            }
            if (Schema::hasColumn('orders', 'grand_total')) {
                $table->dropColumn('grand_total');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
