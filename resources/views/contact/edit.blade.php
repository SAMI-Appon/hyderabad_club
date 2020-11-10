<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

  @php

    if(isset($update_action)) {
        $url = $update_action;
        $customer_groups = [];
        $opening_balance = 0;
        $lead_users = $contact->leadUsers->pluck('id');
    } else {
      $url = action('ContactController@update', [$contact->id]);
      $sources = [];
      $life_stages = [];
      $users = [];
      $lead_users = [];
    }
  @endphp

    {!! Form::open(['url' => $url, 'method' => 'PUT', 'id' => 'contact_edit_form']) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('contact.edit_contact')</h4>
    </div>

    <div class="modal-body">

      <div class="row">
        <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('prefix', __( 'business.prefix' ) . ':') !!}
                    {!! Form::text('prefix', $contact->prefix, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', $contact->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':') !!}
                    {!! Form::text('middle_name', $contact->middle_name, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', $contact->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 supplier_fields">
            <div class="form-group">
                {!! Form::label('supplier_business_name', 'Business Nature:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-briefcase"></i>
                    </span>
                    {!! Form::text('supplier_business_name',  $contact->supplier_business_name, ['class' => 'form-control', 'required', 'placeholder' => __('business.business_name')]); !!}
                </div>
            </div>
          </div>
        
          <div class="col-md-4 supplier_fields">
            <div class="form-group">
                {!! Form::label('marital_status', 'Marital Status:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="fa fa-id-badge"></i>
                    </span>
                    {!! Form::text('marital_status', $contact->marital_status, ['class' => 'form-control', 'required', 'placeholder' => 'Marital Status']); !!}
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_id', 'Membership No:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </span>
                    {!! Form::text('contact_id', $contact->contact_id, ['class' => 'form-control','placeholder' => 'Membership','disabled'=>'disabled']) !!}
                </div>
            </div>
          </div>
        <div class="clearfix"></div>
        <!-- <div class="col-md-4 lead_additional_div">
              <div class="form-group">
                  {!! Form::label('crm_source', __('lang_v1.source') . ':' ) !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fas fa fa-search"></i>
                      </span>
                      {!! Form::select('crm_source', $sources, null , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); !!}
                  </div>
              </div>
            </div> -->

        <!-- lead additional field -->
        <!-- <div class="col-md-4 lead_additional_div">
          <div class="form-group">
              {!! Form::label('crm_source', __('lang_v1.source') . ':' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fas fa fa-search"></i>
                  </span>
                  {!! Form::select('crm_source', $sources, $contact->crm_source , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); !!}
              </div>
          </div>
        </div>
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
              {!! Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fas fa fa-life-ring"></i>
                  </span>
                  {!! Form::select('crm_life_stage', $life_stages, $contact->crm_life_stage , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); !!}
              </div>
          </div>
        </div> -->
        <!-- <div class="col-md-6 lead_additional_div">
          <div class="form-group">
              {!! Form::label('user_id', __('lang_v1.assigned_to') . ':*' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                  </span>
                  {!! Form::select('user_id[]', $users, $lead_users , ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']); !!}
              </div>
          </div>
        </div> -->
        <div class="col-md-4 opening_balance">
          <div class="form-group">
              {!! Form::label('opening_balance', __('lang_v1.opening_balance') . ':') !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fas fa-money-bill-alt"></i>
                  </span>
                  {!! Form::text('opening_balance', $opening_balance, ['class' => 'form-control']); !!}
              </div>
          </div>
        </div>

        <div class="col-md-4 opening_balance">
          <div class="form-group">
              {!! Form::label('qualification','Qualification:') !!}
              <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                  </span>
                  {!! Form::text('qualification', $contact->qualification, ['class' => 'form-control', 'required', 'placeholder' => 'Qualification']); !!}
              </div>
          </div>
        </div>
        <div class="col-md-4 customer_fields">
          <div class="form-group">
              {!! Form::label('credit_limit', __('lang_v1.credit_limit') . ':') !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fas fa-money-bill-alt"></i>
                  </span>
                  {!! Form::text('credit_limit', $contact->credit_limit, ['class' => 'form-control input_number']); !!}
              </div>
              <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
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
                    
                    {!! Form::text('dob', $contact->dob, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
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
                {!! Form::email('email', $contact->email, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
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
                {!! Form::text('mobile', $contact->mobile, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}


            </div>
        </div>
      </div>

      <div class="col-md-12">
        <hr/>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('alternate_number','Office Tel:') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </span>
                {!! Form::text('alternate_number', $contact->alternate_number, ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('landline','Residentail Tel:') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </span>
                {!! Form::text('landline', $contact->landline, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_line_1', 'Present Address:') !!}
            {!! Form::text('address_line_1', $contact->address_line_1, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); !!}
        </div>
      </div>
    
      <div class="clearfix"></div>

      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_line_2','Resident on present address since:') !!}
            {!! Form::text('address_line_2', $contact->address_line_2, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]); !!}
        </div>
      </div>
    
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('photo','photo:') !!}
            {!! Form::file('photo', null, ['class' => 'form-control', 'rows' => 3]); !!}
        </div>
      </div>
     
      <div class="col-md-12">
        <hr/>
      </div>
      @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
        $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
        $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
        $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
      @endphp
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('proposer_name','Proposer Name:') !!}
            {!! Form::text('proposer_name', $contact->proposer_name, ['class' => 'form-control', 
                'placeholder' =>'Proposer Name']); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('signature_pro','Signature of Proposer:') !!}
            {!! Form::file('signature_pro', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('proposer_member_id','Membership No:') !!}
            {!! Form::text('proposer_member_id', $contact->proposer_member_id, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('proposer_number','Tel No:') !!}
            {!! Form::text('proposer_number', $contact->proposer_number, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 shipping_addr_div"><hr></div>

      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_name','Seconder Name:') !!}
            {!! Form::text('seconder_name', $contact->seconder_name, ['class' => 'form-control', 
                'placeholder' =>'Seconder Name']); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_signature','Signature of Seconder:') !!}
            {!! Form::file('seconder_signature', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_member_id','Membership No:') !!}
            {!! Form::text('seconder_member_id', $contact->seconder_member_id, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_number','Tel No:') !!}
            {!! Form::text('seconder_number', $contact->seconder_number, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>
      <!-- <div class="col-md-8 col-md-offset-2 shipping_addr_div" >
          <strong>{{__('lang_v1.shipping_address')}}</strong><br>
          {!! Form::text('shipping_address', $contact->shipping_address, ['class' => 'form-control', 
                'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
        <div id="map"></div>
      </div>
      {!! Form::hidden('position', $contact->position, ['id' => 'position']); !!}

    </div>

    </div> -->

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->