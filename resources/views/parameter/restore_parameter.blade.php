<div class="modal fade" id="restoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Activate Data Parameter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="restore_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="d_id2" readonly=""/>
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                            </svg>
                        </span>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">This is an alert</h4>
                            <span>restoring parameter data may cause system damage</span>
                        </div>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="idtxt4" class="required form-label">ID</label>
                        <input id="idtxt4" name="idtxt4" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt4" class="required form-label">GROUP</label>
                        <input id="gruptxt4" name="gruptxt4" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="valtxt4" class="required form-label">VALUE</label>
                        <input id="valtxt4" name="valtxt4" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt4" class="required form-label">DESCRIPTION</label>
                        <textarea id="desctxt4" name="desctxt4" class="form-control form-control-solid" required="" readonly=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="actbtn_submit" type="button" class="btn btn-success">
                        <span class="indicator-label">
                            Actived
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
    function restoreData(id_parameter) {
        $.ajax({
            url: 'parameter-edit/' + id_parameter,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="idtxt4"]').val(data.dt_param['id_param']);
                    $('input[name="gruptxt4"]').val(data.dt_param['param_group']);
                    $('input[name="valtxt4"]').val(data.dt_param['param_value']);
                    $('textarea[name="desctxt4"]').val(data.dt_param['param_desc']);
                    $("#restoreModal").modal('show');
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
    const formRestore = document.getElementById('restore_form');
    const actButton = document.getElementById('actbtn_submit');
    var validator4 = FormValidation.formValidation(
            formEdit,
            {
                fields: {
                    d_id2: {
                        validators: {
                            notEmpty: {
                                message: 'The ID is required'
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
    actButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator4) {
            validator4.validate().then(function (status) {
                if (status == 'Valid') {
                    actButton.setAttribute('data-kt-indicator', 'on');
                    actButton.disabled = true;
                    const formData = new FormData(formRestore);
                    fetch('parameter-store/?q=restore', {
                        method: 'POST',
                        body: formData
                    })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        text: "data has been deleted",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "OK",
                                        allowOutsideClick: false,
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function () {
                                        actButton.setAttribute('data-kt-indicator', 'off');
                                        actButton.disabled = false;
                                        $('#table-parameter').DataTable().ajax.reload();
                                        $("#restoreModal").modal('toggle');
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