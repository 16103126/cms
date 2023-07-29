@extends('frontend.master')

@section('title', __('About Page'))

@section('content')

 <!-- Hero Section Starts -->
 <section class="hero-section" style="background-color: #042656">
    <div class="container">
        <div class="hero__content text--white">
            <h2 class="hero__title text--white">@lang('About Our Company')</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">@lang('Home')</a>
                </li>
                <li>
                    @lang('About Us')
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Hero Section Ends -->

{{-- @php
    if( DB::table('page_settings')->where('name', 'about')->where('language_id', Session::get('language'))->exists())
    {
        $page = DB::table('page_settings')->where('name', 'about')->where('language_id', Session::get('language'))->first();
    }else{
        $page = DB::table('page_settings')->where('name', 'about')->where('isDefault', 1)->first();
    }
@endphp --}}

<!-- About Section Starts -->
<section class="about-section pt-120 pb-120">
    <div class="container">
        <div class="row flex-row-reverse justify-content-between gy-5">
            <div class="col-lg-6">
                <div class="section__header anime-trigger" data-anime="fadeInUpSm">
                    <h3 class="section__title">{{ $page->title }}</h3>
                </div>
                <div class="about__content anime-trigger" data-anime="fadeInUpSm">
                    <p>
                        {!! $page->description !!}
                    </p>
                    <a href="{{ route('home') }}" class="cmn--btn mt-4 anime-trigger" data-anime="fadeInUpSm">@lang('Get Started Now')</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__wrapper me-xl-4">
                    <div class="about__thumb__area anime-trigger" data-anime="fadeInUp">
                        <div class="about__thumb">
                            <img src="{{ asset('assets/frontend/images/page/'.$page->image) }}" alt="about">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section Ends -->

@endsection