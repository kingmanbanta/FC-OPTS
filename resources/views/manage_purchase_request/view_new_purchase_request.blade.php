@extends('manage_purchase_request.view_purchase_requestt')

@section('verify_item_btn')
<!-- <div class="col-lg-12">
    <div class="card">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success" value="Show/Hide" onClick="showHideDiv('divMsg')">Check Item</button>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Check Item Description</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div id="divMsg" style="display: none;">
            <section class="p-2">
                <form id="viewPRForm">
                    {{csrf_field()}}
                    {{method_field('POST')}}
                    <table id="example" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Select</th>
                                <th class="text-center">Item Desc</th>
                            </tr>
                        </thead>
                        </tr>
                        <tbody>
                            @foreach($item_outputs as $item)
                            <tr>
                                <td>
                                    <center><input type="checkbox" class="custom-control custom-checkbox check" name="item_id[]" value="{{$item['id']}}" /></center>
                                </td>
                                <td class="text-center"><input type="hidden" name="item[]" value="{{$item['item_desc']}}" />{{$item['item_desc']}}</td>                            <tr>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table> -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Canvass</button>
                    </div>
            <!-- </section>
            </form>
        </div>
    </div>
</div> -->

<script type="text/javascript">
    $().ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#viewPRForm').on('submit', function(e) {
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
                            url: "update_new_pr/" + pr_no,
                            data: $('#viewPRForm').serialize(),
                            success: function(response) {

                                if (response.success) {
                                    //alert("data updated");
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'PR has been sent for Canvass!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(function() {
                                        // location.reload();
                                        location.href =
                                            "http://127.0.0.1:8000/approver/new_pr";
                                    }, 1500);
                                }
                            }
                        })
                }

            });
        });
    });

    function showHideDiv(ele) {
        var srcElement = document.getElementById(ele);
        if (srcElement != null) {
            if (srcElement.style.display == "block") {
                srcElement.style.display = 'none';
            } else {
                srcElement.style.display = 'block';
            }
            return false;
        }
    }

    $(document).ready(function() {
        $("#example1").DataTable({})

    });
</script>
@endsection