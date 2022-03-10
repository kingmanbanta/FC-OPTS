@extends('adminltelayout.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Supplier & Item!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Supplier & Items</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <a href="" data-toggle="modal" data-target="#addItem" class="btn btn-success">
                <i class="fa fa-plus">Item</i>
            </a>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($users as $users)
                                <input type="hidden" id="delete_id" name="delete_id" />
                                <td class="class_id">{{$users->id}}</td>
                                <td class="class_name">{{$users->name}}</td>
                                <td class="class_email">{{$users->email}}</td>
                                <td style="display:none" class="class_password">{{$users->password}}</td>
                                @foreach($users->roles as $role)
                                <td class="class_role">{{$role->display_name}}</td>
                                @endforeach
                                <td>
                                    <a href="#" class="btn btn-secondary btn-sm viewbtn"><i class="fa fa-info"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm editbtn"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm deletebtn"><i class="fa fa-trash"></i></a>
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
        $("#example1").DataTable({})
    });
</script>
@endsection