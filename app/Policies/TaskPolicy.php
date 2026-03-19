<?php
// app/Policies/TaskPolicy.php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * هل يمكن للمستخدم عرض قائمة المهام؟
     * أي مستخدم مسجل دخوله يمكنه رؤية قائمة مهامه
     */
    public function viewAny(User $user): bool
    {
        // أي مستخدم مسجل دخوله يمكنه رؤية قائمة مهامه
        return true;
    }

    /**
     * هل يمكن للمستخدم عرض مهمة محددة؟
     * نتحقق أن user_id في المهمة يطابق id المستخدم الحالي
     */
    public function view(User $user, Task $task): bool
    {
        // هل المستخدم الحالي هو صاحب المهمة؟
        return $user->id === $task->user_id;
    }

    /**
     * هل يمكن للمستخدم إنشاء مهمة جديدة؟
     * أي مستخدم مسجل دخوله يمكنه الإنشاء
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * هل يمكن للمستخدم تحديث مهمة؟
     * فقط صاحب المهمة
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * هل يمكن للمستخدم حذف مهمة؟
     * فقط صاحب المهمة
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * هل يمكن للمستخدم استعادة مهمة محذوفة (soft delete)؟
     * فقط صاحب المهمة
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * هل يمكن للمستخدم حذف مهمة نهائيًا؟
     * فقط صاحب المهمة
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
