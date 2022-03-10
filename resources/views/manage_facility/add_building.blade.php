<!-- Modal-->

<div id="addBuilding" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Building</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <form id="addBuildingForm">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group">
            <label>Building Name</label>
            <input type="text" name="build_name" class="form-control" placeholder="Building Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="build_name-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="address-error"></strong>
            </span>
          </div>

          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $().ready(function() {
    $('#addBuildingForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "buildingsave/",
        data: $('#addBuildingForm').serialize(),
        success: function(data) {
          console.log(data);
          if (data.errors) {
            if (data.errors.build_name) {
              $('#build_name-error').html(data.errors.build_name[0]);
            }
            if (data.errors.address) {
              $('#address-error').html(data.errors.address[0]);
            }
          }
          if (data.success) {
            $('#addBuilding').modal('hide');
            //alert("data updated");
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 3500
            });
            setTimeout(function() {
              location.reload();
            }, 3000);
          }
        },

      });
    });
  });
</script>