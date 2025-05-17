<script>
    var dt;
    var KTDatatablesServerSide = function() {
        var initDatatable = function() {
            var dt = $('#table-user').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: false,
                initComplete: function() {
                    Swal.close();
                },
                ajax: {
                    url: "user-management/json",
                    data: function(d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0]
                }],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "button",
                        className: "text-center",
                        orderable: false
                    },
                    {
                        data: "picture",
                        className: "text-center",
                        orderable: false
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {data: "provinsi"},
                    {data: "kabupaten"},
                    {data: "kecamatan"},
                    {data: "kelurahan"},
                    {data: "group"},
                    {
                        data: "status_aktif"
                    },
                    {
                        data: "created_at",
                        className: 'text-center'
                    }
                ],
                displayStart: 0,
                pageLength: 10,
                preDrawCallback: function() {
                    Swal.fire({
                        title: 'memuat data...',
                        html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: function() {
                            Swal.showLoading();
                        }
                    });
                },
                rowCallback: function(row, data) {
                    $(row).addClass('border');
                    $('.dataTables_length').remove();
                    Swal.close();
                }
            });
            $('#_10').on('click', function() {
                dt.page.len(10).draw();
            });
            $('#_25').on('click', function() {
                dt.page.len(25).draw();
            });
            $('#_50').on('click', function() {
                dt.page.len(50).draw();
            });
            $('#_100').on('click', function() {
                dt.page.len(100).draw();
            });
            $('#dt_reload').on('click', function() {
                $('#table-user').DataTable().ajax.reload();
            });
            $('#keyword').on('keyup', function() {
                var keyword = $('#keyword').val();
                if (keyword.length >= 3) {
                    dt.search(this.value).draw();
                } else if (keyword == '') {
                    dt.search(this.value).draw();
                }
            });
            dt.on('draw', function() {
                KTMenu.createInstances();
            });
        };
        return {
            init: function() {
                initDatatable();
            }
        };
    }();
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesServerSide.init();
    });
</script>