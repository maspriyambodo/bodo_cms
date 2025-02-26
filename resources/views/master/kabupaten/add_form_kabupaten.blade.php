<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Kabupaten</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="provtxt" class="required form-label">Provinsi</label>
                        <select id="provtxt" name="provtxt" class="form-control form-control-solid form-select" onchange="add_kode(this.value);">
                            @foreach($provinsi as $dt_provinsi)
                            <option value="{{ $dt_provinsi->id_provinsi; }}">{{ $dt_provinsi->nama; }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="kdtxt" class="required form-label">Kode</label>
                        <input type="text" id="kdtxt" name="kdtxt" class="form-control form-control-solid" required="" onkeypress="return isNumber(event)"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nmatxt" class="required form-label">Name</label>
                        <input type="text" id="nmatxt" name="nmatxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="lattxt" class="form-label">Latitude</label>
                        <input type="text" id="lattxt" name="lattxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="longtxt" class="form-label">Longitude</label>
                        <input type="text" id="longtxt" name="longtxt" class="form-control form-control-solid" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="addbtn_submit" type="button" class="btn btn-primary">
                        <span class="indicator-label">
                            Save
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
    function add_kode(id_prov) {
        $('#kdtxt').val(id_prov);
    }
    $('.form-select').select2({
        dropdownParent: $('#addModal')
    });
    const form = document.getElementById('add_form');
    const submitButton = document.getElementById('addbtn_submit');
    var validator = FormValidation.formValidation(form, {
        fields: {
            provtxt: {
                validators: {
                    notEmpty: {
                        message: 'The Provinsi is required'
                    }
                }
            },
            kdtxt: {
                validators: {
                    notEmpty: {
                        message: 'The Kode is required'
                    }
                }
            },
            nmatxt: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required'
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
    });
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    Swal.fire({
                        title: 'memuat data...',
                        html: '<img src="{{ asset("src/media/misc/loading.gif"); }}" title="Sedang Diverifikasi">',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            Swal.showLoading();
                        }
                    });
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    const formData = new FormData(form);
                    fetch('kabupaten/store/?q=add', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            Swal.fire({
                                text: "data has been saved",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "OK",
                                allowOutsideClick: false,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function () {
                                submitButton.setAttribute('data-kt-indicator', 'off');
                                submitButton.disabled = false;
                                $('#table-kab').DataTable().ajax.reload();
                                $('#btn_close1').click();
                            });
                        } else {
                            Swal.fire({
                                text: "error while insert data, errcode: 20050512",
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
                    }).catch((error) => {
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