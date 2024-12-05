<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id=kt_aside_menu_wrapper data-kt-scroll=true data-kt-scroll-height=auto data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers=#kt_aside_menu data-kt-scroll-offset=5px>
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id=#kt_aside_menu data-kt-menu=true>
            @foreach($menus as $menu)
            @if($menu->children->isEmpty())
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs($menu->link) ? 'active' : '' }}" href="{{ request()->routeIs($menu->link) ? 'javascript:void(0);' : $menu->link }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">{{ $menu->nama; }}</span>
                </a>
            </div>
            @endif
            @foreach($menu->children as $child)
            @if($child->children->isEmpty())
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                            </svg>
                        </span>
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
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                            </svg>
                        </span>
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