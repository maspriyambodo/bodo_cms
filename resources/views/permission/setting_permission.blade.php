<div class="modal fade" id="configModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="configModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="configModalLabel"></h1>
            </div>
            <form id="config_form" class="form" action="#" autocomplete="off">
                @csrf
                <input id="setidtxt" name="setidtxt" type="hidden" required=""/>
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
            url: 'permission/edit/' + id_permission,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    set_permission(id_permission);
                    $('#setidtxt').val(data.dt_permission.id);
                    $('#configModalLabel').html('Setting Permission <strong>' + data.dt_permission.name + '</strong>');
                    $("#configModal").modal('show');
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
    function set_permission(role_id) {
        var dt = $('#table-setpermission').DataTable({
            serverSide: true,
            paging: false,
            deferRender: false,
            info: false,
            stateSave: false,
            ordering: false,
            initComplete: function () {
                    Swal.close();
                },
            ajax: {
                url: "permission/set-json/?role_id=" + role_id,
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
            preDrawCallback: function () {
                Swal.fire({
                    title: 'memuat data...',
                    html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: function () {
                        Swal.showLoading();
                    }
                });
            },
            rowCallback: function (row, data) {
                $('.dataTables_length').remove();
                $(row).addClass('border');
                Swal.close();
            }
        });
        $('#close_btn4').on('click', function () {
            dt.destroy();
        });
        $('#keyword').on('keyup', function () {
            var keyword = $('#keyword').val();
            if (keyword.length >= 3) {
                dt.search(this.value).draw();
            } else if (keyword == '') {
                dt.search(this.value).draw();
            }
        });
    }
</script>
<script>
    const formSetpermisi = document.getElementById('config_form');
    var validator4 = FormValidation.formValidation(
            formEdit,
            {
                fields: {
                    setidtxt: {
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
    const confButton = document.getElementById('confbtn_submit');
    confButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator4) {
            validator4.validate().then(function (status) {
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
//                    $('input:checkbox').prop('checked', true);
                    confButton.setAttribute('data-kt-indicator', 'on');
                    confButton.disabled = true;
                    const formData = new FormData(formSetpermisi);
                    fetch('permission/store/?q=setpermission', {
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
                                        confButton.setAttribute('data-kt-indicator', 'off');
                                        confButton.disabled = false;
                                        var dt = $('#table-setpermission').DataTable();
                                        dt.destroy();
                                        $("#configModal").modal('toggle');
                                    });
                                } else {
                                    Swal.fire({
                                        text: "error while insert data, errcode: 1258121204",
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
<script>
    function v_menu(val) {
        var c, r, u, d;
        c = $("#ctxt" + val);
        r = $("#rtxt" + val);
        u = $("#utxt" + val);
        d = $("#dtxt" + val);
        if ($("#vtxt" + val).prop('checked') == true) {
            document.getElementById("vtxt" + val).value = 1;
            document.getElementById("tvtxt" + val).value = 1;
        } else {
            document.getElementById("vtxt" + val).value = 0;
            document.getElementById("tvtxt" + val).value = 0;
            c.prop('checked', false);
            r.prop('checked', false);
            u.prop('checked', false);
            d.prop('checked', false);
        }
    }
    function c_menu(val) {
        var view_menu = $("#vtxt" + val).val();
        var msgtxt = '';
        if (view_menu == 0) {
            $("#ctxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without view access!';
            document.getElementById("ctxt" + val).value = 0;
            document.getElementById("tctxt" + val).value = 0;
        } else if ($("#ctxt" + val).prop('checked') == true) {
            document.getElementById("ctxt" + val).value = 1;
            document.getElementById("tctxt" + val).value = 1;
        } else {
            document.getElementById("ctxt" + val).value = 0;
            document.getElementById("tctxt" + val).value = 0;
        }
        if (msgtxt) {
            Swal.fire({
                text: msgtxt,
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-warning"
                }
            });
        }
    }
    function r_menu(val) {
        var view_menu = $("#vtxt" + val).val();
        var msgtxt = '';
        if (view_menu == 0) {
            $("#rtxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without view access!';
            document.getElementById("rtxt" + val).value = 0;
            document.getElementById("trtxt" + val).value = 0;
        } else if ($("#rtxt" + val).prop('checked') == true) {
            document.getElementById("rtxt" + val).value = 1;
            document.getElementById("trtxt" + val).value = 1;
        } else {
            document.getElementById("rtxt" + val).value = 0;
            document.getElementById("trtxt" + val).value = 0;
        }
        if (msgtxt) {
            Swal.fire({
                text: msgtxt,
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-warning"
                }
            });
        }
    }
    function u_menu(val) {
        var view_menu = $("#vtxt" + val).val();
        var read_menu = $("#rtxt" + val).val();
        var msgtxt = '';
        if (view_menu == 0 & read_menu == 0) {
            $("#utxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without view access!';
            document.getElementById("utxt" + val).value = 0;
            document.getElementById("tutxt" + val).value = 0;
        } else if (read_menu == 0 & view_menu == 1) {
            $("#utxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without read access!';
            document.getElementById("utxt" + val).value = 0;
            document.getElementById("tutxt" + val).value = 0;
        } else if ($("#utxt" + val).prop('checked') == true) {
            document.getElementById("utxt" + val).value = 1;
            document.getElementById("tutxt" + val).value = 1;
        } else {
            document.getElementById("utxt" + val).value = 0;
            document.getElementById("tutxt" + val).value = 0;
        }
        if (msgtxt) {
            Swal.fire({
                text: msgtxt,
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-warning"
                }
            });
        }
    }
    function d_menu(val) {
        var view_menu = $("#vtxt" + val).val();
        var read_menu = $("#rtxt" + val).val();
        var msgtxt = '';
        if (view_menu == 0 & read_menu == 0) {
            $("#dtxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without view access!';
            document.getElementById("dtxt" + val).value = 0;
            document.getElementById("tdtxt" + val).value = 0;
        } else if (read_menu == 0 & view_menu == 1) {
            $("#dtxt" + val).prop('checked', false);
            msgtxt = 'you cannot select this without read access!';
            document.getElementById("dtxt" + val).value = 0;
            document.getElementById("tdtxt" + val).value = 0;
        } else if ($("#dtxt" + val).prop('checked') == true) {
            document.getElementById("dtxt" + val).value = 1;
            document.getElementById("tdtxt" + val).value = 1;
        } else {
            document.getElementById("dtxt" + val).value = 0;
            document.getElementById("tdtxt" + val).value = 0;
        }
        if (msgtxt) {
            Swal.fire({
                text: msgtxt,
                icon: "warning",
                buttonsStyling: !1,
                confirmButtonText: "OK",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-warning"
                }
            });
        }
    }
</script>
@endpush