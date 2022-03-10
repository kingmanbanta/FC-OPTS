@extends('adminltelayout.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Make Requisistion!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Purchase Request</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-success" data-toggle="modal" data-target="#addPurchaseRequest">
                <span class="spinner-grow spinner-grow-sm"></span>
                <b>Make Requisition</b>
            </button>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tbl_pr" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Purchase Number</th>
                                <th>Type</th>
                                <th>Purpose</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($purchaserequest as $purchase_requests)
                                <input type="hidden" id="pr_id" name="pr_id" />
                                <td class="pr_pr_no">{{$purchase_requests->pr_no}}</td>
                                <td class="pr_type">{{$purchase_requests->type}}</td>
                                <td class="pr_purpose">{{$purchase_requests->purpose}}</td>
                                <td class="pr_remark">{{$purchase_requests->remarks}}</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-block btn-sm view_btn"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('manage_purchase_request.add_purchase_request')
@include('manage_purchase_request.view_purchase_request')


<script>
    $(document).ready(function() {
        $("#tbl_pr").DataTable({});

    });
</script>
@endsection