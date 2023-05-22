@extends('frontend.master')

@section('content')
      <!-- About Section Starts -->
      <section class="about-section pt-120 pb-120">
		<div class="container">
			<div class="row flex-row-reverse justify-content-between gy-5">
				<div class="col-lg-6">
					<div class="section__header anime-trigger" data-anime="fadeInUpSm">
						<span class="section__cate">About Us</span>
						<h3 class="section__title">Learn About Us</h3>
						<p>
							Quis tenetur iure in atque eum? Reiciendis totam eligendi quasi, quidem blanditiis nam? Enim veritatis libero aliquid quam repudiandae. Beatae, facere quod?
						</p>
					</div>
					<div class="about__content anime-trigger" data-anime="fadeInUpSm">
						<p>
							Magnam amet ipsum ut eos sunt illo similique suscipit minima illum recusandae aliquam, porro veritatis quibusdam, corrupti quas. Voluptas molestias tempora perferendis obcaecati repudiandae corporis.
						</p>
						<ul class="about--list">
							<li class="anime-trigger" data-anime="fadeInUpSm">
								<i class="las la-angle-double-right"></i>
								<span>Ipsa voluptas id vitae distinctio</span>
							</li>
							<li class="anime-trigger" data-anime="fadeInUpSm">
								<i class="las la-angle-double-right"></i>
								<span>Beatae porro voluptates officiis veritatis</span>
							</li>
							<li class="anime-trigger" data-anime="fadeInUpSm">
								<i class="las la-angle-double-right"></i>
								<span>Beatae porro voluptates officiis veritatis</span>
							</li>
						</ul>
						<a href="#0" class="cmn--btn mt-4 anime-trigger" data-anime="fadeInUpSm">Get Started Now</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about__wrapper me-xl-4">
						<div class="about__thumb__area anime-trigger" data-anime="fadeInUp">
							<div class="about__thumb">
								<img src="{{ asset('assets/frontend/images/about/about4.jpg') }}" alt="about">
							</div>
						</div>
						<div class="experience__years text--white anime-trigger" data-anime="fadeInDown">
							<h2 class="experience__title text--white m-0">
								24
							</h2>
							<span class="experience__info">Years if Experience</span>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    <!-- About Section Ends -->


    <!-- Feature Section Starts -->
	<section class="feature-section bg--section">
		<div class="container mw-lg-100 p-lg-0">
			<div class="row g-0">
				<div class="col-lg-6 pt-120 pb-120">
					<div class="feature--wrapper pe-xxl-5">
						<div class="section__header anime-trigger" data-anime="fadeInUpSm">
							<span class="section__cate">Feature</span>
							<h3 class="section__title">Why We are The Best</h3>
							<p>
								Quis tenetur iure in atque eum? Reiciendis totam eligendi quasi, quidem blanditiis nam? Enim veritatis libero aliquid quam repudiandae. Beatae, facere quod?
							</p>
						</div>
						<div class="feature__item anime-trigger" data-anime="fadeInUp">
							<div class="feature__thumb">
								<i class="las la-user"></i>
							</div>
							<div class="feature__content">
								<h5 class="feature__title">Integrated global access</h5>
								<p>
									Veniam saepe aspernatur enim inventore at officiis asperiores, officia quo perferendis minus modi  minima consectetur.
								</p>
							</div>
						</div>
						<div class="feature__item anime-trigger" data-anime="fadeInUp">
							<div class="feature__thumb">
								<i class="las la-globe-europe"></i>
							</div>
							<div class="feature__content">
								<h5 class="feature__title">Integrated global access</h5>
								<p>
									Veniam saepe aspernatur enim inventore at officiis asperiores, officia quo perferendis minus modi  minima consectetur.
								</p>
							</div>
						</div>
						<div class="feature__item anime-trigger" data-anime="fadeInUp">
							<div class="feature__thumb">
								<i class="las la-hands-helping"></i>
							</div>
							<div class="feature__content">
								<h5 class="feature__title">Disciplined entrepreneurship</h5>
								<p>
									Veniam saepe aspernatur enim inventore at officiis asperiores, officia quo perferendis minus modi  minima consectetur.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 bg_img" data-background="{{ asset('assets/frontend/images/about/about2.jpg') }}"></div>
			</div>
		</div>
	</section>
    <!-- Feature Section Ends -->


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
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="187">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-user"></i>
							</div>
							<p>Total Investor</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInUpSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="153">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-piggy-bank"></i>
							</div>
							<p>Total Invest</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInDownSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="329">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-user"></i>
							</div>
							<p>Total User</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="counter__item anime-trigger" data-anime="fadeInUpSm">
						<div class="counter__header">
							<h3 class="rafcounter text--white counter__title" data-counter-start="0" data-counter-end="87">0</h3>
							<h3 class="counter__title text--base">k</h3>
						</div>
						<div class="counter__content">
							<div class="counter__icon">
								<i class="las la-money-bill-wave"></i>
							</div>
							<p>Total Return</p>
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
						<span class="section__cate">Blogs</span>
						<h3 class="section__title">Our Latest News & Tips</h3>
						<p>
							Quis tenetur iure in atque eum? Reiciendis totam eligendi quasi, quidem blanditiis nam? Enim veritatis libero aliquid quam repudiandae.
						</p>
					</div>
				</div>
			</div>
			<div class="row g-4 justify-content-center">
				<div class="col-lg-6">
					<div class="post__item anime-trigger" data-anime="fadeInUpSm">
						<div class="post__thumb">
							<a href="#0"><img src="{{ asset('assets/frontend/images/blog/blog1.jpg') }}" alt="blog"></a>
							<div class="post__date bg--title">
								<h4 class="text--white m-0">25</h4>
								<h4 class="text--white m-0">Jan</h4>
							</div>
						</div>
						<div class="post__content">
							<h5 class="post__title">
								<a href="#0" class="line--limit-2">Eaque, ipsum iusto. Pariatur quae omnis laboriosam?</a>
							</h5>
							<p class="line--limit-4 post__para fs--14">
								Oluptates aut a natus possimus magnam, aliquid amet quae maiores hic porro ex quasi accusamus minus fugiat rem consequatur at debitis alias.
							</p>
							<div class="post__meta">
								<div class="post__meta__author">
									Posted by <a href="#0" class="text--base">Rafuj</a>
								</div>
								<a href="#0" class="read--more text--white bg--base"><i class="las la-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="post__item anime-trigger" data-anime="fadeInUpSm">
						<div class="post__thumb">
							<a href="#0"><img src="{{ asset('assets/frontend/images/blog/blog1.jpg') }}" alt="blog"></a>
							<div class="post__date bg--title">
								<h4 class="text--white m-0">25</h4>
								<h4 class="text--white m-0">Jan</h4>
							</div>
						</div>
						<div class="post__content">
							<h5 class="post__title">
								<a href="#0" class="line--limit-2">Eaque, ipsum iusto. Pariatur quae omnis laboriosam?</a>
							</h5>
							<p class="line--limit-4 post__para fs--14">
								Oluptates aut a natus possimus magnam, aliquid amet quae maiores hic porro ex quasi accusamus minus fugiat rem consequatur at debitis alias.
							</p>
							<div class="post__meta">
								<div class="post__meta__author">
									Posted by <a href="#0" class="text--base">Rafuj</a>
								</div>
								<a href="#0" class="read--more text--white bg--base"><i class="las la-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog Section Ends Here -->
@endsection