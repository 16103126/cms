@extends('admin.master')

@section('title', __('Admin Porfile'))

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item {{ (Request::is('admin/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                      </li>
                      <li class="breadcrumb-item {{ (Request::is('admin/account/profile/show*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}">@lang('Profile')</a>
                      </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Profile Information')</h5>
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-10">
                          <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <img src="{{ asset('assets/admin/img/profile/'.$admin->image) }}" class="d-block rounded" height="100" width="100" id="preview-image">
                              
                            </div>
                          </div>
                          <hr class="my-0">
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                              <div class="row">
                                  <div class="col-sm-2">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" value="{{ $admin->name }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Username') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->username }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->email }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Phone Number') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->phone_number }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Age') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->age }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Gender') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->gender }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Nid') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $admin->nid }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Country') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $address->country }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('State') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $address->state }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('city') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $address->city }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('Zip Code') }}</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $address->zip_code }}" disabled/>
                              </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">{{ __('About') }}</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" cols="30" rows="10" disabled>{{ $admin->about }}</textarea>
                              </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>  <!-- Content wrapper -->
@endsection