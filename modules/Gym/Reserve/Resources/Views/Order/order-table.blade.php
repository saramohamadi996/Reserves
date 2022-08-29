<table class="table text-nowrap">
    <thead>
    <tr>
        <th class="small">خدمت</th>
        <th class="small">رزرو</th>
        <th class="small">شروع</th>
        <th class="small">مبلغ</th>
        <th class="small">وضعیت</th>
        <th class="small">کنسل</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($user->orders as $order)
        <tr>
            <td class="small">{{$order->service->title}}</td>
            <td class="small">{{jdate($order->reserve->start_time)->format("m/d")}}</td>
            <td class="small">{{jdate($order->reserve->sens->start)->format("H:i")}}</td>
            <td class="small">{{$order->reserve->sens->priceGroup->price}}</td>
            <td class="small">{{__($order->status)}}</td>
            <td class="small">
                @if($order->status != 'canceled')
                    <button class="btn cancel-order" data-id="{{$order->id}}">X</button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
