<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <h5 style="color:red;"> You are about to grant {{$users->name}} with the same level of privilege as yourself.
           You will NOT be able to revoke this privilege afterwards. Are you sure?   </h5>
      </div>

    </div>
    <div class="modal-footer">
      {!! Form::open(array('action' => 'AdminController@grantadmin')) !!}
      {!! Form::hidden('id', "$users->id") !!}
      {!! Form::submit('Confirm', ['class' => 'btn btn-theme']) !!}
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div><!-- /showback -->
