<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-menu').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: true,
                ajax: {
                    url: "menu-json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [
                    {
                        orderable: false, targets: [0, 1, 4, 5, 6]

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
                        render: function (data, type, row, meta) {
                            var nama_parent = '';
                            if (row.parent) {
                                nama_parent = row.parent.nama;
                            }
                            return nama_parent;
                        }
                    }, {
                        data: "nama"
                    }, {
                        data: "link"
                    }, {
                        render: function(data, type, row, meta){
                            var nama_group = '';
                            if (row.group) {
                                nama_group = row.group.nama;
                            }
                            return nama_group;
                        }
                    }, {
                        data: "icon",
                        className: 'text-center'
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "status_aktif"
                    },
                    {
                        data: "created_at"
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
                $('#table-menu').DataTable().ajax.reload();
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