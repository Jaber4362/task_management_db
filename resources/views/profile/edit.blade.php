@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-circle"></i> الملف الشخصي</h4>
                </div>
                <div class="card-body">

                    <!-- معلومات المستخدم -->
                    <div class="text-center mb-4">
                        <div class="display-1 text-primary">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h3>{{ Auth::user()->name }}</h3>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        <p class="text-muted">
                            <small>عضو منذ: {{ Auth::user()->created_at->format('Y-m-d') }}</small>
                        </p>
                    </div>

                    <hr>

                    <!-- نموذج تحديث الملف الشخصي -->
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="bi bi-pencil"></i> تعديل المعلومات الشخصية</h5>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <hr>

                    <!-- نموذج تغيير كلمة المرور -->
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="bi bi-key"></i> تغيير كلمة المرور</h5>
                        @include('profile.partials.update-password-form')
                    </div>

                    <hr>

                    <!-- نموذج حذف الحساب (منطقة خطر) -->
                    <div class="mb-3">
                        <h5 class="mb-3 text-danger"><i class="bi bi-exclamation-triangle"></i> حذف الحساب</h5>
                        <div class="bg-light p-3 rounded">
                            <p class="text-muted">بمجرد حذف حسابك، سيتم حذف جميع بياناتك بشكل نهائي ولا يمكن استرجاعها.</p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
