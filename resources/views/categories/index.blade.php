@extends('layouts.app')

@section('title', 'التصنيفات')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="bi bi-tags"></i> التصنيفات</h1>
            <p class="text-muted">نظم مهامك باستخدام التصنيفات</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> تصنيف جديد
            </a>
        </div>
    </div>

    <!-- إحصائيات سريعة -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">إجمالي التصنيفات</h6>
                            <h2 class="mb-0">{{ $categories->total() }}</h2>
                        </div>
                        <i class="bi bi-tags fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">إجمالي المهام</h6>
                            <h2 class="mb-0">{{ Auth::user()->tasks()->count() }}</h2>
                        </div>
                        <i class="bi bi-check2-square fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">المتوسط لكل تصنيف</h6>
                            <h2 class="mb-0">
                                {{ $categories->count() > 0 ? round(Auth::user()->tasks()->count() / $categories->total(), 1) : 0 }}
                            </h2>
                        </div>
                        <i class="bi bi-bar-chart fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- شبكة التصنيفات -->
    @if($categories->count() > 0)
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 {{ $category->tasks_count > 0 ? 'border-primary' : '' }}">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-folder"></i> {{ $category->name }}
                            </h5>
                            <span class="badge bg-primary rounded-pill">
                                {{ $category->tasks_count }} مهام
                            </span>
                        </div>
                        <div class="card-body">
                            @if($category->description)
                                <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                            @else
                                <p class="card-text text-muted fst-italic">
                                    <i class="bi bi-chat"></i> لا يوجد وصف
                                </p>
                            @endif

                            <!-- شريط تقدم المهام المكتملة في هذا التصنيف -->
                            @php
                                $totalTasks = $category->tasks_count;
                                $completedTasks = $category->tasks()->where('completed', true)->count();
                                $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                            @endphp

                            @if($totalTasks > 0)
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small>تقدم الإنجاز</small>
                                        <small>{{ $completedTasks }}/{{ $totalTasks }} ({{ $progress }}%)</small>
                                    </div>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-success"
                                             role="progressbar"
                                             style="width: {{ $progress }}%"
                                             aria-valuenow="{{ $progress }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categories.show', $category) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> عرض المهام
                                </a>
                                <div>
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا التصنيف؟\nسيتم إزالة التصنيف من جميع المهام المرتبطة به')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- روابط تقسيم الصفحات -->
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-folder2-open display-1 text-muted"></i>
            </div>
            <h3 class="text-muted">لا توجد تصنيفات بعد</h3>
            <p class="lead">التصنيفات تساعدك في تنظيم مهامك بشكل أفضل</p>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> إنشاء أول تصنيف
            </a>
        </div>
    @endif
</div>
@endsection
