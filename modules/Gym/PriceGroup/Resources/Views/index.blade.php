@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-9">
                            <div id="bootstrapTable" class="mb-5">
                                <h4>لیست گروه های قیمت</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="me-auto">
                                            <a href="{{route('price_groups.store')}}" class="btn btn-outline-theme">
                                                <i class="fa fa-plus-circle me-1"></i>افزودن گروه قیمت جدید</a>
                                        </div>
                                        <table class="table col-6" data-toggle="table"
                                               data-sort-class="table-active"
                                               data-sortable="true" data-search="true" data-pagination="true"
                                               data-show-refresh="true" data-show-columns="true"
                                               data-show-fullscreen="true">
                                            <thead>
                                            <tr>
                                                <th data-sortable="true">نام کاربر</th>
                                                <th data-sortable="true">نام گروه قیمت</th>
                                                <th data-sortable="true">قیمت (ریال)</th>
                                                <th data-sortable="true">دسته بندی</th>
                                                <th data-sortable="true">وضعیت</th>
                                                <th data-sortable="true">ویرایش</th>
                                                <th data-sortable="true">حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($price_groups as $price_group)
                                                <tr>
                                                    <td>{{$price_group->user->name}}</td>
                                                    <td>{{$price_group->title}}</td>
                                                    <td>{{$price_group->price}}</td>
                                                    <td>{{$price_group->Category->title}}</td>

                                                    <td class="nav-item">
                                                        <a class="nav-link active text-green "
                                                           @if($price_group->status == 1)
                                                               href="{{route('price_groups.toggle',[$price_group->id])}}"
                                                           disabled @endif
                                                           href="{{route('price_groups.toggle',[$price_group->id])}}">
                                                            @if($price_group->status == 1)
                                                                فعال
                                                            @else
                                                                <span class="text-warning">غیرفعال</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('price_groups.update', $price_group->id)}}"
                                                           class="btn btn-outline-theme">ویرایش</a>
                                                    </td>
                                                    <td>
                                                        <form method="post"
                                                              action="{{ route('price_groups.destroy', $price_group->id) }}">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-outline-danger m-b-xs">حذف
                                                            </button>
                                                        </form>
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
