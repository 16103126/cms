@extends('auth.master')

@section('title', __('Forgot Password'))

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
            <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">{{ __('Forgot Password') }}</span>
                </a>
            </div>
            <!-- /Logo -->
            <p class="mb-4">{{ __('Enter your email and we will send you instructions to reset your password') }}</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('user.password.forgot') }}" method="POST">
                @csrf
                @include('partials.error')
                @include('partials.success')
                @include('partials.message')
                {{-- <div><p>{{ ('Please wait ....') }}</p></div> --}}
                <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" required>
                </div>
                <button class="btn btn-primary d-grid w-100">{{ __('Send Reset Link') }}</button>
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

                $('#successMsg').removeClass('d-none');
                $('#errorMsg').addClass('d-none');
                $('#successMsg').html('<p>Please wait...</p>');

                e.preventDefault();
                let url      = $(this).attr('action');
                let method   = $(this).attr('method');

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

                        if(response.message){
                            let message = response.message;
                            $('#errorMsg').removeClass('d-none');
                            $('#successMsg').addClass('d-none');
                            $('#errorMsg').html('<p>' + message + '</p>');
                        }

                        if(response.success){
                            let success = response.success;
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