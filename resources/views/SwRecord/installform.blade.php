@extends('master')
@section('content')
<script src="{{ URL::asset('js/typeahead.bundle.min.js') }}"></script>
<link href="{{ URL::asset('css/typesuggest.css') }}" rel="stylesheet">

<h1> Software Installation Form </h1>
<hr>

{!! Form::open(array('action' => 'SwRecordController@store')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Software Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('sw_assetid', "$software->sw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly']  )!!}

  {!! form::label('installinto','Install into:', ['class'=> 'control-label'] )!!}

  @if(!empty(Session::get('ada_error')))
  <div id="findhw" class="form-group has-error">
  {!! Form::text('hw_serialno', null, ['class' => 'form-control','size' => "180", 'placeholder'=> 'Enter serial number of the hardware to install to', 'id'=>'inputError']) !!}
  </div>
  <div class="alert alert-danger"><b>Please choose from the suggestions listed.</b></div>
  @else
  <div id="findhw">
  {!! Form::text('hw_serialno', null, ['class' => 'form-control','size' => "180", 'placeholder'=> 'Enter serial number of the hardware to install to']) !!}
  </div>
  <span class="help-block"><sup>&nbsp&nbsp&nbsp&nbspPlease choose from the suggestions listed.</sup></span>
  @endif

  {!! Form::label('assigndate', "Installed on:", ['class' => 'control-label']) !!}<br>
  {!! Form::input('date','updated_at', null, ['class' => 'form-control', 'required' => 'required']) !!}
  <!-- {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!} -->

  {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
  {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

  {!! Form::hidden('swid', "$software->id") !!}

</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}

<?php $hwinfo = DB::table('hardware')->select('hw_serialno', 'hw_model')->get();
$hwdetail = array();
$arrlength = count($hwinfo);
$x=0;
?>
@foreach($hwinfo as $hw)
<?php $hwdetail[$x] = "$hw->hw_model <SN: $hw->hw_serialno>";
$x++;
?>
@endforeach
<?php $json = json_encode($hwdetail); ?>
<script>
var hwlist = {!! $json !!};

var hwlist = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  local: hwlist
});

$('#findhw .form-control').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'hwlist',
  source: hwlist,
  templates: {
    empty: [
      '<div class="alert alert-warning"><b>Unable to find the specified hardware</b></div>'
    ]
}
});

</script>

@stop
