@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css'); }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive py-5">
            <table id="table-parameter" class="table table-rounded table-striped table-hover gy-5 gs-7 border" style="width: 100%;">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th>#</th>
                        <th>ID</th>
                        <th>GROUP</th>
                        <th>VALUE</th>
                        <th>DESCRIPTION</th>
                        <th>Status</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@if($access_user['create'])
@include('parameter.add_parameter')
@endif
@if($access_user['update'])
@include('parameter.edit_parameter')
@endif
@if($access_user['delete'])
@include('parameter.delete_parameter')
@include('parameter.restore_parameter')
@endif
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js'); }}"></script>
@if($access_user['read'])
@include('parameter.table_parameter')
@endif
@endpush