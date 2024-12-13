<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Menu</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="parenttxt" class="required form-label">Parent</label>
                        <select id="parenttxt" name="parenttxt" class="form-control form-control-solid form-select">
                            <option value="">parent</option>
                            @foreach($menu_parent as $dt_parent)
                            <option value="{{ $dt_parent->id; }}">{{ $dt_parent->nama; }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="namatxt" class="required form-label">Name</label>
                        <input type="text" id="namatxt" name="namatxt" class="form-control form-control-solid"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="linktxt" class="required form-label">Link</label>
                        <input type="text" id="linktxt" name="linktxt" class="form-control form-control-solid"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt" class="required form-label">Group</label>
                        <select id="gruptxt" name="gruptxt" class="form-control form-control-solid form-select">
                            <option value=""></option>
                            @foreach($menu_group as $dt_grup)
                            <option value="{{ $dt_grup->id }}">{{ $dt_grup->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="vistxt" class="required form-label">Visibility</label>
                        <select id="vistxt" name="vistxt" class="form-control form-control-solid form-select">
                            <option value=""></option>
                            <option value="0">Show</option>
                            <option value="1">Hidden</option>
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
    $("#namatxt").keyup(function () {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#linktxt").val(Text);
    });
    const form = document.getElementById('add_form');
    const submitButton = document.getElementById('addbtn_submit');
    var validator = FormValidation.formValidation(form, {
        fields: {
            namatxt: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required'
                    }
                }
            },
            linktxt: {
                validators: {
                    notEmpty: {
                        message: 'The Link is required'
                    }
                }
            },
            gruptxt: {
                validators: {
                    notEmpty: {
                        message: 'The Group is required'
                    }
                }
            },
            vistxt: {
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
    });
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    const formData = new FormData(form);
                    fetch('menu-store/?q=add', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json()).then(data => {
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
                                $('#table-menu').DataTable().ajax.reload();
                                $('#btn_close1').click();
                            });
                        } else {
                            Swal.fire({
                                text: "error while insert data, errcode: 20050512",
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