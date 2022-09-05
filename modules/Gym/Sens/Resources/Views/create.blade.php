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
                                <h4> مرحله پنجم ایجاد سانس جدید</h4>
                                <p>چینش لایه اول خدمت شامل ساعت , تاریخ , ظرفیت و روز می باشد.
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
                                                    <a class="nav-link completed" href="#">
                                                        <div class="nav-no">4</div>
                                                        <div class="nav-text">مرحله چهارم</div>
                                                    </a>
                                                </div>

                                                <div class="nav-item col">
                                                    <a class="nav-link completed" href="#">
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
                                                <form action="{{ route('senses.store', $service->id) }}"
                                                      class="padding-30" method="post">
                                                    @csrf

                                                    <div class="d-flex mt-3">

                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> انتخاب ساعت شروع </label>
                                                            <div class="input-group bootstrap-timepicker timepicker">
                                                                <input name="start" autocomplete="off"
                                                                       class="form-control timepicker-ui-input
                                                                        @error('end') is-invalid @enderror"/>
                                                                @error("end")
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> انتخاب تاریخ شروع </label>
                                                            <input type="text" name="start_at" id="start_at"
                                                                   autocomplete="off" class="form-control
                                                                   @error('start_at') is-invalid @enderror"/>
                                                            <input type="hidden" id="started_at2" name="start_at">
                                                            @error("start_at")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-3">

                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> انتخاب ساعت پایان </label>
                                                            <div class="input-group bootstrap-timepicker timepicker">
                                                                <input name="end" autocomplete="off"
                                                                       class="form-control timepicker-ui-input
                                                                       @error('end') is-invalid @enderror"/>
                                                                @error("end")
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> انتخاب تاریخ پایان </label>
                                                            <input type="text" name="expire_at" id="expire_at"
                                                                   autocomplete="off" class="form-control
                                                                   @error('expire_at') is-invalid @enderror"/>
                                                            <input type="hidden" id="expired_at2" name="expire_at"/>
                                                            @error("expire_at")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-3">
                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> ظرفیت رزرو </label>
                                                            <input type="number" name="volume" value="1"
                                                                   placeholder="پیش فرض ظرفیت یک نفر است."
                                                                   class="form-control @error('volume')
                                                                   is-invalid @enderror"/>
                                                            @error("volume")
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-4 me-auto ms-auto">
                                                            <label class="form-label"> قیمت </label>
                                                            <select name="price_group_id" id="price_group_id"
                                                                    class="form-select @error('price_group_id')
                                                                     is-invalid @enderror">
                                                                <option value="">انتخاب قیمت</option>
                                                                @foreach($price_groups as $price_group)
                                                                    <option class="bg-gray-600"
                                                                            value="{{ $price_group->id }}">
                                                                        {{ $price_group->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="col-6" style="margin-right: 9%">

                                                            <input type="checkbox"
                                                                   class="form-check-input me-2 mb-3 select_all">
                                                            انتخاب همه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="0"/>شنبه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="1"/>یکشنبه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="2"/>دوشنبه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="3"/>سه شنبه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="4"/>چهارشنبه
                                                            <br>
                                                            <input class="form-check-input me-2 checkbox gst"
                                                                   type="checkbox" name="day[]" value="5"/>پنج شنبه
                                                            <br>
                                                            <input type="checkbox" name="day[]" value="6"
                                                                   class="form-check-input me-2 mb-3 checkbox gst border-red"/>
                                                            <span class="text-red">
                                                                جمعه
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="{{route('services.details',$service)}}"
                                                           class="btn btn-outline-default">قبلی</a>
                                                        <button type="submit" class="btn btn-outline-theme">ذخیره
                                                            تغییرات
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

        @section('js')
            <script type="text/javascript">
                $('.timepicker-ui-input').mdtimepicker({
                    is24Hour: true,
                    timeFormat: 'hh:mm',
                    format: 'hh:mm',
                    readOnly: false,
                });

                $('.select_all').on('change', function () {
                    $('.checkbox').prop('checked', $(this).prop("checked"));
                });
                $('.checkbox').change(function () { //".checkbox" change
                    if ($('.checkbox:checked').length == $('.checkbox').length) {
                        $('.select_all').prop('checked', true);
                    } else {
                        $('.select_all').prop('checked', false);
                    }
                });

                $("#start_at").persianDatepicker({
                    formatDate: "YYYY/0M/0D",
                    onSelect: () => {
                        let date = $("#start_at").attr("data-gdate");
                        console.log(date);
                        $("#started_at2").val(date);
                    }
                });
                $("#expire_at").persianDatepicker({
                    formatDate: "YYYY/0M/0D",
                    onSelect: () => {
                        let date = $("#expire_at").attr("data-gdate");
                        console.log(date);

                        $("#expired_at2").val(date);
                    }
                });
            </script>
@endsection

