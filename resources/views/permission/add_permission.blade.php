<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add New Permission</h1>
                <button id="btn_close1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_form" class="form" action="#" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="fv-row mb-10">
                        <label for="parenttxt" class="required form-label">Parent</label>
                        <select id="parenttxt" name="parenttxt" class="form-control form-control-solid" required="">
                            <option value=""></option>
                            <option value="0">parent</option>
                            @foreach($user_groups as $dt_grup)
                            <option value="{{ $dt_grup->id; }}">{{ $dt_grup->name; }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="nametxt" class="required form-label">Name</label>
                        <input id="nametxt" name="nametxt" type="text" class="form-control form-control-solid" required=""/>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="descriptontxt" class="required form-label">Description</label>
                        <textarea id="descriptontxt" name="descriptontxt" class="form-control form-control-solid" required=""></textarea>
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
      parenttxt: {
        validators: {
          notEmpty: {
            message: 'The Parent is required'
          }
        }
      },
      nametxt: {
        validators: {
          notEmpty: {
            message: 'The Name is required'
          }
        }
      },
      descriptontxt: {
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
  submitButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (validator) {
      validator.validate().then(function(status) {
        if (status == 'Valid') {
          submitButton.setAttribute('data-kt-indicator', 'on');
          submitButton.disabled = true;
          const formData = new FormData(form);
          fetch('permission-store/?q=add', {
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
                $('#table-permission').DataTable().ajax.reload();
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
@endpush