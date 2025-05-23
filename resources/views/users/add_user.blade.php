<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="fv-row mb-10">
                                <label for="namatxt" class="required form-label">Name</label>
                                <input id="namatxt" name="namatxt" type="text" class="form-control form-control-solid" required="" />
                            </div>
                            <div class="fv-row mb-10">
                                <label for="pwtxt" class="required form-label">Password</label>
                                <input id="pwtxt" name="pwtxt" type="text" class="form-control form-control-solid" value="{{ $default_password->param_value }}" readonly="" />
                            </div>
                            <div class="fv-row mb-10">
                                <label for="kabtxt" class="required form-label">Kabupaten</label>
                                <select id="kabtxt" name="kabtxt" class="form-select" onchange="getKecamatan(this.value)"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="keltxt" class="required form-label">Kelurahan</label>
                                <select id="keltxt" name="keltxt" class="form-select"></select>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="fv-row mb-10">
                                <label for="mailtxt" class="required form-label">Email</label>
                                <input id="mailtxt" name="mailtxt" type="email" class="form-control form-control-solid" required="" />
                            </div>
                            <div class="fv-row mb-10">
                                <label for="provinsitxt" class="required form-label">Provinsi</label>
                                <select id="provinsitxt" name="provinsitxt" class="form-select" onchange="getKabupaten(this.value)">
                                    <option value=""></option>
                                    @foreach($dt_provinsi as $provinsi)
                                    <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="kectxt" class="required form-label">Kecamatan</label>
                                <select id="kectxt" name="kectxt" class="form-select" onchange="getKelurahan(this.value)"></select>
                            </div>
                            <div class="fv-row mb-10">
                                <label for="leveltxt" class="required form-label">Level</label>
                                <select id="leveltxt" name="leveltxt" class="form-control" required="">
                                    <option value="">select level</option>
                                    @foreach($dt_role as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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
    $('.form-select').select2({
        dropdownParent: $('#addModal'),
        placeholder: "select options",
    });

    function getKabupaten(id_provinsi) {
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
                $('#kabtxt').empty();
                $('#kabtxt').append('<option value="">select options</option>');
                $.each(data.dt_kabupaten, function(index) {
                    $('#kabtxt').append('<option value="' + data.dt_kabupaten[index].id_kabupaten + '">' + data.dt_kabupaten[index].nama + '</option>');
                });
                Swal.close();
            }
        });
    }

    function getKecamatan(id_kabupaten) {
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
                $('#kectxt').empty();
                $('#kectxt').append('<option value="">select options</option>');
                $.each(data.results, function(index) {
                    $('#kectxt').append('<option value="' + data.results[index].id + '">' + data.results[index].text + '</option>');
                });
                Swal.close();
            }
        });
    }

    function getKelurahan(id_kecamatan) {
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
                $('#keltxt').empty();
                $('#keltxt').append('<option value="">select options</option>');
                $.each(data.results, function(index) {
                    $('#keltxt').append('<option value="' + data.results[index].id + '">' + data.results[index].text + '</option>');
                });
                Swal.close();
            }
        });
    }

    const form = document.getElementById('add_form');
    var validator = FormValidation.formValidation(
        form, {
            fields: {
                namatxt: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        }
                    }
                },
                mailtxt: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                pwtxt: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                },
                leveltxt: {
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
    const submitButton = document.getElementById('addbtn_submit');
    submitButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function(status) {
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
                                }).then(function() {
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