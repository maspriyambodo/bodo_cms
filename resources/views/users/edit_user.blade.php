<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="editTitle">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                <input type="hidden" name="e_id" readonly="" />
                <input type="hidden" name="e_kab" />
                <input type="hidden" name="e_kec" />
                <input type="hidden" name="e_kel" />
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="fv-row mb-10">
                                <label for="namatxt2" class="required form-label">Name</label>
                                <input id="namatxt2" name="namatxt2" type="text" class="form-control form-control-solid" required="" />
                            </div>
                            <div class="fv-row mb-10">
                                <label for="leveltxt2" class="required form-label">Level</label>
                                <select id="leveltxt2" name="leveltxt2" class="form-control" required="">
                                    <option value="">select level</option>
                                    @foreach($dt_role as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="kabtxt2" class="required form-label">Kabupaten</label>
                                <select id="kabtxt2" name="kabtxt2" class="form-select" onchange="getKecamatan2(this.value)"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="keltxt2" class="required form-label">Kelurahan</label>
                                <select id="keltxt2" name="keltxt2" class="form-select"></select>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="fv-row mb-10">
                                <label for="mailtxt2" class="required form-label">Email</label>
                                <input id="mailtxt2" name="mailtxt2" type="email" class="form-control form-control-solid" required="" />
                            </div>
                            <div class="fv-row mb-10">
                                <label for="provinsitxt2" class="required form-label">Provinsi</label>
                                <select id="provinsitxt2" name="provinsitxt2" class="form-select" onchange="getKabupaten2(this.value)">
                                    <option value=""></option>
                                    @foreach($dt_provinsi as $provinsi)
                                    <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="kectxt2" class="required form-label">Kecamatan</label>
                                <select id="kectxt2" name="kectxt2" class="form-select" onchange="getKelurahan2(this.value)"></select>
                            </div>

                        </div>

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
@push('scripts')
<script>
    $('.form-select').select2({
        dropdownParent: $('#editModal'),
        placeholder: "select options",
    });

    function getKabupaten2(id_provinsi) {
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
            url: "{{ route('get_kabupaten') }}",
            type: "POST",
            data: {
                id_provinsi: id_provinsi,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                var kab = $('input[name="e_kab"]').val();
                $('#kabtxt2').empty();
                $('#kabtxt2').append('<option value="">select options</option>');
                $.each(data.dt_kabupaten, function(index) {
                    $('#kabtxt2').append('<option value="' + data.dt_kabupaten[index].id_kabupaten + '">' + data.dt_kabupaten[index].nama + '</option>');
                    if (data.dt_kabupaten[index].id_kabupaten == kab) {
                        $('#kabtxt2').val(data.dt_kabupaten[index].id_kabupaten);
                    }
                });
                Swal.close();
                $('#kabtxt2').trigger('change');
            }
        });
    }

    function getKecamatan2(id_kabupaten) {
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
            url: "{{ route('get_kecamatan') }}",
            type: "POST",
            data: {
                id_kabupaten: id_kabupaten,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                var kec = $('input[name="e_kec"]').val();
                $('#kectxt2').empty();
                $('#kectxt2').append('<option value="">select options</option>');
                $.each(data.results, function(index) {
                    $('#kectxt2').append('<option value="' + data.results[index].id + '">' + data.results[index].text + '</option>');
                    if (data.results[index].id == kec) {
                        $('#kectxt2').val(data.results[index].id);
                    }
                });
                Swal.close();
                $('#kectxt2').trigger('change');
            }
        });
    }

    function getKelurahan2(id_kecamatan) {
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
            url: "{{ route('get_kelurahan') }}",
            type: "POST",
            data: {
                id_kecamatan: id_kecamatan,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                var kel = $('input[name="e_kel"]').val();
                $('#keltxt2').empty();
                $('#keltxt2').append('<option value="">select options</option>');
                $.each(data.results, function(index) {
                    $('#keltxt2').append('<option value="' + data.results[index].id + '">' + data.results[index].text + '</option>');
                    if (data.results[index].id == kel) {
                        $('#keltxt2').val(data.results[index].id);
                    }
                });
                Swal.close();
                $('#keltxt2').trigger('change');
            }
        });
    }

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
            url: 'user-management/edit/' + val,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('input[name="e_id"]').val(data.new_id);
                    $('input[name="namatxt2"]').val(data.dt_user['name']);
                    $('input[name="mailtxt2"]').val(data.dt_user['email']);
                    $("#leveltxt2").val(data.dt_user['role']);
                    if (data.dt_user['id_provinsi'] != null) {
                        $("#provinsitxt2").val(data.dt_user['id_provinsi']);
                        $('#provinsitxt2').trigger('change');
                    }
                    $('input[name="e_kab"]').val(data.dt_user['id_kabupaten']);
                    $('input[name="e_kec"]').val(data.dt_user['id_kecamatan']);
                    $('input[name="e_kel"]').val(data.dt_user['id_kelurahan']);
                    $("#editModal").modal('show');
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
                    }).then(function() {
                        window.location.reload();
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    text: textStatus,
                    icon: "error",
                    buttonsStyling: !1,
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
    var validator2 = FormValidation.formValidation(
        formEdit, {
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
                    fetch('user-management/store', {
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
                                }).then(function() {
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
                                }).then(function() {
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
                            }).then(function() {
                                window.location.reload();
                            });
                        });
                }
            });
        }
    });
</script>
@endpush