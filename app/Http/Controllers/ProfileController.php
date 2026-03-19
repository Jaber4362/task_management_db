<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\Category;

class ProfileController extends Controller
{
    /**
     * عرض نموذج تعديل الملف الشخصي
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * تحديث الملف الشخصي
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * حذف الحساب
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * عرض لوحة التحكم مع الإحصائيات
     */
    public function dashboard()
    {
        $user = Auth::user();

        // إحصائيات المهام
        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('completed', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $overdueTasks = Task::where('user_id', $user->id)
                            ->where('completed', false)
                            ->where('due_date', '<', now())
                            ->count();

        // إحصائيات التصنيفات
        $totalCategories = Category::where('user_id', $user->id)->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // التصنيف الأكثر استخداماً
        $topCategory = Category::where('user_id', $user->id)
                               ->withCount('tasks')
                               ->orderBy('tasks_count', 'desc')
                               ->first();

        // المهام الأخيرة (آخر 5 مهام)
        $recentTasks = Task::where('user_id', $user->id)
                          ->with('category')
                          ->orderBy('created_at', 'desc')
                          ->limit(5)
                          ->get();

        // التصنيفات مع عدد المهام
        $categoriesWithCount = Category::where('user_id', $user->id)
                                      ->withCount('tasks')
                                      ->orderBy('tasks_count', 'desc')
                                      ->get();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'overdueTasks',
            'totalCategories',
            'completionRate',
            'topCategory',
            'recentTasks',
            'categoriesWithCount'
        ));
    }
}
