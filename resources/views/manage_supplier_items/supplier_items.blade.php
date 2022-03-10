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
                <th>Item #</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Supplier Business Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($item as $items)
                <input type="hidden" id="delete_item" name="delete_item" />
                <td class="dept_id">{{$items->id}}</td>
                <td class="item_desc">{{$items->item_desc}}</td>
                <td class="item_brand">{{$items->brand}}</td>
                <td class="item_unit">{{$items->unit}}</td>
                <td class="item_price">{{$items->price}}</td>
                <td class="supp_name">{{$items->supplier->business_name}}</td>
                <td>
                  <!-- <a href="#" class="btn btn-secondary btn-sm info_btn"><i class="fa fa-info"></i></a> -->
                  <a href="#" class="btn btn-primary btn-sm edit_btn"><i class="fa fa-edit"></i></a>
                  <a href="#" class="btn btn-danger btn-sm delete_itembtn"><i class="fa fa-trash"></i></a>
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
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <a href="" data-toggle="modal" data-target="#addSupplier" class="btn btn-success">
        <i class="fa fa-plus">Supplier</i>
      </a>
    </div>
    <div class="row">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Business Name</th>
                <th>Contact Person</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Business Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($supplier as $suppliers)
                <input type="hidden" id="delete_supplier_id" name="delete_supplier_id" />
                <td class="dept_id">{{$suppliers->id}}</td>
                <td class="build_name">{{$suppliers->business_name}}</td>
                <td class="build_name">{{$suppliers->contact_person}}</td>
                <td class="build_name">{{$suppliers->contact_no}}</td>
                <td class="build_name">{{$suppliers->email}}</td>
                <td class="build_add">{{$suppliers->business_add}}</td>

                <td>
                  <!-- <a href="#" class="btn btn-secondary btn-sm build_info_btn"><i class="fa fa-info"></i></a> -->
                  <a href="#" class="btn btn-primary btn-sm build_edit_btn"><i class="fa fa-edit"></i></a>
                  <a href="#" class="btn btn-danger btn-sm delete_supplierbtn"><i class="fa fa-trash"></i></a>
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
@include('manage_supplier_items.add_supplier')
@include('manage_supplier_items.add_item')
@include('manage_supplier_items.update_supplier')
@include('manage_supplier_items.update_item')
@include('manage_supplier_items.delete_supplier')
@include('manage_supplier_items.delete_item')

<script>
  $(document).ready(function() {
    $("#example1").DataTable({
    });
    
  });
  $(document).ready(function() {
    $("#example2").DataTable({})
  });
</script>
@endsection