@extends('Dashboard::master')
@section('content')

    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">

                            <div id="general" class="mb-5">
                                <h4><i class="far fa-user fa-fw text-theme"></i>لیست کاربران</h4>
                                <p>اطلاعات عمومی کاربران خود را مشاهده و به روز کنید.</p>
                                @foreach($users as $user)
                                    <div class="card my-1 col-lg-12">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item d-lg-flex align-items-center">

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-2 text-lg-center py-2">
                                                    <div>نام و نام خانوادگی</div>
                                                    <div class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        {{$user->name}}
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-2 text-lg-center py-2">
                                                    <div>نام کاربری</div>
                                                    <div class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        {{$user->username}}
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-1 text-lg-center py-2">
                                                    <div>نقش</div>
                                                    <div class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        @lang($user->role)
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-2 text-lg-center py-2">
                                                    <div>موبایل</div>
                                                    <div class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        @isset($user->mobile)
                                                            {{$user->mobile}}
                                                        @endisset
                                                        @empty($user->mobile)
                                                            <span>***********</span>
                                                        @endempty
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-1 text-lg-center py-2">
                                                    <div>وضعیت</div>
                                                    <div
                                                        class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        @lang($user->status)
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex flex-lg-column text-break col-lg-2 text-lg-center py-2">
                                                    <div>موجودی</div>
                                                    <div class="text-white text-opacity-50">
                                                        <i class="d-lg-none fas fa-lg fa-fw me-2 fa-caret-left"></i>
                                                        {{number_format($user->balance)}}
                                                        ریال
                                                    </div>
                                                </div>

                                                <div class=" ms-auto w-100px">
                                                    <a href="{{route('wallets.create', $user->id)}}"
                                                       class="btn btn-outline-theme">کیف پول</a>
                                                </div>

                                                <div class=" ms-auto w-100px">
                                                    <a href="{{route('users.update', $user->id)}}"
                                                       class="btn btn-outline-default">ویرایش</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @include("User::Admin.pagiresult")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






