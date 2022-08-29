@extends('Dashboard::front')
@section('content')
    <div class="pos pos-vertical card" id="pos" xmlns="http://www.w3.org/1999/html">

        <div class="pos-container card-body">
            <div class="pos pos-vertical card" id="pos">
                <div class="pos-container card-body">

                    <div class="pos-header col-12">
                        <div class="nav col-5">
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
                        </div>                        <div class="time col-1" id="time">00:00</div>
                        <div class="nav col-6">
                            <div class="nav-item me-1 col-3 p-0">
                                <select class="livesearch form-control" id="user" name="livesearch"></select>
                            </div>

                            <div class="nav-item me-1 col-3 p-0">
                                <select class="form-control" id="category">
                                    <option value="">انتخاب گروه</option>
                                    @foreach ($categories  as $category)
                                        <option class="text-black"
                                                value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="nav-item col-3 p-0">
                                <div class="input-group mb-0">
                                    <input type="text" value="{{verta()->formatDate()}}"
                                           class="form-control"
                                           name="date" id="date-filter" autocomplete="off" placeholder="تاریخ شروع"/>
                                    <span class="input-group-text">
											<i class="bi bi-calendar-date-fill fa-lg"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pos-content">
                        <div class="pos">
                            <div class="pos-container">
                                <div class="pos-content h-100">
                                    <div class="pos-content-container pe-1 ps-1" data-scrollbar="true" data-height="100%">
                                        <div class="row gx-3" id="filters"></div>
                                    </div>
                                </div>
                                <div class="pos-sidebar" id="cart-sidebar"></div>
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
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>

    <div class="modal fade" id="modalPosBooking">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">

            </div>
        </div>
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'انتخاب کاربر',
            language: {
                noResults: function () {
                    return $('<a href="/user_register" class="btn btn-outline-success">افزودن کاربر</a>');
                }
            },
            ajax: {
                url: '/ajax-autocomplete-search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $(function () {
            $(document).on("click", ".detail", function () {
                let date = $(this).data('date'),
                    id = $(this).data('id');

                $.ajax({
                    url: "{{ route('products.getModal') }}",
                    data: {date, id},
                    success(data) {
                        $("#modalPosBooking .modal-content").html(data);
                    }
                })
            })
        });
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(function () {
            const urlParams = new URLSearchParams(window.location.search);
            let date = urlParams.get('date') ?? @json(session('date')),
                user = urlParams.get('user') ?? @json(session('user')),
                category = urlParams.get('category') ?? @json(session('category'));
            $("#user").val(user).trigger('change');
            $("#date-filter").val("{{jdate(session('date'))->format('Y/m/d')}}").trigger('change');
            $("#category").val(category).trigger('change');
            getFilters(date, user);
            getCart(user);

            $("#date-filter").persianDatepicker({
                formatDate: "YYYY-MM-DD",
                onSelect: () => {
                    date = $("#date-filter").attr("data-gdate");
                    getFilters(date, user, category);
                    urlParams.set('date', date);
                    window.history.pushState({}, '', `${location.pathname}?${urlParams.toString()}`);
                }
            });

            $("#user").on("change", function () {
                user = $(this).val();
                getFilters(date, user, category);
                getCart(user);
                urlParams.set('user', user);
                window.history.pushState({}, '', `${location.pathname}?${urlParams.toString()}`);
            });

            $(document)
                .on("change", "#category", function () {
                    category = $(this).val();
                    if (date) {
                        getFilters(date, user, category)
                    }
                    urlParams.set('category', category);
                    window.history.pushState({}, '', `${location.pathname}?${urlParams.toString()}`);
                })
                .on("submit", ".reserve", function (e) {
                    e.preventDefault();
                    let reserve_id = $(this).find("input[name='reserve_id']").val(),
                        user_id = user;
                    console.log($(this));
                    $.ajax({
                        url: "/carts/cart",
                        type: "post",
                        data: {user_id, reserve_id, "_token": "{{csrf_token()}}"},
                        success: (data) => {
                            console.log($(this));
                            $("#cart-sidebar").html(data);
                            $(this).addClass("in-use").addClass("selected");
                        }
                    })
                })
                .on("click", ".cart-delete", function () {
                    let id = $(this).data("id");
                    $.ajax({
                        url: "/carts/" + id,
                        type: "delete",
                        data: {"_token": "{{csrf_token()}}"},
                        success: () => {
                            getCart(user);
                        }
                    });
                })
                .on("submit", "#submit-cart", function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "post",
                        data: $(this).serialize(),
                        success(data) {
                            $("#cart-sidebar").html(data);
                        }
                    })
                })
                .on("submit", "#order-final", function (e) {
                    console.log($(this));
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "post",
                        data: $(this).serialize(),
                        success(data) {
                            $("#cart-sidebar").html(data);
                            getFilters(date, user, category);
                        }
                    })
                })
                .on("click", ".cancel-order", function () {
                    let id = $(this).data("id");

                    $.ajax({
                        url: "orders/" + id + "/cancel",
                        type: "post",
                        data: {"_token": "{{csrf_token()}}", user},
                        success: () => {
                            getFilters(date, user, category);
                            $.ajax({
                                url: "orders/detail/" + user,
                                success(data) {
                                    $(document).find("#order-table").html(data)
                                }
                            })
                        }
                    })
                });
        });

        function getCart(user) {

            $.ajax({
                url: "/carts/" + user + "/show",
                success(data) {
                    $("#cart-sidebar").html(data.cart);
                }
            })
        }

        function getFilters(date, user, category_id = null) {

            $.ajax({
                url: "{{ route('products.filter') }}",
                data: {date, category_id, user},
                success(data) {
                    $("#filters").html(data);
                }
            })
        }
    </script>
@endsection
