<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Разрешаем полю быть nullable
            $table->mediumText('content_html')->nullable()->change();
        });

        Schema::table('chapters', function (Blueprint $table) {
            // Разрешаем полю быть nullable
            $table->mediumText('content_html')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Возвращаем как было (не nullable)
            $table->mediumText('content_html')->nullable(false)->change();
        });

        Schema::table('chapters', function (Blueprint $table) {
            // Возвращаем как было (не nullable)
            $table->mediumText('content_html')->nullable(false)->change();
        });
    }
};
