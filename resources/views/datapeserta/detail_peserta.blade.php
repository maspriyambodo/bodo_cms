<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel"></h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_nama"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Tempat Tanggal Lahir</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_lahir1"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>No. Hp</label>
                        </div>
                        <div class="col-md-6">
                            <span id="no_hp"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-6">
                            <span id="addr1"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Utusan</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_utusan"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Jabatan</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_jabatan"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Alamat Kantor</label>
                        </div>
                        <div class="col-md-6">
                            <span id="addr2"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>No. Rekening</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_norek"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Atas Nama Rekening</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_anrek"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Atas Nama Rekening</label>
                        </div>
                        <div class="col-md-6">
                            <span id="peserta_nmbank"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>T T D</label>
                        </div>
                        <div class="col-md-6">
                            <img id="peserta_ttd" alt="Tanda Tangan" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="ctkbtn_submit" type="button" class="btn btn-primary">
                        <span class="indicator-label">
                            Cetak Biodata
                        </span>
                        <span class="indicator-progress">Please wait... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function detailPeserta(id) {
            Swal.fire({
                title: 'memuat data...',
                html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: "{{ route('peserta.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        Swal.close();
                        $('#detailModalLabel').text('Peserta: ' + response.data.nama);
                        $('#peserta_nama').text(': ' + response.data.nama);
                        $('#peserta_lahir1').text(': ' + response.data.tempat_lahir + ', ' + response.data.tanggal_lahir);
                        $('#no_hp').text(': ' + response.data.no_hp);
                        $('#addr1').text(': ' + response.data.alamat);
                        $('#peserta_utusan').text(': ' + response.data.utusan);
                        $('#peserta_jabatan').text(': ' + response.data.jabatan);
                        $('#addr2').text(': ' + response.data.alamat_kantor);
                        $('#peserta_norek').text(': ' + response.data.no_rekening);
                        $('#peserta_anrek').text(': ' + response.data.atas_nama_rek);
                        $('#peserta_nmbank').text(': ' + response.data.bank.nama);
                        $('#peserta_ttd').attr('src', response.data.ttd);
                        $('#detailModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while fetching the data.',
                    });
                }
            });
        }
    </script>
@endpush