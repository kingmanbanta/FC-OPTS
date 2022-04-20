@extends('manage_purchase_request.view_purchase_requestt')

@section('verification_btn')
<div class="col-lg-12">
    <div class="card">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <span class="badge badge-danger" style="font-size: 20px;">Select Supplier and Item</span>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Canvass</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="p-2">
            <form id="selectSupplierForm">
                {{csrf_field()}}
                {{method_field('POST')}}
                <table id="example1" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Select</th>
                            <th class="text-center">Item Desc</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Unit/Size</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Supplier</th>
                        </tr>
                    </thead>
                    </tr>
                    <tbody>
                        @foreach($canvass_output as $canvassed_item)
                        <tr>
                            <td>
                                <center><input type="checkbox" class="custom-control custom-checkbox check" id="checkbox_canvass" name="checkbox_canvass[]" value="{{$canvassed_item['id']}}" /></center>
                            </td>
                            <td class="text-center" name="item_desc[]" value="{{$canvassed_item['item_desc']}}">{{$canvassed_item['item_desc']}}</td>
                            <td class="text-center" name="brand[]" value="{{$canvassed_item['brand']}}">{{$canvassed_item['brand']}}</td>
                            <td class="text-center" name="unit[]" value="{{$canvassed_item['unit']}}">{{$canvassed_item['unit']}}</td>
                            <td class="text-center" name="price[]" value="{{$canvassed_item['price']}}">{{$canvassed_item['price']}}</td>
                            <td class="text-center" name="business_name[]" value="{{$canvassed_item['business_name']}}">{{$canvassed_item['business_name']}}</td>
                        <tr>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
        </section>
        </form>
    </div>
</div>



<script type="text/javascript">
    $().ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#selectSupplierForm').on('submit', function(e) {
            if ($('.check').filter(':checked').length < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Select Atleast One!',
                })
                return false;
            }
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    pr_no = jQuery('#pr_no').val(),
                        $.ajax({
                            type: "PATCH",
                            url: "verify_pr/" + pr_no,
                            data: $('#selectSupplierForm').serialize(),
                            success: function(response) {

                                if (response.success) {
                                    //alert("data updated");
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'PR has been Verified!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(function() {
                                        // location.reload();
                                        location.href =
                                            "http://127.0.0.1:8000/approver/pr_for_verification";
                                    }, 1500);
                                }
                            }
                        })
                }

            });
        });
    });

    $(document).ready(function() {
        $("#example1").DataTable({});

    });
</script>
@endsection