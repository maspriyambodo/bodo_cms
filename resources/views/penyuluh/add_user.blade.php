<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Penyuluh</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-10">
                                <label for="niptxt" class="required form-label">N I P</label>
                                <input id="niptxt" name="niptxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="niktxt" class="required form-label">N I K</label>
                                <input id="niktxt" name="niktxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="agamatxt" class="required form-label">AGAMA</label>
                                <select id="agamatxt" name="agamatxt" class="form-control form-control-solid">
                                    <option value="">Select Agama</option>
                                    <option value="1">Islam</option>
                                    <option value="2">Kristen</option>
                                    <option value="3">Katolik</option>
                                    <option value="4">Hindu</option>
                                    <option value="5">Buddha</option>
                                    <option value="6">Konghucu</option>
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tanggal_lahirtxt" class="required form-label">TANGGAL LAHIR</label>
                                <input id="tanggal_lahirtxt" name="tanggal_lahirtxt" type="date" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="alamattxt" class="required form-label">ALAMAT</label>
                                <textarea id="alamattxt" name="alamattxt" class="form-control form-control-solid"></textarea>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tugas_kabupaten_txt" class="required form-label">TUGAS KABUPATEN</label>
                                <select id="tugas_kabupaten_txt" name="tugas_kabupaten_txt" class="form-control form-control-solid"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tugas_kuatxt" class="required form-label">TUGAS KUA</label>
                                <select id="tugas_kuatxt" name="tugas_kuatxt" class="form-control form-control-solid"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="nohptxt" class="required form-label">NO HP</label>
                                <input id="nohptxt" name="nohptxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="pendidikan_txt" class="required form-label">PENDIDIKAN</label>
                                <select id="pendidikan_txt" name="pendidikan_txt" class="form-control form-control-solid">
                                    <option value="">Select Pendidikan</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Sarjana">Sarjana</option>
                                    <option value="Magister">Magister</option>
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="jurusan_txt" class="required form-label">JURUSAN</label>
                                <input id="jurusan_txt" name="jurusan_txt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="fv-row mb-10">
                                <label for="nipatxt" class="required form-label">N I P A</label>
                                <input id="nipatxt" name="nipatxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="namatxt" class="required form-label">NAMA</label>
                                <input id="namatxt" name="namatxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tempat_lahirtxt" class="required form-label">TEMPAT LAHIR</label>
                                <input id="tempat_lahirtxt" name="tempat_lahirtxt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="jenis_kelamintxt" class="required form-label">JENIS KELAMIN</label>
                                <select id="jenis_kelamintxt" name="jenis_kelamintxt" class="form-control form-control-solid">
                                    <option value="">Select Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tugas_provinsitxt" class="required form-label">TUGAS PROVINSI</label>
                                <select id="tugas_provinsitxt" name="tugas_provinsitxt" class="form-control form-control-solid"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="tugas_kecamatan_txt" class="required form-label">TUGAS KECAMATAN</label>
                                <select id="tugas_kecamatan_txt" name="tugas_kecamatan_txt" class="form-control form-control-solid"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="status_pegawai_txt" class="required form-label">STATUS PEGAWAI</label>
                                <select id="status_pegawai_txt" name="status_pegawai_txt" class="form-control form-control-solid">
                                    <option value="">Select Status Pegawai</option>
                                    <option value="PNS">PNS</option>
                                    <option value="NON PNS">NON PNS</option>
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="emailtxt" class="required form-label">EMAIL</label>
                                <input id="emailtxt" name="emailtxt" type="email" class="form-control form-control-solid" required=""/>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="organisasi_txt" class="required form-label">ORGANISASI</label>
                                <input id="organisasi_txt" name="organisasi_txt" type="text" class="form-control form-control-solid" required=""/>
                            </div>
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
    const form = document.getElementById('add_form');
    var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    niptxt: {
                        validators: {
                            notEmpty: {
                                message: 'NIP is required'
                            },
                            numeric: {
                                message: 'NIP must be a number'
                            }
                        }
                    },
                    niktxt: {
                        validators: {
                            notEmpty: {
                                message: 'NIK is required'
                            }
                        }
                    },
                    agamatxt: {
                        validators: {
                            notEmpty: {
                                message: 'Agama is required'
                            }
                        }
                    },
                    tanggal_lahirtxt: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal lahir is required'
                            }
                        }
                    },
                    alamattxt: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat is required'
                            }
                        }
                    },
                    tugas_kabupaten_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Tugas kabupaten is required'
                            }
                        }
                    },
                    tugas_kuatxt: {
                        validators: {
                            notEmpty: {
                                message: 'Tugas KUA is required'
                            }
                        }
                    },
                    nohptxt: {
                        validators: {
                            notEmpty: {
                                message: 'No HP is required'
                            }
                        }
                    },
                    pendidikan_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Pendidikan is required'
                            }
                        }
                    },
                    jurusan_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Jurusan is required'
                            }
                        }
                    },
                    nipatxt: {
                        validators: {
                            notEmpty: {
                                message: 'NIPA is required'
                            }
                        }
                    },
                    namatxt: {
                        validators: {
                            notEmpty: {
                                message: 'Nama is required'
                            }
                        }
                    },
                    tempat_lahirtxt: {
                        validators: {
                            notEmpty: {
                                message: 'Tempat lahir is required'
                            }
                        }
                    },
                    jenis_kelamintxt: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis kelamin is required'
                            }
                        }
                    },
                    tugas_provinsitxt: {
                        validators: {
                            notEmpty: {
                                message: 'Tugas provinsi is required'
                            }
                        }
                    },
                    tugas_kecamatan_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Tugas kecamatan is required'
                            }
                        }
                    },
                    status_pegawai_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Status pegawai is required'
                            }
                        }
                    },
                    emailtxt: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'Please enter a valid email address'
                            }
                        }
                    },
                    organisasi_txt: {
                        validators: {
                            notEmpty: {
                                message: 'Organisasi is required'
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
                    Swal.fire({
                        title: 'memuat data...',
                        html: '<img src="{{ asset("src/media/misc/loading.gif"); }}" title="Sedang Diverifikasi">',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            Swal.showLoading();
                        }
                    });
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    const formData = new FormData(form);
                    fetch('user-management/store', {
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
    });
</script>
@endpush