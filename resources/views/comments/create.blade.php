<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('CommentController@store'), 'method' => 'post', 'id' =>
        'add_comment_form', 'class' => 'form-horizontal' ]) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Comment</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">

                <label class="col-sm-4 control-label">Select Customer:*</label>

                <div class="col-sm-8">
                    {!! Form::select('customer_id',
                    $customers, null, ['class' => 'form-control sel2', 'id' => 'customer_id',
                    'placeholder' => __('contact.customer'), 'required']);
                    !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Comment:*</label>
                <div class="col-sm-8">
                    <textarea id="message" name="message" class="form-control" required></textarea>
                </div>

            </div>
          <input type="hidden" name="cmd_id" id="cmd_id">
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
