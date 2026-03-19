<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tasks_table.php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary key, big integer, auto-increment
            $table->string('title'); // عنوان المهمة (VARCHAR)
            $table->text('description')->nullable(); // وصف (TEXT) و nullable تعني أنه يمكن أن يكون فارغًا
            $table->boolean('completed')->default(false); // boolean (true/false)، القيمة الافتراضية false (غير مكتملة)
            $table->date('due_date')->nullable(); // تاريخ (DATE) ويمكن أن يكون فارغًا

            // Foreign Keys (المفاتيح الخارجية) - هذا هو جوهر العلاقات
            // Constrained() تعني أنشئ العلاقة مع الجدول صاحب المفتاح الأساسي (users)
            // OnDelete('cascade') تعني: إذا تم حذف المستخدم، فاحذف جميع مهامه تلقائيًا
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // العلاقة مع جدول categories، سنضيفها بعد إنشاء جدول categories
            // سنضيفها لاحقًا لأننا لم ننشئ جدول categories بعد
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps(); // ينشئ عمودين: created_at و updated_at (توقيت الإنشاء والتحديث)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
