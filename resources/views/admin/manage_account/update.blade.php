<!-- Modal-->

<div id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Edit Account</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          {{csrf_field()}}
          {{method_field('PUT')}}
          <div class="form-group">
            <input type="hidden" id="uid" name="uid" class="form-control" />
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="text-danger">
              <strong id="uname-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="text-danger">
              <strong id="uemail-error"></strong>
            </span>
          </div>
          <!-- <div class="form-group">
            <label>new-Password</label>
            <input type="password" name="newpassword" id="newpassword" class="form-control">
          </div> -->
          <div class="form-group">
            <label for="urole">Update Role:</label>
            <select id="urole_id" name="urole_id" class="form-control">
              <option value="" disabled selected>Select Role</option>
              @foreach($roles as $role)
              <option value="{{$role->id}}">{{$role->display_name}}</option>
              @endforeach
            </select>
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
    $('.editbtn').on('click', function() {
      $('#userEditModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#uid').val(data[0]);
      $('#name').val(data[1]);
      $('#email').val(data[2]);
      $('#urole').val(data[4]);
    });
  });
</script>

<script type="text/javascript">
  $().ready(function() {
    $('#editForm').on('submit', function(e) {

      e.preventDefault();
      var id = $("#uid").val();

      $.ajax({
        type: "PATCH",
        url: "manageAccount/update/" + id,
        data: $('#editForm').serialize(),
        success: function(response) {
          console.log(response);
          if (response.errors) {
            if (response.errors.name) {
              $('#uname-error').html(response.errors.name[0]);
            }
            if (response.errors.email) {
              $('#uemail-error').html(response.errors.email[0]);
            }
          }

          if (response.success) {
            // Swal.fire({
            //   title: 'Do you want to save the changes?',
            //   showDenyButton: true,
            //   showCancelButton: true,
            //   confirmButtonText: 'Yes!',
            //   denyButtonText: `Don't!`,
            // }).then((result) => {
            //   if (result.value === true) {
            $('#userEditModal').modal('hide');
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
        //     });

        //   } else{

        //   }
        }
      })
          
    });
  });
</script>