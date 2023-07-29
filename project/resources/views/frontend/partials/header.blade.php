<header>
    <div class="container">
        <div class="header__area">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/frontend/images/logo/'.generalSetting()->website_logo) }}" alt="logo">
                </a>
            </div>
            <ul class="menu">
                @php
                    $id = Session::get('language');
                @endphp
                @foreach (\App\Models\Menu::where('isActive', 1)->orderBy('order_id', 'asc')->get() as $menu)
                    <li>
                        @if ($menu->language_id == Session::get('language') && ($menu->position == 'header' || $menu->position == 'both'))
                            @if ($menu->submenus()->count() < 1 )
                                <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                            @else
                                <a href="javascript:void(0);">{{ $menu->name }}</a>
                                <ul class="submenu">
                                    @foreach ($menu->submenus()->where('isActive', 1)->get() as $submenu)
                                    
                                        @if ($submenu->language_id == Session::get('language'))
                                            <li>
                                                <a href="{{ $submenu->url }}">{{ $submenu->name }}</a>
                                            </li>
                                        @elseif($submenu->isPrimary == 1)
                                            <li>
                                                <a href="{{ $submenu->url }}">{{ $submenu->name }}</a>
                                            </li>
                                        @endif

                                    @endforeach
                                </ul>
                            @endif
                        @elseif(!Session::has('language') || \App\Models\WebsiteLanguage::find($id)->menus()->count() < 1)
                            @if($menu->isPrimary == 1 && ($menu->position == 'header' || $menu->position == 'both'))
                                @if ($menu->submenus()->count() < 1 )
                                    <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                                @else
                                    <a href="javascript:void(0);">{{ $menu->name }}</a>
                                    <ul class="submenu">
                                        @foreach ($menu->submenus()->where('isActive', 1)->get() as $submenu)
                                            @if ($submenu->isPrimary)
                                                <li>
                                                    <a href="{{ $submenu->url }}">{{ $submenu->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        @endif
                    </li>
                @endforeach
                
                <li class="d-md-none">
                    <div class="d-flex flex-wrap mobile--header--buttons justify-content-center">
                        <a href="{{ route('user.login') }}" class="cmn--btn">@lang('Sign In')</a>
                    </div>
                </li>
            </ul>
            <div class="header-bar d-lg-none ms-auto me-3">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header__buttons d-flex">
                <select class="header--select" id="language">
                    @foreach (DB::table('website_languages')->get() as $language)
                    <option value="{{ route('website.language', $language->id) }}" {{ Session::has('language') ? (Session::get('language') == $language->id ? 'selected' : '') : (DB::table('website_languages')->where('isDefault', 1)->first()->id == $language->id ? 'selected' : '')  }}>{{ $language->language }}</option>
                    @endforeach
                </select>
                <select class="header--select">
                    <option value="en">@lang('USD')</option>
                    <option value="bn">Bangla</option>
                    <option value="en">English</option>
                    <option value="bn">Bangla</option>
                    <option value="en">English</option>
                    <option value="bn">Bangla</option>
                </select>
                <div class="d-md-flex d-none">
                    @if (Auth::guard('user')->user())
                    <a href="{{ route('user.logout') }}" class="cmn--btn">@lang('Logout')</a>
                    @else
                    <a href="{{ route('user.login') }}" class="cmn--btn">@lang('Sign In')</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>