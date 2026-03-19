@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="container">
    <!-- عنوان الصفحة -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-4"><i class="bi bi-speedometer2"></i> لوحة التحكم</h1>
            <p class="text-muted">مرحباً بك، {{ Auth::user()->name }}! إليك ملخص سريع لنشاطك.</p>
        </div>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="row g-4 mb-4">
        <!-- إجمالي المهام -->
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">إجمالي المهام</h6>
                            <h2 class="mb-0">{{ $totalTasks }}</h2>
                        </div>
                        <i class="bi bi-list-task fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- المهام المكتملة -->
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">مهام مكتملة</h6>
                            <h2 class="mb-0">{{ $completedTasks }}</h2>
                        </div>
                        <i class="bi bi-check-circle fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- المهام قيد التنفيذ -->
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">قيد التنفيذ</h6>
                            <h2 class="mb-0">{{ $pendingTasks }}</h2>
                        </div>
                        <i class="bi bi-hourglass-split fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- المهام المتأخرة -->
        <div class="col-md-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">مهام متأخرة</h6>
                            <h2 class="mb-0">{{ $overdueTasks }}</h2>
                        </div>
                        <i class="bi bi-exclamation-triangle fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الصف الثاني من البطاقات -->
    <div class="row g-4 mb-4">
        <!-- إجمالي التصنيفات -->
        <div class="col-md-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">إجمالي التصنيفات</h6>
                            <h2 class="mb-0">{{ $totalCategories }}</h2>
                        </div>
                        <i class="bi bi-tags fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- نسبة الإنجاز -->
        <div class="col-md-4">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">نسبة الإنجاز</h6>
                            <h2 class="mb-0">{{ $completionRate }}%</h2>
                        </div>
                        <i class="bi bi-pie-chart fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- التصنيف الأكثر استخداماً -->
        <div class="col-md-4">
            <div class="card bg-dark text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">التصنيف الأكثر استخداماً</h6>
                            @if($topCategory)
                                <h5 class="mb-0">{{ $topCategory->name }}</h5>
                                <small>{{ $topCategory->tasks_count }} مهام</small>
                            @else
                                <h5 class="mb-0">لا يوجد</h5>
                            @endif
                        </div>
                        <i class="bi bi-star fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- صف المخططات والمهام الأخيرة -->
    <div class="row">
        <!-- المهام الأخيرة -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history"></i> أحدث المهام</h5>
                </div>
                <div class="card-body">
                    @if($recentTasks->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($recentTasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                            {{ $task->title }}
                                        </a>
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i> {{ $task->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                                        {{ $task->completed ? 'مكتملة' : 'قيد التنفيذ' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted text-center py-3">لا توجد مهام بعد</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary">عرض كل المهام</a>
                </div>
            </div>
        </div>

        <!-- التصنيفات مع عدد المهام -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart"></i> التصنيفات وعدد المهام</h5>
                </div>
                <div class="card-body">
                    @if($categoriesWithCount->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($categoriesWithCount as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-folder"></i>
                                        <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $category->tasks_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted text-center py-3">لا توجد تصنيفات بعد</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-success">عرض كل التصنيفات</a>
                </div>
            </div>
        </div>
    </div>

    <!-- صف روابط سريعة -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-link"></i> روابط سريعة</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> إضافة مهمة جديدة
                        </a>
                        <a href="{{ route('categories.create') }}" class="btn btn-success">
                            <i class="bi bi-folder-plus"></i> إضافة تصنيف جديد
                        </a>
                        <a href="{{ route('tasks.index') }}" class="btn btn-warning">
                            <i class="bi bi-list-task"></i> عرض كل المهام
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-info">
                            <i class="bi bi-tags"></i> عرض كل التصنيفات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
