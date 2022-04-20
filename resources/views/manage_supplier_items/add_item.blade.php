<!-- Modal-->

<div id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Item</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <form id="addItemForm">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group">
            <label>Item Description</label>
            <input type="text" name="item_desc" class="form-control" placeholder="Item Description">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="item_desc-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Brand</label>
            <input type="text" name="brand" class="form-control" placeholder="Brand">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="brand-error"></strong>
            </span>

          </div>
          <div class="form-group">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" placeholder="Unit">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="unit-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">
              <strong id="price-error"></strong>
            </span>
          </div>
          <div class="form-group">
            <label for="supplier_id">Supplier Name</label>
            <select name="supplier_id" class="form-control">
              <option value="" disabled selected>Select Supplier</option>
              @foreach($supplier as $suppliers)
              <option value="{{$suppliers->id}}">{{$suppliers->business_name}}</option>
              @endforeach
            </select>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="text-danger">
              <strong id="supplier_id-error"></strong>
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
    $('#addItemForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "itemsave/",
        data: $('#addItemForm').serialize(),
        success: function(data) {
          console.log(data);
          if (data.errors) {
            if (data.errors.item_desc) {
              $('#item_desc-error').html(data.errors.item_desc[0]);
            }
            if (data.errors.brand) {
              $('#brand-error').html(data.errors.brand[0]);
            }
            if (data.errors.unit) {
              $('#unit-error').html(data.errors.unit[0]);
            }
            if (data.errors.price) {
              $('#price-error').html(data.errors.price[0]);
            }
            if (data.errors.supplier_id) {
              $('#supplier_id-error').html(data.errors.supplier_id[0]);
            }
          }
          if (data.success) {
            $('#addItem').modal('hide');
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