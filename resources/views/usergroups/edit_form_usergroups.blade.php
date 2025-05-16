<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Group</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="parenttxt2" class="required form-label">Parent</label>
                        <select id="parenttxt2" name="parenttxt2" class="form-control form-control-solid form-select parenttxt2"></select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nametxt2" class="required form-label">Name</label>
                        <input type="hidden" id="eid" name="eid" required=""/>
                        <input type="text" id="nametxt2" name="nametxt2" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="descrptiontxt2" class="form-label">Description</label>
                        <textarea id="descrptiontxt2" name="descrptiontxt2" class="form-control form-control-solid"></textarea>
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
    $('.parenttxt2').select2({
        dropdownParent: $('#editModal'),
        placeholder: "Select...",
        ajax: {
            url: 'user-groups/search/',
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
            url: 'user-groups/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    var parentGroup, id_parent;
                    if (data.dt_usergrup['parent_id'] === 0) {
                        console.log(data.dt_usergrup['parent_id']);
                        parentGroup = 'parent';
                        id_parent = 0;
                    } else {
                        parentGroup = data.dt_usergrup['parent']['name'];
                        id_parent = data.dt_usergrup['parent']['id'];
                    }
                    $('#parenttxt2').append(new Option(parentGroup, id_parent, false, false));
                    $('#parenttxt2').val(id_parent);
                    $('#parenttxt2').trigger('change');
                    $('#eid').val(data.dt_usergrup['id']);
                    $('#nametxt2').val(data.dt_usergrup['name']);
                    $('#descrptiontxt2').val(data.dt_usergrup['description']);
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
                    fetch('user-groups/store/?q=update', {
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
                                        $('#table-usergrup').DataTable().ajax.reload();
                                        $("#editModal").modal('toggle');
                                    });
                                } else {
                                    Swal.fire({
                                        text: "error while insert data, errcode: 28022356",
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
                                    text: "error while insert data, errcode: 28022357",
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