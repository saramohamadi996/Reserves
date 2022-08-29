@extends('Dashboard::master')
@section('content')
    <div id="content" class="app-content">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xl-12">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">

                            </ul>
                            <hr class="mb-4"/>

                            <div id="wizardLayout1" class="mb-5">
                                <h4> مرحله سوم تایید اطلاعات</h4>
                                <p>چینش لایه سوم خدمت شامل تایید اولیه اطلاعات وارد شده می باشد.
                                    لطفا توجه داشته باشید که برای ثبت یک خدمت مراحل را تا گام آخر تکمیل نمایید.</p>
                                <div class="card">
                                    <div class="card-body">

                                        <div class="nav-wizards-container">
                                            <nav class="nav nav-wizards-1 mb-2">

                                                <div class="nav-item col">
                                                    <a href="#" class="nav-link completed">
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
                                                    <a class="nav-link disabled" href="#">
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
                                        <div class="card-body col-9 me-auto ms-auto">
                                            <form action="{{ route('services.create.step.three.post') }}"
                                                  method="post">
                                                @csrf
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div>
                                                                <div class="row mb-2">
                                                                    <div class="col-3 text-center"><h6>عنوان</h6></div>
                                                                    <div class="col-6">{{$service->title}}</div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-3 text-center"><h6>نامک</h6></div>
                                                                    <div class="col-6">{{$service->slug}}</div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-3 text-center"><h6>ترتیب نمایش</h6></div>
                                                                    <div class="col-6">{{$service->priority}}</div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-3 text-center"><h6>کد خدمت</h6></div>
                                                                    <div class="col-6">{{$service->code_service}}</div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-3 text-center"><h6>دسته بندی</h6></div>
                                                                    <div class="col-6">{{$service->category->title}}</div>
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
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="{{route('services.create.step.two')}}"
                                                       class="btn btn-outline-default">قبلی</a>
                                                    <button type="submit" class="btn btn-outline-theme">بعدی
                                                    </button>
                                                </div>
                                            </form>
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

