<div id="bootstrapTable" class="mb-5">
    <div class="card">
        <div class="card-body">
            <h6>لیست بانک ها</h6>
            <table class="table table table-bordered col-6" data-toggle="table"
                   data-sort-class="table-active"
                   data-sortable="true" data-search="true" data-pagination="true">
                <thead>
                <tr>
                    <th data-sortable="true">#</th>
                    <th data-sortable="true">نام</th>
                    <th data-sortable="true">جمع واریزی</th>
                    <th data-sortable="true">عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <td>{{$card->id}}</td>
                        <td>{{$card->bank_name}}</td>
                        <td>{{number_format($card->wallets_sum_amount)}} ریال </td>
                        <td>
                            @if( $card->wallets_sum_amount <= 0)
                                <button
                                    class="btn btn-outline-link p-1 detail" disabled
                                    style="color: #3cd2a5">
                                    <i class="bi bi-eye-slash" style="font-size: 1.5rem;"></i>
                                </button>
                            @else
                                <a type="button" data-bs-toggle="modal" data-id="{{$card->id}}"
                                   data-bs-target="#modalDetail"
                                   class="btn btn-outline-link p-1 card-detail" style="color: #3cd2a5">
                                    <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            {!! $cards->render() !!}--}}

        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
    <div class="modal modal-pos fade" id="modalCard">

        <div class="modal-dialog modal-lg">

            <div class="modal-content border-0">

                <div class="card">
                    <div class="card-body p-0">

                        <div class="modal-header align-items-center">
                            <h5 class="modal-title d-flex align-items-end">
               <span class="me-2 mb-1 opacity-5">
                    <i class="bi bi-x-diamond"></i>
                </span>
                                <h6 class="flex-grow-1">
                                    ساعت :
{{--                                    {{jdate($reserve->start)->format("H:i")}}--}}
{{--                                    الی :--}}
{{--                                    {{jdate($reserve->end)->format("H:i")}}--}}
                                </h6>
                                <h6 class="flex-grow-1">
                                    تاریخ :
{{--                                    {{jdate($reserve->start_time)->format("Y/m/d")}}--}}
                                </h6>
                                <small class="fs-14px me-2 text-white text-opacity-50">قیمت :
{{--                                    {{number_format($reserve->sens->service_price)}}--}}
                                    ریال
                                </small>
                            </h5>
                            <a href="#" data-bs-dismiss="modal" class="ms-auto btn-close"></a>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-2 ">
                                        <div class="input-group">
{{--                                            @foreach ($cards as $user)--}}
{{--                                                <div class="col-lg-6">--}}
{{--                                                    <div class="form-group mb-2 ">--}}
{{--                                                        <div class="input-group d-block">--}}
{{--                                                            <div class="form-check w-100">--}}
{{--                                                                <label class="form-check-label" for="">--}}
{{--                                                                    <div class="form-group mb-2">--}}

{{--                                                                        <div class="input-group">--}}
{{--                                                                            <div class="input-group-text fw-bold w-150px fs-13px">--}}
{{--                                                                                {{$user->name}}--}}
{{--                                                                            </div>--}}
{{--                                                                            <input type="text" class="form-control"--}}
{{--                                                                                   value="{{$user->mobile}}" placeholder="تکمیل"/>--}}
{{--                                                                        </div>--}}

{{--                                                                    </div>--}}
{{--                                                                </label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
                                        </div>
                                    </div>
                                </div>
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
