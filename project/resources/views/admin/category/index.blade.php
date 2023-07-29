@extends('admin.master')

@section('title', __('Manage Category'))

@push('css')
    <style>
        .dataTables_filter{
            margin-top: 20px;
        }
        .dataTables_info{
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')
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
                    <li class="breadcrumb-item {{ (Request::is('admin/category/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">@lang('Manage Category')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Manage Category')</h5>
                    <div class="card-header">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">@lang('Add Category')</a>
                    </div>
                    <div class="card-body">
                        @include('partials.success')
                        @include('partials.error')
                        @foreach ($categories as $category)
                            <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">@lang('Delete Category')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                        <h6 class="text-danger">@lang('Are you sure to delete it permanently?')</h6>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        @lang('Cancel')
                                    </button>
                                    <button data-href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-danger deleteBtn">@lang('Yes, Delete it!')</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <table class="table table-responsive table-bordered datatable mb-3 mt-3">
                                <thead>
                                    <tr>
                                        <th>@lang('S.L')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Slug')</th>
                                        <th>@lang('Action')</th>
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
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            var table = $('.datatable').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.category.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

        });

        $(document).on('click', '.deleteBtn',function(e){
            e.preventDefault();
            let url = $(this).attr('data-href');
            $.ajax({
                url : url,
                type: 'DELETE',
                dataType: 'json',
                data : {
                    _token: '{{csrf_token()}}'
                },

                success: function(response){
                    if(response.success){
                        $('#successMsg').removeClass('d-none');
                        $('#errorMsg').addClass('d-none');
                        $('#successMsg').html(`<p>${response.success}</p>`);
                        $('.datatable').DataTable().ajax.reload();
                        $('.modal-backdrop').removeClass('modal-backdrop');
                        $('.modal').attr('style', 'display:none');
                    }
                    if(response.errors){
                        $('#errorMsg').removeClass('d-none');
                        $('#successMsg').addClass('d-none');
                        $('#errorMsg').html(`<p>${response.errors}</p>`);
                        $('.modal-backdrop').removeClass('modal-backdrop');
                        $('.modal').attr('style', 'display:none');
                    }
                }
            });
        });

    </script>
@endpush