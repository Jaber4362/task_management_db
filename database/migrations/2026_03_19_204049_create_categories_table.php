<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_categories_table.php

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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم التصنيف
            $table->text('description')->nullable(); // وصف التصنيف (اختياري)

            // العلاقة: كل تصنيف ينتمي لمستخدم واحد
            // onDelete('cascade'): إذا حذف المستخدم، تحذف جميع تصنيفاته
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            // نصيحة: لضمان أن المستخدم لا يكرر نفس اسم التصنيف
            // يمكن إضافة unique constraint (لكن هذا خارج نطاقنا الحالي)
            // $table->unique(['user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
