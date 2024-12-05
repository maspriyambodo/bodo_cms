<script>
    var dt;
    var KTDatatablesServerSide = function () {
    var initDatatable = function () {
    var dt = $('#table-user').DataTable({
    searchDelay: 500,
            serverSide: true,
            paging: true,
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
                    @if ($user_access['create'])
            {
            titleAttr: 'add new user',
                    text: '<i class="bi bi-person-plus-fill"></i>',
                    attr: {
                    "data-bs-toggle": 'modal',
                            "data-bs-target": '#addModal'
                    }
            }
            @endif
            ]
            }
            },
            ajax: {
            url: "user-management-json",
                    data: function (d) {
                    d.keyword = $("#keyword").val();
                    }
            },
            columnDefs: [
            {orderable: false, targets: []},
            ],
            columns: [
            {
            data: 'no_urut',
                    className: "text-center",
                    orderable: false
            },
            {data: "button", className: "text-center", orderable: false},
            {data: "picture", className: "text-center", orderable: false},
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