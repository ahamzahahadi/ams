@extends('master')
@section('content')

@include('Alerts::sweetalerts')
<div >
  <div >
    <div class="row mt">
      <h4><i class="fa fa-angle-right"></i>Hardware Overview</h4>
      <?php
      $totnotebook = DB::table('hardware')->where('hw_type','Notebook')->count(); //total notebook
      $notebookinuse = DB::table('hardware')->where('hw_type','Notebook')->where('hw_status',1)->count(); //notebook in use
      $notepercent = round($notebookinuse/$totnotebook*100);
      ?>
      <!-- TWITTER PANEL -->
      <div class="col-md-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>NOTEBOOK IN USE</h5>
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
          <p>{{$totnotebook - $notebookinuse}} Available / {{$notebookinuse}} In Use</p>
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

      <div class="col-md-4 mb">
        <!-- INSTAGRAM PANEL -->
        <div class="instagram-panel pn">
          <i class="fa fa-instagram fa-4x"></i>
          <p>@THISISYOU<br/>
            5 min. ago
          </p>
          <p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
        </div>
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <!-- REVENUE PANEL -->
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>REVENUE</h5>
          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
          </div>
          <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
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
@stop
