@extends('master')
@section('content')

@include('Alerts::sweetalerts')
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

<div >
  <div >
    <div class="row mt">
      <h4><i class="fa fa-angle-right"></i>Hardware Overview</h4>
      <?php
      $totnotebook = DB::table('hardware')->count(); //total hw
      $notebookinuse = DB::table('hardware')->where('hw_status',1)->count(); //notebook in use
      $notepercent = round($notebookinuse/$totnotebook*100);
      ?>
      <!-- TWITTER PANEL -->
      <div class="col-md-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>HARDWARE IN USE</h5>
          </div>
          <canvas id="serverstatus02" height="120" width="120"></canvas>
          <script>
          var notebook = Number('<?php echo $notepercent; ?>');
          var doughnutData = [
            {
              value: notebook,
              color:"#d65f20"
            },
            {
              value : 100-notebook,
              color : "#ffffff"
            }
          ];
          var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
          </script>
          <p>{{$notebookinuse}} <b>Hardware Assigned</b></p>
          <footer>
            <div class="pull-left">
              <h5><i class="fa fa-hdd-o"></i> {{$totnotebook}} Total</h5>
            </div>
            <div class="pull-right">
              <h5>{{$notepercent}}% Assigned</h5>
            </div>
          </footer>
        </div><! -- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <!-- LOG PANEL -->
        <div class="grey-panel pn">
          <div class="grey-header">
            <h5>LAST ACTIVITY BY</h5>
          </div>
          <p><img src="{{ URL::asset('img/amir.jpg') }}" class="img-circle" width="50" height="50"></p>
          <p><b>{{Auth::user()->name}}</b></p>
          <p> At 5:15pm, 26th Jan 2017 </p>
            <div class="row">
              <div class="col-md-6">
                <p class="small mt"><b>ON ASSET</b></p>
                <p>cneg65656</p>
              </div>
              <div class="col-md-6">
                <p class="small mt"><b>ACTION</b></p>
                <p>Recorded asset return</p>
              </div>
            </div>
        </div>

      </div><!-- /col-md-4 -->

      <!-- STATUS OVERVIEW -->
      <div class="col-md-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>ASSET REQUISITIONS ACTIVITY</h5>
          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
          </div>
          <p class="mt"><b>78 Requisitions </b><br/>in the past 11 months</p>
        </div>
      </div><!-- /col-md-4 -->


    </div> <!-- row-mt -->


    <div >
      <h4><i class="fa fa-angle-right"></i>Hardware List</h4>
        <table class="table table-bordered table-striped table-condensed" id="tableA">
          <thead><tr>
            <th> # </th>
            <th>Asset ID</th>
            <th>Serial No.</th>
            <th>Model</th>
            <th>PO No.</th>
            <!-- <th>PO Date</th> -->
            <th>Part No.</th>
            <th>Company</th>
            <th>Price</th>
            <th>Type</th>
            <th>Class</th>
            <th>Status</th>
            <!-- <th>Date Supplied</th>
            <th>Date Transfered to Facility</th> -->
            <th></th>
            <th></th>
            <th></th>
          </tr></thead>
          <tbody>
                @foreach ($allHardware as $hw)
            <tr>
            <td>{{ $hw->id}} </td>
            <td>{{ $hw->hw_assetid }}</td>
            <td>{{ $hw->hw_serialno }}</td>
            <td>{{ $hw->hw_model }}</td>
            <td>{{ $hw->hw_po_no }}</td>
            <!-- @if(($hw->hw_date_po) == '0000-11-30 00:00:00')
            <td></td>
            @else
            <td>{{ $hw->hw_date_po->format('d/m/Y') }}</td>
            @endif -->
            <td>{{ $hw->hw_part_no }}</td>
            <td>{{ $hw->hw_company }}</td>
            <td>RM {{ $hw->hw_price }}</td>
            <td>{{ $hw->hw_type }}</td>
            <td>{{ $hw->hw_class }}</td>
            @if($hw->hw_status == '1')
            <td><span class="badge bg-success">Assigned</span></td>
            @elseif($hw->hw_status == '2')
            <td><span class="badge bg-warning">Faulty</span></td>
            @elseif($hw->hw_status == '3')
            <td><span class="badge">BER</span></td>
            @elseif($hw->hw_status == '4')
            <td><span class="badge bg-important">Stolen</span></td>
            @elseif($hw->hw_status == '5')
            <td><span class="badge bg-inverse">Missing</span></td>
            @elseif($hw->hw_status == '6')
            <td><span class="badge bg-primary">MAF</span></td>
            @else
            <td><span class="badge bg-info">Available</span></td>
            @endif
            <!-- <td>{{ $hw->hw_datesupp }}</td>
            <td>{{ $hw->hw_datefac }}</td> -->
           <td><a href="{{action('RecordController@show', $hw->id)}}" class="btn btn-theme"><i class="fa fa-info"></i> Info</a></td>
           <td><a href="{{action('HardwareController@edit', $hw->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td>
             {!! Form::open(['method' => 'DELETE','id'=>'deleteform','route' => ['hardware.destroy', $hw->id]]) !!}
             {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'id' =>'delete']) !!}
             {!! Form::close() !!}
             <!-- <form "{{action('HardwareController@destroy', $hw->id)}}" method = "DELETE" id="deleteform"> -->

           </td>
          </tr>  @endforeach
       </tbody>
          </table>
      </div><!-- /content-panel -->
   </div><!-- /col-lg-4 -->
</div><!-- /row -->
<script src="{{URL::asset('js/jquery.sparkline.js')}}"></script>
<script src="{{URL::asset('js/sparkline-chart.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<!-- script for morris donut -->
<?php $totavailable = DB::table('hardware')->where('hw_status',0)->count();
      $totassigned = DB::table('hardware')->where('hw_status',1)->count();
      $totber = DB::table('hardware')->where('hw_status',3)->count();
      $totstolen = DB::table('hardware')->where('hw_status',4)->count();
      $totmissing = DB::table('hardware')->where('hw_status',5)->count();?>
<script>
var available = Number('<?php echo $totavailable; ?>');
var assigned = Number('<?php echo $totassigned; ?>');
var ber = Number('<?php echo $totber; ?>');
var stolen = Number('<?php echo $totstolen; ?>');
var missing = Number('<?php echo $totmissing; ?>');

Morris.Donut({
  element: 'donut-example',
  data: [
    {label: "Available", value: available},
    {label: "Assigned", value: assigned},
    {label: "BER", value: ber},
    {label: "Stolen", value: stolen},
    {label: "Missing", value: missing}
  ],
  colors: [
  '#2bc4ba', // turqoise
  '#aae88f', // hijau
  '#d65f20', //kuning
  '#cc2610', //merah
  '#121c84' // biru gelap
]
});
</script>

@stop
