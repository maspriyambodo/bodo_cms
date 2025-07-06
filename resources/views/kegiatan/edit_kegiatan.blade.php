<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Sub Direktorat</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                @method('POST')
                
                <div class="modal-body">
                    <!-- Nama Kegiatan -->
                    <div class="fv-row mb-10">
                        <label for="nmatxt2" class="required form-label">Nama Kegiatan</label>
                        <input type="text" id="nmatxt2" name="nmatxt2" class="form-control form-control-solid" required />
                        <input type="hidden" id="eid" name="eid" value="" />
                    </div>
                    
                    <!-- Nama Direktorat -->
                    <div class="fv-row mb-10">
                        <label for="nmadir2" class="required form-label">Nama Direktorat</label>
                        <select id="nmadir2" name="nmadir2" class="form-select form-select-solid" data-control="select2"
                            data-placeholder="Pilih Direktorat" required onchange="getSubdit2(this.value)">
                            <option value="">Pilih Direktorat</option>
                            @foreach($direktorats as $direktorat)
                                <option value="{{ $direktorat->id }}">{{ $direktorat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Nama Subdit -->
                    <div class="fv-row mb-10">
                        <label for="subdittxt2" class="required form-label">Nama Subdit</label>
                        <select id="subdittxt2" name="subdittxt2" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Pilih Subdit" required></select>
                    </div>
                    
                    <!-- Tanggal Kegiatan -->
                    <div class="fv-row mb-10">
                        <label for="tglmulaitxt2" class="required form-label">Tanggal Mulai Kegiatan</label>
                        <input type="text" id="tglmulaitxt2" name="tglmulaitxt2" class="form-control form-control-solid" required />
                    </div>
                    
                    <div class="fv-row mb-10">
                        <label for="tglendtxt2" class="required form-label">Tanggal Selesai Kegiatan</label>
                        <input type="text" id="tglendtxt2" name="tglendtxt2" class="form-control form-control-solid" required />
                    </div>
                    
                    <!-- Lokasi Kegiatan -->
                    <div class="fv-row mb-10">
                        <label for="loktxt2" class="required form-label">Lokasi Kegiatan</label>
                        <textarea id="loktxt2" name="loktxt" class="form-control form-control-solid" required></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="editbtn_submit" type="button" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $("#tglmulaitxt2").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true,
            });

            $("#tglendtxt2").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true,
            });
        });
    </script>
    <script>
        function editData(val) {
            Swal.fire({
                title: 'memuat data...',
                html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: 'kegiatan/edit/' + val,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#eid').val(data.dt_kegiatan['id']);
                        $('#nmadir2').val(data.dt_kegiatan['direktorat']).trigger('change');
                        $('#subdittxt2').val(data.dt_kegiatan['subdirektorat']).trigger('change');
                        $('#nmatxt2').val(data.dt_kegiatan['nama']);
                        $('#tglmulaitxt2').val(data.dt_kegiatan['tanggal_mulai_kegiatan']);
                        $('#tglendtxt2').val(data.dt_kegiatan['tanggal_selesai_kegiatan']);
                        $('#loktxt2').val(data.dt_kegiatan['lokasi_acara']);
                        $("#editModal").modal('show');
                        Swal.close();
                    } else {
                        Swal.fire({
                            text: 'error while get data!',
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            allowOutsideClick: false,
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            window.location.reload();
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        text: textStatus,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        window.location.reload();
                    });
                }
            });
        }
    </script>

    <script>
        const formEdit = document.getElementById('edit_form');
        var validator2 = FormValidation.formValidation(formEdit, {
            fields: {
                eid: {
                    validators: {
                        notEmpty: {
                            message: 'The ID is required, please refresh page!'
                        }
                    }
                },
                nmatxt2: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Kegiatan is required'
                        }
                    }
                },
                nmadir2: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Direktorat is required'
                        }
                    }
                },
                tglmulaitxt2: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Mulai Kegiatan is required'
                        }
                    }
                },
                tglendtxt2: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Selesai Kegiatan is required'
                        }
                    }
                },
                loktxt2: {
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

        const updateButton = document.getElementById('editbtn_submit');
        updateButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (validator2) {
                validator2.validate().then(function(status) {
                    if (status == 'Valid') {
                        Swal.fire({
                            title: 'memuat data...',
                            html: '<img src="{{ asset("src/media/misc/loading.gif") }}" title="Sedang Diverifikasi">',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            onOpen: function() {
                                Swal.showLoading();
                            }
                        });
                        
                        updateButton.setAttribute('data-kt-indicator', 'on');
                        updateButton.disabled = true;
                        
                        const formData = new FormData(formEdit);
                        fetch("{{ route('subdit.store', 'q=update') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    text: "data has been updated",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    allowOutsideClick: false,
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function() {
                                    updateButton.setAttribute('data-kt-indicator', 'off');
                                    updateButton.disabled = false;
                                    $('#table-subdirektorat').DataTable().ajax.reload();
                                    $("#editModal").modal('toggle');
                                });
                            } else {
                                Swal.fire({
                                    text: "error while insert data, errcode: 2402251149",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    allowOutsideClick: false,
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function() {
                                    window.location.reload();
                                });
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                text: error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                allowOutsideClick: false,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                window.location.reload();
                            });
                        });
                    }
                });
            }
        });

        function getSubdit2(direktoratId) {
        $('#subdittxt2').empty();
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
                const subditSelect = document.getElementById('subdittxt2');
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
