@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  شارژ کیف پول {{$user->name}} </h5>
                <button href="{{route('wallets.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('wallets.store', $user->id) }}" class="padding-30" method="post">
                @csrf
                <div class="title mt-2 ms-2">
                    <button class="btn btn-outline-default title" disabled>
                        موجودی کیف پول :
                        {{number_format($user->balance)}}
                        تومان
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">
                            <div class="col-12 mt-2">
                                <label class="form-label"> نام کاربر </label>
                                <input type="text" autocomplete="off"  value="{{$user->name}}"
                                       class="form-control"/>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @error("user_id")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label"> انتخاب تاریخ واریز </label>
                                <input type="text" name="date_payment" id="date_payment" autocomplete="off"  value="{{verta()->formatDate()}}"
                                       class="form-control @error('date_payment') is-invalid @enderror"/>
                                <input type="hidden" id="date_payment2" name="date_payment"  value="{{today()}}">
                                @error("start_at")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label"> مبلغ شارژ </label>
                                <input type="text" autocomplete="off" name="amount"
                                       class="form-control" oninput="this.value=this.value.replace(/[^0-9\s]/g,'');"/>
                                @error("amount")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label"> انتخاب کارت بانکی </label>
                                <select name="card_id" class="form-select" required>
                                    <option value="">انتخاب کارت بانکی</option>
                                    @foreach($cards as $card)
                                        <option class="bg-gray-600" value="{{ $card->id }}"
                                                @if($card->id == old('card_id')) selected @endif>
                                            {{ $card->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label"> توضیحات </label>
                                <input type="text" autocomplete="off" name="description" value="{{ old('description') }}"
                                       class="form-control"/>

                                @error("description")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('users.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $("#date_payment").persianDatepicker({
            formatDate: "YYYY/0M/0D",
            onSelect: () => {
                let date = $("#date_payment").attr("data-gdate");
                $("#date_payment2").val(date);
            }
        });

        $("#formattedNumberField").on('keyup', function(){
            var n = parseInt($(this).val().replace(/\D/g,''),10);
            $(this).val(n.toLocaleString());
            //do something else as per updated question
            myFunc(); //call another function too
        });
    </script>
@endsection
