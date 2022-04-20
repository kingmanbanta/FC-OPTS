@extends('manage_purchase_request.view_purchase_requestt')

@section('canvass_btn')
<div class="col-lg-12">
    <div class="card">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <a href="{{url('processor/pr_for_canvass/view/generate_canvass', $pr_no=$output[0]['pr_no'])}}">
                            <button type="button" class="btn btn-success">Generate Canvass</button>
                        </a> -->
                        <button type="button" class="btn btn-success" value="Show/Hide" onClick="showHideDiv('divMsg')">Canvass</button>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Canvass</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div id="divMsg" style="display: none;">
            <section class="p-2">
                <form id="canvassForm">
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
                            @foreach($canvass as $canvass_item)
                            <tr>
                                <td>
                                    <center><input type="checkbox" class="custom-control custom-checkbox check" name="checkbox_canvass[]" value="{{$canvass_item['id']}}" /></center>
                                </td>
                                <td class="text-center"><input type="hidden" name="canvass_item[]" value="{{$canvass_item['item_desc']}}" />{{$canvass_item['item_desc']}}</td>
                                <td class="text-center" name="brand[]" value="{{$canvass_item['brand']}}">{{$canvass_item['brand']}}</td>
                                <td class="text-center" name="unit[]" value="{{$canvass_item['unit']}}">{{$canvass_item['unit']}}</td>
                                <td class="text-center" name="price[]" value="{{$canvass_item['price']}}">{{$canvass_item['price']}}</td>
                                <td class="text-center" name="business_name[]" value="{{$canvass_item['business_name']}}">{{$canvass_item['business_name']}}</td>
                            <tr>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Canvass</button>
                    </div>
            </section>
            </form>
        </div>
    </div>
</div>
<script>
    $().ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $('#canvassForm').on('submit', function(e) {
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
            title: 'Send Canvass?',
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
                        type: "POST",
                        url: "send_canvass/" + pr_no,
                        data: $('#canvassForm').serialize(),
                        success: function(response) {

                            if (response.success) {
                                //alert("data updated");
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Canvassed Item for PR has been sent!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    // location.reload();
                                    location.href =
                                        "http://127.0.0.1:8000/processor/pr_for_canvass";
                                }, 1500);
                            }
                        }
                    })
            }

        });
    });
    
})
</script>
@endsection
