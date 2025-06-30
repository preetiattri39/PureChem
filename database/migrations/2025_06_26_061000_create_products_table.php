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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('compound_family')->nullable();
            $table->string('name');
            $table->foreignId('category_id')->nullable()->default(null)->constrained('categories')->onDelete('set null');           
            $table->text('synonym')->nullable();
            $table->string('structure')->nullable();
            $table->string('molecular_formula')->nullable();
            $table->decimal('molecular_weight', 10, 3)->nullable();
            $table->string('cas_number')->nullable();
            $table->string('purity')->nullable();
            $table->text('storage')->nullable();
            $table->string('aspect')->nullable();
            $table->text('patents')->nullable();
            $table->text('uses')->nullable();
            $table->boolean('out_of_stock')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
