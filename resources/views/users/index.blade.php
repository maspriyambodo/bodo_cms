@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/lightbox2-2.11.4/css/lightbox.min.css'); }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-user" class="table table-rounded table-striped table-hover gy-5 gs-7 border" style="width: 100%;">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th>No</th>
                        <th>#</th>
                        <th>Pict</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
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
                        <input id="pwtxt" name="pwtxt" type="text" class="form-control form-control-solid" value="{{ $default_password->param_value; }}" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="leveltxt" class="required form-label">Level</label>
                        <select id="leveltxt" name="leveltxt" class="form-control" required="">
                            <option value="">select level</option>
                            @foreach($dt_role as $role)
                            <option value="{{ $role->id; }}">{{ $role->name; }}</option>
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
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="editTitle">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="e_id" readonly=""/>
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="namatxt2" class="required form-label">Name</label>
                        <input id="namatxt2" name="namatxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="mailtxt2" class="required form-label">Email</label>
                        <input id="mailtxt2" name="mailtxt2" type="email" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="leveltxt2" class="required form-label">Level</label>
                        <select id="leveltxt2" name="leveltxt2" class="form-control" required="">
                            <option value="">select level</option>
                            @foreach($dt_role as $role)
                            <option value="{{ $role->id; }}">{{ $role->name; }}</option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Delete Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="d_id" readonly=""/>
                <div class="modal-body">
                    <p id="deltxt"></p>
                    <p class="text-warning fw-bold mt-4">deleted data cannot be recovered</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="delbtn_submit" type="button" class="btn btn-danger">
                        <span class="indicator-label">
                            Delete
                        </span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="restoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Activate Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="restore_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="d_id2" readonly=""/>
                <div class="modal-body">
                    <p id="restxt"></p>
                    <p class="text-info fw-bold">users will be able to access the application again.</p>
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
<div class="modal fade" id="resetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="resetModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Activate Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reset_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="d_id3" readonly=""/>
                <div class="modal-body">
                    <p id="resettxt"></p>
                    <p id="resettxt2" class="text-info fw-bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="resetbtn_submit" type="button" class="btn btn-info">
                        <span class="indicator-label">
                            Reset
                        </span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/lightbox2-2.11.4/js/lightbox.min.js'); }}"></script>
<script>
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
});
</script>
<script>
    var dt;
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            var dt = $('#table-user').DataTable({
                searchDelay: 500,
                serverSide: true,
                paging: true,
                deferRender: true,
                info: true,
                stateSave: true,
                layout: {
                    topStart: {
                        buttons: [
                            'pageLength',
                            {
                                titleAttr: 'refresh data',
                                text: '<i class="bi bi-arrow-clockwise"></i>',
                                action: function () {
                                    $('#table-user').DataTable().ajax.reload();
                                }
                            },
@if($access_create)
                            {
                                titleAttr: 'add new user',
                                text: '<i class="bi bi-person-plus-fill"></i>',
                                attr: {
                                    "data-bs-toggle": 'modal',
                                    "data-bs-target": '#addModal'
                                }
                            }
@endif
                        ]
                    }
                },
                ajax: {
                    url: "user-management-json",
                    data: function (d) {
                        d.keyword = $("#keyword").val();
                    }
                },
                columnDefs: [
                    {orderable: false, targets: []},
                ],
                columns: [
                    {
                        data: 'no_urut',
                        className: "text-center",
                        orderable: false
                    },
                    {data: "button", className: "text-center", orderable: false},
                    {data: "picture", className: "text-center", orderable: false},
                    {data: "name"},
                    {data: "email"},
                    {data: "role_name"},
                    {data: "status_aktif"},
                    {data: "created_at", className: 'text-center'}
                ],
                displayStart: 0,
                pageLength: 10,
                rowCallback: function (row, data) {
                    $(row).addClass('border');
                },
            });
            dt.on('draw', function () {
                KTMenu.createInstances();
            });
        };
        return {
            init: function () {
                initDatatable();
            }
        };
    }();
// On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });</script>
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
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    const formData = new FormData(form);
                    fetch('user-management-store', {
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
    });</script>
<script>
    function editData(val) {
        $.ajax({
            url: 'user-management-edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="e_id"]').val(data.new_id);
                    $('input[name="namatxt2"]').val(data.dt_user['name']);
                    $('input[name="mailtxt2"]').val(data.dt_user['email']);
                    $("#leveltxt2").val(data.dt_user['role']);
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
    var validator = FormValidation.formValidation(
            formEdit,
            {
                fields: {
                    namatxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required'
                            }
                        }
                    },
                    mailtxt2: {
                        validators: {
                            notEmpty: {
                                message: 'The email is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    leveltxt2: {
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
    const updateButton = document.getElementById('editbtn_submit');
    updateButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    updateButton.setAttribute('data-kt-indicator', 'on');
                    updateButton.disabled = true;
                    const formData = new FormData(formEdit);
                    fetch('user-management-store', {
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
                                        $('#table-user').DataTable().ajax.reload();
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
    });</script>
<script>
    function deleteData(id_user) {
        $.ajax({
            url: 'user-management-edit/' + id_user,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="d_id"]').val(data.new_id);
                    $('#deltxt').html('Are you sure you want to delete <strong>' + data.dt_user['name'] + '</strong>?');
                    $("#deleteModal").modal('show');
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
    const formDelete = document.getElementById('delete_form');
    var validator = FormValidation.formValidation(
            formEdit,
            {
                fields: {
                    d_id: {
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
    const delButton = document.getElementById('delbtn_submit');
    delButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    delButton.setAttribute('data-kt-indicator', 'on');
                    delButton.disabled = true;
                    const formData = new FormData(formDelete);
                    fetch('user-management-store', {
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
                                        delButton.setAttribute('data-kt-indicator', 'off');
                                        delButton.disabled = false;
                                        $('#table-user').DataTable().ajax.reload();
                                        $("#deleteModal").modal('toggle');
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
    });</script>
<script>
    function restoreData(id_user) {
        $.ajax({
            url: 'user-management-edit/' + id_user,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="d_id2"]').val(data.new_id);
                    $('#restxt').html('you will activate user <strong>' + data.dt_user['name'] + '</strong>?');
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
    var validator = FormValidation.formValidation(
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
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    actButton.setAttribute('data-kt-indicator', 'on');
                    actButton.disabled = true;
                    const formData = new FormData(formRestore);
                    fetch('user-management-store', {
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
                                        $('#table-user').DataTable().ajax.reload();
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
    });</script>
<script>
    function resetPassword(id_user) {
        $.ajax({
            url: 'user-management-edit/' + id_user + '?q=reset_password',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('input[name="d_id3"]').val(data.new_id);
                    $('#resettxt').html('you will reset the password of user <strong>' + data.dt_user['name'] + '</strong>?');
                    $('#resettxt2').html('The new user password is: <strong>' + data.default_password + '</strong>');
                    $("#resetModal").modal('show');
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
    const formReset = document.getElementById('reset_form');
    const resetButton = document.getElementById('resetbtn_submit');
    var validator = FormValidation.formValidation(
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
    resetButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    resetButton.setAttribute('data-kt-indicator', 'on');
                    resetButton.disabled = true;
                    const formData = new FormData(formReset);
                    fetch('user-management-store', {
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
                                        resetButton.setAttribute('data-kt-indicator', 'off');
                                        resetButton.disabled = false;
                                        $('#table-user').DataTable().ajax.reload();
                                        $("#resetModal").modal('toggle');
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