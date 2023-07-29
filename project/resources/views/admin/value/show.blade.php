@extends('admin.master')

@section('title', __('Value Table'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/form/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.value.form.index') }}">@lang('Manage Form')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Form Value List')</h5>
                    <div class="card-body">
                        <div class="row">
                            @include('partials.success')
                            @include('partials.error')
                            <div class="table-responsive text-nowrap mb-3 mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if (!empty($headers))
                                                @foreach ($headers[0] as $key => $header)
                                                    <th>{{ $key }}</th>
                                                @endforeach
                                                {{-- <th>@lang('Action')</th> --}}
                                            @else
                                            <h5 class="text-info">@lang('No Data Available.')</h5>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($values as $data)
                                            <tr>
                                                @php
                                                    $value = json_decode($data->value, true);
                                                @endphp
                                                @foreach ($value as $data)
                                                    @if (is_array($data))
                                                        <td>
                                                            @foreach ($data as $da)
                                                                {{ $da }}
                                                            @endforeach
                                                        </td>
                                                    @else
                                                        <td>
                                                            @if (file_exists('assets/frontend/images/form/image/'.$data))
                                                            <a href="{{ route('admin.value.image.download', $data) }}"><img style="width: 100px; height: 75px;" src="{{ asset('assets/frontend/images/form/image/'.$data) }}" alt=""></a>
                                                            @elseif (file_exists('assets/frontend/images/form/file/'.$data))
                                                            <a href="{{ route('admin.value.file.download', $data) }}"><i class='bx bx-file' style="font-size: 50px;"></i></a>
                                                            @else
                                                            {{ $data }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                                {{-- <td><a class="btn btn-danger" href="{{ route('admin.value.delete', $data) }}"><i class="bx bxs-x-circle"></i></a></td> --}}
                                            </tr>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {!! $values->links() !!}
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

    $(document).ready(function(){
        $('.hidden').remove();
    });

</script>
    
@endpush