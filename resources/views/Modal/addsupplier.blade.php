<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">New Supplier Form</h4>
    </div>
    <!-- form -->
    <div class="modal-body">
      <div class="form-group">
        {!! Form::open(array('action' => 'SupplierController@store')) !!}

        {!! Form::label('suppname', 'Supplier Company Name:', ['class' => 'control-label']) !!}
        {!! Form::text('supp_name', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::label('suppcontact', 'Supplier Contact Number:', ['class' => 'control-label']) !!}
        {!! Form::text('supp_contact', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::label('suppadd', 'Supplier Address:', ['class' => 'control-label']) !!}
        {!! Form::textarea('supp_address', null, ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div><!-- /showback -->
