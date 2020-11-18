@php 
if($is_edit){
@endphp
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  @php
    $form_id = 'contact_add_form';
    $url = action('ContactController@store');

  @endphp
    {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id ,'enctype'=>"multipart/form-data"]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add Family Member</h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('prefix', __( 'business.prefix' ) . ':') !!}
                    {!! Form::text('prefix',@$contact->prefix, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', @$contact->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':') !!}
                    {!! Form::text('middle_name',  @$contact->middle_name, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', @$contact->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>
          
        <input type="hidden"   id = 'type' name="type" value="customer">
        <input type="hidden"   name="customer_group_id" value="<?=@$contact->id?>">
        <input type="hidden"   name="is_family_member" value="1">
        <input type="hidden"   name="is_edit" value="<?=(@$contact->id) ? @$contact->id : '0'?>">

    
          <div class="col-md-6 supplier_fields">
            <div class="form-group">
                {!! Form::label('marital_status', 'Marital Status:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="fa fa-id-badge"></i>
                    </span>
                    {!! Form::text('marital_status', @$contact->marital_status, ['class' => 'form-control', 'required', 'placeholder' => 'Marital Status']); !!}
                </div>
            </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_id', 'Membership No:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </span> -->
                    <!-- {!! Form::text('contact_id',@$contact->contact_id, ['class' => 'form-control','placeholder' => 'Membership','readonly'=>'readonly']) !!} -->

                    <input type="hidden"   name="contact_id" value="<?=@$contact->contact_id?>">
                <!-- </div>
            </div>
          </div> -->


          <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('relationship', 'Relationship:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </span>
                    <select name="relationship" class="form-control">
                        <option value='wife' <?=(@$contact->relationship=='wife') ? 'selected' : ''?>>Wife</option>
                        <option value='son'  <?=(@$contact->relationship=='son') ? 'selected' : ''?>>Son</option>
                        <option value='daughter' <?=(@$contact->relationship=='daughter') ? 'selected' : ''?>>Daughter</option>
                    </select>
                
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
            

        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('dob', __('lang_v1.dob') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    {!! Form::text('dob', @$contact->dob, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email', __('business.email') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                {!! Form::email('email', @$contact->email, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mobile', __('contact.mobile') . ':*') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                </span>
                {!! Form::text('mobile',  @$contact->mobile, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}

            </div>
        </div>
      </div>

      <div class="clearfix"></div>
    
     

      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('photo','photo:') !!}
            {!! Form::file('photo', null, ['class' => 'form-control', 'rows' => 3]); !!}
        </div>
      </div>
      <div class="clearfix"></div>
     

      <div class="clearfix"></div>
     
     
     
      <!-- <div class="col-md-8 col-md-offset-2 shipping_addr_div" >
          <strong>{{__('lang_v1.shipping_address')}}</strong><br>
          {!! Form::text('shipping_address', null, ['class' => 'form-control', 
                'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
        <div id="map"></div>
      </div> -->
   


     
      <!-- {!! Form::hidden('position', null, ['id' => 'position']); !!} -->
   
     
      </div>
    </div>
  
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}
  
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
@php 
}else{
@endphp
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  @php
    $form_id = 'contact_add_form';
    $url = action('ContactController@store');

  @endphp
    {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id ,'enctype'=>"multipart/form-data"]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add Family Member</h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('prefix', __( 'business.prefix' ) . ':') !!}
                    {!! Form::text('prefix',@$contact->prefix, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', @$contact->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':') !!}
                    {!! Form::text('middle_name',  @$contact->middle_name, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', @$contact->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>
          
        <input type="hidden"   id = 'type' name="type" value="customer">
        <input type="hidden"   name="customer_group_id" value="<?=@$contact1->id?>">
        <input type="hidden"   name="is_family_member" value="1">
        <input type="hidden"   name="is_edit" value="<?=(@$contact->id) ? @$contact->id : '0'?>">

    
          <div class="col-md-6 supplier_fields">
            <div class="form-group">
                {!! Form::label('marital_status', 'Marital Status:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="fa fa-id-badge"></i>
                    </span>
                    {!! Form::text('marital_status', @$contact->marital_status, ['class' => 'form-control', 'required', 'placeholder' => 'Marital Status']); !!}
                </div>
            </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_id', 'Membership No:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </span> -->
                    <!-- {!! Form::text('contact_id',@$contact->contact_id, ['class' => 'form-control','placeholder' => 'Membership','readonly'=>'readonly']) !!} -->

                    <input type="hidden"   name="contact_id" value="<?=@$contact1->contact_id?>">
                <!-- </div>
            </div>
          </div> -->


          <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('relationship', 'Relationship:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </span>
                    <select name="relationship" class="form-control">
                        <option value='wife' <?=(@$contact->relationship=='wife') ? 'selected' : ''?>>Wife</option>
                        <option value='son'  <?=(@$contact->relationship=='son') ? 'selected' : ''?>>Son</option>
                        <option value='daughter' <?=(@$contact->relationship=='daughter') ? 'selected' : ''?>>Daughter</option>
                    </select>
                
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
            

        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('dob', __('lang_v1.dob') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    {!! Form::text('dob', @$contact->dob, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email', __('business.email') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                {!! Form::email('email', @$contact->email, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mobile', __('contact.mobile') . ':*') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                </span>
                {!! Form::text('mobile',  @$contact->mobile, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}

            </div>
        </div>
      </div>

      <div class="clearfix"></div>
    
     

      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('photo','photo:') !!}
            {!! Form::file('photo', null, ['class' => 'form-control', 'rows' => 3]); !!}
        </div>
      </div>
      <div class="clearfix"></div>
     

      <div class="clearfix"></div>
     
     
     
      <!-- <div class="col-md-8 col-md-offset-2 shipping_addr_div" >
          <strong>{{__('lang_v1.shipping_address')}}</strong><br>
          {!! Form::text('shipping_address', null, ['class' => 'form-control', 
                'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
        <div id="map"></div>
      </div> -->
   


     
      <!-- {!! Form::hidden('position', null, ['id' => 'position']); !!} -->
   
     
      </div>
    </div>
  
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}
  
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
@php
}
@endphp