<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Permission</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="parenttxt2" class="required form-label">Parent</label>
                        <select id="parenttxt2" name="parenttxt2" class="form-control form-control-solid form-select" required="">
                            <option value=""></option>
                            <option value="0">parent</option>
                            @foreach($user_groups as $dt_grup2)
                            <option value="{{ $dt_grup2->id; }}">{{ $dt_grup2->name; }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nametxt2" class="required form-label">Name</label>
                        <input id="nametxt2" name="nametxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="descriptontxt2" class="required form-label">Description</label>
                        <textarea id="descriptontxt2" name="descriptontxt2" class="form-control form-control-solid" required=""></textarea>
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
<script>
    function editData(val) {
        $.ajax({
            url: 'permission-edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="nametxt2"]').val(data.dt_permission['name']);
                    $('textarea[name="descriptontxt2"]').val(data.dt_permission['description']);
                    $("#parenttxt2").val(data.dt_permission['parent_id']);
                    $("#editModal").modal('show');
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
    var validator2 = FormValidation.formValidation(
            formEdit,
            {
                fields: {
                    parenttxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Parent is required'
                            }
                        }
                    },
                    nametxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Name is required'
                            }
                        }
                    },
                    descriptontxt2: {
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
            }
    );
    const updateButton = document.getElementById('editbtn_submit');
    updateButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator2) {
            validator2.validate().then(function (status) {
                if (status == 'Valid') {
                    updateButton.setAttribute('data-kt-indicator', 'on');
                    updateButton.disabled = true;
                    const formData = new FormData(formEdit);
                    fetch('permission-store/?q=update', {
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
                                        $('#table-permission').DataTable().ajax.reload();
                                        $("#editModal").modal('toggle');
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