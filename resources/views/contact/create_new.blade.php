<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  @php
    $form_id = 'contact_add_form';
    if(isset($quick_add)){
      $form_id = 'quick_add_contact';
    }

    if(isset($store_action)) {
      $url = $store_action;
      $type = 'lead';
      $customer_groups = [];
    } else {
      $url = action('ContactController@store');
      $type = '';
      $sources = [];
      $life_stages = [];
      $users = [];
    }
  @endphp
    {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id ,'enctype'=>"multipart/form-data"]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('contact.add_contact')</h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('prefix', __( 'business.prefix' ) . ':') !!}
                    {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':') !!}
                    {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>
          

                        <input type="hidden"   id = 'type' name="type" value="customer">
                    
      
          <div class="col-md-4 supplier_fields">
            <div class="form-group">
                {!! Form::label('supplier_business_name', 'Business Nature:*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-briefcase"></i>
                    </span>
                    {!! Form::text('supplier_business_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('business.business_name')]); !!}
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
                    {!! Form::text('marital_status', null, ['class' => 'form-control', 'required', 'placeholder' => 'Marital Status']); !!}
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
                    {!! Form::text('contact_id', null, ['class' => 'form-control','placeholder' => 'Membership']) !!}
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
            

            <!-- lead additional field -->
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
        <!-- <div class="col-md-4 lead_additional_div">
          <div class="form-group">
              {!! Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fas fa fa-life-ring"></i>
                  </span>
                  {!! Form::select('crm_life_stage', $life_stages, null , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); !!}
              </div>
          </div>
        </div>
        <div class="col-md-6 lead_additional_div">
          <div class="form-group">
              {!! Form::label('user_id', __('lang_v1.assigned_to') . ':*' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                  </span>
                  {!! Form::select('user_id[]', $users, null , ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']); !!}
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
                  {!! Form::text('opening_balance', '', ['class' => 'form-control']); !!}
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
                  {!! Form::text('qualification', null, ['class' => 'form-control', 'required', 'placeholder' => 'Qualification']); !!}
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
                  {!! Form::text('credit_limit', null, ['class' => 'form-control input_number']); !!}
              </div>
              <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
          </div>
        </div>

        <!-- <div class="col-md-4 pay_term">
          <div class="form-group">
            <div class="multi-input"> -->
              <!-- {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term')) -->
              
              <!-- {!! Form::number('pay_term_number', null, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!} -->

              <!-- {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], '', ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]); !!} -->
            <!-- </div>
          </div>
        </div> -->
        <div class="clearfix"></div>
        <!-- <div class="col-md-4 customer_fields">
          <div class="form-group"> -->
              <!-- {!! Form::label('customer_group_id', __('lang_v1.customer_group') . ':') !!} -->
              <!-- <div class="input-group"> -->
                  <!-- <span class="input-group-addon">
                      <i class="fa fa-users"></i>
                  </span> -->
                  <!-- {!! Form::select('customer_group_id', $customer_groups, '', ['class' => 'form-control']); !!} -->
              <!-- </div>
          </div>
        </div> -->
       
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('dob', __('lang_v1.dob') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    {!! Form::text('dob', null, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
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
                {!! Form::email('email', null, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
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
                {!! Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}


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
                {!! Form::text('alternate_number', null, ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]); !!}
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
                {!! Form::text('landline', null, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_line_1', 'Present Address:') !!}
            {!! Form::text('address_line_1', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); !!}
        </div>
      </div>

      <div class="clearfix"></div>
    
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_line_2','Resident on present address since:') !!}
            {!! Form::text('address_line_2', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]); !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('photo','photo:') !!}
            {!! Form::file('photo', null, ['class' => 'form-control', 'rows' => 3]); !!}
        </div>
      </div>
      <div class="clearfix"></div>
      <!-- <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('city', __('business.city') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('business.city')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('state', __('business.state') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('business.state')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('country', __('business.country') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-globe"></i>
                </span>
                {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('business.country')]); !!}
            </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('zip_code', __('business.zip_code') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                {!! Form::text('zip_code', null, ['class' => 'form-control', 
                'placeholder' => __('business.zip_code_placeholder')]); !!}
            </div>
        </div>
      </div> -->

      <div class="clearfix"></div>
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
            {!! Form::text('proposer_name', null, ['class' => 'form-control', 
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
            {!! Form::text('proposer_member_id', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('proposer_number','Tel No:') !!}
            {!! Form::text('proposer_number', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>
      

     
      <div class="col-md-12 shipping_addr_div"><hr></div>
      <!-- <div class="col-md-8 col-md-offset-2 shipping_addr_div" >
          <strong>{{__('lang_v1.shipping_address')}}</strong><br>
          {!! Form::text('shipping_address', null, ['class' => 'form-control', 
                'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
        <div id="map"></div>
      </div> -->
      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_name','Seconder Name:') !!}
            {!! Form::text('seconder_name', null, ['class' => 'form-control', 
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
            {!! Form::text('seconder_member_id', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
        {!! Form::label('seconder_number','Tel No:') !!}
            {!! Form::text('seconder_number', null, ['class' => 'form-control', 
                ]); !!}
        </div>
      </div>
      <!-- {!! Form::hidden('position', null, ['id' => 'position']); !!} -->
      <div class="col-md-12 shipping_addr_div"><hr></div>
    <div class="col-md-6">
        <div class="form-group">
        {!! Form::label('application_date','Application date:') !!}
        {!! Form::text('application_date', null, ['class' => 'form-control dob-date-picker','placeholder' =>'Application Date', 'readonly']); !!}
        

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
        {!! Form::label('approval_date','Approval date:') !!}
        {!! Form::text('approval_date', null, ['class' => 'form-control dob-date-picker','placeholder' =>'Approval Date', 'readonly']); !!}
        

        </div>
      </div>
      </div>
    </div>
  
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}
  
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->