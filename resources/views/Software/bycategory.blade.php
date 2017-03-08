@extends('master')
@section('content')
@include('Alerts::sweetalerts')

<div class="row mt">
  <h4><i class="fa fa-angle-right"></i>{{$category}} Overview</h4>
  <!-- SERVER STATUS PANELS -->
  <?php
    $totalsw = DB::table('software')->where('sw_type',$category)->count();
    $inuse = DB::table('software')->where('sw_type',$category)->where('sw_status',1)->count(); //sw in use
    $usagepercent = round($inuse/$totalsw*100);
  ?>
  <div class="col-md-4 col-sm-4 mb">
    <div class="grey-panel pn donut-chart">
      <div class="grey-header">
        <h5>{{$category}} In Use</h5>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xs-6 goleft">
        </div>
      </div>
      <canvas id="serverstatus01" height="120" width="120"></canvas>
      <script>
      var software = Number('<?php echo $usagepercent; ?>');
      var doughnutData = [
        {
          value: software,
          color:"#FF6B6B"
        },
        {
          value : 100-software,
          color : "#fdfdfd"
        }
      ];
      var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
      </script>
      <div class="row">
        <div class="col-sm-6 col-xs-6 goleft">
          <p>Total<br/>installed:</p>
        </div>
         <div class="col-sm-6 col-xs-6">
          <h2>{{$usagepercent}}%</h2>
         </div>
      </div>
    </div><! --/grey-panel -->
  </div><!-- /col-md-4-->


   <div class="col-md-4 col-sm-4 mb">
     <div class="steps pn">
       <input type='submit' value='{{$category}} Summary'/>
       <label>In Use : {{$inuse}}</label>
       <label>Unassigned : {{$totalsw - $inuse}}</label>
       <label>Total {{$category}}: {{$totalsw}}</label>
     </div>
  </div><!-- /col-md-4 -->

  <div class="col-md-4 col-sm-4 mb">

  </div><! -- /col-md-4 -->


</div><!-- PENUTUP ROW PANEL SERVER/TOP PRODUCT/TOP USER -->
<h4><i class="fa fa-angle-right"></i>{{$category}} List</h4>
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
      @foreach($catsoftware as $sw)
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
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'onclick' =>"return confirm('You will not be able to recover this record, are you sure?')"]) !!}
            {!! Form::close() !!} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
