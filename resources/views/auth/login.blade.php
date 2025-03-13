<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
    <head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>{{ ucfirst(str_replace('-',' ', request()->route()->uri)) . ' | ' . $paramsys['APP_NAME']; }}</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="article">
<meta property="og:title" content="{{ ucfirst(str_replace('-',' ', request()->route()->uri)) . ' | ' . $paramsys['APP_NAME']; }}">
<meta property="og:url" content="{{ route('login'); }}">
<meta property="og:site_name" content="">
<link rel="canonical" href="{{ route('login'); }}">
<link rel="shortcut icon" href="{{ $paramsys['FAVICON']; }}">
<link href="{{ asset('src/css/css.css'); }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('src/css/plugins.bundle.css'); }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('src/css/style.bundle_1.css'); }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('src/css/captcha.css'); }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>if(window.top!=window.self){window.top.location.replace(window.self.location.href)}</script>
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
<script>var defaultThemeMode="light";var themeMode;if(document.documentElement){if(document.documentElement.hasAttribute("data-bs-theme-mode")){themeMode=document.documentElement.getAttribute("data-bs-theme-mode")}else{if(localStorage.getItem("data-bs-theme")!==null){themeMode=localStorage.getItem("data-bs-theme")}else{themeMode=defaultThemeMode}}if(themeMode==="system"){themeMode=window.matchMedia("(prefers-color-scheme: dark)").matches?"dark":"light"}document.documentElement.setAttribute("data-bs-theme",themeMode)}</script>
<div class="d-flex flex-column flex-root" id="kt_app_root">
<style>body{background-image:url("{{ $paramsys['BACKGROUND_LOGIN']; }}")}[data-bs-theme="dark"] body{background-image:url('/metronic8/demo1/assets/media/auth/bg4-dark.jpg')}</style>
<div class="d-flex flex-column flex-column-fluid flex-lg-row">
<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
<div class="d-flex flex-center flex-lg-start flex-column">
<a href="{{ route('login'); }}" class="mb-7">
    <img alt="Logo {{ $paramsys['APP_NAME']; }}" src="{{ $paramsys['LOGO_1']; }}" style="max-width:200px;">
</a>
<h2 class="text-white fw-normal m-0">
{{ $paramsys['TEXT2']; }}
</h2>
</div>
</div>
<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
<div class="text-center mb-11">
<h1 class="text-gray-900 fw-bolder mb-3">
Sign In
</h1>
<div class="text-gray-500 fw-semibold fs-6">
{{ $paramsys['TEXT1']; }}
</div>
</div>
<div class="fv-row mb-8 fv-plugins-icon-container">
<input type="text" placeholder="{{ __('Email Address') }}" name="email" autocomplete="off" class="form-control bg-transparent">
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
<div class="fv-row mb-3 fv-plugins-icon-container">
<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent">
<input id="captchatxt" type="hidden" name="captchatxt" autocomplete="off" value="">
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>


<div class="d-grid my-10">
    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
<span class="indicator-label">Sign In</span>
<span class="indicator-progress">
Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="overlay" id="overlay">
    <div class="overlay-content" id="captcha"></div>
</div>
<script src="{{ asset('src/js/auth/plugins.bundle.js'); }}" type="text/javascript"></script>
<script src="{{ asset('src/js/auth/scripts.bundle.js'); }}" type="text/javascript"></script>
<script src="{{ asset('src/js/auth/general.js'); }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('src/js/auth/captcha.js'); }}" type="text/javascript"></script>
<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xlink="http://www.w3.org/1999/xlink" svgjs="http://svgjs.dev" style="overflow:hidden;top:-100%;left:-100%;position:absolute;opacity:0"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg>
</body>
</html>