<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('custom_synthesis_submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('rfq_id')->constrained('rfqs');
            $table->foreignId('custom_product_id')->constrained('custom_products');

            $table->string('company')->nullable();
            $table->enum('usage', [
                'university_lab_research',
                'testing_standards',
                'product_development',
                'regulatory_use',
                'resale_distribution',
                'other'
            ]);
            $table->string('usage_other', 255)->nullable();
            $table->text('address')->nullable();
            $table->text('special_instructions')->nullable();
            $table->boolean('terms_accepted')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_synthesis_submissions');
    }
};

