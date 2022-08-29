@extends('Dashboard::master')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش کارت </h5>
                <button href="{{route('cards.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('cards.update', $card->id) }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">

                            <div class="col-6">
                                <label class="form-label">نام صاحب حساب </label>
                                <input type="text" name="name_account_holder" value="{{$card->name_account_holder}}"
                                       class="form-control @error('name_account_holder') is-invalid @enderror"/>
                                @error("name_account_holder")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">نام بانک </label>
                                <input type="text" name="bank_name" value="{{$card->bank_name}}"
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
                                <input type="text" name="card_number" value="{{$card->card_number}}"
                                       class="form-control @error('card_number') is-invalid @enderror"
                                       id="cardnumber" onchange="sunnyweb_check_number();">
                                <p id="card_er"
                                   class="invalid-feedback" role="alert">
                                    شماره کارت اشتباه می باشد</p>
                                @error("card_number")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
