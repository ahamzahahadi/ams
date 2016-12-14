<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Quick Loan Form</h4>
    </div>
    <div class="modal-body">
      <div class="form-group">
        {!! Form::open(array('action' => 'CategoryController@store')) !!}

        {!! Form::label('item', 'Item loaned:', ['class' => 'control-label']) !!}
        {!! Form::text('item', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! Form::label('borrower', "Borrower's Name:", ['class' => 'control-label']) !!}
        {!! Form::text('borrower', null, ['class' => 'form-control', 'required' => 'required']) !!}

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
