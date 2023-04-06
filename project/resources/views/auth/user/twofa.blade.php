@extends('auth.master')

@section('title', __('Two Factor Varification'))

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
            <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">{{ __('Two Factor Varification') }}</span>
                </a>
            </div>
            <!-- /Logo -->
            <form id="formAuthentication" class="mb-3" action="{{ route('user.twofa') }}" method="POST">
                @csrf
                @include('partials.error')
                @include('partials.success')
                @include('partials.message')
                <div id="sendMsg" class="alert alert-success d-none" role="alert" >
    
                </div>
                <div class="mb-3">
                <input type="text" class="form-control" id="twofa_code" name="twofa_code" placeholder="{{ __('Enter Varification Code') }}" >
                </div>
                <div class="mt-3">
                    <a href="{{ route('user.resend.code') }}" class="mt-5">
                    {{ __('Resend Code') }}
                    </a>
                </div>
                <button class="btn btn-primary d-grid w-100 mt-3">{{ __('Submit') }}</button>
            </form>
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

    $('a').on('click', function(e){
      e.preventDefault();
      $('#sendMsg').html('<p> Please, wait...</p>');
      let url = $(this).attr('href');
      $.ajax({
        url : url,
        type : 'GET',
        dataType : 'Json',
        success : function(response){
          if(response.send){
            $('#sendMsg').removeClass('d-none');
            $('#errorMsg').addClass('d-none');
            $('#successMsg').addClass('d-none');
            $('#success').addClass('d-none');
            $('#sendMsg').html('<p>' + response.send + '</p>')
          }
        }

      });
    });

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
            $('#sendMsg').addClass('d-none');
            $.each(response.errors, function(index, error){
                $('#errorMsg').html('<p>' + error + '</p>');
            })
          }

          if(response.message){
              let message = response.message;
              $('#errorMsg').removeClass('d-none');
              $('#successMsg').addClass('d-none');
              $('#success').addClass('d-none');
              $('#sendMsg').addClass('d-none');
              $('#errorMsg').html('<p>' + message + '</p>');
          }

          if(response.success){
              let success = response.success;
              $('#successMsg').removeClass('d-none');
              $('#errorMsg').addClass('d-none');
              $('#success').addClass('d-none');
              $('#sendMsg').addClass('d-none');
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