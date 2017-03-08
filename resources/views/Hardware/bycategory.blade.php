@extends('master')
@section('content')

@include('Alerts::sweetalerts')

<div >
  <div >
    <div class="row mt">
      <h4><i class="fa fa-angle-right"></i>{{$category}} Overview</h4>
      <?php
      $totalhw = DB::table('hardware')->where('hw_type',$category)->count(); //total notebook
      $inuse = DB::table('hardware')->where('hw_type',$category)->where('hw_status',1)->count(); //notebook in use
      $usagepercent = round($inuse/$totalhw*100);
      $lastreq = DB::table('hwrecord')->where('status',1)->orderBy('created_at', 'desc')->first();
      $lastret = DB::table('hwrecord')->where('status',2)->orderBy('updated_at', 'desc')->first();
      $latestitem = DB::table('hardware')->where('hw_type', $category)->orderBy('created_at','desc')->first();
      ?>
      <!-- TWITTER PANEL -->
      <div class="col-md-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>{{strtoupper($category)}} IN USE</h5>
          </div>
          <canvas id="serverstatus02" height="120" width="120"></canvas>
          <script>
          var notebook = Number('<?php echo $usagepercent; ?>');
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
          <p>{{$totalhw - $inuse}} Available / {{$inuse}} In Use</p>
          <footer>
            <div class="pull-left">
              <h5><i class="fa fa-hdd-o"></i> {{$totalhw}} Total</h5>
            </div>
            <div class="pull-right">
              <h5>{{$usagepercent}}% Assigned</h5>
            </div>
          </footer>
        </div><! -- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 mb">
        <div class="content-panel pn">
          <div id="blog-bg">
            <div class="badge badge-popular">{{$category}}</div>
            <div class="blog-title">Update Log</div>
          </div>
          <div class="blog-text">
            Lastest requisition: {{date('jS M Y  g:iA',strtotime($lastreq->created_at))}} <a href="{{action('RecordController@show', $lastreq->fk_assetid)}}">View</a><br>
            Last return recorded: {{date('jS M Y  g:iA',strtotime($lastret->updated_at))}} <a href="{{action('RecordController@show', $lastret->fk_assetid)}}">View</a><br>
            Latest {{$category}} registered: {{date('jS M Y  g:iA',strtotime($latestitem->created_at))}} <a href="{{action('RecordController@show', $latestitem->id)}}">{{$latestitem->hw_model}}</a><br>
          </div>
        </div>
      </div><!-- /col-md-4 -->

      <div class="col-md-4 mb">
        <!-- col-sm-4 -->
        <!-- REVENUE PANEL -->
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>ASSET REQUISITIONS RECORDED</h5>
            <?php
            $x=DB::select(DB::raw('SELECT COUNT(id) as "req"
            FROM hwrecord
            WHERE `created_at` != "0000-00-00 00:00:00"
            AND `status` = "1"
            GROUP BY YEAR(`created_at`), MONTH(`created_at`)
            ORDER BY YEAR(`created_at`) desc, MONTH(`created_at`) desc
            LIMIT 11'
            ));
            $x = array_reverse($x);
            $sting = "[";
            $ctr = 0;
            ?>
            @foreach($x as $y)
            <?php $sting .= $y->req.",";
            $ctr += $y->req ?>

            @endforeach
            <?php
            $sting = rtrim($sting, ",");
            $sting.= "]";
            ?>

          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data=<?php echo $sting; ?>   ></div>
          </div>
          <p class="mt"><b>{{$ctr}} Requisitions </b><br/>in the past 11 months</p>
        </div>
      </div><!-- /col-md-4 -->

    </div> <!-- row-mt -->


    <div >
      <h4><i class="fa fa-angle-right"></i>{{$category}} List</h4>
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
                @foreach ($cathardware as $hw)
            <tr>
            <td>{{ $hw->id}} </td>
            <td>{{ $hw->hw_assetid }}</td>
            <td>{{ $hw->hw_serialno }}</td>
            <td>{{ $hw->hw_model }}</td>
            <td>{{ $hw->hw_po_no }}</td>
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
             {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'id' =>'delete' ,'onclick' =>"return confirm('You will not be able to recover this record, are you sure?')"]) !!}
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
@stop
