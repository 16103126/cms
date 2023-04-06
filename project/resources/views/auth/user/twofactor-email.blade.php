@extends('auth.master')

@section('content')
   <p>{{ __('Your two factor authentication code is ') . $user->twofa_code }}</p> 
@endsection