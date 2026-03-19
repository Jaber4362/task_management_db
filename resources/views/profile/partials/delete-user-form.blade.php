<section>
    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
        @csrf
        @method('delete')

        <!-- تحذير -->
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <strong>تحذير!</strong> هذا الإجراء لا يمكن التراجع عنه.
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="mb-3">
            <label for="password" class="form-label">أدخل كلمة المرور لتأكيد الحذف</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="كلمة المرور"
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- زر الحذف -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger"
                    onclick="return confirm('هل أنت متأكد من حذف حسابك؟ هذا الإجراء لا يمكن التراجع عنه.')">
                <i class="bi bi-trash"></i> حذف الحساب نهائياً
            </button>
        </div>
    </form>
</section>
