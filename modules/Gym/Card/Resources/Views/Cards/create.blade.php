@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">یک کارت جدید ایجاد کنید </h5>
                <button href="{{route('cards.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('cards.store') }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">

                            <div class="col-6">
                                <label class="form-label">نام صاحب حساب </label>
                                <input type="text" autocomplete="off" name="name_account_holder" value="{{ old('name_account_holder') }}"
                                       class="form-control @error('name_account_holder') is-invalid @enderror"/>
                                @error("name_account_holder")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">نام بانک </label>
                                <input type="text" autocomplete="off" name="bank_name" value="{{ old('bank_name') }}"
                                       class="form-control @error('bank_name') is-invalid @enderror"/>
                                @error("bank_name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> شماره کارت بانکی </label>
                                <img width="32px" id="img0" src="">

                                <input type="text" autocomplete="off" name="card_number" value="{{ old('card_number') }}"
                                       class="form-control @error('card_number') is-invalid @enderror"
                                       id="cardnumber" onchange="sunnyweb_check_number();">
                                <p id="card_er" class="invalid-feedback" role="alert">
                                    شماره کارت اشتباه یا تکراری می باشد</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('cards.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection

