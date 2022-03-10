<!-- Modal-->

<div id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Building</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <form id="addSupplierForm">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" placeholder="Business Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="business_name-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="contact_person-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_no" class="form-control" placeholder="Contact Number">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="contact_no-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="email-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Business Address</label>
            <input type="text" name="business_add" class="form-control" placeholder="Business Address">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="business_add-error"></strong>
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
    $('#addSupplierForm').on('submit', function(e) {

      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "suppliersave/",
        data: $('#addSupplierForm').serialize(),
        success: function(data) {
          console.log(data);
          if (data.errors) {
            if (data.errors.business_name) {
              $('#business_name-error').html(data.errors.business_name[0]);
            }
            if (data.errors.contact_person) {
              $('#contact_person-error').html(data.errors.contact_person[0]);
            }
            if (data.errors.contact_no) {
              $('#contact_no-error').html(data.errors.contact_no[0]);
            }
            if (data.errors.email) {
              $('#email-error').html(data.errors.email[0]);
            }
            if (data.errors.business_add) {
              $('#business_add-error').html(data.errors.business_add[0]);
            }
          }
          if (data.success) {
            $('#addSupplier').modal('hide');
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