@extends('manage_purchase_request.view_purchase_requestt')

@section('canvass')
<div class="col-lg-12">
<div class="card">
<section class="p-2">
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Unit/Size</th>
            <th>price</th>
            <th>Item Desc</th>
            <th>Supplier</th>
        </tr>
    </thead>
    </tr>
    <tbody>
        @if(!empty($output))
        @foreach($output as $outputs)
        <tr>
            <td class="pr_unit">{{$outputs['unit']}}</td>
            <td class="pr_itemdesc">{{$outputs['price']}}</td>
            <td class="pr_itemdesc">{{$outputs['item_desc']}}</td>
            <td class="pr_itemdesc">{{$outputs['business_name']}}</td>
        <tr>
        </tr>
        @endforeach
        @endif
        </tr>
    </tbody>
    <tfoot>
    </tfoot>
</table>
</section>
</div>
</div>
@endsection