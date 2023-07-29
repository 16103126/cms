<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">
          <img src="{{ asset('assets/admin/img/icons/'.generalSetting()->dashboard_icon) }}" alt="">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{ (Request::is('user/dashboard')) ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">@lang('Dashboard')</div>
        </a>
      </li>
      <li class="menu-item {{ (Request::is('user/account*')) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">{{ __('Account Settings') }}</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('user/account/profile')) ? 'active' : '' }}">
            <a href="{{ route('user.profile') }}" class="menu-link">
              <div data-i18n="Account">{{ __('Account') }}</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('user/account/password/reset')) ? 'active' : '' }}">
            <a href="{{ route('user.account.password.reset.form') }}" class="menu-link">
              <div data-i18n="Notifications">@lang('Password Reset')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('user/account/twofa')) ? 'active' : '' }}">
            <a href="{{ route('user.account.twofa.form') }}" class="menu-link">
              <div data-i18n="Connections">@lang('2Fa')</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>