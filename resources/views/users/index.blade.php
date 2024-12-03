@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css'); }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <table id="table-user" class="table table-rounded table-striped table-hover gy-5 gs-7 border">
            <thead>
                <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                    <th>No</th>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Register Date</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js'); }}"></script>
<script>

var dt;
var KTDatatablesServerSide = function () {
    var initDatatable = function () {
        var dt = $('#table-user').DataTable({
            responsive: true,
            searchDelay: 500,
            serverSide: true,
            paging: true,
            ordering: true,
            deferRender: true,
            info: true,
            stateSave: true,
            layout: {
                topStart: {
                    buttons: [
                        'pageLength',
                        {
                            titleAttr: 'refresh data',
                            text: '<i class="bi bi-arrow-clockwise"></i>',
                            action: function () {
                                $('#table-user').DataTable().ajax.reload();
                            }
                        },
                        {
                            titleAttr: 'add new user',
                            text: '<i class="bi bi-person-plus-fill"></i>',
                            action: function (e, dt, node, config) {
                                alert('Button activated');
                            }
                        }
                    ]
                }
            },
            ajax: {
                url: "user-management-json",
                data: function (d) {
                    d.keyword = $("#keyword").val();
                }
            },
            order: [[0, "asc"]],
            columnDefs: [
                {orderable: false, targets: []},
            ],
            columns: [
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className: "text-center",
                    orderable: false
                },
                {data: "button", className: "text-center", orderable: false},
                {data: "name"},
                {data: "email"},
                {data: "role_name"},
                {data: "status_aktif"},
                {data: "created_at", className: 'text-center'}
            ],
            displayStart: 0,
            pageLength: 10,
            rowCallback: function (row, data) {
                $(row).addClass('border');
            },
        });
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    };
    return {
        init: function () {
            initDatatable();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
</script>
@endpush