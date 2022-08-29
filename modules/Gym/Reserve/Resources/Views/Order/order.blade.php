<div class="pos pos-vertical card" id="pos">
    <div class="h-100 d-flex flex-column p-0">
        <div class="pos-sidebar-header">
            <div class="back-btn">
                <button type="button" data-toggle-class="pos-mobile-sidebar-toggled"
                        data-toggle-target="#pos" class="btn">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>
            <div class="icon"><i class="bi bi-people"></i></div>
            <div class="title">{{$user->name}}</div>
            <div class="order">موبایل : <b class="text-theme">{{$user->mobile}}</b></div>
        </div>
        <hr class="m-0 opacity-3 text-white"/>
        <div class="pos-sidebar-body" data-scrollbar="true" data-height="100%">

            @foreach ($orders as $order)
                <div class="pos-order py-3">
                    <div class="pos-order-product">

                        <div class="flex-1">
                            <div class="row">
                                <div class="col-4">
                                    <div class="h6 mb-1">{{$order->service->title}}</div>
                                    <div class="small">
                                        شروع :
                                        {{jdate($order->reserve->sens->start)->format("H:i")}}
                                    </div>
                                    <div class="small">
                                        پایان :
                                        {{jdate($order->reserve->sens->end)->format("H:i")}}
                                    </div>
                                    <div class="small">
                                        {{jdate($order->reserve->start_time)->format("Y/m/d")}}
                                    </div>
                                </div>
                                <div class="col-3 text-white fw-bold text-end">
                                    {{number_format($order->reserve->sens->priceGroup->price)}}
                                </div>
                                <div class="col-5">
                                    ثبت :
                                    {{jdate($order->created_at)->format("Y/m/d")}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pos-sidebar-footer">
            <div class="d-flex align-items-center mb-2">
                <div>کل هزینه</div>
                <div class="flex-1 text-end h4 mb-0">
                    {{number_format($orders->sum('reserve.sens.priceGroup.price'))}}
                    ریال
                </div>
            </div>
            <div class="mt-3">
                <div class="col-12">
                    <form action="{{route('orders.wallet')}}" id="order-final" method="post">
                        <input type="hidden" name="user" value="{{$user->id}}">
                        @csrf
                        <button class="btn btn-outline-theme rounded-0 w-300px">
                            <i class="bi bi-wallet2 fa-lg"></i><br/>
                            پرداخت
                        </button>
                    </form>
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
