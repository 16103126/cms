@extends('auth.master')

@section('title', __('Password Reset Link'))

@section('content')
   <p>{{ __('Click here,') }}</p> <a href="{{ route('user.password.reset', $user->username) }}"> {{ __('for reset your password.') }}</a>
@endsection