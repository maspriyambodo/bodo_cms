@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/lightbox2-2.11.4/css/lightbox.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row clearfix">
            @if($user_access['read'])
            <div class="col-md-4 my-2">
                <input id="keyword" name="keyword" type="text" class="form-control" placeholder="search data..."/>
            </div>
            @endif
            <div class="col-md-8 text-end my-2">
                <div class="btn-group" role="group" aria-label="action button">
                    @if($user_access['read'])
                    <div>
                        <button type="button" class="btn btn-secondary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                            show data
                            <span class="svg-icon fs-3 rotate-180 ms-3 me-0"><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4"></div>
                            </div>
                            <div class="separator mb-3 opacity-75"></div>
                            <div class="menu-item px-3">
                                <a id="_10" href="javascript:void(0);" class="menu-link px-3">
                                    show 10
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a id="_25" href="javascript:void(0);" class="menu-link px-3">
                                    show 25
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a id="_50" href="javascript:void(0);" class="menu-link px-3">
                                    show 50
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a id="_100" href="javascript:void(0);" class="menu-link px-3">
                                    show 100
                                </a>
                            </div>
                        </div>
                    </div>
                    <button id="dt_reload" type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="reload data" data-kt-initialized="1"><i class="bi bi-arrow-clockwise"></i></button>
                    @endif
                    @if($user_access['create'])
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="add new data" data-kt-initialized="1" class="bi bi-plus-lg"></i></button>
                    @endif
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table-user" class="table table-rounded table-hover border">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th>No</th>
                        <th>#</th>
                        <th>Pict</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@if($user_access['create'])
@include('users.add_user')
@endif
@if($user_access['update'])
@include('users.edit_user')
@endif
@if($user_access['delete'])
@include('users.delete_user')
@include('users.restore_user')
@include('users.resetpass_user')
@endif
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('src/plugins/custom/lightbox2-2.11.4/js/lightbox.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
});
</script>
@if($user_access['read'])
@include('users.table_user')
@endif
@endpush