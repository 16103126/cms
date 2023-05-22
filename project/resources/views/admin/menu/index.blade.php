@extends('admin.master')

@section('title', __('Menu'))

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                          <li class="breadcrumb-item {{ (Request::is('admin/dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                          <li class="breadcrumb-item {{ (Request::is('admin/menu/index')) ? 'active' : '' }}">
                            <a href="{{ route('admin.menu.index') }}">@lang('Menu')</a>
                          </li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <h6 class="text-primary">@lang('Menu List')</h6>
                                      </div>
                                      <div class="col-sm-6">
                                        <select id="lang" class="form-select">
                                          <option value="{{ route('admin.menu.primary', $menus->where('isPrimary', 1)->first()->id) }}">@lang('Primary')</option>
                                          @foreach ($languages as $language)
                                          <option value="{{ route('admin.menu.lang', $language->id) }}" {{ Session::get('lang') == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="alert alert-success d-none" id="message">
                                      <div id="menuMessage"> </div>
                                    </div>
                                    <div class="alert alert-info d-none" id="statusInfo"></div>
                                    <ul id="sortableMenu" style="margin-left: -30px">
                                        @foreach ($menus->where('language_id', Session::get('lang')) as $menu )
                                          <div data-id="{{ $menu->id }}" class="ui-state">
                                              <div class="container card mt-3" style="background-color: rgba(14, 11, 11, 0.1);">
                                                  <h6 class="mt-3">{{ $menu->name }} 
                                                      <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteMenu{{ $menu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                      <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editMenu{{ $menu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                      <span class="form-switch" style="float: right; margin-right: 10px;">
                                                      <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.menu.status', $menu->id) }}" {{ $menu->isActive == 1 ? 'checked' : '' }} id="switchForMenu" style="size: 10px;"></span>
                                                  </h6>
                                              </div>
                                              @if ($menu->submenus())
                                                  <ul id="sortableSubmenu">
                                                      @foreach ($menu->submenus as $submenu)
                                                        <div class="ui-state container card mt-3 submenu" data-id="{{ $submenu->id }}" style="background-color: rgba(14, 11, 11, 0.1);">
                                                            <h6 class="mt-3">{{ $submenu->name }}
                                                                <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteSubmenu{{ $submenu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                                <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editSubmenu{{ $submenu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                                <span class="form-switch" style="float: right; margin-right: 10px;">
                                                                <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.submenu.status', $submenu->id) }}" {{ $submenu->isActive == 1 ? 'checked' : '' }} id="switchForSubmenu" style="size: 10px;"></span>
                                                            </h6>
                                                        </div>
                                                      @endforeach
                                                  </ul>
                                              @endif
                                          </div>
                                        @endforeach
                                        @if (!Session::has('lang') || $menus->where('language_id', Session::get('lang'))->count() < 1)
                                          @php
                                              $lang_id = $languages->where('isDefault', 1)->first()->id;
                                          @endphp
                                          @foreach ($menus->where('language_id', $lang_id) as $menu )
                                            <div data-id="{{ $menu->id }}" class="ui-state">
                                                <div class="container card mt-3" style="background-color: rgba(14, 11, 11, 0.1);">
                                                    <h6 class="mt-3">{{ $menu->name }} 
                                                        <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteMenu{{ $menu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                        <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editMenu{{ $menu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                        <span class="form-switch" style="float: right; margin-right: 10px;">
                                                        <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.menu.status', $menu->id) }}" {{ $menu->isActive == 1 ? 'checked' : '' }} id="switchForMenu" style="size: 10px;"></span>
                                                    </h6>
                                                </div>
                                                @if ($menu->submenus())
                                                    <ul id="sortableSubmenu">
                                                        @foreach ($menu->submenus as $submenu)
                                                          <div class="ui-state container card mt-3 submenu" data-id="{{ $submenu->id }}" style="background-color: rgba(14, 11, 11, 0.1);">
                                                              <h6 class="mt-3">{{ $submenu->name }}
                                                                  <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteSubmenu{{ $submenu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                                  <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editSubmenu{{ $submenu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                                  <span class="form-switch" style="float: right; margin-right: 10px;">
                                                                  <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.submenu.status', $submenu->id) }}" {{ $submenu->isActive == 1 ? 'checked' : '' }} id="switchForSubmenu" style="size: 10px;"></span>
                                                              </h6>
                                                          </div>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                          @endforeach
                                        @endif
                                        @if (!Session::has('lang') && Session::has('primary') && !$menus->where('language_id', Session::get('lang'))->count() < 1)
                                          @foreach ($menus->where('isPrimary', Session::has('primary')) as $menu )
                                            <div data-id="{{ $menu->id }}" class="ui-state">
                                                <div class="container card mt-3" style="background-color: rgba(14, 11, 11, 0.1);">
                                                    <h6 class="mt-3">{{ $menu->name }} 
                                                        <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteMenu{{ $menu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                        <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editMenu{{ $menu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                        <span class="form-switch" style="float: right; margin-right: 10px;">
                                                        <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.menu.status', $menu->id) }}" {{ $menu->isActive == 1 ? 'checked' : '' }} id="switchForMenu" style="size: 10px;"></span>
                                                    </h6>
                                                </div>
                                                @if ($menu->submenus())
                                                    <ul id="sortableSubmenu">
                                                        @foreach ($menu->submenus as $submenu)
                                                          <div class="ui-state container card mt-3 submenu" data-id="{{ $submenu->id }}" style="background-color: rgba(14, 11, 11, 0.1);">
                                                              <h6 class="mt-3">{{ $submenu->name }}
                                                                  <span style="float: right;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteSubmenu{{ $submenu->id }}"><i class='bx bx-x text-danger'></i></a></span>
                                                                  <span style="float: right; margin-right: 10px;"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editSubmenu{{ $submenu->id }}"><i class='bx bxs-edit-alt'></i></a></span> 
                                                                  <span class="form-switch" style="float: right; margin-right: 10px;">
                                                                  <input class="form-check-input switch" type="checkbox" data-href="{{ route('admin.submenu.status', $submenu->id) }}" {{ $submenu->isActive == 1 ? 'checked' : '' }} id="switchForSubmenu" style="size: 10px;"></span>
                                                              </h6>
                                                          </div>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                          @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @foreach ($menus as $menu)
                            @foreach ($menu->submenus as $submenu)
                              <div class="modal fade" id="editSubmenu{{ $submenu->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel2">@lang('Edit Submenu')</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('admin.submenu.update', $submenu->id) }}" method="POST" data-id="{{ $submenu->id }}">
                                        @csrf
                                        <div class="d-none" id="submenuErrorMsg{{ $submenu->id }}"></div>
                                        <div class="d-none" id="submenuSuccessMsg{{ $submenu->id }}"></div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Submenu Name')</label>
                                            <input type="text" name="name" id="nameSmall" class="form-control" value="{{ $submenu->name }}">
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Menu')</label>
                                            <select name="menu_id" id="defaultSelect" class="form-select">
                                              @foreach ($menus as $menu)
                                                @if ($menu->language_id == Session::get('lang'))
                                                  <option value="{{ $menu->id }}" {{ $menu->id == $submenu->menu_id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                                @endif
                                                @if ((!Session::has('lang') || $menus->where('language_id', Session::get('lang'))->count() < 1)))
                                                  @if ($menu->language_id == $lang_id)
                                                    <option value="{{ $menu->id }}" {{ $menu->id == $submenu->menu_id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                                  @endif
                                                @endif
                                              @endforeach 
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Submenu url')</label>
                                            <input type="text" name="url" id="nameSmall" class="form-control" value="{{ $submenu->url }}">
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameSmall" class="form-label">@lang('Language')</label>
                                                <select name="language_id" id="defaultSelect" class="form-select">
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}" {{ $language->id == $submenu->language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                              <label for="nameSmall" class="form-label">@lang('Submenu Type')</label>
                                              <div class="form-check mt-2">
                                                <input class="form-check-input" name="isPrimary" type="checkbox" {{ $submenu->isPrimary == 1 ? 'checked' : '' }} id="defaultCheck3">
                                                <label class="form-check-label" for="defaultCheck3"> @lang('Primary') </label>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        @lang('Cancel')
                                      </button>
                                      <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                            </div>
    
                            <div class="modal fade" id="deleteSubmenu{{ $submenu->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel2">@lang('Delete Submenu')</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row mb-3">
                                        <div class="col">
                                          <div class="d-none" id="deleteMsg{{ $submenu->id }}"></div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col">
                                          <h6 class="text-danger">@lang('Are you sure to delete it permanently?')</h6>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        @lang('Cancel')
                                      </button>
                                      <button data-href="{{ route('admin.submenu.delete', $submenu->id) }}" data-id="{{ $submenu->id }}" class="btn btn-danger">@lang('Yes, Delete it!')</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        @endforeach

                        @foreach ($menus as $menu)
                          <div class="modal fade" id="editMenu{{ $menu->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">@lang('Edit Menu')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" id="menuUpdateForm" data-id="{{ $menu->id }}">
                                      @csrf
                                      <div class="d-none" id="menuErrorMsg{{ $menu->id }}"></div>
                                      <div class="d-none" id="menuSuccessMsg{{ $menu->id }}"></div>
                                      <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Menu Name')</label>
                                            <input name="name" type="text" id="nameSmall" class="form-control" value="{{ $menu->name }}">
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Menu Url')</label>
                                            <input name="url" type="text" id="nameSmall" class="form-control" value="{{ $menu->url }}">
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Language')</label>
                                            <select name="language_id" id="defaultSelect" class="form-select">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ $language->id == $menu->language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">@lang('Menu Type')</label>
                                            <div class="form-check mt-2">
                                              <input class="form-check-input" name="isPrimary" type="checkbox" {{ $menu->isPrimary == 1 ? 'checked' : '' }} id="defaultCheck3">
                                              <label class="form-check-label" for="defaultCheck3"> @lang('Primary') </label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <label for="" class="form-lebel">@lang('Position')</label>
                                            <small class="text-light fw-semibold d-block"></small>
                                            <div class="form-check form-check-inline mt-2">
                                              <input class="form-check-input" {{ $menu->position == 'header' ? 'checked' : '' }} type="radio" name="position" id="inlineRadio4" value="header">
                                              <label class="form-check-label" for="inlineRadio4">@lang('Header')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" {{ $menu->position == 'footer' ? 'checked' : '' }} type="radio" name="position" id="inlineRadio4" value="footer">
                                              <label class="form-check-label" for="inlineRadio4">@lang('Footer')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ $menu->position == 'both' ? 'checked' : '' }} type="radio" name="position" id="inlineRadio4" value="both">
                                                <label class="form-check-label" for="inlineRadio4">@lang('Both')</label>
                                            </div>
                                          </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                      @lang('Cancel')
                                    </button>
                                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                          </div>
                          <div class="modal fade" id="deleteMenu{{ $menu->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">@lang('Delete Menu')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="d-none" id="deleteMsg{{ $menu->id }}"></div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col">
                                        <h6 class="text-danger">@lang('Are you sure to delete it permanently?')</h6>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                      @lang('Cancel')
                                    </button>
                                    <button data-href="{{ route('admin.menu.delete', $menu->id) }}" data-id="{{ $menu->id }}" class="btn btn-danger">@lang('Yes, Delete it!')</button>
                                  </div>
                                </div>
                              </div>
                          </div> 
                        @endforeach

                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="text-primary">@lang('Create Custom Menu')</h6>
                                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                        <li class="nav-item" id="mainMenuBtn">
                                          <a class="nav-link active" href="javascript:void(0);">@lang('Menu')</a>
                                        </li>
                                        <li class="nav-item" id="subMenuBtn" >
                                          <a class="nav-link" href="javascript:void(0);">@lang('Submenu')</a>
                                        </li>
                                    </ul>
                                    <form id="mainMenuForm" class="" action="{{ route('admin.menu.store') }}" method="POST">
                                        @csrf
                                        @include('partials.success')
                                        @include('partials.error')
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('Menu Name')</label>
                                            <input name="name" type="text" class="form-control" placeholder="Enter menu name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('URL')</label>
                                            <input name="url" type="text" class="form-control" placeholder="Enter menu url" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('Language')</label>
                                            <select name="language_id" id="defaultSelect" class="form-select">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ Session::get('lang') == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-lebel">@lang('Position')</label>
                                            <small class="text-light fw-semibold d-block"></small>
                                            <div class="form-check form-check-inline mt-2">
                                              <input class="form-check-input" checked type="radio" name="position" id="inlineRadio1" value="header">
                                              <label class="form-check-label" for="inlineRadio1">@lang('Header')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="footer">
                                              <label class="form-check-label" for="inlineRadio2">@lang('Footer')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="booth">
                                                <label class="form-check-label" for="inlineRadio2">@lang('Both')</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">@lang('Submint')</button>
                                    </form>
                                    <form id="subMenuForm" class="d-none" action="{{ route('admin.submenu.store') }}" method="POST">
                                        @csrf
                                        <div id="Msg"></div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('Submenu Name')</label>
                                            <input name="name" type="text" class="form-control" placeholder="Enter submenu name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('Menu')</label>
                                            <select name="menu_id" id="defaultSelect" class="form-select">
                                                @foreach ($menus as $menu)
                                                  @if ($menu->language_id == Session::get('lang'))
                                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                  @endif
                                                  @if ((!Session::has('lang') || $menus->where('language_id', Session::get('lang'))->count() < 1)))
                                                    @if ($menu->language_id == $lang_id)
                                                      <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                    @endif
                                                  @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('URL')</label>
                                            <input name="url" type="text" class="form-control" placeholder="Enter submenu url" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lebel" for="">@lang('Language')</label>
                                            <select name="language_id" id="defaultSelect" class="form-select">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ Session::get('lang') == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">@lang('Submint')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(document).ready(function(){

      $('#lang').on('change', function(){
          let url = $(this).val();
          window.location = url;
      });

      $('.btn-danger').on('click', function(e){
        e.preventDefault();
        let url = $(this).attr('data-href');
        let id = $(this).attr('data-id');
        
        $.ajax({
          url : url,
          type : 'DELETE',
          dataType : 'json',
          data : {
            _token: '{{csrf_token()}}'
          },

          success : function(response){
            if(response.infoMsg){
              $('#deleteMsg'+id).removeClass('d-none');
              $('#deleteMsg'+id).html(`<p class="text-info">${response.infoMsg}<p>`);
            }
            if(response.deleteMsg){
              $('#deleteMsg'+id).removeClass('d-none');
              $('#deleteMsg'+id).html(`<p class="text-success">${response.deleteMsg}<p>`);
                location.reload(true);
            }
          }
        });
      });

      $('form').on('submit', function(e){
        e.preventDefault();
        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let id = $(this).attr('data-id');
        $.ajax({
          url : url,
          method : method,
          data : new FormData(this),
          cache : false,
          processData : false,
          contentType: false,

          success : function(response){
            if(response.menuerrors){
              $('#menuSuccessMsg'+id).addClass('d-none');
              $('#menuErrorMsg'+id).removeClass('d-none');
              $.each(response.menuerrors, function(index, error){
                  $('#menuErrorMsg'+id).html('<p class="text-danger">' + error + '</p>');
              });
            }

            if(response.menusuccess){
              $('#menuSuccessMsg'+id).removeClass('d-none');
              $('#menuErrorMsg'+id).addClass('d-none');
              $('#menuSuccessMsg'+id).html('<p class="text-success">' + response.menusuccess + '</p>');
              location.reload(true);
            }

            if(response.submenuerrors){
              $('#submenuSuccessMsg'+id).addClass('d-none');
              $('#submenuErrorMsg'+id).removeClass('d-none');
              $.each(response.submenuerrors, function(index, error){
                $('#submenuErrorMsg'+id).html('<p class="text-danger">' + error + '</p>');
              });
            }

            if(response.submenusuccess){
              $('#submenuSuccessMsg'+id).removeClass('d-none');
              $('#submenuErrorMsg'+id).addClass('d-none');
              $('#submenuSuccessMsg'+id).html('<p class="text-success">' + response.submenusuccess + '</p>');
              location.reload(true);
            }

            if(response.errors){
                $('#errorMsg').removeClass('d-none');
                $('#successMsg').addClass('d-none');
                $('#message').addClass('d-none');
                $.each(response.errors, function(index, error){
                    $('#errorMsg').html('<p>' + error + '</p>');
                });
            }

            if(response.success){
                $('#errorMsg').addClass('d-none');
                $('#successMsg').removeClass('d-none');
                $('#message').addClass('d-none');
                $('#successMsg').html('<p>' + response.success + '</p>');
                location.reload(true);
            }

            if(response.errorss){
                $('#errorMsg').removeClass('d-none');
                $('#successMsg').addClass('d-none');
                $('#message').addClass('d-none');
                $.each(response.errorss, function(index, errors){
                    $('#Msg').html('<p class="text-danger">' + errors + '</p>');
                });
            }
            if(response.successs){
                $('#errorMsg').addClass('d-none');
                $('#successMsg').removeClass('d-none');
                $('#message').addClass('d-none');
                $('#Msg').html('<p class="text-success">' + response.successs + '</p>');
                location.reload(true);
            }
          }
        });
      });

      $('input.switch[type=checkbox]').on('change', function(){
          let url = $(this).attr('data-href');
          let method = 'POST';
          let array = [];

          if($(this).is(':checked')){
              array.push(1);
          }
          
          if(!$(this).is(':checked')){
              array.push(0);
          }

          let data = array.toString();
          $.ajax({
              type : method,
              url : url,
              dataType: 'json',
              data : {
                  data  : data,
                  _token: '{{csrf_token()}}'
              },
              success : function(response){

                if(response.infoStatus){
                  $('#statusInfo').removeClass('d-none');
                  $('#message').addClass('d-none');
                  $('#successMsg').addClass('d-none');
                  $('#statusInfo').html(`<p>${response.infoStatus}</P>`);
                }
                if(response.msg){
                  $('#message').removeClass('d-none');
                  $('#statusInfo').addClass('d-none');
                  $('#successMsg').addClass('d-none');
                  $('#message').html('<p>' + response.msg + '</p>');
                  location.reload(true);
                }
              }
          });
      });

      $('#mainMenuBtn').on('click', function(){
          $(this).find('a').addClass('active');
          $('#subMenuBtn').find('a').removeClass('active');
          $('#mainMenuForm').removeClass('d-none');
          $('#subMenuForm').addClass('d-none');
      });

      $('#subMenuBtn').on('click', function(){
          $(this).find('a').addClass('active');
          $('#mainMenuBtn').find('a').removeClass('active');
          $('#subMenuForm').removeClass('d-none');
          $('#mainMenuForm').addClass('d-none');
      });

      $( "#sortableMenu" ).sortable({
          axis : 'y',
          cursor: 'move',
          opacity: '.5',
          update : function(event, ui){
              let id = $('#sortableMenu').sortable('toArray', {attribute : 'data-id'});
              $.ajax({
                  type: "POST", 
                  dataType: "json", 
                  url: "{{ route('admin.menu.order.update') }}",
                  data: {
                  order  : id,
                  _token: '{{csrf_token()}}'
                  },
                  success: function(response) {
                      if(response.message){
                          $('#message').removeClass('d-none');
                          $('#successMsg').addClass('d-none');
                          $('#statusInfo').addClass('d-none');
                          $('#message').html('<p>' + response.message + '</p>');
                          location.reload(true);
                      }
                  }
              });
          }
      });

      $('.submenu').parents('#sortableSubmenu').sortable({
          axis : 'y',
          cursor: 'move',
          opacity: '.5',
          update : function(event, ui){
              let id = $(this).sortable('toArray', {attribute : 'data-id'});
              $.ajax({
                  type: "POST", 
                  dataType: "json", 
                  url: "{{ route('admin.submenu.order.update') }}",
                  data: {
                  order  : id,
                  _token: '{{csrf_token()}}'
                  },
                  success: function(response) {

                    if(response.infoStatus){
                      $('#statusInfo').removeClass('d-none');
                      $('#message').addClass('d-none');
                      $('#successMsg').addClass('d-none');
                      $('#statusInfo').html(`<p>${response.infoStatus}</p>`)
                    }
                    if(response.messagess){
                      $('#message').removeClass('d-none');
                      $('#successMsg').addClass('d-none');
                      $('#statusInfo').addClass('d-none');
                      $('#message').html('<p>' + response.messagess + '</p>');
                      location.reload(true);
                    }
                  }
              });
          }
      });
    });
</script>
@endpush