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
                <div class="col-4 px-2">
                    <label class="form-label"> ظرفیت </label>
                    <input type="number" name="volume" value="{{$sens->volume}}"
                           class="form-control @error('volume') is-invalid @enderror"/>
                    @error("volume")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="d-flex mt-3">
                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب ساعت شروع </label>
                        <input type="time" name="start" value="{{$sens->start}}"
                               class="form-control @error('start') is-invalid @enderror"/>
                        @error("start")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب تاریخ شروع </label>
                        <input type="text" id="start_at" name="start_at"
                               class="form-control @error('start_at') is-invalid @enderror"/>
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
                        <input type="time" name="end" value="{{$sens->end}}"
                               class="form-control @error('end') is-invalid @enderror"/>
                        @error("end")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-4 me-auto ms-auto">
                        <label class="form-label"> انتخاب تاریخ پایان </label>
                        <input type="text" id="expire_at" name="expire_at"
                               class="form-control @error('expire_at') is-invalid @enderror"/>
                        @error("expire_at")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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

