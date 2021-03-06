<div class="modal fade" id="add_booking_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {!! Form::open(['url' => action('Restaurant\BookingController@store'), 'method' => 'post', 'id' =>
            'add_booking_form' ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang( 'restaurant.add_booking' )</h4>
            </div>

            <div class="modal-body">

                <div class="row">
					
                    <div class="col-sm-6">
                        <div class="form-group">
							<select class="form-control" onchange="roomType(this.value)" required>
								<option value="">Select Type</option>
								<option value="room">Room</option>
								<option value="hall">Hall</option>
							</select>
                        </div>
					</div>
					<div class="col-sm-6">
                        <div class="form-group">
							<select class="form-control" id="getRooms" required>
								<option value="">Select Room & Hall</option>
							</select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                {!! Form::select('contact_id',
                                $customers, null, ['class' => 'form-control', 'id' => 'booking_customer_id', 
                                array('onchange' => 'selectCustomer(this.value)'),'placeholder' => __('contact.customer'), 'required']); !!}
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default bg-white btn-flat add_new_customer"
                                        data-name="" @if(!auth()->user()->can('customer.create')) disabled @endif><i
                                            class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <select class="form-control" id="getMembers" required>
								<option value="">Select Family Member</option>
							</select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="restaurant_module_span"></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('status', __('restaurant.start_time') . ':*') !!}
                            <div class='input-group date'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                {!! Form::text('booking_start', null, ['class' => 'form-control','placeholder' => __(
                                'restaurant.start_time' ), 'required', 'id' => 'start_time', 'readonly']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('status', __('restaurant.end_time') . ':*') !!}
                            <div class='input-group date'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                {!! Form::text('booking_end', null, ['class' => 'form-control','placeholder' => __(
                                'restaurant.end_time' ), 'required', 'id' => 'end_time', 'readonly']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('booking_note', __( 'restaurant.customer_note' ) . ':') !!}
                            {!! Form::textarea('booking_note', null, ['class' => 'form-control','placeholder' => __(
                            'restaurant.customer_note' ), 'rows' => 3 ]); !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('send_notification', 1, true, ['class' => 'input-icheck', 'id' =>
                                'send_notification']); !!} @lang('restaurant.send_notification_to_customer')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close'
                        )</button>
                </div>

                {!! Form::close() !!}

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
	</div>
