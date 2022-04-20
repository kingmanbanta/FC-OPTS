@extends('adminltelayout.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Verify PR!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Verify Purchase Request</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($pr as $pr_for_verify)
                                <input type="hidden" id="pr_id" name="pr_id" />
                                <td class="pr_no_for_canvass">{{$pr_for_verify->pr_no}}</td>
                                <td class="pr_type">{{$pr_for_verify->type}}</td>
                                <td class="pr_purpose">{{$pr_for_verify->purpose}}</td>
                                <td class="pr_remark">{{$pr_for_verify->remarks}}</td>
                                <td class="pr_remark">{{$pr_for_verify->action}}</td>
                                <td>
                                    <a href="{{route('pr_verify',$pr_no = $pr_for_verify->pr_no )}}" class="btn btn-danger btn-block btn-sm view_btn"><i class="fa fa-eye"></i>View</a>
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
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Verified PR!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <!-- <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Verify Purchase Request</li>
                </ol> -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Purchase Number</th>
                                <th>Type</th>
                                <th>Purpose</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($verified_pr as $verified)
                                <input type="hidden" id="pr_id" name="pr_id" />
                                <td class="pr_no_for_canvass">{{$verified->pr_no}}</td>
                                <td class="pr_type">{{$verified->type}}</td>
                                <td class="pr_purpose">{{$verified->purpose}}</td>
                                <td class="pr_remark">{{$verified->remarks}}</td>
                                <td class="pr_remark">{{$verified->action}}</td>
                                <td>
                                    <a href="{{route('update_verified',$pr_no = $verified->pr_no )}}" class="btn btn-danger btn-block btn-sm view_btn"><i class="fa fa-eye"></i>View</a>
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


<script>
    $(document).ready(function() {
        $("#tbl_pr").DataTable({});

    });
    $(document).ready(function() {
        $("#table2").DataTable({});

    });
</script>
@endsection