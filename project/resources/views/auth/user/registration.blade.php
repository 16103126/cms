@extends('auth.master')

@section('title', __('User Rgistration'))

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">{{ __('Register') }}</span>
              </a>
            </div>
            <!-- /Logo -->

            <form id="formAuthentication" class="mb-3" action="{{ route('user.register') }}" method="POST">
              @csrf
              @include('partials.error')
              @include('partials.success')
              <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Enter your name') }}" required />
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="{{ __('Enter your username') }}" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" required />
              </div>
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
              <div class="mb-3">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
              </div>
              <button class="btn btn-primary d-grid w-100">{{ __('Sign up') }}</button>
            </form>

            <p class="text-center">
              <span>{{ __('Already have an account?') }}</span>
              <a href="{{ route('user.login.form') }}">
                <span>{{ __('Sign in instead') }}</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
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
      let url    = $(this).attr('action');
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
              $('#successMsg').removeClass('d-none');
              $('#errorMsg').addClass('d-none');
              $('#successMsg').html('<p>' + success + '</p>');
              if(response.redirect){
                window.location = response.redirect;
              }
              //   window.location.replace(
              //     '{{ route("user.login.form") }}'
              //   );
              
          }
        }
      });
    });
  });
</script>
    
@endpush