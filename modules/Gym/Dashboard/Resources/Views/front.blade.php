<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>رزرو ورزش سافت | پنل ادمین</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('/assets/css/persianDatepicker-default.css')}}">
    <link href="{{asset('/assets/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet"/>
    @yield('css')
</head>

<body class='pace-top'>
<div id="app" class="app app-content-full-height app-without-sidebar app-without-header">
    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        @yield('content')
    </div>
</div>
<script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor.min.js')}}" type="c5c0adc4f4089ee7793a577e-text/javascript"></script>
<script src="{{asset('/assets/js/app.min.js')}}" type="c5c0adc4f4089ee7793a577e-text/javascript"></script>
<script src="{{asset('/assets/persianDatePicker/js/persianDatepicker.js')}}"></script>
<script src="{{asset('/assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="c5c0adc4f4089ee7793a577e-|49" defer=""></script>
<script src="{{asset('/assets/js/select2.min.js')}}"></script>
<script src="{{asset('/assets/js/beacon.min.js')}}"></script>


<script src="{{asset('/assets/plugins/highlight.js/highlight.min.js')}}" type="5cd566d4c9167be52e0a161f-text/javascript">
</script>
<script src="{{asset('/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons/js/buttons.print.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('/assets/plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"
        type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('assets/js/demo/pos-kitchen-order.demo.js')}}" type="9099366c5a289102fb8f352e-text/javascript">
</script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="9099366c5a289102fb8f352e-|49" defer=""></script>
@yield('js')
</body>
</html>
