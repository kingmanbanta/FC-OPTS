@extends('adminltelayout.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">View Pr</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Purchase Request</li>
                    <li class="breadcrumb-item active">View Purchase Request</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="forbes-logo-col" style="width:100%; height:auto">
            <section class="mt-5 pl-4">
                @if(!empty($output[0]['action']))
                <span class="badge badge-danger" style="font-size: 20px; float:right;">{{ $output[0]['action'] }}</span>
                @endif
                <div class="row d-flex">
                    <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                            <div class="mx-auto" style="width: 140px;">
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;"> <img src="{{ asset('dist/img/forbeslogo.png')}}" alt="person" class="img-fluid "> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                <br>
                                <h4 class="pt-sm-2 pb-0 mb-0 text-nowrap">Forbes College Inc.</h4>
                                <p class="mb-0">E. Aquende Bldg. III Rizal cor. Elizondo Sts. Legazpi City</p>
                                <div class="text-muted"><small>4500, Philippines</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <form id="viewPRForm">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <section class="p-2">
                    <span class="badge badge-success" style="font-size: 20px;">Purchase Requisiton Form</span>
                    <div class="custom-control custom-checkbox">
                        @if(!empty($output[0]['Building_name']))
                        <input type="checkbox" class="custom-control-input" checked>
                        <label class="custom-control-label" for="building">{{ $output[0]['Building_name'] }}
                            @endif
                    </div>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    Type of Requisition:
                                    <!-- Default inline 1-->
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if(!empty($output[0]['type']))
                                        <input type="radio" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="type_of_req1">{{$output[0]['type']}}</labe>
                                            @endif

                                    </div>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <span class="text-danger">
                                        <strong id="type_of_req-error"></strong>
                                    </span>
                                </td>
                                <td>
                                    PR number:
                                    @if(!empty($output[0]['pr_no']))
                                    <input type="hidden" id="pr_no" name="pr_no" value="{{ $output[0]['pr_no'] }}">
                                    <label class="" for="pr_no">{{ $output[0]['pr_no'] }}</label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Requesting Department:
                                    @if(!empty($output[0]['department_id']))
                                    <input type="hidden" class="form-group">
                                    <span style="font-size: 18px;">{{$output[0]['Dept_name']}}</span>
                                    @endif
                                </td>
                                <td>
                                    Date:
                                    @if(!empty($outputs[0]['created_at']))
                                    <span>{{date('Y-m-d H:i:s' ,strtotime($outputs[0]['created_at']))}}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea2">Purpose of Requisition</label>
                                        @if(!empty($output[0]['purpose']))
                                        <textarea class="form-control rounded-0" rows="3" readonly>{{$output[0]['purpose']}}</textarea>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Beggining</th>
                                <th>Ending</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Item Desc</th>
                            </tr>
                        </thead>
                        </tr>
                        <tbody>
                            <tr>
                                @if(!empty($output))
                                @foreach($output as $outputs)
                                <td class="pr_beggining">{{$outputs['beggining']}}</td>
                                <td class="pr_ending">{{$outputs['ending']}}</td>
                                <td class="pr_unit">{{$outputs['unit']}}</td>
                                <td class="pr_quantity">{{$outputs['quantity']}}</td>
                                <td class="pr_itemdesc">{{$outputs['item_desc']}}</td>
                            <tr>
                            </tr>
                            @endforeach
                            @endif
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="request_bottom" colspan="5">
                                    <p>*****nothing follows*****</p>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="request_bottom" colspan="5">
                                    <p>Last request:</p>
                                </td>
                            </tr> -->
                        </tfoot>
                    </table>
                    <!-- @if(Auth::user()->hasRole('Approver'))
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit for Canvass</button>
                    </div>
                    @endif -->
                </section>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $().ready(function() {
        $('.generate_canvass').on('click', function() {

            pr_no = jQuery('#pr_no').val(),
                console.log(pr_no);

            $.ajax({
                type: "GET",
                url: "generate_canvass/" + pr_no,
            })

        });

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
                            url: "verify_pr/" + pr_no,
                            data: $('#viewPRForm').serialize(),
                            success: function(response) {

                                if (response.success) {
                                    //alert("data updated");
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'PR has been sent',
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
    $('#canvassForm').on('submit', function(e) {
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
                                    title: 'PR has been sent',
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
</script>
@endsection