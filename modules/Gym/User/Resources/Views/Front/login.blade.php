@extends('Dashboard::master')
@section('content')
    <div id="app" class="app app-full-height app-without-header">
        <div class="register">
            <div class="register-content">
                <form method="post" action="{{ route('login') }}" name="register_form">
                    @csrf
                    <h1 class="text-center">ورود</h1>
                    <div class="text-white text-opacity-50 text-center mb-4">
                        برای حفاظت از شما، لطفا هویت خود را تأیید کنید.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نام کاربری یا شماره موبایل<span class="text-danger">*</span></label>
                        <input id="mobile" type="text" autocomplete="off"
                               class="form-control form-control-lg bg-white bg-opacity-5
                         @error('mobile') is-invalid @enderror" name="mobile"
                               placeholder=" شماره موبایل" value="{{ old('mobile') }}" required
                               autofocus>
                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">پسورد <span class="text-danger">*</span></label>
                        <input type="password" autocomplete="off" name="password" id="password"
                               class="form-control form-control-lg bg-white bg-opacity-5
                               @error('password') is-invalid @enderror"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="customCheck1">مرا به خاطر بسپار</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">ورود</button>
                    <div class="text-center text-white text-opacity-50">
                        حساب کاربری ندارید؟ <a href="{{url('/register')}}">ثبت نام</a>.
                    </div>
                </form>
            </div>
        </div>
@endsection
