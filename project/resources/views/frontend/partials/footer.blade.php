<footer class="bg--title shape__container">
    @php
        if( DB::table('page_settings')->where('name', 'footer')->where('language_id', Session::get('language'))->exists())
        {
            $page = DB::table('page_settings')->where('name', 'footer')->where('language_id', Session::get('language'))->first();
        }else{
            $page = DB::table('page_settings')->where('name', 'footer')->where('isDefault', 1)->first();
        }
    @endphp
    <div class="top-footer pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-between">
                <div class="footer__widget widget__about">
                    <div class="logo mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/frontend/images/logo/'.generalSetting()->website_logo) }}" alt="logo">
                        </a>
                    </div>
                    <p>{{ $page->description }}</p>
                </div>
                @if (\App\Models\Submenu::where('isActive', 1)->count() > 0)
                <div class="footer__widget">
                    <h5 class="title">@lang('Pages')</h5>
                    <ul>
                        @foreach (\App\Models\Submenu::where('isActive', 1)->orderBy('order_id', 'asc')->get() as $submenu)
                            <li>
                                @if ($submenu->language_id == Session::get('language'))
                                <a href="{{ $submenu->url }}"><i class="las la-angle-right"></i>{{ $submenu->name }}</a>
                                @endif 
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="footer__widget">
                    <h5 class="title">@lang('Useful Links')</h5>
                    <ul>
                        @foreach (\App\Models\Menu::where('isActive', 1)->orderBy('order_id', 'asc')->get() as $menu)
                            <li>
                                @if ($menu->language_id == Session::get('language') && ($menu->position == 'footer' || $menu->position == 'both'))
                                <a href="{{ $menu->url }}"><i class="las la-angle-right"></i>{{ $menu->name }}</a>
                                @endif 
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-area">
                <div class="left">
                    <p>&copy; 2021 <a href="#0" class="text--base">Impero</a> | All right reserved</p>
                </div>
                <ul class="social-icons">
                    <li>
                        <a href="https://www.facebook.com/" class="facebook">
                            <i class="lab la-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/" class="google">
                            <i class="lab la-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" class="twitter">
                            <i class="lab la-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/" class="instagram">
                            <i class="lab la-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>