@extends('layouts.app')

@section('title', 'تعديل المهمة')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> تعديل المهمة: {{ $task->title }}</h4>
                </div>
                <div class="card-body">
                    {{-- نموذج تعديل مهمة --}}
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- لأن المتصفحات لا تدعم PUT مباشرة --}}

                        {{-- حقل العنوان --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان المهمة <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $task->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- حقل الوصف --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- حقل التصنيف --}}
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">التصنيف</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id"
                                        name="category_id">
                                    <option value="">-- بدون تصنيف --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- حقل تاريخ الاستحقاق --}}
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                                <input type="date"
                                       class="form-control @error('due_date') is-invalid @enderror"
                                       id="due_date"
                                       name="due_date"
                                       value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- حالة الإنجاز --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="completed"
                                       name="completed"
                                       value="1"
                                       {{ old('completed', $task->completed) ? 'checked' : '' }}>
                                <label class="form-check-label" for="completed">
                                    <i class="bi bi-check-circle"></i> مهمة مكتملة
                                </label>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- أزرار التحكم --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-info">
                                <i class="bi bi-eye"></i> عرض التفاصيل
                            </a>
                            <div>
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-right"></i> رجوع
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> تحديث المهمة
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- قسم الحذف --}}
                    <hr class="my-4">
                    <div class="bg-light p-3 rounded">
                        <h5 class="text-danger"><i class="bi bi-exclamation-triangle"></i> منطقة خطر</h5>
                        <p class="text-muted">حذف المهمة لا يمكن التراجع عنه!</p>
                        <form action="{{ route('tasks.destroy', $task) }}"
                              method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة نهائياً؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> حذف المهمة
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
