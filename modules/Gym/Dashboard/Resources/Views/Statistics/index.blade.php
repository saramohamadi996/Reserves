@extends('Dashboard::front')
@section('content')
    <div id="content" class="app-content p-0">
        <div class="pos-container card-body">
            <div class="pos pos-vertical card" id="pos">
                <div class="pos-container card-body">
                    <div class="pos-header col-12">
                        <div class="nav col-6">
                            <div class="logo col-3 p-0">
                                <a href="{{url('/dashboard')}}">
                                    <div class="logo-img">
                                        <i class="bi bi-pie-chart nav-icon" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="logo-text">
                                        گزارشات
                                    </div>
                                </a>
                            </div>
                            <div class="logo col-3 p-0 pe-2">
                                <a href="{{url('/')}}">
                                    <div class="logo-img">
                                        <i class="bi bi-bag-check" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="logo-text">
                                        پیشخوان
                                    </div>
                                </a>
                            </div>
                            <div class="logo col-3 p-0 pe-2">
                                <a href="{{url('/users')}}">
                                    <div class="logo-img">
                                        <i class="bi bi-list nav-icon" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="logo-text">
                                        منوها
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-4 ms-auto pe-4">
                            <div class="input-group input-daterange">
                                <input type="text" value="{{verta()->formatDate()}}"
                                       class="form-control range-from-example"
                                       name="date_payment" autocomplete="off" placeholder="تاریخ شروع"/>
                                <span class="input-group-text">
                                        <i class="bi bi-calendar-date-fill fa-lg"></i>
                                    </span>
                                <input type="text" value="{{verta()->formatDate()}}"
                                       class="form-control range-to-example"
                                       name="date_payment" autocomplete="off" placeholder="تاریخ پایان"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 statistics">
                        @include('Dashboard::Statistics.all')
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
        <div class="modal modal-pos fade" id="modalDetail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var to, from;
        var to_date, from_date;
        to = $(".range-to-example").persianDatepicker({
            inline: true,
            altField: '.range-to-example-alt',
            altFormat: 'LLLL',
            initialValue: false,
            onSelect: function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate != unix) {
                    let cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
                to_date = $(document).find(".range-to-example").attr("data-gdate");
                get_stats(from_date, to_date);
            }
        });
        from = $(".range-from-example").persianDatepicker({
            inline: true,
            altField: '.range-from-example-alt',
            altFormat: 'LLLL',
            initialValue: false,
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    let cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
                from_date = $(document).find(".range-from-example").attr("data-gdate");
                get_stats(from_date, to_date);
            }
        });

        function get_stats(start_date, end_date) {
            $.ajax({
                url: "/dashboard",
                data: {start_date, end_date},
                success(data) {
                    $(".statistics").html(data);
                }
            })
        }

        $(document)
            .on('click', '.service-detail', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: "service-detail/" + id,
                    data: {"start_date": from_date, "end_date": to_date},
                    success(data) {
                        $("#modalDetail .modal-content").html(data);
                    }
                })
            })
            .on('click', '.staff-detail', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: "staffRegisteredUsersDetail/" + id,
                    data: {"start_date": from_date, "end_date": to_date},
                    success(data) {
                        $("#modalDetail .modal-content").html(data);
                    }
                })
            })
            .on('click', '.card-detail', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: "cardDetail/" + id,
                    data: {"start_date": from_date, "end_date": to_date},
                    success(data) {
                        $("#modalDetail .modal-content").html(data);
                    }
                })
            })
            .on('click', '.wallet-detail', function () {
                let type = $(this).data('type');
                $.ajax({
                    url: "walletDetail",
                    data: {"start_date": from_date, "end_date": to_date, type},
                    success(data) {
                        $("#modalDetail .modal-content").html(data);
                    }
                })
            })
    </script>
@endsection
