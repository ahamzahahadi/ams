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


  </head>

<body>
<section id="container" >
  @include('mainmain.topbar')
  @include('mainmain.sidebar')

  <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-lg-12">
<?php
$test = DB::table('hardware')
->select(DB::raw('hw_model,hw_po_no,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_datesupp)/365)) AS Age'))
->where('hw_type', 'notebook')
->where('hw_model', '!=', '')
->where('hw_datesupp', '!=', '0000-00-00')
->groupBy('hw_model', 'hw_po_no') //add 'hw_po_no' to distinguish same model, but from different PO
->orderBy('Age', 'desc')
->get();
 ?>

<h1> Hardware Age Report </h1>
<!-- CLICK SINI 	<a href="javascript:genPDF();" >PDF ade screenshot</a> -->
<a href="{{URL::to('downloadExcel') }}"><button class="btn btn-success btn-lg">Export as Excel</button></a>
<table id="tableI" class ="table table-bordered table-condensed table-striped" >
  <!-- <caption> Notebook Age Summary </caption> -->
  <thead>
  <tr>
    <th> Model </th> <th> PO Number </th> <th> Quantity </th> <th> Age </th>
  </tr>
</thead>
@foreach($test as $t)
<tr>
  <td>{{$t->hw_model}}</td>
  <td>{{$t->hw_po_no}}</td>
  <td>{{$t->Quantity}}</td>
  @if($t->Age == '0')
<td> New </td>
@elseif($t->Age == '')
<td> Missing Information </td>
@else
  <td> {{$t->Age}}</td>
  @endif
</tr>
@endforeach
</table>

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
