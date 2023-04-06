@extends('auth.master')

@section('title', __('Reset Password'))

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                    <span class="app-brand-text demo text-body fw-bolder">{{ __('Reset Password') }}</span>
                    </a>
                </div>
                <!-- /Logo -->
                <form id="formAuthentication" class="mb-3" action="{{ route('user.password.reset', $user->username) }}" method="POST">
                    @csrf
                    @include('partials.error')
                    @include('partials.success')
                    @include('partials.message')
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <div class="input-group input-group-merge">
                          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required aria-describedby="password"/>
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                      </div>
                      <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="confirm_password">{{ __('Confirm Password') }}</label>
                        <div class="input-group input-group-merge">
                          <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required aria-describedby="password"/>
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                      </div>
                    <button class="btn btn-primary d-grid w-100">{{ __('Reset Password') }}</button>
                </form>
                <div class="text-center">
                    <a href="{{ route('user.login.form') }}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    {{ __('Back to login') }}
                    </a>
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
        $('form').on('submit', function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                url         : url,
                type        : method,
                data        : new FormData(this),
                cache       : false,
                processData : false,
                contentType : false,

                success : function(response){
                    if(response.errors){
                        $('#errorMsg').removeClass('d-none');
                        $('#successMsg').addClass('d-none');
                        $.each(response.errors, function(index, error){
                            $('#errorMsg').html('<p>' + error + '</p>');
                        })
                    }

                    if(response.success){
                        let success = response.success;
                        let link = response.redirect;
                        $('#successMsg').removeClass('d-none');
                        $('#errorMsg').addClass('d-none');
                        $('#successMsg').html('<p>' + success + '</p>');
                    }
                }
            });
        });
    });
</script>
@endpush