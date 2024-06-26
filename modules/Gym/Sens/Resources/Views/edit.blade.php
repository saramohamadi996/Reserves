@extends('Dashboard::master')
@section('content')
    <div class="mx-auto mx-lg-auto col-12 col-md-8 p-3">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">یک خدمت جدید ایجاد کنید </h5>
                <button href="{{route('services.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('senses.update', [$service->id, $sens->id ]) }}" class="padding-30" method="post">
                @csrf
                @method('patch')
                <div class="d-flex mt-3">

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب ساعت شروع </label>
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input name="start" autocomplete="off" value="{{jdate($sens->start)->format("H:i")}}"
                                   class="form-control timepicker-ui-input @error('end') is-invalid @enderror"/>
                            @error("end")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب تاریخ شروع </label>
                        <input type="text" id="start_at"
                               autocomplete="off" value="{{jdate($sens->start_at)->format("Y/m/d")}}"
                               class="form-control @error('start_at') is-invalid @enderror"/>
                        <input type="hidden" id="started_at2" name="start_at" value="{{$sens->start_at}}">
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
                            <input name="end" autocomplete="off" value="{{jdate($sens->end)->format("H:i")}}"
                                   class="form-control timepicker-ui-input @error('end') is-invalid @enderror"/>
                            @error("end")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب تاریخ پایان </label>
                        <input type="text" id="expire_at"
                               autocomplete="off" value="{{jdate($sens->expire_at)->format("Y/m/d")}}"
                               class="form-control @error('expire_at') is-invalid @enderror"/>
                        <input type="hidden" id="expired_at2" name="expire_at" value="{{$sens->expire_at}}"/>
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
                        <input type="number" name="volume" value="{{$sens->volume}}"
                               placeholder="پیش فرض ظرفیت یک نفر است."
                               class="form-control @error('volume') is-invalid @enderror"/>
                        @error("volume")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> قیمت </label>
                        <select name="price_group_id" id="price_group_id"
                                class="form-select @error('price_group_id') is-invalid @enderror">
                            @foreach($price_groups as $price_group)
                                <option class="bg-gray-600" value="{{ $price_group->id }}"
                                        @if($price_group->id == $price_group->title) selected @endif>
                                    {{ $price_group->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="mt-3">
                    <div class="col-6" style="margin-right: 9%">

                        <input class="form-check-input me-2 mb-3 select_all" type="checkbox">انتخاب همه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(0)) checked @endif type="checkbox" name="day[]"
                               value="0"/>شنبه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(1)) checked @endif  type="checkbox" name="day[]" value="1"/>یکشنبه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(2)) checked @endif  type="checkbox" name="day[]" value="2"/>دوشنبه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(3)) checked @endif  type="checkbox" name="day[]" value="3"/>سه
                        شنبه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(4)) checked @endif  type="checkbox" name="day[]" value="4"/>چهارشنبه
                        <br>
                        <input class="form-check-input me-2 checkbox gst" @if($sens->day->contains(5)) checked @endif  type="checkbox" name="day[]" value="5"/>پنج
                        شنبه
                        <br>
                        <input class="form-check-input me-2 mb-3 checkbox gst border-red"  @if($sens->day->contains(6)) checked @endif  type="checkbox" name="day[]"
                               value="6"/>
                        <span class="text-red">جمعه</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{route('services.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
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


