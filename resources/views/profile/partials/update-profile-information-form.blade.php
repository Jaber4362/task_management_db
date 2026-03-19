<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- حقل الاسم -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل البريد الإلكتروني -->
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small">
                        بريدك الإلكتروني غير موثق.
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            اضغط هنا لإعادة إرسال رابط التوثيق
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <!-- زر الحفظ -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> حفظ التغييرات
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success mt-3">
                تم تحديث الملف الشخصي بنجاح
            </div>
        @endif
    </form>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
    @endif
</section>
