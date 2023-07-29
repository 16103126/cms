<section class="hero-section" style="background-color: #042656">
    <div class="container">
        <div class="hero__content text--white">
            <h2 class="hero__title text--white">{{ $page->title }}</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">@lang('Home')</a>
                </li>
                <li>
                    {{ $page->name }}
                </li>
            </ul>
        </div>
    </div>
</section>