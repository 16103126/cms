@extends('auth.master')

@section('title', __('User Login'))

@section('content')
<style>
  .input{
    background: rgba(255, 255, 255, 0.1);
  }
</style>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card" style="background-color: #042656 !important;">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <h4> @lang('Login')</h4>
            </div>
            <form class="mb-3" action="{{ route('user.login') }}" method="POST">
              @csrf
              @include('partials.error')
              @include('partials.success')
              @include('partials.message')
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input style="background-color: rgba(255, 255, 255, 0.1);" type="email" class="form-control" id="email" name="email" @if(Cookie::has('email')) value="{{ Cookie::get('email') }}" @endif placeholder="{{ __('Enter your email') }}" required/>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">{{ __('Password') }}</label>
                  <a href="{{ route('user.password.forgot.form') }}">
                    <small>{{ __('Forgot Password?') }}</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" @if(Cookie::has('password')) value="{{ Cookie::get('password') }}" @endif  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                  <span style="background-color: rgba(255, 255, 255, 0.1);" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input style="background-color: rgba(255, 255, 255, 0.1);" class="form-check-input" type="checkbox" name="remember_me" id="remember_me" @if(Cookie::has('email')) checked @endif />
                  <label class="form-check-label" for="remember_me"> {{ __('Remember Me') }} </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Sign in') }}</button>
              </div>
              <div class="mb-3">
                <a href="{{ route('user.provider.login','google') }}" class="btn btn-outline-success d-grid w-100">{{ __('Login with google') }}</a>
              </div>
              <div class="mb-3">
                <a href="{{ route('user.provider.login','facebook') }}" class="btn btn-outline-primary d-grid w-100">{{ __('Login with facebook') }}</a>
              </div>
            </form>

            <p class="text-center">
              <span>{{ __('New on our platform?') }}</span>
              <a href="{{ route('user.register.form') }}">
                <span>{{ __('Create an account') }}</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
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
            $('#success').addClass('d-none');
            $.each(response.errors, function(index, error){
                $('#errorMsg').html('<p>' + error + '</p>');
            })
          }

          if(response.message){
              let message = response.message;
              $('#errorMsg').removeClass('d-none');
              $('#successMsg').addClass('d-none');
              $('#success').addClass('d-none');
              $('#errorMsg').html('<p>' + message + '</p>');
          }

          if(response.deactiveMsg){
            let message = response.deactiveMsg;
              $('#errorMsg').removeClass('d-none');
              $('#successMsg').addClass('d-none');
              $('#success').addClass('d-none');
              $('#errorMsg').html('<p>' + message + '</p>');
          }

          if(response.success){
              let success = response.success;
              $('#successMsg').removeClass('d-none');
              $('#errorMsg').addClass('d-none');
              $('#success').addClass('d-none');
              $('#successMsg').html('<p>' + success + '</p>');
              if(response.redirect){
                window.location = response.redirect;
              }
          }
        }
      })
  
    });
  });
  </script>

@endpush