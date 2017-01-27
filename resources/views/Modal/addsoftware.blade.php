<script src="{{ URL::asset('js/typeahead.bundle.min.js') }}"></script>
<link href="{{ URL::asset('css/typesuggest.css') }}" rel="stylesheet">

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
            <li data-filtr="{{$valsw->sw_type}}"><input type="radio" name="swname" value="{{$valsw->sw_model}}">{{$valsw->sw_model}}
              <?php $counter = DB::table('software')->where('sw_status', 0)->where('sw_model', $valsw->sw_model)->where('sw_model', '<>', '')->count();?>
              @if($counter < 2)
              <font color="red"> {{$counter}} unit available <br> </font>
              @else
              <font color="green"> {{$counter}} units available <br> </font>
              @endif
            </li>
              @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == $valsw->sw_model)
              <div class="alert alert-danger"> No key available for <b>{{$valsw->sw_model}}</b>, please purchase and add into the system </div>
              @endif
            @endforeach
          </ul>
          {!! Form::label('datesupp', 'Date Installed:', ['class' => 'control-label']) !!}
          {!! Form::input('date','updated_at', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <hr>
          <span class="help-block"><b>Or search using available product key..</b></span>
          @if(!empty(Session::get('ada_error')) && Session::get('ada_error') == 2)
          <div id="findswkey">
          {!! Form::text('sw_prodkey', null, ['class' => 'form-control', 'placeholder' => 'Enter product key', 'size' => "180"]) !!}
          </div>
          <div class="alert alert-danger"> Product key is not in a valid format. Please select from the suggested list or leave this field empty. </div>
          @elseif(!empty(Session::get('ada_error')) && Session::get('ada_error') == 3)
          <div id="findswkey">
          {!! Form::text('sw_prodkey', null, ['class' => 'form-control', 'placeholder' => 'Enter product key', 'size' => "180"]) !!}
          </div>
          <div class="alert alert-danger"> Unable to assign software with no product key through this quick form, please assign manually from the list of software. </div>
          @else
          <div id="findswkey">
          {!! Form::text('sw_prodkey', null, ['class' => 'form-control', 'placeholder' => 'Enter product key', 'size' => "180"]) !!}
          </div>
          @endif
          <br>
          {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
          {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

<!-- SOME AUTOFILL INFOS -->
          @if($hardware->hw_status == '1') <!-- sebab kalau status = 0, xde current user, crash -->
          {!! Form::hidden('id', "$hardware->id") !!}
          @endif

<!-- START OF FILTR.JS SCRIPTING -->
          <script src="{{ URL::asset('js/jquery.filtr.min.js') }}"></script>
          <script>
          $('select[name="filtr_3"]').filtr($('#list_3 li'), {
            trigger				: 'change',
            wait				: 0
          });
          </script>
<!-- START OF BLOODHOUND.JS SCRIPTING -->
            <?php $swdetail = DB::table('software')->select('sw_model', 'sw_prodkey')->get();
            $swarray = array();
            $arrlength = count($swdetail);
            $x=0;
            ?>
            @foreach($swdetail as $sw)
            <?php $swarray[$x] = "$sw->sw_model < $sw->sw_prodkey >";
            $x++;
            ?>
            @endforeach
            <?php $json = json_encode($swarray); ?>
            <script>
            var sw = {!! $json !!};

            var sw = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              local: sw
            });

            $('#findswkey .form-control').typeahead({
              hint: true,
              highlight: true,
              minLength: 1
            },
            {
              name: 'sw',
              source: sw,
              templates: {
                empty: [
                  '<div class="alert alert-warning"><b>Unable to find the product key</b></div>'
                ]
            }
            });

            </script>
            <!-- end of blood -->
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
