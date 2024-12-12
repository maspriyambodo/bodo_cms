<div class="modal fade" id="configModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="configModalModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="configModalLabel"></h1>
            </div>
            <form id="config_form" class="form" action="#" autocomplete="off">
                @csrf
                <input id="d_id2" name="d_id2" type="hidden" required=""/>
                <div class="modal-body">
                    <table id="table-setpermission" class="table table-rounded table-hover border my-5">
                        <thead>
                            <tr class="bg-secondary fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                                <th class="text-center">Menu</th>
                                <th class="text-center">view</th>
                                <th class="text-center">create</th>
                                <th class="text-center">read</th>
                                <th class="text-center">update</th>
                                <th class="text-center">delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="close_btn4" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="confbtn_submit" type="button" class="btn btn-primary">
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
    function configData(id_permission) {
        $.ajax({
            url: 'permission-edit/' + id_permission,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    set_permission(id_permission);
                    $('#d_id2').val(data.dt_permission.id);
                    $('#configModalLabel').html('Setting Permission <strong>' + data.dt_permission.name + '</strong>');
                    $("#configModal").modal('show');
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
    function set_permission(role_id) {
        var dt = $('#table-setpermission').DataTable({
            serverSide: true,
            paging: false,
            deferRender: false,
            info: false,
            stateSave: true,
            ordering: false,
            ajax: {
                url: "permission-set-json/?role_id=" + role_id,
                data: function (d) {
                    d.keyword = $("#keyword").val();
                }
            },
            columns: [
                {
                    data: "menu",
                    render: function (data, type, row, meta) {
                        return data.nama;
                    }
                },
                {className: "text-center", data: "view"},
                {className: "text-center", data: "create"},
                {className: "text-center", data: "read"},
                {className: "text-center", data: "update"},
                {className: "text-center", data: "delete"}
            ],
            displayStart: 0,
            pageLength: 10,
            rowCallback: function (row, data) {
                $('.dataTables_length').remove();
                $(row).addClass('border');
            }
        });
        $('#close_btn4').on('click', function () {
            dt.destroy();
        });
        $('#keyword').on('keyup', function () {
            dt.search(this.value).draw();
        });
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }
</script>
<script>
    const formConfig = document.getElementById('config_form');
    const confSubmit = document.getElementById('confbtn_submit');
    var validator4 = FormValidation.formValidation(
            formConfig,
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
    confSubmit.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator4) {
            validator4.validate().then(function (status) {
                if (status == 'Valid') {
                    confSubmit.setAttribute('data-kt-indicator', 'on');
                    confSubmit.disabled = true;
                    const formData = new FormData(formConfig);
                    fetch('permission-store/?q=setpermission', {
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
                                        confSubmit.setAttribute('data-kt-indicator', 'off');
                                        confSubmit.disabled = false;
                                        var dt = $('#table-setpermission').DataTable();
                                        dt.destroy();
                                        $("#configModal").modal('toggle');
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