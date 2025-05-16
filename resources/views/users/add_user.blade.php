<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="namatxt" class="required form-label">Name</label>
                        <input id="namatxt" name="namatxt" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="mailtxt" class="required form-label">Email</label>
                        <input id="mailtxt" name="mailtxt" type="email" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="pwtxt" class="required form-label">Password</label>
                        <input id="pwtxt" name="pwtxt" type="text" class="form-control form-control-solid" value="{{ $default_password->param_value }}" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="leveltxt" class="required form-label">Level</label>
                        <select id="leveltxt" name="leveltxt" class="form-control" required="">
                            <option value="">select level</option>
                            @foreach($dt_role as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
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
    const form = document.getElementById('add_form');
    var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    namatxt: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required'
                            }
                        }
                    },
                    mailtxt: {
                        validators: {
                            notEmpty: {
                                message: 'The email is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    pwtxt: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    leveltxt: {
                        validators: {
                            notEmpty: {
                                message: 'The level is required'
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
    const submitButton = document.getElementById('addbtn_submit');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
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
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    const formData = new FormData(form);
                    fetch('user-management/store', {
                        method: 'POST',
                        body: formData
                    })
                            .then(response => response.json())
                            .then(data => {
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
                                        $('#table-user').DataTable().ajax.reload();
                                        $("#addModal").modal('toggle');
                                    });
                                } else {
                                    Swal.fire({
                                        text: "error while insert data, errcode: 12040011",
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