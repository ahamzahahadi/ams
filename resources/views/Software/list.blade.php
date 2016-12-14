@extends('master')
@section('content')
@include('Alerts::sweetalerts')
<h4><i class="fa fa-angle-right"></i>Software List</h4>
  <table class="table table-bordered table-striped table-condensed" id="tableA">
    <thead>
      <tr><th>#</th>
          <th>Asset ID</th>
          <th>Serial Number</th>
          <th>PO Number</th>
          <th>Software Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Product Key</th>
          <th>Supplier</th>
          <th>Status</th>
          <th></th>
          <th></th>
          <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($swList as $sw)
      <tr><td> {{ $sw->id}} </td>
          <td> {{ $sw->sw_assetid}} </td>
          <td> {{ $sw->sw_serialno}} </td>
          <td> {{ $sw->sw_po_no}} </td>
          <td> {{ $sw->sw_model}} </td>
          <td> {{ $sw->sw_type}} </td>
          <td> RM {{ $sw->sw_price}} </td>
          <td> {{ $sw->sw_prodkey}} </td>
          <td>{{ DB::table('supplier')->where('id',$sw->sw_supplier)->value('supp_name')}}</td>
          @if($sw->sw_status == '1')
          <td><span class="badge bg-warning">In Use</span></td>
          @else
          <td><span class="badge bg-info">Available</span></td>
          @endif
          <td><a href="{{action('SwRecordController@show', $sw->id)}}" class="btn btn-theme"><i class="fa fa-info"></i> Info</button></a></td>
          <td><a href="{{action('SoftwareController@edit', $sw->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td>
            {!! Form::open(['method' => 'DELETE','route' => ['software.destroy', $sw->id]]) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
