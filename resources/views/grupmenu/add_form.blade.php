<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Group</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="nmatxt" class="required form-label">Group Name</label>
                        <input type="text" id="nmatxt" name="nmatxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt" class="form-label">Description</label>
                        <textarea id="desctxt" name="desctxt" class="form-control form-control-solid"></textarea>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="ordtxt" class="required form-label">Order Number</label>
                        <select id="ordtxt" name="ordtxt" class="form-control form-control-solid form-select">
                            @foreach($order_num as $order_nums)
                            <option value="{{ $order_nums->order_no }}">{{ $order_nums->order_no }}</option>
                            @endforeach
                            <option value="{{ $order_nums->order_no + 1 }}">{{ $order_nums->order_no + 1}}</option>
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
    const submitButton = document.getElementById('addbtn_submit');
    var validator = FormValidation.formValidation(form, {
        fields: {
            nmatxt: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required'
                    }
                }
            },
            ordtxt: {
                validators: {
                    notEmpty: {
                        message: 'The Group is required'
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
                    fetch('menugrup-store', {
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
                                change_order_no();
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
    function change_order_no() {
        
    }
</script>
@endpush