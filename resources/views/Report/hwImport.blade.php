@extends('master')
@section('content')
@include('Alerts::sweetalerts')

<?php
$getlastinsert = DB::table('hardware')->orderBy('created_at', 'desc')->first();
$complist = DB::table('hardware')->select('hw_company')->distinct()->get();
$typelist = DB::table('hwtype')->select('type')->where('flag',1)->get();
?>
<h1> Welcome to hardware batch registration page</h1><hr>

  <div class="col-lg-6">
    <div class="showback">
      <div class="panel-heading">
        <h3> Import guideline </h3>
      </div>
      <div class="panel-body">
       <p> 1) Please prepare a .csv file according to this <a href="{{asset('HwSample.csv')}}" download="Sample For Hardware Import.csv"> sample </a>.</p>
       <p> 2) Do not change the first row of the sample, your new asset should start from the second row (replacing the sample) </p>
       <p> 3) Replace/Delete the sample row to avoid dummy from data being inserted. </p>
       <p style="color:green"> 4) 'hw_supplier' code can be referred at Supplier List page (shown as Supplier ID). </p>
       <p> 5) To ensure uniformity of data for fields with categorical values, please refer/copy the intended value from the "List of standard variable".</p>
      </div>
    </div>
  </div>

<div class="col-lg-6">
  <div class="showback">
    <div class="panel-heading">
      <h3> List of standard variables </h3>
    </div>
      <div class="panel-body">

        <div class="col-lg-4"><b>hw_type</b>
          @foreach($typelist as $type)
            <p>{{$type->type}}</p>
          @endforeach
        </div>

        <div class="col-lg-4"><b>hw_company</b>
          @foreach($complist as $comp)
            <p>{{$comp->hw_company}}</p>
          @endforeach
        </div>

        <div class="col-lg-4"><b>hw_class</b>
          <p>Standard</p>
          <p>SAILS</p>
          <p>Service</p>
        </div>
    </div>
  </div>

</div>

  <div class="col-md-12 centered">
    <div class="showback">
      <div class="panel-heading">
        <h3> Import wizard </h3>
      </div>
      <div class="alert alert-info"><b>Last hardware registered:</b> {{date('jS M Y  g:iA',strtotime($getlastinsert->created_at))}}</div>
      <p> Fill the following details for the new batch: </p>
      <form action="hwImportHandler" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}" >
      <div class="row">
        <div class="col-lg-6">
        {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
        {!! Form::input('date','hw_date_po', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::label('datesupp', 'Date supplied:', ['class' => 'control-label']) !!}
        {!! Form::input('date','hw_datesupp', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::label('datepono', 'Date received by GIT:', ['class' => 'control-label']) !!}
        {!! Form::input('date','hw_datefac', null, ['class' => 'form-control', 'required' => 'required']) !!}

        </div>
        <div class="col-lg-6">
          <br><br><br><br><br>
          <input type="file" name="batchhw">
        </div>

      </div>
    </div>

    <input type="checkbox" name="vehicle" value="agree"> <i>By clicking "Import", I am aware that the batch of data to be imported is thoroughly inspected and deemed valid.</i><br>
    <input type="submit" value="Import" class="btn btn-round btn-primary"></input>
</form>
</div>
@stop
