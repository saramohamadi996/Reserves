<div id="header" class="app-header">
    <div class="desktop-toggler">
        <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed"
                data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <div class="mobile-toggler">
        <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled"
                data-toggle-target=".app">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>


    <div class="brand">
        <a href="#" class="brand-logo">
					<span class="brand-img">
						<span class="brand-img-text text-theme">ه</span>
					</span>
            <span class="brand-text">پنل ادمین</span>
        </a>
    </div>
    <div class="menu">
        <div class="menu-item dropdown">
            <a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"
               class="menu-link">
                <div class="menu-icon"><i class="bi bi-search nav-icon"></i></div>
            </a>
        </div>
        <div class="menu-item dropdown dropdown-mobile-full">
            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                <div class="menu-icon"><i class="bi bi-grid-3x3-gap nav-icon"></i></div>
            </a>
            <div class="dropdown-menu fade dropdown-menu-end w-300px text-center p-0 mt-1">
                <div class="row row-grid gx-0">
                    {{--                    <div class="col-4">--}}
                    {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                    {{--                            <div class="position-relative">--}}
                    {{--                                <i--}}
                    {{--                                    class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>--}}
                    {{--                                <i class="bi bi-envelope h2 opacity-5 d-block my-1"></i>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="fw-500 fs-10px text-white">صندوق ورودی</div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-4">--}}
                    {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                    {{--                            <div><i class="bi bi-hdd-network h2 opacity-5 d-block my-1"></i></div>--}}
                    {{--                            <div class="fw-500 fs-10px text-white">دیسک درایو</div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-4">--}}
                    {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                    {{--                            <div><i class="bi bi-calendar4 h2 opacity-5 d-block my-1"></i></div>--}}
                    {{--                            <div class="fw-500 fs-10px text-white">تقویم</div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                </div>
                {{--                <div class="row row-grid gx-0">--}}
                {{--                    <div class="col-4">--}}
                {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                {{--                            <div><i class="bi bi-terminal h2 opacity-5 d-block my-1"></i></div>--}}
                {{--                            <div class="fw-500 fs-10px text-white">ترمینال</div>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-4">--}}
                {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                {{--                            <div class="position-relative">--}}
                {{--                                <i--}}
                {{--                                    class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>--}}
                {{--                                <i class="bi bi-sliders h2 opacity-5 d-block my-1"></i>--}}
                {{--                            </div>--}}
                {{--                            <div class="fw-500 fs-10px text-white">تنظیمات</div>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-4">--}}
                {{--                        <a href="#" class="dropdown-item text-decoration-none p-3 bg-none">--}}
                {{--                            <div><i class="bi bi-collection-play h2 opacity-5 d-block my-1"></i></div>--}}
                {{--                            <div class="fw-500 fs-10px text-white">کتابخانه</div>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="menu-item dropdown dropdown-mobile-full">
            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                <div class="menu-icon"><i class="bi bi-bell nav-icon"></i></div>
                <div class="menu-badge bg-theme"></div>
            </a>
            {{--            <div class="dropdown-menu dropdown-menu-end mt-1 w-300px fs-11px pt-1">--}}
            {{--                <h6 class="dropdown-header fs-10px mb-1">اطلاعیه‌ها</h6>--}}
            {{--                <div class="dropdown-divider mt-1"></div>--}}
            {{--                <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">--}}
            {{--                    <div class="fs-20px">--}}
            {{--                        <i class="bi bi-bag text-theme"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-1 flex-wrap ps-3">--}}
            {{--                        <div class="mb-1 text-white">سفارش جدید دریافتی(1,299 تومان)</div>--}}
            {{--                        <div class="small">اکنون</div>--}}
            {{--                    </div>--}}
            {{--                    <div class="ps-2 fs-16px">--}}
            {{--                        <i class="bi bi-chevron-left"></i>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">--}}
            {{--                    <div class="fs-20px w-20px">--}}
            {{--                        <i class="bi bi-person-circle text-theme"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-1 flex-wrap ps-3">--}}
            {{--                        <div class="mb-1 text-white"> 3 اکانت ساخته شد</div>--}}
            {{--                        <div class="small">2 دقیقه قبل</div>--}}
            {{--                    </div>--}}
            {{--                    <div class="ps-2 fs-16px">--}}
            {{--                        <i class="bi bi-chevron-left"></i>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">--}}
            {{--                    <div class="fs-20px w-20px">--}}
            {{--                        <i class="bi bi-gear text-theme"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-1 flex-wrap ps-3">--}}
            {{--                        <div class="mb-1 text-white">نصب کامل شد</div>--}}
            {{--                        <div class="small">3 دقیقه قبل</div>--}}
            {{--                    </div>--}}
            {{--                    <div class="ps-2 fs-16px">--}}
            {{--                        <i class="bi bi-chevron-left"></i>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">--}}
            {{--                    <div class="fs-20px w-20px">--}}
            {{--                        <i class="bi bi-grid text-theme"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-1 flex-wrap ps-3">--}}
            {{--                        <div class="mb-1 text-white">ویجت اینستاگرام نصب شد</div>--}}
            {{--                        <div class="small">5 دقیقه قبل</div>--}}
            {{--                    </div>--}}
            {{--                    <div class="ps-2 fs-16px">--}}
            {{--                        <i class="bi bi-chevron-left"></i>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">--}}
            {{--                    <div class="fs-20px w-20px">--}}
            {{--                        <i class="bi bi-credit-card text-theme"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-1 flex-wrap ps-3">--}}
            {{--                        <div class="mb-1 text-white">روش پرداختی فعال شد</div>--}}
            {{--                        <div class="small">10 دقیقه قبل</div>--}}
            {{--                    </div>--}}
            {{--                    <div class="ps-2 fs-16px">--}}
            {{--                        <i class="bi bi-chevron-left"></i>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <hr class="bg-white-transparent-5 mb-0 mt-2" />--}}
            {{--                <div class="py-10px mb-n2 text-center">--}}
            {{--                    <a href="#" class="text-decoration-none fw-bold">دیدن همه</a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="menu-item dropdown dropdown-mobile-full">
            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link d-flex">
                <div class="menu-img online">
                    <img src="{{asset('assets/img/user/profile.jpg')}}" height="60px"/>
                </div>
                <div class="menu-text d-sm-block d-none">
                    <a class="dropdown-item d-flex align-items-center mt-0 mb-3 " href="{{route('logout')}}">خروج از حساب
                        کاربری
                        <i class="bi bi-toggle-off ms-auto me-auto text-theme fs-28px my-n1"></i>
                    </a>
                </div>
            </a>
            {{--            <div class="dropdown-menu dropdown-menu-end me-lg-3 fs-11px mt-1">--}}
            {{--                <a class="dropdown-item d-flex align-items-center" href="#">پروفایل<i--}}
            {{--                        class="bi bi-person-circle ms-auto text-theme fs-16px my-n1"></i></a>--}}
            {{--                <a class="dropdown-item d-flex align-items-center" href="#">صندوق ورودی<i--}}
            {{--                        class="bi bi-envelope ms-auto text-theme fs-16px my-n1"></i></a>--}}
            {{--                <a class="dropdown-item d-flex align-items-center" href="#">تقویم<i--}}
            {{--                        class="bi bi-calendar ms-auto text-theme fs-16px my-n1"></i></a>--}}
            {{--                <a class="dropdown-item d-flex align-items-center" href="#">تنظیمات<i--}}
            {{--                        class="bi bi-gear ms-auto text-theme fs-16px my-n1"></i></a>--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--                <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">خروج<i--}}
            {{--                        class="bi bi-toggle-off ms-auto text-theme fs-16px my-n1"></i></a>--}}
            {{--            </div>--}}
        </div>
    </div>
    <form class="menu-search" method="POST" name="header_search_form">
        <div class="menu-search-container">
            <div class="menu-search-icon"><i class="bi bi-search"></i></div>
            <div class="menu-search-input">
                <input type="text" class="form-control form-control-lg" placeholder="جستجو..."/>
            </div>
            {{--            <div class="menu-search-icon">--}}
            {{--                <a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"><i--}}
            {{--                        class="bi bi-x-lg"></i></a>--}}
            {{--            </div>--}}
        </div>
    </form>
</div>
