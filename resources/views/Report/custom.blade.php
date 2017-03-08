<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>AMS</title>
    <link rel="icon" href="{!! asset('img/sapura.ico') !!}"/>
    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ URL::asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style-responsive.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/tableexport/tableExport.js') }}"></script>
    <script src="{{ URL::asset('js/tableexport/jquery.base64.js') }}"></script>

  </head>

<body>
<section id="container" >
  @include('mainmain.topbar')
  @include('mainmain.sidebar')

  <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-lg-12">

 @if($type == 1)
 <h1> User assigned with {{$model}} </h1><hr>
 <p> Total records : <?php echo count($query); ?> </p>

 <!-- CLICK SINI 	<a href="javascript:genPDF();" >PDF ade screenshot</a> -->
 <a href="#" onClick ="$('#tableI').tableExport({type:'excel',escape:'false'});"><button class="btn btn-success btn-lg">Export as Excel</button></a>
 <table id="tableI" class ="table table-bordered table-condensed table-striped" >
 <thead>
   <tr>
     <th> User </th> <th> Serial No. </th> <th> Department </th><th> Company </th>
   </tr>
 </thead>
 @foreach($query as $q)
 <tr>
   <td>{{$q->staff_name}}</td>
   <td>{{$q->hw_serialno}}</td>
   <td>{{$q->staff_dept}}</td>
   <td>{{$q->staff_company}}</td>
 </tr>
 @endforeach
 </table>


 @elseif($type == 2)
 <h1> List of {{$status}} {{$cat}} </h1><hr>
 <p> Total {{$status}} : <?php echo count($query); ?> </p>
 <!-- CLICK SINI 	<a href="javascript:genPDF();" >PDF ade screenshot</a> -->
 <a href="#" onClick ="$('#tableI').tableExport({type:'excel',escape:'false'});"><button class="btn btn-success btn-lg">Export as Excel</button></a>
 <table id="tableI" class ="table table-bordered table-condensed table-striped" >
 <thead>
   <tr>
     <th> Serial No. </th> <th> Model </th> <th> Last User </th> <th> Department </th><th> Last recorded date </th>
   </tr>
 </thead>
 @foreach($query as $q)
 <tr>
   <td>{{$q->hw_serialno}}</td>
   <td>{{$q->hw_model}}</td>
   <td>{{$q->staff_name}}</td>
   <td>{{$q->staff_dept}}</td>
   <td>{{date('jS F Y', strtotime($q->updated_at))}}</td>
 </tr>
 @endforeach
 </table>


  @elseif($type == 3)
  <h1> List of all {{$cat}} currently assigned </h1><hr>
  <p> Total records : <?php echo count($query); ?> </p>
  <a href="#" onClick ="$('#tableI').tableExport({type:'excel',escape:'false'});"><button class="btn btn-success btn-lg">Export as Excel</button></a>
  <table id="tableI" class ="table table-bordered table-condensed table-striped" >
  <thead>
    <tr>
      <th> Age </th> <th> Model </th> <th> Serial No. </th> <th> User  </th><th> Department </th>
    </tr>
  </thead>
  @foreach($query as $q)
  <tr>
    @if($q->Age <1 && $q->Age >0)
    <td> New</td>
    @else
    <td>{{$q->Age}}</td>
    @endif
    <td>{{$q->hw_model}}</td>
    <td>{{$q->hw_serialno}}</td>
    <td>{{$q->staff_name}}</td>
    <td>{{$q->staff_dept}}</td>
  </tr>
  @endforeach
  </table>

  @elseif($type == 4)
  <h1> {{$cat}} age by Purchase Order </h1><hr>
  <p> Total records based on PO : <?php echo count($query); ?> </p>
  <a href="#" onClick ="$('#tableI').tableExport({type:'excel',escape:'false',filename: 'Hardware Age by PO'});"><button class="btn btn-success btn-lg">Export as Excel</button></a>
  <table id="tableI" class ="table table-bordered table-condensed table-striped" >
    <thead>
      <tr>
        <th> Model </th> <th> PO Number </th> <th> Quantity </th> <th> Age </th>
      </tr>
    </thead>
    @foreach($query as $q)
    <tr>

      <td>{{$q->hw_model}}</td>
      <td>{{$q->hw_po_no}}</td>
      <td>{{$q->Quantity}}</td>
      @if($q->Age <1 && $q->Age >=0)
      <td> New</td>
      @else
      <td>{{$q->Age}}</td>
      @endif
    </tr>
    @endforeach
  </table>


 @endif

 </div>
 </div>
 </section>

</section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--  insert scripts here-->
<script src="{{ URL::asset('js/common-scripts.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.dcjqaccordion.2.7.js') }}" class="include" type="text/javascript" ></script>
<script src="{{ URL::asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>


</body>
</html>
