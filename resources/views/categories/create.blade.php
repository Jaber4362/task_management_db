@extends('layouts.app')

@section('title', 'إضافة تصنيف جديد')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-folder-plus"></i> إضافة تصنيف جديد</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <!-- اسم التصنيف -->
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم التصنيف <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="مثال: عمل، دراسة، تسوق، شخصي"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                اختر اسماً واضحاً ومميزاً للتصنيف
                            </small>
                        </div>

                        <!-- وصف التصنيف -->
                        <div class="mb-3">
                            <label for="description" class="form-label">وصف التصنيف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="وصف مختصر للتصنيف (اختياري)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                وصف قصير يساعدك في فهم نوع مهام هذا التصنيف
                            </small>
                        </div>

                        <!-- ألوان مقترحة (اختياري - يمكن إضافته مستقبلاً) -->
                        <div class="mb-4">
                            <label class="form-label">ألوان مقترحة</label>
                            <div class="d-flex gap-2">
                                <div class="color-option" style="width: 30px; height: 30px; background: #dc3545; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#dc3545'"></div>
                                <div class="color-option" style="width: 30px; height: 30px; background: #fd7e14; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#fd7e14'"></div>
                                <div class="color-option" style="width: 30px; height: 30px; background: #ffc107; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#ffc107'"></div>
                                <div class="color-option" style="width: 30px; height: 30px; background: #198754; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#198754'"></div>
                                <div class="color-option" style="width: 30px; height: 30px; background: #0d6efd; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#0d6efd'"></div>
                                <div class="color-option" style="width: 30px; height: 30px; background: #6610f2; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('color').value='#6610f2'"></div>
                            </div>
                            <input type="hidden" name="color" id="color" value="{{ old('color', '#0d6efd') }}">
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-right"></i> رجوع
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> حفظ التصنيف
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- أمثلة على تصنيفات مفيدة -->
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h5><i class="bi bi-lightbulb text-warning"></i> أفكار لتصنيفات مفيدة:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-briefcase text-primary"></i> العمل</li>
                                <li><i class="bi bi-book text-success"></i> دراسة</li>
                                <li><i class="bi bi-house text-warning"></i> منزل</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-cart text-danger"></i> تسوق</li>
                                <li><i class="bi bi-heart text-danger"></i> شخصي</li>
                                <li><i class="bi bi-people text-info"></i> عائلة</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-graph-up text-success"></i> مشاريع</li>
                                <li><i class="bi bi-calendar-week text-primary"></i> مواعيد</li>
                                <li><i class="bi bi-activity text-warning"></i> رياضة</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.color-option:hover {
    transform: scale(1.2);
    transition: transform 0.2s;
    border: 2px solid #333;
}
</style>
@endpush
@endsection
