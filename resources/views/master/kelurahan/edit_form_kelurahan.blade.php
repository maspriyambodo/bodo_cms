<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Kelurahan</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="kectxt2" class="required form-label">Kecamatan</label>
                        <select id="kectxt2" name="kectxt2" class="form-control form-control-solid form-select kectxt2" onchange="add_kode2(this.value);"></select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="kdtxt2" class="required form-label">Kode</label>
                        <input type="hidden" id="eid" name="eid" required=""/>
                        <input type="text" id="kdtxt2" name="kdtxt2" class="form-control form-control-solid" required="" onkeypress="return isNumber(event)"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nmatxt2" class="required form-label">Name</label>
                        <input type="text" id="nmatxt2" name="nmatxt2" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="lattxt2" class="form-label">Latitude</label>
                        <input type="text" id="lattxt2" name="lattxt2" class="form-control form-control-solid" maxlength="11" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="longtxt2" class="form-label">Longitude</label>
                        <input type="text" id="longtxt2" name="longtxt2" class="form-control form-control-solid" maxlength="11" required=""/>
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
    function add_kode2(id_prov) {
        $('#kdtxt2').val(id_prov);
    }
    $('.kectxt2').select2({
        dropdownParent: $('#editModal'),
        placeholder: "Select...",
        ajax: {
            url: 'kelurahan/search/',
            data: function (params) {
                var query = {
                    search: params.term
                };

                // Query parameters will be ?search=[term]
                return query;
            }
        }
    });
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
            url: 'kelurahan/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#kectxt2').append(new Option(data.dt_kelurahan['kecamatan']['nama'], data.dt_kelurahan['id_kecamatan'], false, false));
                    $('#kectxt2').val(data.dt_kelurahan['id_kecamatan']);
                    $('#kectxt2').trigger('change');
                    $('#eid').val(data.dt_kelurahan['id_kelurahan']);
                    $('#kdtxt2').val(data.dt_kelurahan['id_kelurahan']);
                    $('#nmatxt2').val(data.dt_kelurahan['nama']);
                    $('#lattxt2').val(data.dt_kelurahan['coordinates']['coordinates'][1]);
                    $('#longtxt2').val(data.dt_kelurahan['coordinates']['coordinates'][0]);
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
                                message: 'The Kode is required, please refresh page!'
                            }
                        }
                    },
                    kectxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Provinsi is required'
                            }
                        }
                    },
                    kdtxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Kode is required'
                            }
                        },
                        stringLength: {
                                max: 6,
                                message: 'The kode must be less than 6 characters long'
                            }
                    },
                    nmatxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Provinsi Name is required'
                            }
                        }
                    },
                    lattxt2: {
                        validators: {
                            stringLength: {
                                max: 11,
                                message: 'The latitude must be 11 characters long'
                            }
                        }
                    },
                    longtxt2: {
                        validators: {
                            stringLength: {
                                max: 11,
                                message: 'The longitude must be 11 characters long'
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
                    fetch('kelurahan/store/?q=update', {
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
                                        $('#table-kel').DataTable().ajax.reload();
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