@extends('auth.master')

@section('title', __('Admin Login'))

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <h4>{{ __('Login') }}</h4>
            </div>
            <!-- /Logo -->

            <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
              @csrf
              @include('partials.message')
              @include('partials.error')
              @include('partials.success')
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" required/>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">{{ __('Password') }}</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                  <span style="background-color: rgba(255, 255, 255, 0.1);" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Sign in') }}</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection

@push('js')

{{-- <!--Login Form Js -->
<script src="{{ asset('assets/dashboard/js/login-form.js') }}"></script> --}}

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
  
    })
  });
  </script>

@endpush