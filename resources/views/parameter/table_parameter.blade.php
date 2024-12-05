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
              @if($access_user['create']) {
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