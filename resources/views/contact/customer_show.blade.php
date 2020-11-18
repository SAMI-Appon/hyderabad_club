@extends('layouts.app')
@section('title', $title)

@section('content')

<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3>{{ $title }}</h3>
        </div>
        <div class="col-md-4 col-xs-12 mt-15 pull-right">
        </div>
    </div>
    <div class="hide print_table_part">
        <style type="text/css">
            .info_col {
                width: 25%;
                float: left;
                padding-left: 10px;
                padding-right: 10px;
            }
        </style>
        <div style="width: 100%;">
            <div class="info_col">
                <p>sd</p>
            </div>
        </div>
    </div>
     <br>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                	<div class="row">
                   <div class="col-md-4">
                   	<img src="https://dummyimage.com/600x400/000/fff" style="width: 100%;">
                   </div>
                <div class="col-md-4" style="    padding-left: 60px;">
            <!-- <strong>Mr Dani  Khan</strong><br><br> -->
					<h3 class="profile-username">
					    <i class="fas fa-user-tie"></i>
					    Mr Dani  Khan
					    <small>
					                    Customer
					            </small>
					</h3><br>
					<strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
					<p class="text-muted">
					    tee st, xzcxcxzcxc
					</p>
					    <strong><i class="fa fa-briefcase margin-r-5"></i> 
					    Business Name</strong>
					    <p class="text-muted">
					        test
					    </p>

					<strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>
					<p class="text-muted">
					    8451651
					</p>
					    <strong><i class="fa fa-phone margin-r-5"></i> Landline</strong>
					    <p class="text-muted">
					        234234234
					    </p>
					    <strong><i class="fa fa-phone margin-r-5"></i> Alternate contact number</strong>
					    <p class="text-muted">
					        234234
					    </p>
					    <strong><i class="fa fa-calendar margin-r-5"></i> Date of birth</strong>
					    <p class="text-muted">
					        16/11/2020
					    </p>
                </div>
                   <!-- <div class="col-md-4" style="    padding-left: 60px;">
            	<strong>Total Sale</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Total Sale Payment</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Total Sale Due</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Opening Balance</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 10,000.00</span>
				</p>
				<strong>Opening Balance Due</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 10,000.00</span>
				</p>
				    </div> -->
                      <div class="col-md-4" style="    margin-top: 55px;">
            	<strong>Total Sale</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Total Sale Payment</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Total Sale Due</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 0.00</span>
				</p>
				<strong>Opening Balance</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 10,000.00</span>
				</p>
				<strong>Opening Balance Due</strong>
				<p class="text-muted">
				<span class="display_currency" data-currency_symbol="true">₨ 10,000.00</span>
				</p>
				    </div>
                </div>

                <div class="row" style="margin-top: 30px;">
                	<div class="col-md-3 text-center">
                		<img src="https://dummyimage.com/600x400/000/fff" style="width: 80%;">
                		<h3>Alex</h3>
                		<p>Relation: SON</p>
                	</div>
                	<div class="col-md-3 text-center">
                		<img src="https://dummyimage.com/600x400/000/fff" style="width: 80%;">
                		<h3>Alex</h3>
                		<p>Relation: SON</p>
                	</div>
                	<div class="col-md-3 text-center">
                		<img src="https://dummyimage.com/600x400/000/fff" style="width: 80%;">
                		<h3>Alex</h3>
                		<p>Relation: SON</p>
                	</div>
                	<div class="col-md-3 text-center">
                		<img src="https://dummyimage.com/600x400/000/fff" style="width: 80%;">
                		<h3>Alex</h3>
                		<p>Relation: SON</p>
                	</div>
                </div>


            </div>
        </div>
        </div>
    </div>
</section>
@endsection
