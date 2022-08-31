@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-9">
                            <div id="bootstrapTable" class="mb-5">
                                <h4>لیست دسته بندی ها</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="me-auto">
                                            <a href="{{route('categories.store')}}" class="btn btn-outline-theme">
                                                <i class="fa fa-plus-circle me-1"></i>افزودن دسته بندی جدید</a>
                                        </div>
                                        <table class="table col-6" data-toggle="table"
                                               data-sort-class="table-active"
                                               data-sortable="true" data-search="true" data-pagination="true"
                                               data-show-refresh="true" data-show-columns="true"
                                               data-show-fullscreen="true">
                                            <thead>
                                            <tr>
                                                <th data-sortable="true">نام دسته بندی</th>
                                                <th data-sortable="true">اسلاگ</th>
                                                <th data-sortable="true">دسته بندی والد</th>
                                                <th data-sortable="true">وضعیت</th>
                                                <th data-sortable="true">ویرایش</th>
{{--                                                <th data-sortable="true">حذف</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $category)
                                                <tr>
                                                    <td>{{$category->title}}</td>
                                                    <td>{{$category->slug}}</td>
                                                    <td>{{$category->parent}}</td>
                                                    <td class="nav-item">
                                                        <a class="nav-link active text-green"
                                                           @if($category->is_enabled == 1)href="{{route('categories.toggle',[$category->id])}}"
                                                           disabled @endif
                                                           href="{{route('categories.toggle',[$category->id])}}">
                                                            @if($category->is_enabled == 1)
                                                                فعال
                                                            @else
                                                                <span class="text-warning">غیرفعال</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('categories.update', $category->id)}}"
                                                           class="btn btn-outline-theme">ویرایش</a>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <form method="post"--}}
{{--                                                              action="{{ route('categories.destroy', $category->id) }}">--}}
{{--                                                            @method('delete')--}}
{{--                                                            @csrf--}}
{{--                                                            <button type="submit"--}}
{{--                                                                    class="btn btn-outline-danger m-b-xs">حذف--}}
{{--                                                            </button>--}}
{{--                                                        </form>--}}
{{--                                                    </td>--}}
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
