<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <!-- كلمة المرور الحالية -->
        <div class="mb-3">
            <label for="current_password" class="form-label">كلمة المرور الحالية</label>
            <input type="password"
                   class="form-control @error('current_password') is-invalid @enderror"
                   id="current_password"
                   name="current_password"
                   required>
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- كلمة المرور الجديدة -->
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور الجديدة</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- تأكيد كلمة المرور الجديدة -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
            <input type="password"
                   class="form-control"
                   id="password_confirmation"
                   name="password_confirmation"
                   required>
        </div>

        <!-- زر الحفظ -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> تحديث كلمة المرور
            </button>
        </div>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-3">
                تم تحديث كلمة المرور بنجاح
            </div>
        @endif
    </form>
</section>
