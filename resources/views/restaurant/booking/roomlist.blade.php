@extends('layouts.app')
@section('title', __('restaurant.bookings'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Room List </h1>
</section>


<section class="content">
    <div class="row">
        <!-- <div class="col-sm-12">
            <select id="business_location_id" class="select2" style="width:50%">
                <option value="">@lang('purchase.business_location')</option>
            </select>
        </div> -->

    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Room List And Today's Booking Rooms</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-condensed" id="todays_bookings_table">
                        <thead>
                            <tr>
                                <th>id#</th>
                                <th>Room name</th>
                                <th>Room Type</th>
                                <th>Booking Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($roomGet as $k => $val)
                            @php
                            $check_booked = explode(',', $val->check_booked);
                            $class_bok = array('booked' => 'btn-primary','completed' => 'btn-success' ,'cancelled' =>
                            'btn-danger')
                            @endphp
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{  $val->name }}</td>
                                <td>{{  ucWords($val->type) }}</td>
                                <td>
                                    @if(!empty($check_booked[0]))
                                    <a class="bookedDetailModel btn btn-xs {{ $class_bok[$check_booked[1]] }}"
                                        href="{{ action('Restaurant\BookingController@show', [$check_booked[0]] ) }}">
                                        {{  ucWords($check_booked[1]) }} </a>
                                    @else
                                    <a class="btn btn-xs btn-info" href="#">Not Booked </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"
        id="detail_booking_modal">

    </div>

</section>


@endsection

@section('javascript')

<script type="text/javascript">
$(document).ready(function() {
    $('.bookedDetailModel').click(function(event) {
        event.preventDefault();
        // /alert($(this).attr('href'));
        $.ajax({
            url: $(this).attr('href'),
            dataType: "html",
            success: function(response) {
                $('#detail_booking_modal').html(response)
                setTimeout(function() {
                    $('#detail_booking_modal').modal('show')
                }, 500);


            }
        });

    });


    $('#detail_booking_modal').on('shown.bs.modal', function(e) {
        $('form#edit_booking_form').validate({
            submitHandler: function(form) {
                $(form).find('button[type="submit"]').attr('disabled', true);
                var data = $(form).serialize();

                $.ajax({
                    method: "PUT",
                    url: $(form).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.view_modal').modal('hide');
                            toastr.success(result.msg);

                            $(form).find('button[type="submit"]').attr(
                                'disabled', false);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
});
</script>

@endsection