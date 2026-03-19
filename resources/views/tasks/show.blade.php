@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- بطاقة المهمة --}}
            <div class="card">
                <div class="card-header {{ $task->completed ? 'bg-success' : 'bg-primary' }} text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-card-text"></i> {{ $task->title }}
                        </h4>
                        <span class="badge {{ $task->completed ? 'bg-light text-success' : 'bg-warning' }} fs-6">
                            {{ $task->completed ? 'مكتملة ✓' : 'قيد التنفيذ' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    {{-- معلومات سريعة --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <i class="bi bi-folder"></i> <strong>التصنيف:</strong>
                                @if($task->category)
                                    <span class="badge bg-info">{{ $task->category->name }}</span>
                                @else
                                    <span class="badge bg-secondary">بدون تصنيف</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <i class="bi bi-calendar"></i> <strong>تاريخ الإنشاء:</strong>
                                {{ $task->created_at->format('Y-m-d h:i A') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <i class="bi bi-calendar-check"></i> <strong>تاريخ الاستحقاق:</strong>
                                @if($task->due_date)
                                    {{ $task->due_date->format('Y-m-d') }}
                                    @if($task->due_date->isPast() && !$task->completed)
                                        <span class="badge bg-danger">متأخرة</span>
                                    @endif
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <i class="bi bi-arrow-repeat"></i> <strong>آخر تحديث:</strong>
                                {{ $task->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    {{-- وصف المهمة --}}
                    <div class="mb-4">
                        <h5><i class="bi bi-chat-text"></i> الوصف:</h5>
                        <div class="p-3 bg-light rounded">
                            @if($task->description)
                                {{ $task->description }}
                            @else
                                <p class="text-muted mb-0"><i>لا يوجد وصف لهذه المهمة</i></p>
                            @endif
                        </div>
                    </div>

                    {{-- أزرار التحكم --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i> العودة للقائمة
                        </a>
                        <div>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> تعديل
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- يمكن إضافة تعليقات أو ملاحظات هنا مستقبلاً --}}
        </div>
    </div>
</div>
@endsection
