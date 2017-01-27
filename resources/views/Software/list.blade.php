@extends('master')
@section('content')
@include('Alerts::sweetalerts')

<div class="row mt">
  <h4><i class="fa fa-angle-right"></i>Software Overview</h4>
  <!-- SERVER STATUS PANELS -->
  <div class="col-md-4 col-sm-4 mb">
    <div class="white-panel pn donut-chart">
      <div class="white-header">
        <h5>SERVER LOAD</h5>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xs-6 goleft">
          <p><i class="fa fa-database"></i> 70%</p>
        </div>
      </div>
      <canvas id="serverstatus01" height="120" width="120"></canvas>
      <script>
      var doughnutData = [
        {
          value: 70,
          color:"#68dff0"
        },
        {
          value : 30,
          color : "#fdfdfd"
        }
      ];
      var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
      </script>
    </div><! --/grey-panel -->
  </div><!-- /col-md-4-->


  <div class="col-md-4 col-sm-4 mb">
    <div class="white-panel pn">
      <div class="white-header">
        <h5>TOP PRODUCT</h5>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xs-6 goleft">
          <p><i class="fa fa-heart"></i> 122</p>
        </div>
        <div class="col-sm-6 col-xs-6"></div>
      </div>
      <div class="centered">
        <img src="assets/img/product.png" width="120">
      </div>
    </div>
  </div><!-- /col-md-4 -->

  <div class="col-md-4 mb">
    <!-- WHITE PANEL - TOP USER -->
    <div class="white-panel pn">
      <div class="white-header">
        <h5>TOP USER</h5>
      </div>
      <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
      <p><b>Zac Snider</b></p>
      <div class="row">
        <div class="col-md-6">
          <p class="small mt">MEMBER SINCE</p>
          <p>2012</p>
        </div>
        <div class="col-md-6">
          <p class="small mt">TOTAL SPEND</p>
          <p>$ 47,60</p>
        </div>
      </div>
    </div>
  </div><!-- /col-md-4 -->


</div><!-- PENUTUP ROW PANEL SERVER/TOP PRODUCT/TOP USER -->
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
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'onclick' =>"return confirm('You will not be able to recover this record, are you sure?')"]) !!}
            {!! Form::close() !!} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
