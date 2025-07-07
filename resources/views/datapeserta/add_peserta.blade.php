<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Peserta</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="nmatxt" class="required form-label">Nama Peserta</label>
                        <input type="text" id="nmatxt" name="nmatxt" class="form-control form-control-solid" required=""/>
                        <input type="hidden" id="id_kegiatan2" name="id_kegiatan2" value="{{ $id_kegiatan }}"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="tmplahirtxt" class="required form-label">Tempat Lahir</label>
                        <input type="text" id="tmplahirtxt" name="tmplahirtxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="tgllahirtxt" class="required form-label">Tanggal Lahir</label>
                        <input type="text" id="tgllahirtxt" name="tgllahirtxt" class="form-control form-control-solid" readonly required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="alamattxt" class="required form-label">Alamat</label>
                        <textarea type="text" id="alamattxt" name="alamattxt" class="form-control form-control-solid" required=""></textarea>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nohptxt" class="required form-label">No. Hp</label>
                        <input type="text" id="nohptxt" name="nohptxt" class="form-control form-control-solid" required="" onkeypress="return isNumber(event)"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="utustxt" class="required form-label">Utusan</label>
                        <input type="text" id="utustxt" name="utustxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="jabtxt" class="required form-label">Jabatan</label>
                        <input type="text" id="jabtxt" name="jabtxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="almktrtxt" class="required form-label">Alamat Kantor</label>
                        <textarea type="text" id="almktrtxt" name="almktrtxt" class="form-control form-control-solid" required=""></textarea>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="rektxt" class="required form-label">No. Rekening</label>
                        <input type="text" id="rektxt" name="rektxt" class="form-control form-control-solid" required="" onkeypress="return isNumber(event)"/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="banktxt" class="required form-label">Nama Bank</label>
                        <select id="banktxt" name="banktxt" class="banktxt form-control form-select form-select-solid" required="">
                            <option></option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="antxt" class="required form-label">Atas Nama Rekening</label>
                        <input type="text" id="antxt" name="antxt" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="ttdtxt" class="required form-label">T T D</label>
                        <input type="hidden" id="ttdtxt" name="ttdtxt" class="form-control form-control-solid" required=""/>
                        <div class='js-signature w-100 text-center mt-2'></div>
                        <div class="text-center">
                            <button type="button" class="btn btn-light btn-sm mt-2" id="btn_clear_signature" onclick="clearTtd()">Hapus TTD</button>
                            <button type="button" class="btn btn-success btn-sm mt-2" id="svttd" onclick="getTtd()">Simpan TTD</button>
                        </div>
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
        
        $('.banktxt').select2({
            dropdownParent: $('#addModal .modal-content'),
            placeholder: "Pilih Bank",
        });

        $("#tgllahirtxt").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        });
        $('.js-signature').jqSignature({
            width: 400,
            height: 150
        });
    });

    function getTtd() {
        var dataUrl = $('.js-signature').jqSignature('getDataURL');;
        if (dataUrl == '') {
            Swal.fire({
                text: "TTD harus diisi",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            return;
        }
        $('#ttdtxt').val(dataUrl);
        Swal.fire({
            text: "TTD berhasil disimpan",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "OK",
            allowOutsideClick: false,
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function () {
            $('#svttd').attr('disabled', true);
            $('#svttd').html('<span class="indicator-label">TTD Sudah Disimpan</span>');
        });

    }

    function clearTtd() {
        $('.js-signature').jqSignature('clearCanvas');
        $('#ttdtxt').val('');
        $('#svttd').attr('disabled', false);
        $('#svttd').html('<span class="indicator-label">Simpan TTD</span>');
    }

    function isNumber(b) {
        b = (b) ? b : window.event;
        var a = (b.which) ? b.which : b.keyCode;
        if (a > 31 && (a < 48 || a > 57)) {
            return false;
        }
        return true;
    }
</script>
<script>
    
    const form = document.getElementById('add_form');
    const submitButton = document.getElementById('addbtn_submit');

    var validator = FormValidation.formValidation(form, {
        fields: {
            nmatxt: {
                validators: {
                    notEmpty: {
                        message: 'Nama Peserta is required'
                    },
                }
            },
            tmplahirtxt: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Lahir is required'
                    }
                }
            },
            tgllahirtxt: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Lahir is required'
                    }
                }
            },
            alamattxt: {
                validators: {
                    notEmpty: {
                        message: 'Alamat Peserta is required'
                    }
                }
            },
            nohptxt: {
                validators: {
                    notEmpty: {
                        message: 'No. Hp Peserta is required'
                    }
                }
            },
            utustxt: {
                validators: {
                    notEmpty: {
                        message: 'Utusan is required'
                    }
                }
            },
            jabtxt: {
                validators: {
                    notEmpty: {
                        message: 'Jabatan is required'
                    }
                }
            },
            almktrtxt: {
                validators: {
                    notEmpty: {
                        message: 'Alamat Kantor is required'
                    }
                }
            },
            rektxt: {
                validators: {
                    notEmpty: {
                        message: 'No. Rekening is required'
                    }
                }
            },
            banktxt: {
                validators: {
                    notEmpty: {
                        message: 'Nama Bank is required'
                    }
                }
            },
            antxt: {
                validators: {
                    notEmpty: {
                        message: 'Atas Nama Rekening is required'
                    }
                }
            },
            ttdtxt: {
                validators: {
                    notEmpty: {
                        message: 'Tanda Tangan is required'
                    }
                }
            }
        },
        plugins: {
            declarative: new FormValidation.plugins.Declarative({
                            html5Input: true,
                        }),
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
                    fetch("{{ route('peserta.store', 'q=add') }}", {
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
                                $('#table-peserta').DataTable().ajax.reload();
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
