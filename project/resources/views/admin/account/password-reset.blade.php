@extends('admin.master')

@section('title', __('Password Reset'))

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
                          </li>
                          <li class="breadcrumb-item {{ (Request::is('admin/account/password/reset')) ? 'active' : '' }}">
                            <a href="{{ route('admin.account.password.reset.form') }}">@lang('Password Reset')</a>
                          </li>
                        </ol>
                    </nav>
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                          <a class="nav-link {{(Request::is('admin/profile')) ? 'active' : ''}}" href="{{ route('admin.profile') }}"><i class="bx bx-user me-1"></i> @lang('Account')</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ (Request::is('admin/account/password/reset')) ? 'active' : '' }}" href="{{ route('admin.account.password.reset.form') }}"><i class='bx bx-reset me-1'></i> @lang('Password Reset')</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('Password Reset')</h5>
                        <div class="card-body">
                            <form action="{{ route('admin.account.password.reset', $admin->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row mb-3">
                                            <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <div id="successMsg"></div>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="password">{{ __('Password') }}</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control" placeholder="@lang('Password')" aria-describedby="password" required/>
                                            <div id="passwordMsg" class="d-none"></div>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="new_password">{{ __('New Password') }}</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="new_password" class="form-control" placeholder="{{ __('New password') }}" aria-describedby="password" required/>
                                            <div id="newPasswordMsg" class="d-none"></div>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm password')" aria-describedby="password" required/>
                                            <div id="confirmMsg" class="d-none"></div>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-primary">{{ __('Reset') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        'use strick';
        $(document).ready(function(){
            $('form').on('submit', function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                $.ajax({
                    url          : url,
                    type         : method,
                    data         : new FormData(this),
                    cache        : false,
                    processData  : false,
                    contentType  : false,
                    success      : function(response){
                                        if(response.message){
                                            $('#passwordMsg').removeClass('d-none');
                                            $('#newPasswordMsg').addClass('d-none');
                                            $('#confirmMsg').addClass('d-none');
                                            $('#successMsg').addClass('d-none');
                                            $('#passwordMsg').html(`<p class="text-danger">${response.message}</p>`);
                                        }
                                        if(response.success){
                                            $('#successMsg').removeClass('d-none');
                                            $('#confirmMsg').addClass('d-none');
                                            $('#newPasswordMsg').addClass('d-none');
                                            $('#passwordMsg').addClass('d-none');
                                            $('#successMsg').html(`<p class="text-success">${response.success}</p>`);
                                        }
                                        if(response.info){
                                            $('#newPasswordMsg').removeClass('d-none');
                                                $('#passwordMsg').addClass('d-none');
                                                $('#confirmMsg').addClass('d-none');
                                                $('#successMsg').addClass('d-none');
                                                $('#newPasswordMsg').html(`<p class="text-danger">${response.info}</p>`);
                                        }
                                        if(response.errors){
                                            if(response.errors.password){
                                                $('#passwordMsg').removeClass('d-none');
                                                $('#newPasswordMsg').addClass('d-none');
                                                $('#confirmMsg').addClass('d-none');
                                                $('#successMsg').addClass('d-none');
                                                $('#passwordMsg').html(`<p class="text-danger">${response.errors.password}</p>`);
                                            }
                                            if(response.errors.new_password){
                                                $('#newPasswordMsg').removeClass('d-none');
                                                $('#passwordMsg').addClass('d-none');
                                                $('#confirmMsg').addClass('d-none');
                                                $('#successMsg').addClass('d-none');
                                                $('#newPasswordMsg').html(`<p class="text-danger">${response.errors.new_password}</p>`);
                                            }
                                            if(response.errors.password_confirmation){
                                                $('#confirmMsg').removeClass('d-none');
                                                $('#newPasswordMsg').addClass('d-none');
                                                $('#passwordMsg').addClass('d-none');
                                                $('#successMsg').addClass('d-none');
                                                $('#confirmMsg').html(`<p class="text-danger">${response.errors.password_confirmation}</p>`);
                                            }
                                        }
                                    }
                });
            });
        });
    </script>
@endpush