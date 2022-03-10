<!-- Modal-->

<div id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">View Account</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="userform">
          {{csrf_field()}}
          <input type="hidden" id="view_id" name="view_id" />

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="view_name" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="view_email" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label for="urole">Roles:</label>
            <input id="view_role" type="text" class="form-control " name="role" readonly>
          </div>


          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $().ready(function() {
    $('.viewbtn').on('click', function() {
      $('#userViewModal').modal('show');
      let $row = $(this).closest("tr");
      let $text = $row.find(".class_id").text();
      $("#view_id").val($text);
      $text = $row.find(".class_name").text();
      $("#view_name").val($text);
      $text = $row.find(".class_email").text();
      $("#view_email").val($text);
      $text = $row.find(".class_role").text();
      $("#view_role").val($text);


      console.log($text);


    });
  });
</script>