<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// لوحة التحكم - المعدلة
Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// مجموعة routes التي تحتاج مصادقة
Route::middleware('auth')->group(function () {

    // ملف المستخدم (من Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes المهام
    Route::resource('tasks', TaskController::class);

    // Routes التصنيفات
    Route::resource('categories', CategoryController::class);

    // Route إضافي لتغيير حالة المهمة
    Route::patch('/tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])
         ->name('tasks.toggle-complete');
});

// Routes المصادقة
require __DIR__.'/auth.php';
