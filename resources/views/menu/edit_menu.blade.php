<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data menu</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="parenttxt2" class="required form-label">Parent</label>
                        <select id="parenttxt2" name="parenttxt2" class="form-control form-control-solid form-select">
                            <option value="">parent</option>
                            @foreach($menu_parent as $dt_parent2)
                            <option value="{{ $dt_parent2->id }}">{{ $dt_parent2->nama }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="idtxt2"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="namatxt2" class="required form-label">Name</label>
                        <input type="text" id="namatxt2" name="namatxt2" class="form-control form-control-solid"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="linktxt2" class="required form-label">Link</label>
                        <input type="text" id="linktxt2" name="linktxt2" class="form-control form-control-solid"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt2" class="required form-label">Group</label>
                        <select id="gruptxt2" name="gruptxt2" class="form-control form-control-solid form-select">
                            <option value=""></option>
                            @foreach($menu_group as $dt_grup)
                            <option value="{{ $dt_grup->id }}">{{ $dt_grup->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="vistxt2" class="required form-label">Visibility</label>
                        <select id="vistxt2" name="vistxt2" class="form-control form-control-solid form-select">
                            <option value=""></option>
                            <option value="0">Show</option>
                            <option value="1">Hidden</option>
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="descripttxt2" class="required form-label">Description</label>
                        <textarea id="descripttxt2" name="descripttxt2" class="form-control form-control-solid"></textarea>
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
            url: 'menu/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="idtxt2"]').val(data.dt_menu['id']);
                    $('input[name="linktxt2"]').val(data.dt_menu['link']);
                    $('input[name="namatxt2"]').val(data.dt_menu['nama']);
                    $('textarea[name="descripttxt2"]').val(data.dt_menu['description']);
                    $("#parenttxt2").val(data.dt_menu['menu_parent']);
                    $("#gruptxt2").val(data.dt_menu['group_menu']);
                    $("#vistxt2").val(data.dt_menu['is_hide']);
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
                    namatxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Name is required'
                            }
                        }
                    },
                    linktxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Link is required'
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
                    vistxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The Visibility is required'
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
                    fetch('menu/store/?q=update', {
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
                                        $('#table-menu').DataTable().ajax.reload();
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
@endpush