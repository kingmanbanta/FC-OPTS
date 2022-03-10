<!-- Modal-->

<div id="update_SupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Supplier</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="update_SupplierForm">
          {{csrf_field()}}
          {{method_field('PUT')}}
          <div class="form-group">
            <input type="hidden" id="build_edit_id" name="build_edit_id" class="form-control" />
          </div>
          <div class="form-group">
            <label>Business Name</label>
            <input type="text" name="up_business_name" id="up_business_name" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="up_business_name-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="up_contact_person" id="up_contact_person" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="up_contact_person-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="up_contact_no" id="up_contact_no" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="up_contact_no-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="up_email" id="up_email" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="up_email-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Business Address</label>
            <input type="text" name="up_business_add" id="up_business_add" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="up_business_add-error"></strong>
            </span>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-primary ">Save changes</button>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $().ready(function() {
    $('.build_edit_btn').on('click', function() {
      $('#update_SupplierModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#build_edit_id').val(data[0]);
      $('#up_business_name').val(data[1]);
      $('#up_contact_person').val(data[2]);
      $('#up_contact_no').val(data[3]);
      $('#up_email').val(data[4]);
      $('#up_business_add').val(data[5]);
    });
  });
</script>

<script type="text/javascript">
  $().ready(function() {
    $('#update_SupplierForm').on('submit', function(e) {

      e.preventDefault();
      var id = $("#build_edit_id").val();
    
          //$('#logout-form').submit() // this submits the form 
          $.ajax({
            type: "PATCH",
            url: "supplier/update/" + id,
            data: $('#update_SupplierForm').serialize(),
            success: function(response) {
              console.log(response);
              if (response.errors) {
                if (response.errors.up_business_name) {
                  $('#up_business_name-error').html(response.errors.up_business_name[0]);
                }
                if (response.errors.up_contact_person) {
                  $('#up_contact_person-error').html(response.errors.up_contact_person[0]);
                }
                if (response.errors.up_contact_no) {
                  $('#up_contact_no-error').html(response.errors.up_contact_no[0]);
                }
                if (response.errors.up_email) {
                  $('#up_email-error').html(response.errors.up_email[0]);
                }
                if (response.errors.up_business_add) {
                  $('#up_business_add-error').html(response.errors.up_business_add[0]);
                }
              }
              if (response.success) {
                $('#update_SupplierModal').modal('hide');
                //alert("data updated");
                Swal.fire({
                  icon: 'success',
                  title: 'Data Have been updated!',
                  showConfirmButton: false,
                  timer: 3500
                });
                setTimeout(function() {
                  location.reload();
                }, 3000);
              }
            }
          });

    });
  });
</script>