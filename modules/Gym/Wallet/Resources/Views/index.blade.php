@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="bootstrapTable" class="mb-5">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="me-auto mb-0">
                                            <a href="" class="btn btn-outline-theme">
                                                لیست کیف پول کاربران</a>
                                        </div>
                                        <table class="table mt-0" data-toggle="table" data-sort-class="table-active"
                                               data-sortable="true" data-search="true" data-pagination="true"
                                               data-show-refresh="true" data-show-columns="true"
                                               data-show-fullscreen="true">
                                            <thead>
                                            <tr>
                                                <th data-sortable="true">نام ادمین</th>
                                                <th data-sortable="true">نام کاربر</th>
                                                <th data-sortable="true">نوع حساب</th>
                                                <th data-sortable="true">مبلغ شارژ</th>
                                                <th data-sortable="true">تاریخ واریز</th>
                                                <th data-sortable="true">توضیحات</th>
                                                <th data-sortable="true">وضعیت</th>
                                                <th data-sortable="true">ویرایش</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($wallets as $wallet)
                                                <tr>
                                                    <td>{{$wallet->admin_id}}</td>
                                                    <td>{{$wallet->user->name}}</td>
                                                    <td>@lang($wallet->type)</td>
                                                    <td>{{number_format($wallet->amount)}}
                                                        ریال
                                                    </td>
                                                    <td>
                                                        {{jdate($wallet->date_payment)->format("Y/m/d")}}
                                                    </td>
                                                    <td>{{$wallet->description}}
                                                    </td>
                                                    <td class="nav-item">
                                                        <a class="nav-link active text-green"
                                                           @if($wallet->status == 1)href="{{route('wallets.toggle',[$wallet->id])}}"
                                                           disabled @endif
                                                           href="{{route('wallets.toggle',[$wallet->id])}}">
                                                            @if($wallet->status == 1)
                                                                فعال
                                                            @else
                                                                <span class="text-warning">غیرفعال</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('wallets.update', $wallet->id)}}"
                                                           class="btn btn-outline-theme">ویرایش</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
