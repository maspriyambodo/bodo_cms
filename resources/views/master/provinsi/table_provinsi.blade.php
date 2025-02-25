<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-prov').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: true,
                ajax: {
                    url: "provinsi/json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [
                    {
                        orderable: false, targets: [1, 4, 5]

                    }
                ],
                columns: [
                    {
                        className: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "button",
                        className: "text-center"

                    },
                    {
                        data: "id_provinsi",
                        className: "text-center"
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "latitude",
                        className: "text-center"
                    },
                    {
                        data: "longitude",
                        className: "text-center"
                    },
                    {
                        data: "status_aktif",
                        className: "text-center"
                    },
                    {
                        data: "created_at",
                        className: "text-center"
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
                $('#table-prov').DataTable().ajax.reload();
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
    function isNumber(b) {
        b = (b) ? b : window.event;
        var a = (b.which) ? b.which : b.keyCode;
        if (a > 31 && (a < 48 || a > 57)) {
            return false;
        }
        return true;
    }
</script>