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
                                <h4> مرحله دوم</h4>
                                <p>چینش لایه دوم خدمت شامل نام دسته بندی , ترتیب نمایش , کد خدمت می باشد.
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
                                                <form action="{{ route('services.create.step.two.post') }}"
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

                                                                <div class="mt-3 col-4">
                                                                    <label class="form-label"> دسته بندی </label>
                                                                    <select name="category_id" id="categoryId"
                                                                            class="form-select" required>
                                                                        <option value="">انتخاب دسته بندی</option>
                                                                        @foreach($categories as $category)
                                                                            <option class="bg-gray-600" required
                                                                                    value="{{ $category->id ?? '' }}">{{ $category->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="mt-3 col-4">
                                                                    <label class="form-label"> ترتیب نمایش </label>
                                                                    <input type="number"
                                                                           placeholder="ترتیب قرار گیری خدمت در لیست نمایش"
                                                                           value="{{{ $service->priority ?? '' }}}"
                                                                           autocomplete="off" class="form-control"
                                                                           oninput="this.value=this.value.replace(/[^0-9\s]/g,'');"
                                                                           id="taskPriority" name="priority">
                                                                </div>

                                                                <div class="mt-3 col-4">
                                                                    <label class="form-label"> کد خدمت </label>
                                                                    <input type="text" placeholder="کد خدمت "
                                                                           value="{{{ $service->code_service ?? '' }}}"
                                                                           autocomplete="off" class="form-control"
                                                                           id="taskCode_service" name="code_service"/>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('services.create.step.one.post') }}"
                                                           class="btn btn-outline-default">قبلی</a>
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

