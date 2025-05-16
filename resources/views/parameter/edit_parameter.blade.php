<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Parameter</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="idtxt2" class="required form-label">ID</label>
                        <input id="idtxt2" name="idtxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt2" class="required form-label">GROUP</label>
                        <input id="gruptxt2" name="gruptxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="valtxt2" class="required form-label">VALUE</label>
                        <input id="valtxt2" name="valtxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt2" class="required form-label">DESCRIPTION</label>
                        <textarea id="desctxt2" name="desctxt2" class="form-control form-control-solid" required=""></textarea>
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
            url: 'parameter/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="idtxt2"]').val(data.dt_param['id_param']);
                    $('input[name="gruptxt2"]').val(data.dt_param['param_group']);
                    $('input[name="valtxt2"]').val(data.dt_param['param_value']);
                    $('textarea[name="desctxt2"]').val(data.dt_param['param_desc']);
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
    const updateButton = document.getElementById('editbtn_submit');
    var validator1 = FormValidation.formValidation(formEdit, {
        fields: {
            idtxt2: {
                validators: {
                    notEmpty: {
                        message: 'The ID is required'
                    }
                }
            },
            gruptxt2: {
                validators: {
                    notEmpty: {
                        message: 'The Group is required'
                    }
                }
            },
            valtxt2: {
                validators: {
                    notEmpty: {
                        message: 'The Value is required'
                    }
                }
            },
            desctxt2: {
                validators: {
                    notEmpty: {
                        message: 'The Description is required'
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
    updateButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator1) {
            validator1.validate().then(function (status) {
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
                    fetch('parameter/store/?q=update', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json()).then(data => {
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
                                $('#table-parameter').DataTable().ajax.reload();
                                $('#btn_close2').click();
                            });
                        } else {
                            Swal.fire({
                                text: "error while insert data, errcode: 04121113",
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