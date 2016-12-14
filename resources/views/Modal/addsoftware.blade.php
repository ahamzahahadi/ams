
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Software Installation Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
<!-- THE QUERIES TO GET THE SOFTWARE LIST & TYPE -->
          <?php $value2 = DB::table('hwtype')->where('flag', 2)->orderBy('type', 'asc')->pluck('type')->toArray();
                $value2=array_prepend($value2,'--Choose Category--');
                $valswname = DB::table('software')->distinct()->orderBy('sw_model','asc')->get(['sw_model', 'sw_type']);
          ?>

<!-- THE FORM HTML -->
          <h4> Select Software Type  </h4>
        {!! Form::open(array('action' => 'SwRecordController@modalinstall')) !!}
          <select name="filtr_3">
            @foreach($value2 as $val2)
            <option value="{{$val2}}">{{$val2}}</option>
            @endforeach
          </select>
          <br>
          <h5> Select Software to Install: </h5>
          <ul id="list_3">
            @foreach($valswname as $valsw)
            <li data-filtr="{{$valsw->sw_type}}"><input type="radio" name="swname" value="{{$valsw->sw_model}}">{{$valsw->sw_model}}</li>
              @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == $valsw->sw_model)
              <div class="alert alert-danger"> No key available for <b>{{$valsw->sw_model}}</b>, please purchase and add into the system </div>
              @endif
            @endforeach
          </ul>
          {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
          {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

<!-- SOME AUTOFILL INFOS -->
          {!! Form::hidden('hwid', "$hardware->hw_assetid") !!}
          @if($hardware->hw_status == '1') <!-- sebab kalau status = 0, xde current user, crash -->
          {!! Form::hidden('current_userid', "$userstaffdb->staff_id") !!}
          {!! Form::hidden('id', "$hardware->id") !!}
          @endif

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
