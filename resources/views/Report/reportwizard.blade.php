@extends('master')
@section('content')
@include('Alerts::sweetalerts')

<?php
  $allmodel = DB::table('hardware')->select('hw_model')->distinct()->orderBy('hw_model', 'asc')->get();
  $allcat = DB::table('hwtype')->where('flag',1)->orderBy('type', 'asc')->get();

 ?>
<h1> Welcome to Hardware Custom Report Wizard</h1><hr>
{!! Form::open(array('action' => 'ExcelController@generateHwReport')) !!}

{!! Form::label('reporttype', 'Choose report type: ', ['class' => 'control-label']) !!} <br>
<select name='reporttype' required onchange="reportSelectHandler(this)" class = 'form-control' id='rep_type'>
  <option value="1"> Hardware based on specific model </option>
  <option value="2"> Hardware based on specific status </option>
  <option value="3"> All hardware assigned </option>
  <option value="4"> All hardware by age </option>
</select>

{!! Form::label('category', 'Choose hardware category: ', ['class' => 'control-label', 'id'=> 'catlabel']) !!} <br>
<select name='category'  class = 'form-control' id='category'>
  @foreach($allcat as $cat)
  <option value='{{$cat->type}}'> {{$cat->type}}  </option>
  @endforeach
</select>

{!! Form::label('model', 'Choose model: ', ['class' => 'control-label', 'id'=> 'modellabel']) !!} <br>
<select name='model'  required class = 'form-control' id='model'>
  <!-- <option value='apa2'> Any  </option> -->
  @foreach($allmodel as $model)
  <option value='{{$model->hw_model}}'> {{$model->hw_model}}  </option>
  @endforeach
</select>

{!! Form::label('status:', 'Choose status: ', ['class' => 'control-label', 'id'=> 'statuslabel']) !!} <br>
<select name='hw_status'  class = 'form-control' id='status'>
  <!-- <option value='7'> Any  </option> -->
  <option value='0'> Available  </option>
  <option value='1'> Assigned  </option>
  <option value='2'> Faulty  </option>
  <option value='3'> BER  </option>
  <option value='4'> Stolen  </option>
  <option value='5'> Missing  </option>
  <option value='6'> MAF  </option>
</select>
<br>


<script>
function hide(){
var model = document.getElementById('model');
var modellabel = document.getElementById('modellabel');
var status = document.getElementById('status');
var statuslabel = document.getElementById('statuslabel');
model.style.visibility = 'hidden';
modellabel.style.visibility = 'hidden';
document.getElementById("model").required = false;
status.style.visibility = 'hidden';
statuslabel.style.visibility = 'hidden';
}

function show(){
var model = document.getElementById('model');
var modellabel = document.getElementById('modellabel');
var status = document.getElementById('status');
var statuslabel = document.getElementById('statuslabel');
model.style.visibility = 'visible';
modellabel.style.visibility = 'visible';
document.getElementById("model").required = true;
status.style.visibility = 'visible';
statuslabel.style.visibility = 'visible';
}

function hidemodel(){
  var model = document.getElementById('model');
  var modellabel = document.getElementById('modellabel');
  model.style.visibility = 'hidden';
  modellabel.style.visibility = 'hidden';
  document.getElementById("model").required = false;
}

function reportSelectHandler(select){
if(select.value == '1'){
show();
}else if(select.value == '2'){
  show();
  hidemodel();
}else if(select.value == '3' || select.value == '4'){
hide();
}}

// $('#rep_type').change(function() {
//    $('#model').attr('disabled', $(this).val() == '3' || $(this).val() == '4');
// });

</script>
{!! Form::submit('Generate report!', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop
