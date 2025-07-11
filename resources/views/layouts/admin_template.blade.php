<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ route('dashboard') }}">
    @isset($paramsys['APP_NAME'])
        <title>{{ ucfirst(str_replace('-', ' ', request()->route()->uri)) }} | {{ $paramsys['APP_NAME'] }}</title>
    @endisset
    
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Open Graph Meta Tags -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ ucfirst(str_replace('-', ' ', request()->route()->uri)) }} | {{ $paramsys['APP_NAME'] }}">
    <meta property="og:url" content="{{ url('') }}">
    @isset($paramsys['APP_NAME'])
    <meta property="og:site_name" content="{{ str_replace('-', ' ', request()->route()->uri) }} | {{ $paramsys['APP_NAME'] }}">
    @endisset

    <link rel="canonical" href="{{ url('') }}">
    @isset($paramsys['FAVICON'])
    <link rel="shortcut icon" href="{{ $paramsys['FAVICON'] }}">
    @endisset

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('stylesheet')
</head>

<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
    <!--[remaining content matches exactly the previously approved version from final_file_content]-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!-- Left Aside -->
            <div id="kt_aside" class="aside" 
                data-kt-drawer="true" 
                data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" 
                data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '250px'}" 
                data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                
                <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
                    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                        <div class="symbol symbol-50px">
                            <img src="{{ asset($user->pict) }}" alt="User Avatar">
                        </div>
                        <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                            <div class="d-flex">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-white text-hover-primary fs-6 fw-bold">
                                        {{ $user->name }}
                                    </a>
                                    <span class="text-gray-600 fw-bold d-block fs-8 mb-1">
                                        {{ $role_user->name }}
                                    </span>
                                    <div class="d-flex align-items-center text-success fs-9">
                                        <span class="bullet bullet-dot bg-success me-1"></span>online
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @include('layouts.navigation')
            </div>

            <!-- Main Content Wrapper -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!-- Header -->
                <div id="kt_header" class="header align-items-stretch">
                    <div class="header-brand">
                        <a href="{{ request()->routeIs('dashboard') ? 'javascript:void(0);' : route('dashboard') }}">
                            <img alt="Logo" src="{{ $paramsys['LOGO_1'] }}" class="h-25px h-lg-25px">
                        </a>
                        
                        <!-- Aside Toggle -->
                        <div id="kt_aside_toggle" 
                            class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize"
                            data-kt-toggle="true" 
                            data-kt-toggle-state="active" 
                            data-kt-toggle-target="body"
                            data-kt-toggle-name="aside-minimize">
                            <span class="svg-icon svg-icon-1 me-n1 minimize-default">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="black"/>
                                    <path d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z" fill="black"/>
                                    <path opacity="0.5" d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z" fill="black"/>
                                </svg>
                            </span>
                            <span class="svg-icon svg-icon-1 minimize-active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
                                    <path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"/>
                                    <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
                                </svg>
                            </span>
                        </div>

                        <!-- Mobile Menu Toggle -->
                        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black"/>
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Toolbar -->
                    <div class="toolbar">
                        <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
                            <!-- Page Title -->
                            <div class="page-title d-flex flex-column me-5">
                                <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0 text-capitalize">
                                    {{ str_replace('-', ' ', request()->route()->uri) }}
                                </h1>
                                <!-- Breadcrumb -->
                                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-dark">
                                        {{ str_replace('-', ' ', request()->route()->uri) }}
                                    </li>
                                </ul>
                            </div>

                            <!-- Time Display -->
                            <div class="page-title d-flex flex-column me-5">
                                <h1 id="clock" class="d-flex flex-column text-dark fw-bolder fs-3 mb-0 text-capitalize"></h1>
                                <h2 class="d-flex flex-column fs-3 mb-0 text-capitalize">
                                    {{ date('d F Y') }}<span id="dayName"></span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">{{ date('Y') }} &copy;</span>
                            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">
                                @isset($paramsys['APP_NAME'])
                                    {{ $paramsys['APP_NAME'] }}
                                @else
                                    {{ config('app.name', 'Laravel') }}
                                @endisset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Top -->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"/>
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"/>
            </svg>
        </span>
    </div>

    <!-- Scripts -->
    <script>
        var hostUrl = "{{ asset('') }}";
    </script>
    <script src="{{ asset('src/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('src/js/scripts.bundle.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Activate current menu item
            var menu_active = $('#active').parent().parent();
            menu_active.addClass('hover show');

            // Clock Update Function
            function updateClock() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0');
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                
                $('#clock').text(`${hours}:${minutes}:${seconds} ${days[now.getDay()]}`);
            }

            // Initialize clock
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
