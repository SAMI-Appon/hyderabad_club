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
                        @foreach($customer_data as $value)
                        @if($value->relationship == 'parent')
                        <div class="col-md-4">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row" style="margin-top: 30px;">
                                        @foreach($customer_data as $val)
                                        @if($val->relationship != 'parent')
                                        <div class="col-md-12 text-center">
                                            <img src="{{ asset('') }}/{{$val->image}}" style="width: 80%;">
                                            <h5>{{ $val->name }}</h5>
                                            <p>Relation: {{ $val->relationship }}</p>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h3 class="profile-username">
                                        <i class="fas fa-user-tie"></i>
                                        {{ $value->name }} <small>Customer</small>
                                    </h3><br>
                                </div>
                                <div class="col-md-6 col-md-offset-1">

                                    <strong><i class="fa fa-calendar margin-r-5"></i> Date of birth</strong>
                                    <p class="text-muted">
                                        {{ $value->dob }}
                                    </p>
                                    <strong><i class="fa fa-briefcase margin-r-5"></i>
                                        Business Name</strong>
                                    <p class="text-muted">
                                        {{ $value->supplier_business_name }}
                                    </p>
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                                    <p class="text-muted">
                                        {{ $value->address_line_1 }}
                                    </p>

                                </div>
                                <div class="col-md-5">
                                    <strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>
                                    <p class="text-muted">
                                        {{ $value->mobile }}
                                    </p>
                                    <strong><i class="fa fa-phone margin-r-5"></i> Landline</strong>
                                    <p class="text-muted">
                                        {{ $value->landline }}
                                    </p>
                                    <strong><i class="fa fa-phone margin-r-5"></i> Alternate contact number</strong>
                                    <p class="text-muted">
                                        {{ $value->alternate_number }}
                                    </p>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h3 class="profile-username"> <i class="fas fa-comment-dots"></i> Last Comment </h3>
                                </div>
                                <div class="col-md-10 col-md-offset-1">

                                    <!-- <strong>Total Expense</strong> -->
                                    <p class="text-muted">
                                        <span>{{ $comment->message ?? 'Not Comment Yet' }}</span>
                                    </p>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h3 class="profile-username"> <i class="fas fa-money-bill-alt"></i> Due Amount </h3>
                                </div>
                                <div class="col-md-6 col-md-offset-1">

                                    <strong>Total Expense</strong>
                                    <p class="text-muted">
                                        <span class="display_currency"
                                            data-currency_symbol="true">{{ $due_balance['contact_details']->total_invoice }}</span>
                                    </p>
                                    <strong>Total pay</strong>
                                    <p class="text-muted">
                                        <span class="display_currency"
                                            data-currency_symbol="true">{{ $due_balance['contact_details']->total_paid }}</span>
                                    </p>
                                    <strong>Total Expense Due</strong>
                                    <p class="text-muted">
                                        <span class="display_currency"
                                            data-currency_symbol="true">{{ $due_balance['contact_details']->total_invoice - $due_balance['contact_details']->total_paid }}</span>
                                    </p>

                                </div>
                                <div class="col-md-5">

                                    @if(!empty($due_balance['contact_details']->opening_balance) ||
                                    $due_balance['contact_details']->opening_balance
                                    != '0.00')
                                    <strong>@lang('lang_v1.opening_balance') </strong>
                                    <p class="text-muted"><span class="display_currency" data-currency_symbol="true">
                                            {{ $due_balance['contact_details']->opening_balance }}</span></p>
                                    <strong>@lang('lang_v1.opening_balance_due') </strong>

                                    <p class="text-muted">
                                        <span class="display_currency" data-currency_symbol="true">
                                            {{ $due_balance['ob_due'] }}</span>
                                    </p>
                                    @endif
                                </div>
                            </div>

                        </div>


                        @endif
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </div>
</section>
@endsection