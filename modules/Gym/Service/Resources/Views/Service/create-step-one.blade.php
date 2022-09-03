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
                                <h4> مرحله اول</h4>
                                <p>چینش لایه اول خدمت شامل نام خدمت, نامک خدمت می باشد.
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
                                                    <a class="nav-link disabled" href="#">
                                                        <div class="nav-no">2</div>
                                                        <div class="nav-text">مرحله دوم</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link disabled" href="#">
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

                                        <div class="card">
                                            <div class="card-body">
                                                <form action="{{ route('services.create.step.one.post') }}"
                                                      class="padding-30" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <div class="row row-space-10">
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif

                                                                <div class="col-6">
                                                                    <label class="form-label"> عنوان خدمت </label>
                                                                    <input type="text" placeholder="عنوان خدمت را وارد کنید"
                                                                           value="{{ $service->title ?? '' }}"
                                                                           autocomplete="off" class="form-control"
                                                                           id="taskTitle" name="title" required>
                                                                </div>

                                                                <div class="col-6">
                                                                    <label class="form-label"> نامک </label>
                                                                    <input type="text" placeholder="تکرار عنوان خدمت"
                                                                           value="{{{ $service->slug ?? '' }}}"
                                                                           autocomplete="off" class="form-control"
                                                                           id="taskSlug" name="slug">
                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                                <a href="{{route('services.index')}}"
                                                                   class="btn btn-outline-default">بستن</a>
                                                        <button type="submit" class="btn btn-outline-theme">بعدی
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="card-arrow">
                                                <div class="card-arrow-top-left"></div>
                                                <div class="card-arrow-top-right"></div>
                                                <div class="card-arrow-bottom-left"></div>
                                                <div class="card-arrow-bottom-right"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

