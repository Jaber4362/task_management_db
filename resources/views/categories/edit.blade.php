@extends('layouts.app')

@section('title', 'تعديل التصنيف')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> تعديل التصنيف: {{ $category->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- اسم التصنيف -->
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم التصنيف <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $category->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- وصف التصنيف -->
                        <div class="mb-3">
                            <label for="description" class="form-label">وصف التصنيف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-info">
                                <i class="bi bi-eye"></i> عرض التفاصيل
                            </a>
                            <div>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-right"></i> رجوع
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> تحديث التصنيف
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- منطقة الخطر: حذف التصنيف -->
                    <hr class="my-4">
                    <div class="bg-light p-3 rounded">
                        <h5 class="text-danger"><i class="bi bi-exclamation-triangle"></i> حذف التصنيف</h5>
                        <p class="text-muted">
                            عند حذف هذا التصنيف، ستصبح جميع المهام المرتبطة به <strong>بدون تصنيف</strong>.
                            لا يتم حذف المهام.
                        </p>
                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا التصنيف؟\nسيتم إزالة التصنيف من جميع المهام المرتبطة به')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> حذف التصنيف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
