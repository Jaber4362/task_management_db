<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * عرض قائمة التصنيفات
     */
    public function index()
    {
        $categories = Auth::user()->categories()
                            ->withCount('tasks')
                            ->orderBy('name')
                            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * عرض نموذج إنشاء تصنيف جديد
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * حفظ تصنيف جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'تم إنشاء التصنيف بنجاح!');
    }

    /**
     * عرض تصنيف محدد مع مهامه
     */
    public function show(Category $category)
    {
        // التحقق من الصلاحية
        if ($category->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بمشاهدة هذا التصنيف');
        }

        $tasks = $category->tasks()->orderBy('created_at', 'desc')->paginate(10);

        return view('categories.show', compact('category', 'tasks'));
    }

    /**
     * عرض نموذج تعديل تصنيف
     */
    public function edit(Category $category)
    {
        // التحقق من الصلاحية
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * تحديث تصنيف
     */
    public function update(Request $request, Category $category)
    {
        // التحقق من الصلاحية
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'تم تحديث التصنيف بنجاح!');
    }

    /**
     * حذف تصنيف
     */
    public function destroy(Category $category)
    {
        // التحقق من الصلاحية
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        // قبل حذف التصنيف، نجعل جميع مهامه بلا تصنيف
        $category->tasks()->update(['category_id' => null]);

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'تم حذف التصنيف بنجاح!');
    }
}
