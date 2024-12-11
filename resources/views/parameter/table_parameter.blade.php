<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-parameter').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: true,
                ajax: {
                    url: "parameter-json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 4]
                    }],
                columns: [{
                        data: "button",
                        className: "text-center",
                        orderable: false
                    }, {
                        data: "id_param"
                    }, {
                        data: "param_group"
                    }, {
                        data: "param_value"
                    }, {
                        data: "param_desc"
                    }, {
                        data: "status_aktif"
                    }, {
                        data: "created_at",
                        className: 'text-center'
                    }],
                displayStart: 0,
                pageLength: 10,
                rowCallback: function (row, data) {
                    $('.dataTables_length').remove();
                    $(row).addClass('border');
                }
            });
            $('#_10').on('click', function () {
                dt.page.len(10).draw();
            });
            $('#_25').on('click', function () {
                dt.page.len(25).draw();
            });
            $('#_50').on('click', function () {
                dt.page.len(50).draw();
            });
            $('#_100').on('click', function () {
                dt.page.len(100).draw();
            });
            $('#dt_reload').on('click', function () {
                $('#table-permission').DataTable().ajax.reload();
            });
            $('#keyword').on('keyup', function () {
                dt.search(this.value).draw();
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