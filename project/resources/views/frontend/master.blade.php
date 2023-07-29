<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ DB::table('seos')->where('id', 1)->first()->meta_description }} @yield('description')">
    <meta name="keywords" content="{{ DB::table('seos')->where('id', 1)->first()->meta_keywords }} @yield('keywords')">

    <title>{{ DB::table('seos')->where('id', 1)->first()->title }} | @yield('title')</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/forntend/images/icon/'.generalSetting()->website_icon) }}" />

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

    @stack('css')

</head>

<body>

    <a href="javascript:void(0)" class="scrollToTop"><i class="las la-angle-up"></i></a>
    <div class="overlay"></div>

	<!-- Preloader -->
	@include('frontend.partials.preloader')
	<!-- Preloader -->

    <!-- Header Section Starts -->
	@include('frontend.partials.header')
    <!-- Header Section Ends -->

    @yield('content')

	<!-- Newsletter Section Starts Here -->
	@include('frontend.partials.newsletter')
	<!-- Newsletter Section Ends Here -->


	<!-- Footer Section Starts Here -->
	@include('frontend.partials.footer')
	<!-- Footer Section Ends Here -->

    <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/rafcounter.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/raf-scroll.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#language').on('change', function(){
                let url = $(this).val();
                window.location = url;
            });
        });
    </script>
    @stack('js')

</body>
</html>