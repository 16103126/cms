<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">
          <img src="{{ asset('assets/admin/img/logo/'.generalSetting()->dashboard_logo) }}" alt="">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

      <!-- Dashboard -->

      <li class="menu-item {{ (Request::is('admin/dashboard')) ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">@lang('Dashboard')</div>
        </a>
      </li>

      <!-- Menu-->

      <li class="menu-item {{ (Request::is('admin/menu/index')) ? 'active' : '' }}">
        <a href="{{ route('admin.menu.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-menu"></i>
          <div data-i18n="Basic">@lang('Menu')</div>
        </a>
      </li>

      <!-- Page-->
      <li class="menu-item {{ ((Request::is('admin/page/create') || Request::is('admin/page/index') || Request::is('admin/page/edit*') )) ? 'active' : '' }}">
        <a href="{{ route('admin.page.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-food-menu"></i>
          <div data-i18n="Basic">@lang('Pages')</div>
        </a>
      </li>

      <!-- Form-->
      <li class="menu-item {{ (Request::is('admin/form*')) ? 'active' : '' }}">
        <a href="{{ route('admin.form.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
          <div data-i18n="Basic">@lang('Form')</div>
        </a>
      </li>

      <!-- Value-->
      <li class="menu-item {{ (Request::is('admin/value*')) ? 'active' : '' }}">
        <a href="{{ route('admin.value.form.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-table"></i>
          <div data-i18n="Basic">@lang('Value')</div>
        </a>
      </li>

      <!-- Blog -->

      <li class="menu-item {{ (Request::is('admin/category*')) || (Request::is('admin/post*')) ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon bx bxs-spreadsheet"></i>
          <div data-i18n="Account">@lang('Blog')</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('admin/category*')) ? 'active' : '' }}">
            <a href="{{ route('admin.category.index') }}" class="menu-link">
              <div data-i18n="Account">@lang('Category')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/post*')) ? 'active' : '' }}">
            <a href="{{ route('admin.post.index') }}" class="menu-link">
              <div data-i18n="Notifications">@lang('Post')</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- User -->
      <li class="menu-item {{ (Request::is('admin/user*')) ? 'active' : '' }}">
        <a href="{{ route('admin.user.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user"></i>
          <div data-i18n="Basic">@lang('User List')</div>
        </a>
      </li>

      <!-- Settings -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">@lang('Settings')</span></li>
      
      <!-- Account -->

      <li class="menu-item {{ (Request::is('admin/account*')) ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon bx bxs-user-account"></i>
          <div data-i18n="Account">@lang('Account')</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('admin/account/profile')) ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="menu-link">
              <div data-i18n="Account">@lang('Account')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/account/password/reset')) ? 'active' : '' }}">
            <a href="{{ route('admin.account.password.reset.form') }}" class="menu-link">
              <div data-i18n="Notifications">@lang('Password Reset')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/account/profile/show*')) ? 'active' : '' }}">
            <a href="{{ route('admin.account.profile.show', Auth::guard('admin')->user()->id) }}" class="menu-link">
              <div data-i18n="Connections">@lang('Profile')</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Language -->

      <li class="menu-item {{ (Request::is('admin/admin-language*')) || (Request::is('admin/website-language*')) ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon bx bxs-user-voice"></i>
          <div data-i18n="Account">@lang('Language')</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('admin/admin-language*')) ? 'active' : '' }}">
            <a href="{{ route('admin.admin-language.index') }}" class="menu-link">
              <div data-i18n="Account">@lang('Admin Language')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/website-language*')) ? 'active' : '' }}">
            <a href="{{ route('admin.website-language.index') }}" class="menu-link">
              <div data-i18n="Notifications">@lang('Website Language')</div>
            </a>
          </li>
        </ul>
      </li>

       <!-- Page setting -->

      <li class="menu-item {{ (Request::is('admin/page/setting*')) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">@lang('Page Setting')</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('admin/page/setting/home*')) ? 'active' : '' }}">
            <a href="{{ route('admin.page.setting.home') }}" class="menu-link">
              <div data-i18n="Basic Inputs">@lang('Home')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/page/setting/about*')) ? 'active' : '' }}">
            <a href="{{ route('admin.page.setting.about') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('About')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/page/setting/faqs*')) ? 'active' : '' }}">
            <a href="{{ route('admin.page.setting.faqs') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('Faqs')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/page/setting/footer*')) ? 'active' : '' }}">
            <a href="{{ route('admin.page.setting.footer') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('Footer')</div>
            </a>
          </li>
        </ul>
      </li>

       <!-- General setting -->
       <li class="menu-item {{ (Request::is('admin/general/setting*')) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div data-i18n="Form Elements">@lang('General Setting')</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ (Request::is('admin/general/setting/logo*')) ? 'active' : '' }}">
            <a href="{{ route('admin.general.setting.logo') }}" class="menu-link">
              <div data-i18n="Basic Inputs">@lang('Logo')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/general/setting/icon*')) ? 'active' : '' }}">
            <a href="{{ route('admin.general.setting.icon') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('Icon')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/general/setting/social*')) ? 'active' : '' }}">
            <a href="{{ route('admin.general.setting.social') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('Social Login')</div>
            </a>
          </li>
          <li class="menu-item {{ (Request::is('admin/general/setting/captcha*')) ? 'active' : '' }}">
            <a href="{{ route('admin.general.setting.captcha') }}" class="menu-link">
              <div data-i18n="Input groups">@lang('Captcha Setting')</div>
            </a>
          </li>
        </ul>
      </li>

       <!-- Mail -->
       <li class="menu-item {{ (Request::is('admin/mail')) ? 'active' : '' }}">
        <a href="{{ route('admin.mail') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-envelope"></i>
          <div data-i18n="Basic">@lang('Mail Setting')</div>
        </a>
      </li>

      <!-- SEO -->
      <li class="menu-item {{ (Request::is('admin/seo')) ? 'active' : '' }}">
        <a href="{{ route('admin.seo') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-brightness"></i>
          <div data-i18n="Basic">@lang('SEO')</div>
        </a>
      </li>

      <!-- Contact -->
      <li class="menu-item {{ (Request::is('admin/contact*')) ? 'active' : '' }}">
        <a href="{{ route('admin.contact.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-contact"></i>
          <div data-i18n="Basic">@lang('Contact')</div>
        </a>
      </li>

      <!-- Subscriber -->
      <li class="menu-item {{ (Request::is('admin/subscriber/index')) ? 'active' : '' }}">
        <a href="{{ route('admin.subscriber.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-bell-ring"></i>
          <div data-i18n="Basic">@lang('Subscribers')</div>
        </a>
      </li>

    </ul>
  </aside>