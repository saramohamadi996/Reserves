@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> ویرایش اطلاعات کاربری </h5>
                <button href="{{route('users.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">
                            <div class="col-6">
                                <label class="form-label"> نام نام خوانوادگی </label>
                                <input type="text" name="name" value="{{$user->name}}"
                                       class="form-control @error('name') is-invalid @enderror"/>
                                @error("name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> نام کاربری </label>
                                <input type="text" name="username" value="{{$user->username}}"
                                       class="form-control @error('username') is-invalid @enderror"/>
                                @error("username")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <label class="form-label"> موبایل </label>
                                <input type="text" name="mobile" value="{{$user->mobile}}"
                                       class="form-control @error('mobile') is-invalid @enderror"/>
                                @error("mobile")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <label class="form-label"> پسورد </label>
                                <input type="text" name="password" value="*********************************"
                                       class="form-control @error('password') is-invalid @enderror"/>
                                @error("password")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-5 col-6">
                                <label class="mb-2">نقش کاربری</label>
                                <select class="form-select" name="role">
                                    @foreach(\Gym\User\Models\User::$roles as $role)
                                        <option value="{{ $role }}"
                                                @if($role == $user->role) selected @endif
                                        >@lang($role)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5 col-6">
                                <label class="mb-2">وضعیت اکانت</label>
                                <select class="form-select" name="status">
                                    <option selected></option>
                                    @foreach(\Gym\User\Models\User::$statuses as $status)
                                        <option value="{{ $status }}"
                                                @if($status == $user->status) selected @endif
                                        >@lang($status)</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
{{--                    <div class="alert alert-muted">--}}
{{--                        <b>لطفا توجه داشته باشید:</b>--}}
{{--                        <br>--}}
{{--                        <span>--}}
{{--                        رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ،--}}
{{--                حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.--}}
{{--            </span>--}}
{{--                    </div>--}}
                </div>
                <div class="modal-footer">
                    <a href="{{route('users.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
