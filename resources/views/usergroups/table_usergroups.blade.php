<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-usergrup').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: false,
                processing: true,
                initComplete: function () {
                    Swal.close();
                },
                ajax: {
                    url: "user-groups/json",
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "button",
                        className: "text-center"

                    },
                    {
                        render: function (data, type, row, meta) {
                            var nama_parent = '';
                            if (row.parent) {
                                nama_parent = row.parent.name;
                            }
                            return nama_parent;
                        }
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "description",
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
                preDrawCallback: function () {
                    Swal.fire({
                        title: 'memuat data...',
                        html: '<img src="{{ asset("src/media/misc/loading.gif"); }}" title="Sedang Diverifikasi">',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            Swal.showLoading();
                        }
                    });
                },
                rowCallback: function (row, data) {
                    $('.dataTables_length').remove();
                    $(row).addClass('border');
                    Swal.close();
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
                $('#table-usergrup').DataTable().ajax.reload();
            });
            $('#keyword').on('keyup', function () {
                var keyword = $('#keyword').val();
                if (keyword.length >= 3) {
                    dt.search(this.value).draw();
                } else if (keyword == '') {
                    dt.search(this.value).draw();
                }
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