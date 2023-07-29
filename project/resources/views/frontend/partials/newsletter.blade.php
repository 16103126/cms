<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-wrapper anime-trigger" data-anime="active">
            <div class="section__header section__header__center text--white mb-2">
                <span class="section__cate bg--white text--title">@lang('SUBSCRIBE US')</span>
                <h3 class="section__title">@lang('Newsletter Subscription')</h3>
            </div>
            <form class="subscribe-form" action="{{ route('subscriber.store') }}" method="POST">
                @csrf
                @include('partials.error')
                @include('partials.success')
                <div class="form-group subscribe--form-group">
                    <i class="las la-envelope-open-text"></i>
                    <input type="email" name="email" placeholder="{{ __('Enter Your Email...') }}" required>
                </div>
                <button type="submit" class="cmn--btn">@lang('Subscribe Us')</button>
            </form>			
        </div>
    </div>
</section>

@push('js')
    <script>
        $(document).on('submit', '.subscribe-form', function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                url : url,
                method : method,
                data : new FormData(this),
                cache : false,
                processData : false,
                contentType : false,

                success: function(response){
                    if(response.success) {
                            $('#successMsg').removeClass('d-none');
                            $('#errorMsg').addClass('d-none');
                            $('#successMsg').html(`<p>${response.success}</p>`);
                        }
                    if(response.errors){
                        $.each(response.errors, function(index, error){
                            $('#successMsg').addClass('d-none');
                            $('#errorMsg').removeClass('d-none');
                            $('#errorMsg').html(`<p>${error}</p>`);
                        });
                    }
                }
            });
        });
    </script>
@endpush