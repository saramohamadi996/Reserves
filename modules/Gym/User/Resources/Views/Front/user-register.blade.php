@extends('Dashboard::master')
@section('content')
    <div id="app" class="app app-full-height app-without-header">
        <div class="register">
            <div class="register-content">
                <form method="post" action="{{ route('user_register') }}" name="register_form">
                    @csrf
                    <h1 class="text-center">ثبت نام</h1>
                    <p class="text-white text-opacity-50 text-center">
                        یک شناسه مدیریت تمام چیزی است که برای دسترسی به خدمات مجموعه نیاز دارید
                    </p>

                    <div class="mb-3">
                        <label class="form-label">نام نام خوانوادگی<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" name="name" value="{{old('name')}}" class="form-control form-control-lg bg-white bg-opacity-5 "
                                autofocus/>
                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نام کاربری<span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" name="username" class="form-control form-control-lg bg-white bg-opacity-5"
                               placeholder="نام کاربری" value="{{old('username')}}" />
                        @if ($errors->has('username'))
                            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره موبایل </label>
                        <input type="text" autocomplete="off" name="mobile" class="form-control form-control-lg bg-white bg-opacity-5"
                               placeholder="091212345678" value="{{old('mobile')}}"/>
                        @if ($errors->has('mobile'))
                            <span class="text-danger text-left">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100">ثبت نام</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
