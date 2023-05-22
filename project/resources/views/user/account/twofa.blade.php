@extends('user.master')

@section('title', __('2Fa'))

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                          <li class="breadcrumb-item {{ (Request::is('user/dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
                          </li>
                          <li class="breadcrumb-item {{ (Request::is('user/account/twofa')) ? 'active' : '' }}">
                            <a href="{{ route('user.account.twofa.form') }}">@lang('2Fa')</a>
                          </li>
                        </ol>
                    </nav>
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                          <a class="nav-link {{(Request::is('user/profile')) ? 'active' : ''}}" href="{{ route('user.profile') }}"><i class="bx bx-user me-1"></i> @lang('Profile')</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ (Request::is('user/account/password/reset')) ? 'active' : '' }}" href="{{ route('user.account.password.reset.form') }}"><i class='bx bx-reset me-1'></i> @lang('Password Reset')</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ (Request::is('user/account/twofa')) ? 'active' : '' }}" href="{{ route('user.account.twofa.form') }}"><i class='bx bx-lock me-1'></i>@lang('2FA')</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('2Fa Varification')</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <form action="{{ route('user.account.twofa', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div id="successMsg"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="twofa" type="checkbox" id="checkbox" {{ $user->isTwoFa == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkbox">@lang('2FA')</label>
                                        </div>
                                    </div>
                                    <div class="row mb-3 d-none" id="twofa">
                                        <div class="col-sm">
                                            <p>@lang('Varification with')</p>
                                            <div class="form-check">
                                              <input name="sending_type" class="form-check-input" value="1" type="radio" id="smsRadio" {{ $user->sending_type == 1 ? 'checked' : '' }}>
                                              <label class="form-check-label" for="smsRadio"> @lang('SMS') </label>
                                            </div>
                                            @if ($user->phone_number == null)
                                            <div class="row">
                                                <div class="col-sm-1"> </div>
                                                <div class="col-sm-9">
                                                    <div class="d-none" id="sms">
                                                        <input class="form-control mt-3" type="number" name="phone_number" value="{{ $user->phone_number }}" placeholder="Phone number">
                                                        <div id="errorMsg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-check mt-3">
                                              <input name="sending_type" class="form-check-input" type="radio" value="0" id="gmailRadio" {{ $user->sending_type == 0 ? 'checked' : '' }}>
                                              <label class="form-check-label" for="gmailRadio"> @lang('Gmial') </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-sm-3 mb-3">
                                        <button type="submit" class="btn btn-primary active">{{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strick";
        $(document).ready(function(){
            if($('#checkbox').is(":checked")){
                    $('#twofa').removeClass('d-none');
                    $('#smsRadio').click(function(){
                        if($(this).is(':checked')){
                            $('#sms').removeClass('d-none');
                        }
                    });
                    $('#gmailRadio').click(function(){
                        if($(this).is(':checked')){
                            $('#sms').addClass('d-none');
                        }
                    });
                }
            $('#checkbox').click(function(){
                if($('#checkbox').is(":checked")){
                    $('#twofa').removeClass('d-none');
                    $('#smsRadio').click(function(){
                        if($(this).is(':checked')){
                            $('#sms').removeClass('d-none');
                        }
                    });
                    $('#gmailRadio').click(function(){
                        if($(this).is(':checked')){
                            $('#sms').addClass('d-none');
                        }
                    });
                }else{
                    $('#twofa').addClass('d-none');
                }
            });

            $('form').on('submit', function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');

                $.ajax({
                    url : url,
                    method: method,
                    data : new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(response){
                        if(response.errors){
                            $('#errorMsg').removeClass('d-none');
                            $('#successMsg').addClass('d-none');
                            $.each(response.errors, function(index, error){
                                $('#errorMsg').html(`<p class="text-danger"> ${error}</p>`);
                            })
                        }
                        if(response.success){
                            $('#successMsg').removeClass('d-none');
                            $('#errorMsg').addClass('d-none');
                            $('#successMsg').html(`<p class="text-success"> ${response.success}</p>`);
                        }
                    }
                })
            })
        });
    </script>
@endpush