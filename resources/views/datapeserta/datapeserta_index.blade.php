@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row clearfix">
            <div class="col-md-4 my-2">
                <input id="keyword" name="keyword" type="text" class="form-control" placeholder="search data..."/>
            </div>
            <div class="col-md-8 text-end my-2">
                <div class="btn-group" role="group" aria-label="action button">
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
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="add new data" data-kt-initialized="1"></i></button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table-peserta" class="table table-rounded table-hover border my-5" style="width: 100%;">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th class="text-center">No</th>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NO. Hp</th>
                        <th class="text-center">Utusan</th>
                        <th class="text-center">Jabatan</th>
                    </tr>
                </thead>
            </table>
            <div class="clearfix my-5"></div>
        </div>
    </div>
</div>
<input type="hidden" id="id_kegiatan" value="{{ $id_kegiatan }}"/>
@if($user_access['create'])
@include('datapeserta.add_peserta')
@endif
@if($user_access['update'])
@include('datapeserta.edit_peserta')
@endif
@if($user_access['delete'])
@include('datapeserta.delete_peserta')
@include('datapeserta.restore_peserta')
@endif
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('datapeserta.table_peserta')
@endpush