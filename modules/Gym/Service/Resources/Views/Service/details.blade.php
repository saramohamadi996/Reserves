@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="breadcrumb"></ul>
                            <hr class="mb-4"/>

                            <div id="wizardLayout1" class="mb-5">
                                <h4> مرحله چهارم لیست سانس ها</h4>
                                <p>چینش لایه چهارم خدمت شامل لیست کامل سانس های ایجاد شده می باشد.
                                    لطفا توجه داشته باشید که برای ثبت یک خدمت مراحل را تا گام آخر تکمیل نمایید.</p>
                                <div class="card">
                                    <div class="card-body">

                                        <div class="nav-wizards-container">
                                            <nav class="nav nav-wizards-1 mb-2">
                                                <div class="nav-item col">
                                                    <a href="#step-1" type="button"
                                                       class="nav-link completed">
                                                        <div class="nav-no">1</div>
                                                        <div class="nav-text">مرحله یک</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link completed" href="#">
                                                        <div class="nav-no">2</div>
                                                        <div class="nav-text">مرحله دوم</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link completed" href="#">
                                                        <div class="nav-no">3</div>
                                                        <div class="nav-text">مرحله سوم</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link completed" href="#">
                                                        <div class="nav-no">4</div>
                                                        <div class="nav-text">مرحله چهارم</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link disabled" href="#">
                                                        <div class="nav-no">5</div>
                                                        <div class="nav-text">مرحله پنجم</div>
                                                    </a>
                                                </div>

                                            </nav>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">

                                                <div class="card-header">
                                                    <h6 class="card-title">
                                                        نام خدمت
                                                        :{{$service->title}}
                                                    </h6>
                                                </div>
                                                <table class="table col-6" data-toggle="table"
                                                       data-sort-class="table-active"
                                                       data-sortable="true" data-search="true" data-pagination="true"
                                                       data-show-refresh="true" data-show-columns="true"
                                                       data-show-fullscreen="true">
                                                    <thead>
                                                    <tr>
                                                        <th data-sortable="true"> خدمت</th>
                                                        <th data-sortable="true">نام کاربر</th>
                                                        <th data-sortable="true">روز</th>
                                                        <th data-sortable="true">ظرفیت</th>
                                                        <th data-sortable="true">سانس</th>
                                                        <th data-sortable="true">تاریخ</th>
                                                        <th data-sortable="true">ویرایش</th>
                                                        <th data-sortable="true">وضعیت</th>
                                                        <th data-sortable="true">حذف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($senses as $sens)
                                                        <tr>
                                                            <td>{{$sens->service->title}}</td>
                                                            <td>{{$sens->user->name}}</td>
                                                            <td>
                                                                @foreach ($sens->day as $value)

                                                                    {{ Gym\Sens\Models\Sens::dayOfWeek($value) }}
                                                                @endforeach
                                                            </td>
                                                            <td>{{$sens->volume}} نفر</td>
                                                            <td>
                                                                {{jdate($sens->start)->format("H:i")}}
                                                                الی
                                                                 {{jdate($sens->end)->format("H:i")}}
                                                            </td>
                                                            <td>
                                                                {{jdate($sens->srart_at)->format("Y/m/d")}}
                                                                الی
                                                                {{jdate($sens->expire_at)->format("Y/m/d")}}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('senses.edit', [$service->id, $sens->id]) }}"
                                                                   class="btn btn-outline-theme">ویرایش</a>
                                                            </td>
                                                            <td class="nav-item">
                                                                <a class="nav-link active text-green "
                                                                   @if($sens->status == 1)
                                                                       href="{{route('senses.toggle',$sens->id)}}"
                                                                   disabled @endif
                                                                   href="{{route('senses.toggle',$sens->id)}}">
                                                                    @if($sens->status == 1)
                                                                        فعال
                                                                    @else
                                                                        <span class="text-warning">غیرفعال</span>
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <form method="post"
                                                                      action="{{ route('senses.destroy',[$service->id ,$sens->id]) }}">
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
                                                <div class="modal-footer">
                                                    @empty($sens)
                                                    @else
                                                        <a href="{{route('services.index')}}"
                                                           class="btn btn-outline-default">قبلی</a>
                                                    @endempty
                                                    <a href="{{route('senses.create', [$service->id]) }}"
                                                       class="btn btn-outline-theme">ایجاد سانس جدید</a>
                                                </div>

                                            </div>
                                            <div class="card-arrow">
                                                <div class="card-arrow-top-left"></div>
                                                <div class="card-arrow-top-right"></div>
                                                <div class="card-arrow-bottom-left"></div>
                                                <div class="card-arrow-bottom-right"></div>
                                            </div>
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
        </div>
@endsection

