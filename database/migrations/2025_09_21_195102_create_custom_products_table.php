<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('custom_products', function (Blueprint $table) {
            $table->id();
            $table->string('molecule_name', 255);
            $table->string('purity', 255);
            $table->string('molecular_formula', 255);
            $table->enum('unit', ['mg', 'g', 'kg']);
            $table->integer('quantity');
            $table->boolean('structure_uploaded')->default(false);
            $table->string('structure_file', 255)->nullable();
            $table->enum('upload_method', ['upload', 'draw'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_products');
    }
};
