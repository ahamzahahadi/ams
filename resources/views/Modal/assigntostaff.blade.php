
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hardware Requisition Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
<!-- THE QUERIES TO GET THE SOFTWARE LIST & TYPE -->
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
              <?php $counter = DB::table('hardware')->where('hw_status', 0)->where('hw_model', $valhw->hw_model)->count();?>
              <font color="red"> {{$counter}} units available <br> </font>
            </li>
              @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == $valhw->hw_model)
              <div class="alert alert-danger"> No key available for <b>{{$valhw->hw_model}}</b>, please purchase and add into the system </div>
              @endif
            @endforeach
          </ul>
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
