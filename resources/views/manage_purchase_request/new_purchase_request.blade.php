@extends('adminltelayout.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Purchase Request!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">New Purchase Request</li>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($pr as $new_pr)
                                <input type="hidden" id="pr_id" name="pr_id" />
                                <td class="pr_no_for_canvass">{{$new_pr->pr_no}}</td>
                                <td class="pr_type">{{$new_pr->type}}</td>
                                <td class="pr_purpose">{{$new_pr->purpose}}</td>
                                <td class="pr_remark">{{$new_pr->remarks}}</td>
                                <td>
                                <a href="{{route('view_new_pr',$pr_no = $new_pr->pr_no )}}" class="btn btn-danger btn-block btn-sm view_btn"><i class="fa fa-eye"></i>View</a>
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
</script>
@endsection