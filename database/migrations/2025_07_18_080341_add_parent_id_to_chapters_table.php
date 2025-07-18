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
        Schema::table('chapters', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('book_id')
                ->constrained('chapters') // Указывает, что это ссылка на эту же таблицу
                ->onDelete('cascade');    // При удалении родителя, удаляются и все дочерние разделы
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            // Сначала нужно удалить внешний ключ, потом колонку
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
