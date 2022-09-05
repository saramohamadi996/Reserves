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
        <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">

            <div class="tab-pane fade h-100 show active" id="newOrderTab">
                @foreach($carts as $cart)
                    <div class="pos-order py-3">
                        <div class="pos-order-product">

                            <div class="flex-1">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="h6 mb-1">{{$cart->service->title}}</div>
                                        <div class="small">
                                            شروع :
                                            {{jdate($cart->reserve->sens->start)->format("H:i")}}
                                        </div>
                                        <div class="small">
                                            پایان :
                                            {{jdate($cart->reserve->sens->end)->format("H:i")}}
                                        </div>
                                    </div>

                                    <div class="col-4 text-white fw-bold text-end">
                                        {{number_format($cart->sens_price)}}
                                    </div>
                                    <div class="col-3 text-end">{{jdate($cart->reserve->start_time)->format("m/d")}}</div>

                                    <div class="col-1 text-white fw-bold text-end">
                                        <a href="javascript:;" data-id="{{$cart->id}}" class="cart-delete">
                                            <i class="far fa-times-circle fa-fw me-1  text-red"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('Reserve::Order.detail')
        </div>
        <div class="pos-sidebar-footer">
            <div class="d-flex align-items-center mb-2">
                <div>کل هزینه</div>
                <div class="flex-1 text-end h4 mb-0">
                    {{number_format($carts->sum('sens_price'))}}
                    ریال
                </div>
            </div>
            <div class="d-flex align-items-center mb-2">
                <div>مانده کیف پول</div>

                @if($user->balance <=  $carts->sum('sens_price'))
                    <div class="text-red flex-1 text-end h6 mb-0">
                        {{number_format($user->balance -  $carts->sum('sens_price'))}}
                        ریال
                    </div>
                @else
                    <div class="text-theme flex-1 text-end h6 mb-0">
                        {{number_format($user->balance -  $carts->sum('sens_price'))}}
                        ریال
                    </div>
                @endif
            </div>
            <div class="mt-3">
                <div class="btn-group d-flex">
                    <ul class="nav nav-tabs nav-fill">
                        <li>
                            <a class="btn btn-outline-theme rounded-0 w-150px" href="#" data-bs-toggle="tab"
                               data-bs-target="#orderHistoryTab">
                                <i class="bi bi-list-ul fa-lg"></i><br/>
                                گزارش سفارشات
                            </a>
                        </li>
                    </ul>
                    @if($carts->sum('sens_price') > 0)
                    <form action="{{route('orders.store')}}" id="submit-cart" method="post">
                            <input type="hidden" name="user" value="{{$user->id}}">
                            @csrf
                                <button class="btn btn-outline-theme rounded-0 w-150px">
                                    <i class="bi bi-cart-plus fa-lg"></i><br/>ثبت سفارش
                                </button>
                        </form>
                    @else
                        <button class="btn btn-outline-theme rounded-0 w-150px" disabled>
                            <i class="bi bi-cart-plus fa-lg"></i><br/>ثبت سفارش
                        </button>
                    @endif

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
