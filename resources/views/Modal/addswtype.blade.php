<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">New software category</h4>
    </div>
    <div class="modal-body">
      <div class="form-group">
        {!! Form::open(array('action' => 'CategoryController@store')) !!}

        {!! Form::label('assettype', 'Define new software category:', ['class' => 'control-label']) !!}
        {!! Form::text('type', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::hidden('flag', 2, ['class' => 'form-control']) !!}
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div><!-- /showback -->
