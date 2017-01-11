@extends('master')
@section('content')
<script src="{{ URL::asset('js/typeahead.bundle.min.js') }}"></script>
<link href="{{ URL::asset('css/typesuggest.css') }}" rel="stylesheet">

<h1> Fixed Asset Requisition Form </h1>
<hr>

{!! Form::open(array('action' => 'RecordController@store')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('id', "$hardware->hw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly']  )!!}

  {!! form::label('assignto','Given to:', ['class'=> 'control-label'] )!!}
  <div id="findstaff">
  {!! Form::text('current_userid', null, ['class' => 'form-control', 'placeholder' => 'Enter Staff Name or ID', 'size' => "180"]) !!}
  </div>
  <span class="help-block"><sup>&nbsp&nbsp&nbsp&nbspPlease choose from the suggestions listed.</sup></span>

  {!! Form::label('assigndate', "Handed on:", ['class' => 'control-label']) !!}<br>
  {!! form::input( 'date','date_handed' , null,['class'=> 'form-control', 'required' => 'required'])!!}

  {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
  {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

  {!! Form::hidden('id', "$hardware->id") !!}

</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}


<?php $staffname = DB::table('staff')->select('staff_name', 'staff_id')->get();
$staffdetail = array();
$arrlength = count($staffname);
$x=0;
?>
@foreach($staffname as $staff)
<?php $staffdetail[$x] = "$staff->staff_name <Staff ID: $staff->staff_id>";
$x++;
?>
@endforeach
<?php $json = json_encode($staffdetail); ?>
<script>
var staff = {!! $json !!};

var staff = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  local: staff
});

$('#findstaff .form-control').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'staff',
  source: staff
});

</script>

@stop
