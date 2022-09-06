@foreach($services as $service)
    <div class="col-xl-6">
        <div class="pos-table-booking card service m-1">
            <div class="card-body p-1">
                <div class="pos-table-booking-container">
                    <div class="pos-table-booking-header">
                        <div class="d-flex align-items-center">
                            <div class="flex-1">
                                <div class="title">{{$service->category->title}}</div>
                                <div class=""><h4>{{$service->title}}</h4></div>
                            </div>
                            <div class="text-success">
                                <i class="bi bi-check2-circle fa-3x"></i>
                            </div>
                        </div>
                    </div>
                    @foreach($service->sens as $sens)
                        <form action="{{route('carts.cart' , $service->id)}}" class="reserve" method="post">
                            @csrf
                            <div class="pos-table-booking-body">
                                <div class="booking">
                                    @foreach($sens->reserves as $reserve)
                                        <div class="info">
                                            {{jdate($reserve->start_time)->format("m/d")}}
                                            {{jdate($sens->start)->format("H:i")}}
                                        </div>
                                        <div class="info"> ظرفیت : {{$sens->volume}} ({{$reserve->paid_users->count()}}
                                            )
                                        </div>
                                        <div class="info ">{{$sens->priceGroup->price}}
                                            ریال
                                        </div>

                                        <div class="">
                                            @if( $reserve->paid_users->count() <= 0)
                                                <button
                                                    class="btn btn-outline-link detail" disabled
                                                    style="color: #3cd2a5">
                                                    <i class="bi bi-eye-slash" style="font-size: 1.5rem;"></i>
                                                </button>
                                            @else
                                                <a type="button" data-bs-toggle="modal" data-id="{{$reserve->id}}"
                                                   data-date="{{$date}}" data-bs-target="#modalPosBooking"
                                                   class="btn btn-outline-link detail" style="color: #3cd2a5">
                                                    <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                                                </a>
                                            @endif
                                            <input type="hidden" name="reserve_id" value="{{$reserve->id}}">
                                            <input type="hidden" name="service_id" value="{{$service->id}}">
                                            @if($sens->volume <= $reserve->users->count())
                                                <button class="btn btn-outline-default pt-1 p-1" disabled>تکمیل</button>
                                            @elseif($reserve->paid_users->contains($user) || $reserve->end_time >= now())
                                                <button class="btn btn-outline-default" disabled>رزرو</button>
                                            @else
                                                <button class="btn btn-outline-success"> رزرو</button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    @endforeach

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
@endforeach


