<script type="text/javascript">
  $().ready(function() {
    $('.deletebtn').on('click', function(e) {
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);
      e.preventDefault();
      var id = $("#delete_id").val();
      //alert(id);
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var data = {
            "_token": $('input[name=_token]').val(),
            "id": id,
          };
          $.ajax({
            type: "DELETE",
            url: "manageAccount/delete/" + id,
            data: data,
            success: function(response) {
              console.log(response);
              Swal.fire({
              icon: 'success',
              title: 'Data Have been deleted!',
              showConfirmButton: false,
              timer: 3500
            });
            }
          });
          setTimeout(function() {
              location.reload();
            }, 3000);
        }
      });
    });
  });
</script>