@extends('frontend.master')

@section('title', __('Home Page'))

@section('content')

	<!-- Banner Section Starts -->

	@include('frontend.partials.home-banner')
	
	<!-- Banner Section Ends -->

    <!-- Investor Section -->
    <section class="investor-section pt-120 pb-120">
        <div class="container">
			<div class="section__header section__header__center anime-trigger" data-anime="fadeInUpSm">
				<span class="section__cate">Investors</span>
				<h3 class="section__title">Our Top Investor</h3>
				<p>
					Quis tenetur iure in atque eum? Reiciendis totam eligendi quasi, quidem blanditiis nam? Enim veritatis libero aliquid quam repudiandae. Beatae, facere quod
				</p>
			</div>
            <div class="row justify-content-center gy-4">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInUpSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor1.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Hera Rahman</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInDownSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor2.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Abu Raihan Rafuj</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInUpSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor3.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Panna Rahman</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInDownSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor4.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Masud Parvej</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInUpSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor5.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Sajid Akram</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInDownSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor6.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Mahadi Sabbir</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInUpSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor7.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Sohan Alam</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="investor__item anime-trigger" data-anime="fadeInDownSm">
                        <div class="investor__thumb">
                            <img src="{{ asset('assets/frontend/images/investor/investor0.jpg') }}" alt="investor">
                        </div>
                        <div class="investor__content">
                            <h6 class="title">Sakib Al Hasan</h6>
                            <span class="amount">$10,000.90</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Investor Section -->


    <!-- Counter Section -->
	<div class="counter-section bg--title pt-80 pb-80 shape__container">
		<div class="top--shape">
			<img src="{{ asset('assets/frontend/css/img/shapes.png') }}" alt="schapes">
		</div>
		<div class="bottom--shape">
			<img src="{{ asset('assets/frontend/css/img/shapes2.png') }}" alt="schapes">
		</div>
		<div class="container">
			<div class="row g-4 text--white">
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInDownSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="{{ $blogs->count() }}">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-user"></i>
							</div>
							<p>@lang('Total Blog')</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInUpSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="{{ $users->count() }}">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-piggy-bank"></i>
							</div>
							<p>@lang('Total User')</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInDownSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="{{ $forms->count() }}">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-user"></i>
							</div>
							<p>@lang('Total Form')</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInUpSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="{{ $pages->count() }}">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-money-bill-wave"></i>
							</div>
							<p>@lang('Total Page')</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Counter Section -->

    
	<!-- Blog Section Starts Here -->
	<section class="blog-section pt-120 pb-120">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-6">
					<div class="section__header anime-trigger" data-anime="fadeInUpSm">
						<span class="section__cate">@lang('Blogs')</span>
						<h3 class="section__title">@lang('Our Latest News & Tips')</h3>
					</div>
				</div>
			</div>
			<div class="row g-4 justify-content-center">
				@foreach ($posts as $post)
					<div class="col-lg-6">
						<div class="post__item anime-trigger" data-anime="fadeInUpSm">
							<div class="post__thumb">
								<a href="#0"><img src="{{ asset('assets/frontend/images/post/'.$post->image) }}" alt="blog"></a>
								<div class="post__date bg--title">
									<h4 class="text--white m-0">25</h4>
									<h4 class="text--white m-0">Jan</h4>
								</div>
							</div>
							<div class="post__content">
								<h5 class="post__title">
									<a href="#0" class="line--limit-2">{{ $post->title }}</a>
								</h5>
								<p class="line--limit-4 post__para fs--14">
									{!! $post->description  !!}
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