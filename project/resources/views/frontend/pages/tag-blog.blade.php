@extends('frontend.master')

@section('title', __('Tag Page'))

@section('content')

 <!-- Hero Section Starts -->
 <section class="hero-section" style="background-color: #042656">
    <div class="container">
        <div class="hero__content text--white">
            <h2 class="hero__title text--white">@lang('Blog Tag')</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">@lang('Home')</a>
                </li>
                <li>
                    @lang('Blog Tag')
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Hero Section Ends -->

 <!-- Blog Section Starts Here -->
 <section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($posts as $post)
            <div class="col-lg-6">
                <div class="post__item">
                    <div class="post__thumb">
                        <a href="#0"><img src="{{ asset('assets/frontend/images/post/'.$post->image) }}" alt="blog"></a>
                        <div class="post__date bg--title">
                            <h4 class="text--white m-0">{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</h4>
                            <h4 class="text--white m-0">{{ \Carbon\Carbon::parse($post->created_at)->format('M') }}</h4>
                        </div>
                    </div>
                    <div class="post__content">
                        <h5 class="post__title">
                            <a href="#0" class="line--limit-2">{{ $post->title }}</a>
                        </h5>
                        <p class="post__para fs--14">
                            {!! $post->description !!}
                        </p>
                        <div class="post__meta">
                            <a href="{{ route('blog.detail', $post->slug) }}" class="read--more text--white bg--base"><i class="las la-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Section Ends Here -->

@endsection