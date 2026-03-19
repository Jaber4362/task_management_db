<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * عرض قائمة المهام
     */
    public function index()
    {
        $userId = Auth::id();

        $tasks = Task::with('category')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // تحويل due_date إلى Carbon لكل مهمة
        foreach ($tasks as $task) {
            if ($task->due_date) {
                $task->due_date = \Carbon\Carbon::parse($task->due_date);
            }
        }

        $categories = Auth::user()->categories()->orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * عرض نموذج إنشاء مهمة جديدة
     */
    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();

        return view('tasks.create', compact('categories'));
    }

    /**
     * حفظ مهمة جديدة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['completed'] = false;

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'تم إنشاء المهمة بنجاح!');
    }

    /**
     * عرض مهمة محددة
     */
    public function show(Task $task)
    {
        // التحقق من الصلاحية
        if ($task->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بمشاهدة هذه المهمة');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * عرض نموذج تعديل مهمة
     */
    public function edit(Task $task)
    {
        // التحقق من الصلاحية
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Auth::user()->categories()->orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * تحديث مهمة في قاعدة البيانات
     */
    public function update(Request $request, Task $task)
    {
        // التحقق من الصلاحية
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
            'due_date' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'تم تحديث المهمة بنجاح!');
    }

    /**
     * حذف مهمة
     */
    public function destroy(Task $task)
    {
        // التحقق من الصلاحية
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'تم حذف المهمة بنجاح!');
    }

    /**
     * تبديل حالة الإنجاز (مكتمل/غير مكتمل) - للـ AJAX
     */
    public function toggleComplete(Task $task)
    {
        // التحقق من الصلاحية
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $task->update([
            'completed' => !$task->completed
        ]);

        return response()->json([
            'success' => true,
            'completed' => $task->completed
        ]);
    }
}
