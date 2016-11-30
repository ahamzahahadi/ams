@extends('master')

@section('content')

<h4><i class="fa fa-angle-right"></i>Software List</h4>
  <table class="table table-bordered table-striped table-condensed" id="tableA">
    <thead>
      <tr><th>#</th>
          <th>Asset ID</th>
          <th>Serial Number</th>
          <th>PO Number</th>
          <th>PO Date</th>
          <th>Software Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Product Key</th>
          <th>Supplier</th>
          <th>Date Supplied</th>
          <th>Date Transfered to Facility</th>
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
          <td> {{ $sw->sw_date_po}} </td>
          <td> {{ $sw->sw_model}} </td>
          <td> {{ $sw->sw_type}} </td>
          <td> RM {{ $sw->sw_price}} </td>
          <td> {{ $sw->sw_prodkey}} </td>
          <td>{{ DB::table('supplier')->where('id',$sw->sw_supplier)->value('supp_name')}}</td>
          <td> {{ $sw->sw_datesupp}} </td>
          <td> {{ $sw->sw_datefac}} </td>
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
