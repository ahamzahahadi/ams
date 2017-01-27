<script src="{{ URL::asset('js/typeahead.bundle.min.js') }}"></script>
<link href="{{ URL::asset('css/typesuggest.css') }}" rel="stylesheet">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hardware Requisition Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
<!-- THE QUERIES TO GET HARDWARE LIST & TYPE -->
          <?php $value2 = DB::table('hwtype')->where('flag', 1)->orderBy('type', 'asc')->pluck('type')->toArray();
                $value2=array_prepend($value2,'--Choose Category--');
                $valhwname = DB::table('hardware')->distinct()->orderBy('hw_model','asc')->get(['hw_model', 'hw_type']);
          ?>

<!-- THE FORM HTML -->
          <h4> Select Hardware Category  </h4>
        {!! Form::open(array('action' => 'RecordController@modalassign')) !!}
          <select name="filtr_3">
            @foreach($value2 as $val2)
            <option value="{{$val2}}">{{$val2}}</option>
            @endforeach
          </select>
          <br>
          <h5> Select hardware to assign: </h5>
          <ul id="list_3">
            @foreach($valhwname as $valhw)
            <li data-filtr="{{$valhw->hw_type}}"><input type="radio" name="hwname" value="{{$valhw->hw_model}}">{{$valhw->hw_model}}
              <?php $counter = DB::table('hardware')->where('hw_status', 0)->where('hw_model', $valhw->hw_model)->where('hw_model', '<>', '')->count();?>
              @if($counter < 2)
              <font color="red"> {{$counter}} unit available <br> </font>
              @else
              <font color="green"> {{$counter}} units available <br> </font>
              @endif
            </li>
              @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == $valhw->hw_model)
              <div class="alert alert-danger">  There are no available <b>{{$valhw->hw_model}}</b> to be assigned. </div>
              @endif
            @endforeach
          </ul>
          {!! Form::label('datesupp', 'Date Given:', ['class' => 'control-label']) !!}
          {!! Form::input('date','created_at', null, ['class' => 'form-control', 'required' => 'required']) !!}
<!-- or find using hardware SN -->
          <span class="help-block"><sub><b>Or search using hardware S/N..</b></sub></span>
          @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == 2)
          <div id="findhw">
          {!! Form::text('hw_serialno', null, ['class' => 'form-control', 'placeholder' => 'Enter hardware S/N', 'size' => "180"]) !!}
          </div>
          <div class="alert alert-danger"> Serial number is not in a valid format. Please select from the suggested list or leave this field empty. </div>
          @else
          <div id="findhw">
          {!! Form::text('hw_serialno', null, ['class' => 'form-control', 'placeholder' => 'Enter hardware S/N', 'size' => "180"]) !!}
          </div>
          @endif

          {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
          {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

<!-- SOME AUTOFILL INFOS -->
          {!! Form::hidden('current_userid', "$staff->staff_id") !!}
          {!! Form::hidden('id', "$staff->id") !!}

<!-- START OF SCRIPTING -->
          <script src="{{ URL::asset('js/jquery.filtr.min.js') }}"></script>
          <script>
          $('select[name="filtr_3"]').filtr($('#list_3 li'), {
            trigger				: 'change',
            wait				: 0
          });
          </script>
<!-- START OF BLOODHOUND.JS SCRIPTING -->
          <?php $hwinfo = DB::table('hardware')->select('hw_serialno', 'hw_model')->where('hw_status', 0)->get();
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
<!-- END OF BLOODHOUND SCRIPTING -->
        </div>

      </div>
      <div class="modal-footer">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
