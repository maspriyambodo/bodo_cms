@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
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
        <table id="table-user" class="bg-white table table-rounded table-hover table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr class="fw-bold fs-6 border-bottom-2 border-gray-200 text-center text-uppercase">
                        <th class="text-center">No</th>
                        <th class="text-center">#</th>
                        <th class="text-center">nama</th>
                        <th class="text-center">jenis kelamin</th>
                        <th class="text-center">nik</th>
                        <th class="text-center">tempat lahir</th>
                        <th class="text-center">tanggal lahir</th>
                        <th class="text-center">alamat</th>
                        <th class="text-center">nip</th>
                        <th class="text-center">nipa</th>
                        <th class="text-center">tugas provinsi</th>
                        <th class="text-center">tugas kabupaten</th>
                        <th class="text-center">tugas kecamatan</th>
                        <th class="text-center">tugas kua</th>
                        <th class="text-center">email</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
            </table>
    </div>
</div>
@if($user_access['create'])
@include('penyuluh.add_user')
@endif
@if($user_access['update'])
@include('penyuluh.edit_user')
@endif
@if($user_access['delete'])
@include('penyuluh.delete_user')
@include('penyuluh.restore_user')
@include('penyuluh.resetpass_user')
@endif
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@if($user_access['read'])
@include('penyuluh.table_user')
@endif
@endpush