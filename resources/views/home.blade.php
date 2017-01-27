@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::asset('lineicons/style.css')}}">
<link href="{{ URL::asset('css/to-do.css') }}" rel="stylesheet">
<div class="row">
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

<!-- FETCH LIVE RECORDS -->
    <?php $hwcount = DB::table('hardware')->count();//total hardware
          $totnotebook = DB::table('hardware')->where('hw_type','Notebook')->count(); //total notebook
          $notebookinuse = DB::table('hardware')->where('hw_type','Notebook')->where('hw_status',1)->count(); //notebook in use
          $notepercent = round($notebookinuse/$totnotebook*100);
          $swcount = DB::table('software')->count();
          $staffcount = DB::table('staff')->count();
          $staffupdate = DB::table('staff')->select('updated_at')->orderBy('updated_at','desc')->first();
          $loancount = DB::table('loan')->count();?>


<div class="col-lg-9 main-chart">
  <!-- START OF PRETTY ICON WITH MINIMAL INFO -->
  <div class="row mtbox">
    <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
      <div class="box1">
        <span class="li_display"></span>
        <h3>{{$hwcount}}</h3>
      </div>
      <p>{{$hwcount}} total hardware in record.</p>
    </div>

    <div class="col-md-2 col-sm-2 box0">
      <div class="box1">
        <span class="li_vynil"></span>
        <h3>{{$swcount}}</h3>
      </div>
      <p>{{$swcount}} total software licenses in record.</p>
    </div>

    <div class="col-md-2 col-sm-2 box0">
      <div class="box1">
        <span class="li_user"></span>
        <h3>{{$staffcount}}</h3>
      </div>
      <p>{{$staffcount}} total staff in AMS record. Last update on {{date('jS M Y  g:iA',strtotime($staffupdate->updated_at))}}</p>
    </div>


    <div class="col-md-2 col-sm-2 box0">
      <div class="box1">
        <span class="li_news"></span>
        <h3>{{$loancount}}</h3>
      </div>
      <p>{{$loancount}} items are in loan.</p>
    </div>

    <div class="col-md-2 col-sm-2 box0">
      <div class="box1">
        <span class="li_data"></span>
        <h3>OK!</h3>
      </div>
      <p>Your server is working perfectly. Relax & enjoy.</p>
    </div>

  </div><!-- END OF PRETTY ICON WITH MINIMAL INFO -->
  <div class="row mt"> <!-- PANEL UNTUK QUICK LOAN LOG -->
    <div class="col-md-12">
        <section class="task-panel tasks-widget">
      <div class="panel-heading" id="loan">
            <div class="pull-left"><h3><i class="fa fa-pencil-square-o"></i>  Quick Loan Log </h3></div>
            <br><br><hr>
      </div>
            <div class="panel-body">
                <div class="task-content">
                    <ul id="sortable" class="task-list">
                      <?php $rekodpeminjam = DB::table('loan')->get(); ?>
                      @foreach($rekodpeminjam as $peminjam)
                        <li class="list-primary">
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="badge bg-theme">Yesterday</span>
                                <span class="task-title-sp">{{$peminjam->borrower}} borrowed {{$peminjam->item}}</span>
                                <div class="pull-right hidden-phone">
                                    {!! Form::open(['method' => 'DELETE','route' => ['loan.padam', $peminjam->id]]) !!}
                                    {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger', 'class'=>'fa fa-trash-o'] )  !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </li>
                      @endforeach
                    </ul>
                </div>
                <div class=" add-task-row">
                  <button class="btn btn-success btn-sm pull-left" data-toggle="modal" data-target="#myModal">Add New Record</button>
                </div>
            </div>
        </section>
    </div><!--/col-md-12 -->
  </div><!-- END OF PANEL UNTUK QUICK LOAN LOG -->
  
  <div class="row mt">

    <div class="col-lg-5">
      <h3><b>CURRENT STATUS SUMMARY (Unit Count)</b></h3>
      <div id="donut-example"></div>
    </div>

  <div class="col-lg-2"></div>

    <div class="col-lg-5">
      <h5>SOFTWARE IN USE</h5>
      <div id="donut-example"></div>
    </div>

  </div>

  <div class="row mt">
              <!--CUSTOM CHART START -->
              <div class="border-head">
                  <h3>HARDWARE IN ACTIVE DUTY</h3>
              </div>
              <div class="custom-bar-chart">
                  <ul class="y-axis">
                      <li><span>10.000</span></li>
                      <li><span>8.000</span></li>
                      <li><span>6.000</span></li>
                      <li><span>4.000</span></li>
                      <li><span>2.000</span></li>
                      <li><span>0</span></li>
                  </ul>
                  <div class="bar">
                      <div class="title">JAN</div>
                      <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                      <!-- data original title = mouse over
                      data placement = ketinggian bar itu -->
                  </div>
                  <div class="bar ">
                      <div class="title">FEB</div>
                      <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                  </div>
                  <div class="bar ">
                      <div class="title">MAR</div>
                      <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                  </div>
                  <div class="bar ">
                      <div class="title">APR</div>
                      <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                  </div>
                  <div class="bar">
                      <div class="title">MAY</div>
                      <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                  </div>
                  <div class="bar ">
                      <div class="title">JUN</div>
                      <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                  </div>
                  <div class="bar">
                      <div class="title">JUL</div>
                      <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                  </div>
              </div>
              <!--custom chart end-->
  </div><!-- /row -->

    <!-- start of black panel row -->
    <div class="row mt">
      <!-- TWITTER PANEL -->
      <div class="col-md-4 col-sm-4 mb">
        <!-- REVENUE PANEL -->
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>ASSET REQUISITIONS RECORDED</h5>
          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
          </div>
          <p class="mt"><b>78 Requisitions </b><br/>in the past 11 months</p>
        </div>
      </div><!-- /col-md-4 -->

      <div class="col-md-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>TOTAL HARDWARE ASSET IN USE</h5>
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
          <p>{{$notebookinuse}} In Use</p>
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
        <!-- REVENUE PANEL -->
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>ASSET RETURNS RECORDED</h5>
          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
          </div>
          <p class="mt"><b>103 Returns</b><br/>in the past 11 months</p>
        </div>
      </div><!-- /col-md-4 -->

    </div><!-- end of black panel row DROPBOX/INSTA/REVENUE -->
    <div class="row mt">
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

          <div class="centered">
            <img src="{{URL::asset('img/p2t.png')}}" height="180" width="250">
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


  </div>



                <!-- RIGHT SIDEBAR -->
                <div class="col-lg-3 ds">
                  <!--COMPLETED ACTIONS DONUTS CHART-->
                <h3>NOTIFICATIONS</h3>

                    <!-- First Action -->
                    <div class="desc">
                      <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <div class="details">
                        <p><muted>2 Minutes Ago</muted><br/>
                           <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                        </p>
                      </div>
                    </div>
                    <!-- Second Action -->
                    <div class="desc">
                      <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <div class="details">
                        <p><muted>3 Hours Ago</muted><br/>
                           <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                        </p>
                      </div>
                    </div>
                    <!-- Third Action -->
                    <div class="desc">
                      <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <div class="details">
                        <p><muted>7 Hours Ago</muted><br/>
                           <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                        </p>
                      </div>
                    </div>
                    <!-- Fourth Action -->
                    <div class="desc">
                      <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <div class="details">
                        <p><muted>11 Hours Ago</muted><br/>
                           <a href="#">Mark Twain</a> commented your post.<br/>
                        </p>
                      </div>
                    </div>
                    <!-- Fifth Action -->
                    <div class="desc">
                      <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <div class="details">
                        <p><muted>18 Hours Ago</muted><br/>
                           <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                        </p>
                      </div>
                    </div>

                     <!-- USERS ONLINE SECTION -->
                <h3>TEAM MEMBERS</h3>
                    <!-- First Member -->
                    <div class="desc">
                      <div class="thumb">
                        <img class="img-circle" src="{{URL::asset('img/abgk1.jpg')}}" width="60px" height="60px" align="left">
                      </div>
                      <div class="details">
                        <p><a href="#">KHAIRUL ANUAR</a><br/>
                           <muted>Available</muted>
                        </p>
                      </div>
                    </div>
                    <!-- Second Member -->
                    <div class="desc">
                      <div class="thumb">
                        <img class="img-circle" src="{{URL::asset('img/ain1.png')}}" width="60px" height="60px" align="">
                      </div>
                      <div class="details">
                        <p><a href="#">SHASARIDA</a><br/>
                           <muted>I am Busy</muted>
                        </p>
                      </div>
                    </div>
                    <!-- Third Member -->
                    <div class="desc">
                      <div class="thumb">
                        <img class="img-circle" src="assets/img/ui-danro.jpg" width="35px" height="35px" align="">
                      </div>
                      <div class="details">
                        <p><a href="#">DAN ROGERS</a><br/>
                           <muted>Available</muted>
                        </p>
                      </div>
                    </div>
                    <!-- Fourth Member -->
                    <div class="desc">
                      <div class="thumb">
                        <img class="img-circle" src="assets/img/ui-zac.jpg" width="35px" height="35px" align="">
                      </div>
                      <div class="details">
                        <p><a href="#">Zac Sniders</a><br/>
                           <muted>Available</muted>
                        </p>
                      </div>
                    </div>
                    <!-- Fifth Member -->
                    <div class="desc">
                      <div class="thumb">
                        <img class="img-circle" src="assets/img/ui-sam.jpg" width="35px" height="35px" align="">
                      </div>
                      <div class="details">
                        <p><a href="#">Marcel Newman</a><br/>
                           <muted>Available</muted>
                        </p>
                      </div>
                    </div>


                </div><!-- /col-lg-3 -->

  </div>
</div>



@include('modal.addloaner')
<!-- page-specific scripting -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="{{URL::asset('js/tasks.js') }}" type="text/javascript"></script>
<script src="{{URL::asset('js/jquery.sparkline.js')}}"></script>
<script src="{{URL::asset('js/sparkline-chart.js')}}"></script>

<script>
  jQuery(document).ready(function() {
      TaskList.initTaskWidget();
  });
  $(function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
  });
</script>
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



@endsection
