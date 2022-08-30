<div id="sidebar" class="app-sidebar mt-3">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">
                <h6>پنل مدیریت رزرو ورزش سافت</h6>
            </div>

            <div class="menu-item active">
                <a href="{{url('/dashboard')}}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">داشبورد</span>
                </a>
            </div>

            <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="bi bi-bag-check"></i>
                        <span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span>
                    </div>
                    <div class="menu-text d-flex align-items-center">پیشخوان خدمت</div>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                            <a href="{{route('products.index')}}" class="menu-link">
                                <div class="menu-text">پیشخوان خدمت</div>
                            </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="{{route('services.index')}}" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-x-diamond"></i>
                    </span>
                    <span class="menu-text">خدمات</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{route('services.index')}}" class="menu-link">
                            <span class="menu-text">لیست خدمات</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('services.create.step.one.post')}}" class="menu-link">
                            <span class="menu-text">ایجاد خدمت</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="{{route('users.index')}}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people"></i></span>
                    <span class="menu-text">کاربران</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{route('users.index')}}" class="menu-link">
                            <span class="menu-text">لیست کاربران</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{url('/user_register')}}" class="menu-link">
                            <span class="menu-text">ثبت نام کاربر جدید</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('wallets.index')}}" class="menu-link">
                            <span class="menu-text">لیست کیف پول ها</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-credit-card"></i></span>
                    <span class="menu-text">کا‌رت‌ها</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{route('cards.index')}}" class="menu-link">
                            <span class="menu-text">لیست کارت ها</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub">
                {{--                {{ request()->is('categories/index') ? 'active' : '' }}--}}
                <a href="{{url('/categories')}}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-folder2-open"></i></span>
                    <span class="menu-text">دسته بندی ها</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{route('categories.index')}}" class="menu-link">
                            <span class="menu-text">لیست دسته بندی ها</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('categories.store')}}" class="menu-link">
                            <span class="menu-text">ایجاد دسته بندی جدید</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="{{route('price_groups.index')}}" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </span>
                    <span class="menu-text">گروه های قیمت</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>

                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{route('price_groups.index')}}" class="menu-link">
                            <span class="menu-text">لیست گروه های قیمت</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('price_groups.store')}}" class="menu-link">
                            <span class="menu-text">ایجاد گروه قیمت</span>
                        </a>
                    </div>
                </div>
            </div>

{{--            <div class="menu-item">--}}
{{--                <a href="#" class="menu-link">--}}
{{--                    <span class="menu-icon"><i class="bi bi-gear"></i></span>--}}
{{--                    <span class="menu-text">تنظیمات</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="menu-item">--}}
{{--                <a href="#" class="menu-link">--}}
{{--                    <span class="menu-icon"><i class="bi bi-gem"></i></span>--}}
{{--                    <span class="menu-text">راهنما</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <div class="p-3 px-4 mt-auto">
            <a href="#" class="btn d-block btn-outline-theme">
                <i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> راهنمای استفاده از نرم افزار
            </a>
        </div>
    </div>
</div>
