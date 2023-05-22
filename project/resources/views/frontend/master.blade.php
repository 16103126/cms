<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Impero Solitions HTML Template</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/forntend/images/favicon.png') }}" type="image/x-icon">

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


    <!-- Banner Section Starts -->
    @include('frontend.partials.banner')
    <!-- Banner Section Ends -->

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

</body>
</html>