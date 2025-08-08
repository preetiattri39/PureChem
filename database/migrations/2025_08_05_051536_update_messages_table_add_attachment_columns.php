<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            if (Schema::hasColumn('messages', 'message')) {
                $table->dropColumn('message');
            }

            if (Schema::hasColumn('messages', 'is_admin')) {
                $table->dropColumn('is_admin');
            }

            $table->dropTimestamps();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade')->before('created_at');
            $table->text('message')->nullable()->before('created_at');
            $table->boolean('has_attachment')->default(false)->before('created_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
            $table->dropForeign(['conversation_id']);
            $table->dropColumn('conversation_id');

            $table->dropColumn('message');
            $table->dropColumn('has_attachment');

        });
    }
};
