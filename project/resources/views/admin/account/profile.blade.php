@extends('admin.master')

@section('title', __('Admin Porfile'))

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item {{ (Request::is('admin/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                      </li>
                      <li class="breadcrumb-item {{ (Request::is('admin/account/profile')) ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}">@lang('Account')</a>
                      </li>
                    </ol>
                </nav>
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link {{(Request::is('admin/account/profile')) ? 'active' : ''}}" href="{{ route('admin.profile') }}"><i class="bx bx-admin me-1"></i> @lang('Account')</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (Request::is('admin/account/password/reset')) ? 'active' : '' }}" href="{{ route('admin.account.password.reset.form') }}"><i class='bx bx-reset me-1'></i> @lang('Password Reset')</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Profile Information')</h5>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4 mt-2">
                                  <img src="{{ asset('assets/admin/img/profile/'.$admin->image) }}" class="d-block rounded" height="100" width="100" id="preview-image">
                                  <div class="button-wrapper">
                                    <form id="imageForm" action="{{ route('admin.profile.image.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div id="imgMsg" class="d-none"></div>
                                        <label for="upload" class="btn btn-warning me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">{{ __('Upload profile image') }}</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="image" class="account-file-input" hidden>
                                        </label>
                                        <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">@lang('Update')</span>
                                        </button>
                                        <p class="text-muted mb-0">{{ __('Allowed JPG, JPEG or PNG. Max size of 1MB.') }}</p>
                                    </form>
                                  </div>
                                </div>
                        </div>
                        <hr class="my-0">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1">

                            </div>
                            <div class="col-sm-10">
                                <form method="POST" id="profileForm" action="{{ route('admin.profile.update', $admin->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            @include('partials.error')
                                            @include('partials.success')
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required/>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="username">{{ __('Username') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required/>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="email">{{ __('Email') }}</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required/>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="number">{{ __('Phone Number') }}</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="col-sm-3">
                                                <select id="phoneNumber" name="phone_code" class="form-select input-group-text">
                                                </select>
                                            </div>
                                            <input type="number" name="phone_number" class="form-control" id="number" placeholder="Phone number"/>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="age">{{ __('Age') }}</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="age" class="form-control" id="age" placeholder="Age"/>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="select" class="col-sm-2 col-form-label">{{ __('Gender') }}</label>
                                        <div class="col-sm-10">
                                            <select id="gender" name="gender" class="form-select">
                                                <option value="{{ null }}">{{ __('Select Gender') }}</option>
                                                <option value="Male" {{ $admin->gender == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                <option value="Female" {{ $admin->gender == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option> 
                                                <option value="Third Gender" {{ $admin->gender == 'Third Gender' ? 'selected' : '' }}>{{ __('Third Gender') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="nid">{{ __('NID') }}</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="nid" class="form-control" id="nid" placeholder="NID"/>
                                    </div>
                                    </div>
                                    <div class="address">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="address">{{ __('Address') }}</label>
                                            <div class="col-sm-5">
                                            <select id="country" name="country" class="form-select">
                                                <option value="{{ null }}">{{ __('Select Country') }}</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select id="state" name="state" class="form-select">
                                                    <option value="{{ null }}">{{ __('Select State') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-5">
                                                <select id="city" name="city" class="form-select">
                                                    <option value="{{ null }}">{{ __('Select City') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5 ">
                                                <input type="number" id="zipCode" name="zip_code" class="form-control" id="address" placeholder="Zip code" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="select" class="col-sm-2 col-form-label">{{ __('Language') }}</label>
                                        <div class="col-sm-10">
                                            <select id="language" class="form-select">
                                                <option value="">{{ __('Select Language') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="select" class="col-sm-2 col-form-label">{{ __('Currency') }}</label>
                                        <div class="col-sm-10">
                                            <select id="currency" class="form-select">
                                                <option value="">{{ __('Select Currency') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="about">{{ __('About') }}</label>
                                    <div class="col-sm-10">
                                        <textarea id="about" name="about" class="form-control" placeholder="About ....."></textarea>
                                    </div>
                                    </div>
                                    <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>  
    <!-- Content wrapper -->
@endsection

@push('js')
    <script>
        "use strick";
        $(document).ready(function(){
            $('#profileForm').on('submit', function(e){
                e.preventDefault();
                let url     = $(this).attr('action');
                let method  = $(this).attr('method');
                $.ajax({
                    url         : url,
                    type        : method,
                    data        : new FormData(this),
                    cache       : false,
                    processData : false,
                    contentType : false,

                    success: function(response){
                        if(response.errors){
                            $('#errorMsg').removeClass('d-none');
                            $('#successMsg').addClass('d-none');
                            $.each(response.errors, function(index, error){
                                $('#errorMsg').html('<p>' + error + '</p>');
                            });
                        }

                        if(response.success){
                            $('#successMsg').removeClass('d-none');
                            $('#errorMsg').addClass('d-none');
                            $('#successMsg').html('<p>' + response.success + '</p>');
                        }
                    }
                });
            });

            $('#imageForm').on('submit', function(e){
                e.preventDefault();
                let url     = $(this).attr('action');
                let method  = $(this).attr('method');
                $.ajax({
                    url         : url,
                    type        : method,
                    data        : new FormData(this),
                    cache       : false,
                    processData : false,
                    contentType : false,

                    success: function(response){
                        if(response.errorimg){
                            $('#imgMsg').removeClass('d-none');
                            $.each(response.errorimg, function(index, error){
                                $('#imgMsg').html('<p class = "text-danger">' + error + '</p>');
                            });
                        }

                        if(response.successimg){
                            $('#imgMsg').removeClass('d-none');
                            $('#imgMsg').html('<p class = "text-success">' + response.successimg + '</p>');
                        }
                    }
                });
            });

            $('#upload').change(function(){    
                let reader      = new FileReader();
                reader.onload   = (e) => { 
                    $('#preview-image').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });

            let State           = () => {
                let country_id  = $('#country').find(':selected').attr('data-id');
                let url         = "{{route('admin.state', ':id')}}" ;
                url             = url.replace(':id', country_id);
                $.ajax({
                url         : url,
                type        : 'GET',
                dataType    : "json",
                success     : function(response){
                    let address = response.address;
                    $.each(response.states, function(index, state){
                        let selected = address.state == state.name ? 'selected' : '';
                        $('#state').append(`<option value="${state.name}" ${selected} data-id="${state.id}">${state.name}</option>`);
                    });
                    City();
                }
                });
            }

            let City            = () => {
                let state_id    = $('#state').find(':selected').attr('data-id');
                let url         = "{{route('admin.city', ':id')}}" ;
                url             = url.replace(':id', state_id);
                $.ajax({
                url         : url,
                type        : 'GET',
                dataType    : "json",
                success     : function(response){
                    let address = response.address;
                    $.each(response.cities, function(index, city){
                        let selected = address.city == city.name ? 'selected' : '';
                        $('#city').append(`<option value="${city.name}" ${selected} data-id="${city.id}">${city.name}</option>`);
                    });
                }
                });
            }

            $.ajax({
                url         : '{{route("admin.profile.data")}}',
                type        : 'GET',
                dataType    : "json",
                success     : function(response) {
                    $("#name").val(response.admin.name);
                    $("#username").val(response.admin.username);
                    $("#email").val(response.admin.email);
                    $("#number").val(response.admin.phone_number);
                    $("#age").val(response.admin.age);
                    $("#nid").val(response.admin.nid);
                    $("#about").val(response.admin.about);
                    let address = response.address;
                    $('#zipCode').val(address.zip_code);
                    $.each(response.countries, function(index, country){
                        let selected = address.country == country.name ? 'selected' : '';
                        $('#country').append(`<option value="${country.name}" ${selected}  data-id="${country.id}">${country.name}</option>`);
                        $('#phoneNumber').append(`<option value="${country.phonecode}" ${selected}> ${country.code}(+${country.phonecode}) </option>`)
                    });
                    State();
                }
            });
        });

        $(document).on('change','#country',function () {
            $('#state').each(function(){
                $(this).find('option').remove();
            });
            $('#city').each(function(){
                $(this).find('option').remove();
            });
            $('#zipCode').val('');
            let country_id  = $(this).find(':selected').attr('data-id');
            let url         = "{{route('admin.state', ':id')}}" ;
            url             = url.replace(':id', country_id);
            $.ajax({
                url         : url,
                type        : 'GET',
                dataType    : "json",
                success     : function(response){
                    let addressState = response.address.state;
                    $.each(response.states, function(index, state){
                        $('#state').append(`<option value="${state.name}" data-id="${state.id}">${state.name}</option>`);
                    });
                }
            })
        });

        $(document).on('change','#state',function () {
            $('#city').each(function(){
                $(this).find('option').remove();
            });
            $('#zipCode').val('');
            let state_id    = $(this).find(':selected').attr('data-id');
            let url         = "{{route('admin.city', ':id')}}" ;
            url             = url.replace(':id', state_id);
            $.ajax({
                url         : url,
                type        : 'GET',
                dataType    : "json",
                success     : function(response){
                    if(response.cities){
                        $.each(response.cities, function(index, city){
                            $('#city').append(`<option value="${city.name}" {{ $address->city == '${city.name}' ? 'selected' : '' }} data-id="${city.id}">${city.name}</option>`);
                        });
                    }else{
                        $('#city').text(`<option>{{ __('Not available') }}</option>`);
                    }
                    
                }
            })
        });

        $(document).on('change','#city',function () {
            $('#zipCode').val('');
        });
    </script>
@endpush