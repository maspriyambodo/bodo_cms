<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Sub Direktorat</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="nmadir2" class="required form-label">Nama Direktorat</label>
                        <select id="nmadir2" name="nmadir2" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Direktorat" required="">
                            <option value="">Pilih Direktorat</option>
                            @foreach($direktorats as $direktorat)
                                <option value="{{ $direktorat->id }}">{{ $direktorat->nama }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="eid" name="eid" value=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nmatxt2" class="required form-label">Nama Sub Direktorat</label>
                        <input type="text" id="nmatxt2" name="nmatxt2" class="form-control form-control-solid" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="editbtn_submit" type="button" class="btn btn-primary">
                        <span class="indicator-label">
                            Update
                        </span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function editData(val) {
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
            url: 'subdit/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#eid').val(data.dt_subdit['id']);
                    $('#nmadir2').val(data.dt_subdit['id_direktorat']).trigger('change');
                    $('#nmatxt2').val(data.dt_subdit['nama']);
                    $("#editModal").modal('show');
                    Swal.close();
                } else {
                    Swal.fire({
                        text: 'error while get data!',
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function () {
                        window.location.reload();
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    text: textStatus,
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function () {
                    window.location.reload();
                });
            }
        });
    }
</script>
<script>
    const formEdit = document.getElementById('edit_form');
    var validator2 = FormValidation.formValidation(formEdit,
            {
                fields: {
                    eid: {
                        validators: {
                            notEmpty: {
                                message: 'The ID is required, please refresh page!'
                            }
                        }
                    },
                    nmadir2: {
                        validators: {
                            notEmpty: {
                                message: 'The Direktorat is required'
                            }
                        }
                    },
                    nmatxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Sub Direktorat is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
    );
    const updateButton = document.getElementById('editbtn_submit');
    updateButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator2) {
            validator2.validate().then(function (status) {
                if (status == 'Valid') {
                    Swal.fire({
                        title: 'memuat data...',
                        html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            Swal.showLoading();
                        }
                    });
                    updateButton.setAttribute('data-kt-indicator', 'on');
                    updateButton.disabled = true;
                    const formData = new FormData(formEdit);
                    fetch("{{ route('subdit.store', 'q=update') }}", {
                        method: 'POST',
                        body: formData
                    })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        text: "data has been updated",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        allowOutsideClick: false,
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function () {
                                        updateButton.setAttribute('data-kt-indicator', 'off');
                                        updateButton.disabled = false;
                                        $('#table-subdirektorat').DataTable().ajax.reload();
                                        $("#editModal").modal('toggle');
                                    });
                                } else {
                                    Swal.fire({
                                        text: "error while insert data, errcode: 2402251149",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        allowOutsideClick: false,
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function () {
                                        window.location.reload();
                                    });
                                }
                            })
                            .catch((error) => {
                                Swal.fire({
                                    text: error,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "OK",
                                    allowOutsideClick: false,
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function () {
                                    window.location.reload();
                                });
                            });
                }
            });
        }
    });
</script>
@endpush