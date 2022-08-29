
@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  ویرایش کیف پول {{$wallet->user->name}} </h5>
                <button href="{{route('wallets.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('wallets.update', $wallet->id) }}" class="padding-30" method="post">
                @csrf
                <div class="title mt-2 ms-2">
                    <button class="btn btn-outline-default title" disabled>
                        موجودی کیف پول :
                        {{number_format($wallet->user->balance)}}
                        تومان
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">
                            <div class="col-6">
                                <label class="form-label"> نام کاربر </label>
                                <input type="text" name="user_id" value="{{$wallet->user->name}}"
                                       class="form-control"/>
                                @error("user_id")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> مبلغ شارژ </label>
                                <input type="text" name="amount" value="{{number_format($wallet->amount)}}"
                                       class="form-control" oninput="this.value=this.value.replace(/[^0-9\s]/g,'');"/>
                                @error("amount")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label"> تاریخ </label>
                                <input type="text" name="date_payment" id="expire_at" autocomplete="off"
                                       value="{{jdate($wallet->date_payment)->format("Y/m/d")}}"
                                       class="form-control @error('expire_at') is-invalid @enderror"/>
                                <input type="hidden" id="expired_at2" name="expire_at" />
                                @error("expire_at")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label"> توضیحات </label>
                                <input type="text" name="description" value="{{$wallet->description}}"
                                       class="form-control"/>

                                @error("description")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <select name="card_id" id="cardId"
                                        class="form-control @error('card_id') is-invalid @enderror">
                                    @foreach ($cards as $card)
                                        <option value="{{ $card->id }}"
                                                @if ($card->id == $card->card_id) selected @endif>{{ $card->bank_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('wallets.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
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

