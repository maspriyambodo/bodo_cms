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
@push('scripts')
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
    var validator3 = FormValidation.formValidation(
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
        if (validator3) {
            validator3.validate().then(function (status) {
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
    });
</script>
@endpush