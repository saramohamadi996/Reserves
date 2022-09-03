@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="bootstrapTable" class="mb-5">
                                <h4>لیست خدمات</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="me-auto">
                                            <a href="{{ route('services.create.step.one') }}" class="btn btn-outline-theme">
                                                <i class="fa fa-plus-circle me-1"></i>افزودن خدمت جدید</a>
                                        </div>
                                        <table class="table col-6" data-toggle="table"
                                               data-sort-class="table-active"
                                               data-sortable="true" data-search="true" data-pagination="true"
                                               data-show-refresh="true" data-show-columns="true"
                                               data-show-fullscreen="true">
                                            <thead>
                                            <tr>
                                                <th data-sortable="true">ترتیب نمایش</th>
                                                <th data-sortable="true">کد خدمت</th>
                                                <th data-sortable="true">عنوان</th>
                                                <th data-sortable="true">دسته بندی</th>
                                                <th data-sortable="true">افزودن</th>
                                                <th data-sortable="true">وضعیت</th>
                                                <th data-sortable="true">ویرایش</th>
{{--                                                <th data-sortable="true">حذف</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($services as $service)
                                                <tr>
                                                    <td>{{$service->priority}}</td>
                                                    <td>{{$service->code_service}}</td>
                                                    <td>{{$service->title}}</td>
                                                    <td>{{$service->Category->title}}</td>
                                                    <td>
                                                        <a href="{{ route('services.details', $service->id) }}"
                                                           class="">افزودن سانس جدید</a>
                                                    </td>

                                                    <td class="nav-item">
                                                        <a class="nav-link active text-green "
                                                           @if($service->is_enabled == 1)
                                                               href="{{route('services.toggle',[$service->id])}}"
                                                           disabled @endif
                                                           href="{{route('services.toggle',[$service->id])}}">
                                                            @if($service->is_enabled == 1)
                                                                فعال
                                                            @else
                                                                <span class="text-warning">غیرفعال</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('services.update', $service->id)}}"
                                                           class="btn btn-outline-theme">ویرایش</a>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <form method="post"--}}
{{--                                                              action="{{ route('services.destroy', $service->id) }}">--}}
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
