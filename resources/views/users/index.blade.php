@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/lightbox2-2.11.4/css/lightbox.min.css'); }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-user" class="table table-rounded table-striped table-hover gy-5 gs-7 border" style="width: 100%;">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th>No</th>
                        <th>#</th>
                        <th>Pict</th>
                        <th>Name</th>
                        <th>Email</th>
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
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/lightbox2-2.11.4/js/lightbox.min.js'); }}"></script>
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