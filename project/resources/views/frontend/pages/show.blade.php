@extends('frontend.master')

@section('title', $page->title)

@section('description', $page->meta_description)

@section('keywords', $page->meta_keywords)

@section('content')
    @include('frontend.partials.page-banner')
    <section class="">
		<div class="container">
            <div class="description">
                {!! $page->description !!}
            </div>
            @foreach ($forms as $form)
                @if ($form->isActive == 1)
                <div class="form mt-5">
                    <div class="contact__form__wrapper bg--body">
                        <h5>{{ $form->title }}</h5>
                        <hr>
                        <form class="contact__form row g-4" action="{{ route('admin.form.value', $form->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('partials.success')
                            @include('partials.error')
                            @if (!is_null($form->input))
                                @php
                                $input_data = $form->input;
                                $input = json_decode($input_data, true);
                                @endphp
                                @foreach ($input['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="{{ $name }}" class="profile--label">{{ $name }} <small class="text-danger">{{ $input['option'][$key] == 1 ? '(required)*' : '' }}</small></label>
                                    <input type="{{ $input['type'][$key] }}" name="{{ $name }}" class="form-control mb-0 form--control" {{ $input['option'][$key] == 1 ? 'required' : '' }}>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->textarea))
                                @php
                                $textarea_data = $form->textarea;
                                $textarea = json_decode($textarea_data, true);
                                @endphp
                                @foreach ($textarea['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="{{ $name }}" class="profile--label">{{ $name }}<small class="text-danger">{{ $textarea['option'][$key] == 1 ? '(required)*' : '' }}</small></label>
                                    <textarea name="{{ $name }}" class="form-control mb-0 form--control" id="" cols="30" rows="10" {{ $textarea['option'][$key] == 1 ? 'required' : '' }}></textarea>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->image))
                                @php
                                $image_data = $form->image;
                                $image = json_decode($image_data, true);
                                @endphp
                                @foreach ($image['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="formFile" class="profile--label">{{ $image['label'][$key] }}<small class="text-danger">{{ $image['option'][$key] == 1 ? '(required)*' : '' }}</small></label>
                                    <input name="{{ $name }}" class="form-control mb-0 form--control" type="file" id="formFile" {{ $image['option'][$key] == 1 ? 'required' : '' }}>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->file))
                                @php
                                $file_data = $form->file;
                                $file = json_decode($file_data, true);
                                @endphp
                                @foreach ($file['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="formFile" class="profile--label">{{ $file['label'][$key] }}<small class="text-danger">{{ $file['option'][$key] == 1 ? '(required)*' : '' }}</small></label>
                                    <input name="{{ $name }}" class="form-control mb-0 form--control" type="file" id="formFile" {{ $file['option'][$key] == 1 ? 'required' : '' }}>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->select))
                                @php
                                $select_data = $form->select;
                                $select = json_decode($select_data, true);
                                @endphp
                                @foreach ($select['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="formFile" class="profile--label">@lang('Select') {{ $name }} <small class="text-danger">{{ $select['option'][$key] == 1 ? '(required)*' : '' }}</small></label>
                                    <select name="{{ $name }}" id="defaultSelect" class="form-select form-control mb-0 form--control" {{ $select['option'][$key] == 1 ? 'required' : '' }}>
                                        <option>@lang('Select') {{ $name }}</option>
                                        @foreach ($select['value'] as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->checkbox))
                                @php
                                $checkbox_data = $form->checkbox;
                                $checkbox = json_decode($checkbox_data, true);
                                $name = $checkbox['title'][0];
                                @endphp
                                <div class="form-group form--group">
                                    <label class="profile--label">{{ $checkbox['title'][0] }}</label>
                                </div>
                                @foreach ($checkbox['checkbox_comb'] as $key => $value)
                                <div class="form-group form--group">
                                    <input name="{{ $name }}[]" value="{{ $value }}" class="form-check-input" type="checkbox" id="defaultCheck3">
                                    <label class="form-check-label" for="defaultCheck3"> {{ $key }} </label>
                                </div>
                                @endforeach
                            @endif
                            @if (!is_null($form->radio))
                                @php
                                $radio_data = $form->radio;
                                $radio = json_decode($radio_data, true);
                                @endphp
                                @foreach ($radio['name'] as $key => $name)
                                <div class="form-group form--group">
                                    <label for="formFile" class="profile--label">{{ $name }}</label>
                                    @foreach ($radio['value'] as $value)
                                    <div class="col-md">
                                        <div class="form-check mt-3">
                                        <input name="{{ $name }}" class="form-check-input" type="radio" value="{{ $value }}" id="defaultRadio1" checked>
                                        <label class="form-check-label" for="defaultRadio1"> {{ $value }} </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            @endif
                            <button type="submit" class="col-sm-2 cmn--btn">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
                @endif
            @endforeach
		</div>
    </section>
@endsection

@push('js')

<script>
    $(document).ready(function(){
        $('form').on('submit', function(e){
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
                    if(response.success){
                        $('#successMsg').removeClass('d-none');
                        $('#errorMsg').addClass('d-none');
                        $('#successMsg').html(`<p>${response.success}</p>`)
                    }
                    if(response.errors){
                        $.each(response.errors, function(index, error){
                            $('#successMsg').addClass('d-none');
                            $('#errorMsg').removeClass('d-none');
                            $('#errorMsg').html(`<p>${error}</p>`);
                        })
                    }
                }
            });
        })
    });
</script>
    
@endpush