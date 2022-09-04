@extends('Dashboard::master')
@section('content')
    <div class=" me-5 ms-5 pe-3">
        <div class=" col-lg-10 ms-auto pe-lg-5 me-2 p-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card my-1 col-lg-12 p-3">

                                <div id="general" class="mb-5">
                                    <div class="d-lg-flex mb-3">

                                        <div class="col-lg-3 ms-lg-auto me-lg-auto">
                                            <h4><i class="far fa-user fa-fw text-theme"></i>لیست کاربران</h4>
                                        </div>
                                        <div class="col-lg-3 ms-lg-auto me-lg-auto">
                                            <div class="nav-item">
                                                {{--                                      <select class="livesearch form-control" id="user" name="livesearch"></select>--}}
                                                <form action="{{route('users.search')}}" method="get" class="">
                                                    @csrf
                                                    <div class="t-header-searchbox font-size-13">
                                                        <input type="text" class="text" name="name">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ms-lg-auto me-lg-auto">
                                            <a href="{{url('/user_register')}}" class="btn btn-outline-theme">
                                                <i class="fa fa-plus-circle me-1"></i>ثبت نام کاربر جدید</a>
                                        </div>
                                    </div>
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
                                                    <div class="d-flex text-break col-lg-2 text-lg-center py-2">

                                                        <div class="ms-auto w-auto">
                                                            <a href="{{route('wallets.create', $user->id)}}"
                                                               class="btn btn-outline-theme">ولت</a>
                                                        </div>

                                                        <div class="w-auto pe-1">
                                                            <a href="{{route('users.update', $user->id)}}"
                                                               class="btn btn-outline-default">ویرایش</a>
                                                        </div>
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


                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






