@extends('adminltelayout.layout')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Acounts!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Accounts</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4></h4>
            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success">
                <i class="fa fa-user-plus">Create User</i>
            </a>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="table">
                    <table id="example2" class="table table-striped table-bordered">
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
@include('admin.manage_account.create')
@include('admin.manage_account.view')
@include('admin.manage_account.update')
@include('admin.manage_account.delete')
@endsection
<script>
  $(document).ready(function() {
    $("#example2").DataTable({})
  });
</script>