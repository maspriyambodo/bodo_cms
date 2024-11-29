<!doctype html>
<html lang=en>
    <head><base href="">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name=description content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free.">
        <meta name=keywords content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon">
        <meta name=viewport content="width=device-width,initial-scale=1">
        <meta charset=utf-8>
        <meta property=og:locale content=en_US>
        <meta property=og:type content=article>
        <meta property=og:title content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme">
        <meta property=og:url content=https://keenthemes.com/metronic>
        <meta property=og:site_name content="{{ config('app.name', 'Laravel') }}">
        <link rel=canonical href=https://preview.keenthemes.com/metronic8>
        <link rel="shortcut icon" href=assets/media/logos/favicon.ico>
        <link rel=stylesheet href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
        <link href="{{ asset('src/plugins/custom/fullcalendar/fullcalendar.bundle.css'); }}" rel=stylesheet>
        <link href="{{ asset('src/plugins/global/plugins.bundle.css'); }}" rel=stylesheet>
        <link href="{{ asset('src/css/style.bundle.css'); }}" rel=stylesheet>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('stylesheet')
    </head>
    <body id=kt_body class="header-tablet-and-mobile-fixed aside-enabled">
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">
                <div id=kt_aside class=aside data-kt-drawer=true data-kt-drawer-name=aside data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay=true data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction=start data-kt-drawer-toggle=#kt_aside_mobile_toggle>
                    <div class="aside-toolbar flex-column-auto" id=kt_aside_toolbar>
                        <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                            <div class="symbol symbol-50px">
                                <img src="{{ asset('src/media/avatars/150-26.jpg'); }}" alt="">
                            </div>
                            <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                                <div class=d-flex>
                                    <div class="flex-grow-1 me-2">
                                        <a href=# class="text-white text-hover-primary fs-6 fw-bold">{{ $user->name; }}</a>
                                        <span class="text-gray-600 fw-bold d-block fs-8 mb-1">{{ $role_user->name; }}</span>
                                        <div class="d-flex align-items-center text-success fs-9">
                                            <span class="bullet bullet-dot bg-success me-1"></span>online</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aside-search py-5">
                            <div id=kt_header_search class="d-flex align-items-center" data-kt-search-keypress=true data-kt-search-min-length=2 data-kt-search-enter=enter data-kt-search-layout=menu data-kt-menu-trigger=auto data-kt-menu-permanent=true data-kt-menu-placement=bottom-start data-kt-menu-flip=bottom>
                                <form data-kt-search-element=form class="w-100 position-relative" autocomplete=off>
                                    <input type=hidden>
                                    <span class="svg-icon svg-icon-2 search-icon position-absolute top-50 translate-middle-y ms-4">
                                        <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                        <rect opacity=0.5 x=17.0365 y=15.1223 width=8.15546 height=2 rx=1 transform="rotate(45 17.0365 15.1223)" fill=black />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill=black />
                                        </svg>
                                    </span>
                                    <input class="form-control ps-13 fs-7 h-40px" name=search placeholder="Quick Search" data-kt-search-element=input>
                                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element=spinner>
                                        <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                    </span>
                                    <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element=clear>
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                            <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                            <rect opacity=0.5 x=6 y=17.3137 width=16 height=2 rx=1 transform="rotate(-45 6 17.3137)" fill=black />
                                            <rect x=7.41422 y=6 width=16 height=2 rx=1 transform="rotate(45 7.41422 6)" fill=black />
                                            </svg>
                                        </span>
                                    </span>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="aside-menu flex-column-fluid">
                        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id=kt_aside_menu_wrapper data-kt-scroll=true data-kt-scroll-height=auto data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers=#kt_aside_menu data-kt-scroll-offset=5px>
                            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id=#kt_aside_menu data-kt-menu=true>
                                @foreach($menus as $menu)
                                @if($menu->children->isEmpty())
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs($menu->link) ? 'active' : '' }}" href="{{ $menu->link }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ $menu->nama }}</span>
                                    </a>
                                </div>
                                @endif
                                @foreach($menu->children as $child)
                                @if($child->children->isEmpty())
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ $menu->nama }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;" kt-hidden-height="273">
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ $child->link }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $child->nama }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($child->children->isNotEmpty())
                                @foreach($child->children as $subChild)
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ $menu->nama }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;" kt-hidden-height="312">
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $child->nama }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                                <div class="menu-item">
                                                    <a class="menu-link" href="{{ $subChild->link }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ $subChild->nama }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endforeach
                                @endforeach
                                <div class=menu-item>
                                    <div class=menu-content>
                                        <div class="separator mx-1 my-4"></div>
                                    </div>
                                </div>

                                <div class=menu-item>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                            <span class=menu-icon>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                                    <rect x=2 y=2 width=9 height=9 rx=2 fill=black />
                                                    <rect opacity=0.3 x=13 y=2 width=9 height=9 rx=2 fill=black />
                                                    <rect opacity=0.3 x=13 y=13 width=9 height=9 rx=2 fill=black />
                                                    <rect opacity=0.3 x=2 y=13 width=9 height=9 rx=2 fill=black />
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class=menu-title>{{ __('Log Out') }}</span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper d-flex flex-column flex-row-fluid" id=kt_wrapper>
                    <div id=kt_header class="header align-items-stretch">
                        <div class=header-brand>
                            <a href="">
                                <img alt=Logo src="{{ asset('src/media/logos/logo-1-dark.svg'); }}" class="h-25px h-lg-25px">
                            </a>
                            <div id=kt_aside_toggle class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize" data-kt-toggle=true data-kt-toggle-state=active data-kt-toggle-target=body data-kt-toggle-name=aside-minimize>
                                <span class="svg-icon svg-icon-1 me-n1 minimize-default">
                                    <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                    <rect opacity=0.3 x=8.5 y=11 width=12 height=2 rx=1 fill=black />
                                    <path d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z" fill=black />
                                    <path opacity=0.5 d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z" fill=black />
                                    </svg>
                                </span>
                                <span class="svg-icon svg-icon-1 minimize-active">
                                    <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                    <rect opacity=0.3 width=12 height=2 rx=1 transform="matrix(-1 0 0 1 15.5 11)" fill=black />
                                    <path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill=black />
                                    <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill=#C4C4C4 />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                                <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id=kt_aside_mobile_toggle>
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill=black />
                                        <path opacity=0.3 d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill=black />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class=toolbar>
                            <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
                                <div class="page-title d-flex flex-column me-5">
                                    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Dashboard</h1>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                                        <li class="breadcrumb-item text-muted">
                                            <a href=../../demo8/dist/index.html class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <li class=breadcrumb-item>
                                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-dark">Default</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="content d-flex flex-column flex-column-fluid" id=kt_content>
                        <div class="post d-flex flex-column-fluid" id=kt_post>
                            <div id=kt_content_container class=container-xxl>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    <div class="footer py-4 d-flex flex-lg-column" id=kt_footer>
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-bold me-1">@php echo date('Y'); @endphp©</span>
                                <a href=https://keenthemes.com target=_blank class="text-gray-800 text-hover-primary">{{ config('app.name', 'Laravel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id=kt_scrolltop class=scrolltop data-kt-scrolltop=true>
            <span class=svg-icon>
                <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none>
                <rect opacity=0.5 x=13 y=6 width=13 height=2 rx=1 transform="rotate(90 13 6)" fill=black />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill=black />
                </svg>
            </span>
        </div>
        <script>var hostUrl = "{{ asset('src/'); }}";</script>
        <script src="{{ asset('src/plugins/global/plugins.bundle.js'); }}"></script>
        <script src="{{ asset('src/js/scripts.bundle.js'); }}"></script>
        <script src="{{ asset('src/plugins/custom/fullcalendar/fullcalendar.bundle.js'); }}"></script>
        <script src="{{ asset('src/js/custom/widgets.js'); }}"></script>
        <script src="{{ asset('src/js/custom/apps/chat/chat.js'); }}"></script>
        <script src="{{ asset('src/js/custom/modals/create-app.js'); }}"></script>
        <script src="{{ asset('src/js/custom/modals/upgrade-plan.js'); }}"></script>
        @yield('scripts')
    </body>
</html>