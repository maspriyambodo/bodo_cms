@extends('layouts.admin_template')
@push('stylesheet')
<link href="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.css'); }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css'); }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive py-5">
            <table id="table-parameter" class="table table-rounded table-striped table-hover gy-5 gs-7 border" style="width: 100%;">
                <thead>
                    <tr class="bg-light fw-bold fs-6 border-bottom-2 border-gray-200 text-center border">
                        <th>#</th>
                        <th>ID</th>
                        <th>GROUP</th>
                        <th>VALUE</th>
                        <th>DESCRIPTION</th>
                        <th>Status</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Parameter</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="idtxt" class="required form-label">ID</label>
                        <input id="idtxt" name="idtxt" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt" class="required form-label">GROUP</label>
                        <input id="gruptxt" name="gruptxt" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="valtxt" class="required form-label">VALUE</label>
                        <input id="valtxt" name="valtxt" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt" class="required form-label">DESCRIPTION</label>
                        <textarea id="desctxt" name="desctxt" class="form-control form-control-solid" required=""></textarea>
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
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Parameter</h1>
                <button id="btn_close2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="idtxt2" class="required form-label">ID</label>
                        <input id="idtxt2" name="idtxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt2" class="required form-label">GROUP</label>
                        <input id="gruptxt2" name="gruptxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="valtxt2" class="required form-label">VALUE</label>
                        <input id="valtxt2" name="valtxt2" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt2" class="required form-label">DESCRIPTION</label>
                        <textarea id="desctxt2" name="desctxt2" class="form-control form-control-solid" required=""></textarea>
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
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Data Parameter</h1>
                <button id="btn_close3" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">This is an alert</h4>
                            <span>deleting parameter data may cause system damage</span>
                        </div>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="idtxt3" class="required form-label">ID</label>
                        <input id="idtxt3" name="idtxt3" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="gruptxt3" class="required form-label">GROUP</label>
                        <input id="gruptxt3" name="gruptxt3" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="valtxt3" class="required form-label">VALUE</label>
                        <input id="valtxt3" name="valtxt3" type="text" class="form-control form-control-solid" required="" readonly=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="desctxt3" class="required form-label">DESCRIPTION</label>
                        <textarea id="desctxt3" name="desctxt3" class="form-control form-control-solid" required="" readonly=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
@endsection
@push('scripts')
<script src="{{ asset('src/plugins/custom/prismjs/prismjs.bundle.js'); }}"></script>
<script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js'); }}"></script>
<script>
  var dt;
  var KTDatatablesServerSide = function() {
    var initDatatable = function() {
      var dt = $('#table-parameter').DataTable({
        searchDelay: 500,
        serverSide: true,
        paging: true,
        deferRender: true,
        info: true,
        stateSave: true,
        layout: {
          topStart: {
            buttons: ['pageLength', {
                titleAttr: 'refresh data',
                text: '<i class="bi bi-arrow-clockwise"></i>',
                action: function() {
                  $('#table-parameter').DataTable().ajax.reload();
                }
              },
              @if($access_create) {
                titleAttr: 'add new parameter',
                text: ' <i class="bi bi-plus"></i>',
                attr: {
                  "data-bs-toggle": 'modal',
                  "data-bs-target": '#addModal'
                }
              }
              @endif
            ]
          }
        },
        ajax: {
          url: "parameter-json",
          data: function(d) {
            d.keyword = $("#keyword").val();
          }
        },
        columnDefs: [{
          orderable: false,
          targets: []
        }, ],
        columns: [{
          data: "button",
          className: "text-center",
          orderable: false
        }, {
          data: "id_param"
        }, {
          data: "param_group"
        }, {
          data: "param_value"
        }, {
          data: "param_desc"
        }, {
          data: "status_aktif"
        }, {
          data: "created_at",
          className: 'text-center'
        }],
        displayStart: 0,
        pageLength: 10,
        rowCallback: function(row, data) {
          $(row).addClass('border');
        },
      });
      dt.on('draw', function() {
        KTMenu.createInstances();
      });
    };
    return {
      init: function() {
        initDatatable();
      }
    };
  }();
  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTDatatablesServerSide.init();
  });
</script>
<script>
  function editData(val) {
    $.ajax({
      url: 'parameter-edit/' + val,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          $('input[name="idtxt2"]').val(data.dt_param['id_param']);
          $('input[name="gruptxt2"]').val(data.dt_param['param_group']);
          $('input[name="valtxt2"]').val(data.dt_param['param_value']);
          $('textarea[name="desctxt2"]').val(data.dt_param['param_desc']);
          $("#editModal").modal('show');
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
  const form = document.getElementById('add_form');
  const submitButton = document.getElementById('addbtn_submit');
  var validator = FormValidation.formValidation(form, {
    fields: {
      idtxt: {
        validators: {
          notEmpty: {
            message: 'The ID is required'
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
      valtxt: {
        validators: {
          notEmpty: {
            message: 'The Value is required'
          }
        }
      },
      desctxt: {
        validators: {
          notEmpty: {
            message: 'The Description is required'
          }
        }
      },
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
  submitButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (validator) {
      validator.validate().then(function(status) {
        if (status == 'Valid') {
          submitButton.setAttribute('data-kt-indicator', 'on');
          submitButton.disabled = true;
          const formData = new FormData(form);
          fetch('parameter-store/?q=add', {
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
              }).then(function() {
                submitButton.setAttribute('data-kt-indicator', 'off');
                submitButton.disabled = false;
                $('#table-parameter').DataTable().ajax.reload();
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
              }).then(function() {
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
            }).then(function() {
              window.location.reload();
            });
          });
        }
      });
    }
  });
</script>
<script>
  const formEdit = document.getElementById('edit_form');
  const updateButton = document.getElementById('editbtn_submit');
  var validator1 = FormValidation.formValidation(formEdit, {
    fields: {
      idtxt2: {
        validators: {
          notEmpty: {
            message: 'The ID is required'
          }
        }
      },
      gruptxt2: {
        validators: {
          notEmpty: {
            message: 'The Group is required'
          }
        }
      },
      valtxt2: {
        validators: {
          notEmpty: {
            message: 'The Value is required'
          }
        }
      },
      desctxt2: {
        validators: {
          notEmpty: {
            message: 'The Description is required'
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
  updateButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (validator1) {
      validator1.validate().then(function(status) {
        if (status == 'Valid') {
          updateButton.setAttribute('data-kt-indicator', 'on');
          updateButton.disabled = true;
          const formData = new FormData(formEdit);
          fetch('parameter-store/?q=update', {
            method: 'POST',
            body: formData
          }).then(response => response.json()).then(data => {
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
                $('#table-parameter').DataTable().ajax.reload();
                $('#btn_close2').click();
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
            }).then(function() {
              window.location.reload();
            });
          });
        }
      });
    }
  });
</script>
<script>
  function deleteData(id_parameter) {
    $.ajax({
      url: 'parameter-edit/' + id_parameter,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          $('input[name="idtxt3"]').val(data.dt_param['id_param']);
          $('input[name="gruptxt3"]').val(data.dt_param['param_group']);
          $('input[name="valtxt3"]').val(data.dt_param['param_value']);
          $('textarea[name="desctxt3"]').val(data.dt_param['param_desc']);
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
  const formDelete = document.getElementById('delete_form');
  const delButton = document.getElementById('delbtn_submit');
  var validator3 = FormValidation.formValidation(formEdit, {
    fields: {
      idtxt3: {
        validators: {
          notEmpty: {
            message: 'The ID is required'
          }
        }
      },
      gruptxt3: {
        validators: {
          notEmpty: {
            message: 'The Group is required'
          }
        }
      },
      valtxt3: {
        validators: {
          notEmpty: {
            message: 'The Value is required'
          }
        }
      },
      desctxt3: {
        validators: {
          notEmpty: {
            message: 'The Description is required'
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
  delButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (validator3) {
      validator3.validate().then(function(status) {
        if (status == 'Valid') {
          delButton.setAttribute('data-kt-indicator', 'on');
          delButton.disabled = true;
          const formData = new FormData(formDelete);
          fetch('parameter-store/?q=delete', {
            method: 'POST',
            body: formData
          }).then(response => response.json()).then(data => {
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
              }).then(function() {
                delButton.setAttribute('data-kt-indicator', 'off');
                delButton.disabled = false;
                $('#table-parameter').DataTable().ajax.reload();
                $("#btn_close3").click();
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