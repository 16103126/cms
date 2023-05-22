<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">@lang('Sneat')</span>
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

      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
      <!-- Forms -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">Form Elements</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="forms-basic-inputs.html" class="menu-link">
              <div data-i18n="Basic Inputs">Basic Inputs</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="forms-input-groups.html" class="menu-link">
              <div data-i18n="Input groups">Input groups</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Layouts">Form Layouts</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="form-layouts-vertical.html" class="menu-link">
              <div data-i18n="Vertical Form">Vertical Form</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="form-layouts-horizontal.html" class="menu-link">
              <div data-i18n="Horizontal Form">Horizontal Form</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- Tables -->
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-table"></i>
          <div data-i18n="Tables">Tables</div>
        </a>
      </li>
      <!-- Misc -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
      <li class="menu-item">
        <a
          href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
          target="_blank"
          class="menu-link"
        >
          <i class="menu-icon tf-icons bx bx-support"></i>
          <div data-i18n="Support">Support</div>
        </a>
      </li>
      <li class="menu-item">
        <a
          href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
          target="_blank"
          class="menu-link"
        >
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li>
    </ul>
  </aside>