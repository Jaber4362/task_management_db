@extends('layouts.app')

@section('title', 'إضافة مهمة جديدة')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> إضافة مهمة جديدة</h4>
                </div>
                <div class="card-body">
                    {{-- نموذج إضافة مهمة --}}
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf {{-- حماية من هجمات CSRF --}}

                        {{-- حقل العنوان --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان المهمة <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="أدخل عنوان المهمة"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">العنوان يجب أن يكون واضحاً ومختصراً</small>
                        </div>

                        {{-- حقل الوصف --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="أدخل وصفاً تفصيلياً للمهمة (اختياري)">{{ old('description') }}</textarea>
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
                                    <option value="">-- اختر تصنيفاً (اختياري) --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <a href="{{ route('categories.create') }}" target="_blank">
                                        <i class="bi bi-plus"></i> إضافة تصنيف جديد
                                    </a>
                                </small>
                            </div>

                            {{-- حقل تاريخ الاستحقاق --}}
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                                <input type="date"
                                       class="form-control @error('due_date') is-invalid @enderror"
                                       id="due_date"
                                       name="due_date"
                                       value="{{ old('due_date') }}"
                                       min="{{ date('Y-m-d') }}">
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">اختر تاريخاً للانتهاء (اختياري)</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- أزرار التحكم --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-right"></i> رجوع
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> حفظ المهمة
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- نصائح سريعة --}}
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h5><i class="bi bi-lightbulb text-warning"></i> نصائح لكتابة مهمة جيدة:</h5>
                    <ul class="mb-0">
                        <li>اجعل العنوان واضحاً ومحدداً</li>
                        <li>أضف تفاصيل كافية في الوصف</li>
                        <li>حدد تاريخ استحقاق واقعي</li>
                        <li>اختر تصنيفاً مناسباً لتنظيم مهامك</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
