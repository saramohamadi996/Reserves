<div id="bootstrapTable" class="mb-5">
    <div class="card">
        <div class="card-body">
            <h6>لیست خدمات</h6>
            <table class="table table table-bordered col-6" data-toggle="table"
                   data-sort-class="table-active"
                   data-sortable="true" data-search="true" data-pagination="true">
                <thead>
                <tr>
                    <th data-sortable="true">#</th>
                    <th data-sortable="true">نام خدمت</th>
                    <th data-sortable="true">رزرو شده</th>
                    <th data-sortable="true">جمع</th>
                    <th data-sortable="true">عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->title}}</td>
                        <td>{{number_format($service->orders_count)}} نفر</td>
                        <td>{{number_format($service->paid_orders_sum_price)}} ریال </td>
                        <td>
                            @if( $service->orders_count <= 0)
                                <button
                                    class="btn btn-outline-link p-1 detail" disabled
                                    style="color: #3cd2a5">
                                    <i class="bi bi-eye-slash" style="font-size: 1.5rem;"></i>
                                </button>
                            @else
                                <a type="button" data-bs-toggle="modal" data-id="{{$service->id}}"
                                   data-bs-target="#modalDetail"
                                   class="btn btn-outline-link p-1 service-detail" style="color: #3cd2a5">
                                    <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
