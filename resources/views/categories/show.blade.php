@extends('layouts.app')

@section('title', 'تصنيف: ' . $category->name)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">التصنيفات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> تعديل التصنيف
            </a>
            <a href="{{ route('tasks.create', ['category_id' => $category->id]) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> إضافة مهمة في هذا التصنيف
            </a>
        </div>
    </div>

    <div class="row">
        <!-- معلومات التصنيف -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> معلومات التصنيف</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $category->name }}</h3>

                    @if($category->description)
                        <p class="text-muted">{{ $category->description }}</p>
                    @else
                        <p class="text-muted fst-italic">لا يوجد وصف</p>
                    @endif

                    <hr>

                    <div class="mb-2">
                        <i class="bi bi-calendar"></i>
                        <strong>تاريخ الإنشاء:</strong> {{ $category->created_at->format('Y-m-d') }}
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-arrow-repeat"></i>
                        <strong>آخر تحديث:</strong> {{ $category->updated_at->diffForHumans() }}
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-list-task"></i>
                        <strong>عدد المهام:</strong> {{ $tasks->total() }}
                    </div>

                    @php
                        $completedCount = $category->tasks()->where('completed', true)->count();
                        $pendingCount = $tasks->total() - $completedCount;
                        $progress = $tasks->total() > 0 ? round(($completedCount / $tasks->total()) * 100) : 0;
                    @endphp

                    <hr>

                    <!-- إحصائيات المهام -->
                    <h6>إحصائيات الإنجاز:</h6>
                    <div class="mb-2">
                        <span class="badge bg-success">مكتمل: {{ $completedCount }}</span>
                        <span class="badge bg-warning">قيد التنفيذ: {{ $pendingCount }}</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-success"
                             role="progressbar"
                             style="width: {{ $progress }}%"
                             aria-valuenow="{{ $progress }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- قائمة المهام في هذا التصنيف -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-list-task"></i> مهام التصنيف</h5>
                    <a href="{{ route('tasks.create', ['category_id' => $category->id]) }}" class="btn btn-sm btn-light">
                        <i class="bi bi-plus"></i> إضافة مهمة
                    </a>
                </div>
                <div class="card-body">
                    @if($tasks->count() > 0)
                        <div class="list-group">
                            @foreach($tasks as $task)
                                <div class="list-group-item list-group-item-action {{ $task->completed ? 'list-group-item-success' : '' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">
                                                <input type="checkbox"
                                                       class="form-check-input me-2 toggle-complete"
                                                       data-task-id="{{ $task->id }}"
                                                       {{ $task->completed ? 'checked' : '' }}>
                                                <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                                    {{ $task->title }}
                                                </a>
                                            </h6>
                                            @if($task->description)
                                                <p class="mb-1 text-muted small">{{ Str::limit($task->description, 100) }}</p>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            @if($task->due_date)
                                                <small class="d-block {{ $task->due_date->isPast() && !$task->completed ? 'text-danger' : 'text-muted' }}">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ $task->due_date->format('Y-m-d') }}
                                                </small>
                                            @endif
                                            <div class="mt-2">
                                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- روابط تقسيم الصفحات -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $tasks->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <h4 class="mt-3 text-muted">لا توجد مهام في هذا التصنيف</h4>
                            <p>أضف أول مهمة في تصنيف "{{ $category->name }}"</p>
                            <a href="{{ route('tasks.create', ['category_id' => $category->id]) }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> إضافة مهمة
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.toggle-complete').change(function() {
        const taskId = $(this).data('task-id');
        const isChecked = $(this).prop('checked');

        $.ajax({
            url: `/tasks/${taskId}/toggle-complete`,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                const listItem = $(`input[data-task-id="${taskId}"]`).closest('.list-group-item');
                if(response.completed) {
                    listItem.addClass('list-group-item-success');
                } else {
                    listItem.removeClass('list-group-item-success');
                }
            },
            error: function() {
                alert('حدث خطأ. يرجى المحاولة مرة أخرى.');
                $(this).prop('checked', !isChecked);
            }
        });
    });
});
</script>
@endpush
