@extends('layouts.app')

@section('title', 'قائمة المهام')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="bi bi-list-task"></i> المهام</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> مهمة جديدة
            </a>
        </div>
    </div>

    <!-- فلتر التصنيفات -->
    <div class="row mb-3">
        <div class="col-md-4">
            <select class="form-select" id="categoryFilter">
                <option value="">جميع التصنيفات</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" id="statusFilter">
                <option value="">الكل</option>
                <option value="completed">مكتملة</option>
                <option value="pending">قيد التنفيذ</option>
            </select>
        </div>
    </div>

    <!-- جدول المهام -->
    <div class="card">
        <div class="card-body">
            @if($tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الحالة</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>تاريخ الاستحقاق</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                @php
                                    // تحويل due_date إلى كائن Carbon إذا كان موجوداً
                                    $dueDate = $task->due_date ? \Carbon\Carbon::parse($task->due_date) : null;
                                @endphp
                                <tr class="{{ $task->completed ? 'table-success' : '' }}">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   class="form-check-input toggle-complete"
                                                   data-task-id="{{ $task->id }}"
                                                   {{ $task->completed ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($task->category)
                                            <span class="badge bg-info">{{ $task->category->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">بدون تصنيف</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($dueDate)
                                            {{ $dueDate->format('Y-m-d') }}
                                            @if($dueDate->isPast() && !$task->completed)
                                                <span class="badge bg-danger">متأخرة</span>
                                            @endif
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- روابط تقسيم الصفحات -->
                <div class="d-flex justify-content-center">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h3 class="mt-3 text-muted">لا توجد مهام بعد</h3>
                    <p>ابدأ بإضافة مهمتك الأولى!</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> إضافة مهمة
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // تحديث حالة المهمة (مكتمل/غير مكتمل)
    $('.toggle-complete').change(function() {
        const taskId = $(this).data('task-id');
        const isChecked = $(this).prop('checked');
        const checkbox = $(this);

        $.ajax({
            url: `/tasks/${taskId}/toggle-complete`,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // تحديث لون الصف
                    const row = checkbox.closest('tr');
                    if(response.completed) {
                        row.addClass('table-success');
                    } else {
                        row.removeClass('table-success');
                    }
                }
            },
            error: function(xhr) {
                alert('حدث خطأ أثناء تحديث حالة المهمة');
                // إعادة checkbox لحالته السابقة
                checkbox.prop('checked', !isChecked);
            }
        });
    });

    // فلترة المهام (اختياري)
    $('#categoryFilter, #statusFilter').change(function() {
        // يمكن إضافة منطق الفلترة هنا
        console.log('تغيير الفلتر');
    });
});
</script>
@endpush
