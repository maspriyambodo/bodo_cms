<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-permission').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: true,
                ajax: {
                    url: "permission-json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [
                    {
                        orderable: false, targets: [0, 1, 3, 4]

                    }
                ],
                columns: [
                    {

                        className: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        data: "button",
                        className: "text-center"

                    }, {
                        data: "name"
                    }, {
                        data: "children",
                        render: function (data) {
                            var child_name = '';
                            for (var i = 0, l = data.length; i < l; i++) {
                                child_name = data[i].name;
                            }
                            return child_name;
                        }
                    }, {
                        data: "description"
                    }, {
                        data: "status_aktif"
                    }, {
                        data: "created_at",
                        className: 'text-center'
                    }
                ],
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
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });
</script>