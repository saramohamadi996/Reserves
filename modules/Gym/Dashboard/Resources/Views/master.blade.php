<!DOCTYPE html>
<html lang="en" dir="rtl">
@include('Dashboard::Layout.head')
<body>
<div id="app" class="app app-full-height app-without-header mt-5">
    @include('Dashboard::Layout.header')

    @include('Dashboard::Layout.sidebar')
    <button class="app-sidebar-mobile-backdrop" data-toggle-target=".app"
            data-toggle-class="app-sidebar-mobile-toggled"></button>
    @yield('content')
    <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

    <div class="app-theme-panel">
        <div class="app-theme-panel-container">
            <a href="javascript:;" data-toggle="theme-panel-expand" class=""></a>
        </div>
    </div>

@include('Dashboard::Layout.foot')
{{--@include('sweetalert::alert')--}}
</body>
</html>
