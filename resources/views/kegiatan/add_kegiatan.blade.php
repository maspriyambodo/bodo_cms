<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Kegiatan</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="nmatxt" class="required form-label">Nama Kegiatan</label>
                        <input type="text" id="nmatxt" name="nmatxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nmadir" class="required form-label">Nama Direktorat</label>
                        <select id="nmadir" name="nmadir" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Direktorat" required="" onchange="getSubdit(this.value)">
                            <option value="">Pilih Direktorat</option>
                            @foreach($direktorats as $direktorat)
                                <option value="{{ $direktorat->id }}">{{ $direktorat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="subdittxt" class="required form-label">Nama Subdit</label>
                        <select id="subdittxt" name="subdittxt" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Subdit" required=""></select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="tglmulaitxt" class="required form-label">Tanggal Mulai Kegiatan</label>
                        <input type="text" id="tglmulaitxt" name="tglmulaitxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="tglendtxt" class="required form-label">Tanggal Selesai Kegiatan</label>
                        <input type="text" id="tglendtxt" name="tglendtxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="loktxt" class="required form-label">Lokasi Kegiatan</label>
                        <textarea type="date" id="loktxt" name="loktxt" class="form-control form-control-solid" required=""></textarea>
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
    $(function () {
        $("#tglmulaitxt").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        });

        $("#tglendtxt").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        });
    });
</script>
<script>
    
    const form = document.getElementById('add_form');
    const submitButton = document.getElementById('addbtn_submit');

    function nmatxtCallback(value) {
        fetch(`{{ url('kegiatan/checknama') }}/${value}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    Swal.fire({
                        text: "Nama Kegiatan sudah ada, silakan gunakan nama lain.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    return {
                        valid: false,
                        message: 'Nama Kegiatan sudah ada, silakan gunakan nama lain.'
                    };
                } else {
                    return {
                        valid: true,
                        message: ''
                    };
                }
            })
            .catch(error => {
                console.error('Error get data kegiatan:', error);
                window.dispatchEvent(new Event('subdit-loading-error'));
            })
            .finally(() => {
                // Fire event when finished (success or error)
                window.dispatchEvent(new Event('subdit-loading-end'));
            });
    }

    var validator = FormValidation.formValidation(form, {
        fields: {
            nmatxt: {
                validators: {
                    notEmpty: {
                        message: 'Nama Kegiatan is required'
                    },
                    callback: {
                        message: 'Nama Kegiatan sudah ada, silakan gunakan nama lain.',
                        callback: function(input) {
                            const result = nmatxtCallback(input.value);
                            return result.valid;
                        }
                    }
                }
            },
            nmadir: {
                validators: {
                    notEmpty: {
                        message: 'Nama Direktorat is required'
                    }
                }
            },
            tglmulaitxt: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Mulai Kegiatan is required'
                    }
                }
            },
            tglendtxt: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Selesai Kegiatan is required'
                    }
                }
            },
            loktxt: {
                validators: {
                    notEmpty: {
                        message: 'Lokasi Kegiatan is required'
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
                    fetch("{{ route('kegiatan.store', 'q=add') }}", {
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
                                $('#table-kegiatan').DataTable().ajax.reload();
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
    
    function getSubdit(direktoratId) {
        $('#subdittxt').empty();
        // Fire event when starting request
        window.dispatchEvent(new Event('subdit-loading-start'));
        Swal.fire({
            title: 'memuat data...',
            html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
            allowOutsideClick: false,
            showConfirmButton: false,
            onOpen: function () {
                Swal.showLoading();
            }
        });

        fetch(`{{ url('kegiatan/subdirektorat') }}/${direktoratId}`)
            .then(response => response.json())
            .then(data => {
                const subditSelect = document.getElementById('subdittxt');
                subditSelect.innerHTML = '<option value="">Pilih Subdit</option>';
                data.forEach(subdit => {
                    const option = document.createElement('option');
                    option.value = subdit.id;
                    option.textContent = subdit.nama;
                    subditSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error get data subdirektorat:', error);
                window.dispatchEvent(new Event('subdit-loading-error'));
            })
            .finally(() => {
                // Fire event when finished (success or error)
                window.dispatchEvent(new Event('subdit-loading-end'));
                Swal.close();
            });
    }
</script>
@endpush
