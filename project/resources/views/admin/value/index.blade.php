@extends('admin.master')

@section('title', __('Form'))

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
                        <a href="{{ route('admin.value.form.index') }}">@lang('Manage Value')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Form List')</h5>
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-responsive table-bordered datatable mb-3 mt-3">
                                <thead>
                                    <tr>
                                        <th>@lang('S.L')</th>
                                        <th>@lang('name')</th>
                                        <th>@lang('Page')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('View Table')</th>
                                    </tr>
                                </thead>
                            </table>
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

    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.value.form.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'name'},
                {data: 'page', name: 'page'},
                {data: 'active', name: 'active'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });

</script>
    
@endpush