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
                stateSave: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: '400px',
                fixedColumns: {
                    leftColumns: 1
                },
                initComplete: function () {
                    Swal.close();
                },
                ajax: {
                    url: "penyuluh/json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [
                    {
                        orderable: false, targets: [0]
                    },
                ],
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "button", 
                        className: "text-center", 
                        orderable: false, 
                        searchable: false
                    },
                    {data: "nama"},
                    {data: "jenis_kelamin"},
                    {data: "nik"},
                    {data: "tempat_lahir"},
                    {data: "tanggal_lahir"},
                    {data: "alamat"},
                    {data: "nip"},
                    {data: "nipa"},
                    {data: "provinsi.nama"},
                    {data: "kabupaten.nama"},
                    {data: "kecamatan.nama"},
                    {data: "tugas_kua.nama_kua"},
                    {data: "email"},
                    {data: "status_aktif"},
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
                    $(row).addClass('border');
                    $('.dataTables_length').remove();
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
                $('#table-user').DataTable().ajax.reload();
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