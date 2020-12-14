@extends('layouts.app')
@section('title', __('product.add_new_product'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $title }}</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ action('NotificationController@send_notification') }}" method="post" id="add_comment_form">
    @csrf
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row">
        <!-- <div class="col-md-4">
            <div class="form-group" style="margin-top: 27px;">
                <label for="barcode_type">All Users:</label> &nbsp;&nbsp;
                <input type="checkbox" class="input-icheck" name="forever" value="all">
            </div>
        </div> -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="barcode_type">Users:</label>
                <select class="form-control" id="users" name="user_id[]" multiple="multiple">
                    <option value="all">All</option>
                   @foreach($user_data as $user_data)
                    <option value="{{$user_data->id}}">{{$user_data->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="barcode_type">Title:*</label>
                <input type="text" class="form-control" name="title" value="{{ @$form_data->start_date }}" required>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="barcode_type">Description:*</label>
                <textarea class="form-control" name="dec" required=""></textarea>
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="Submit" class="btn btn-primary waves-effect waves-light" style="color: white;">Send</button>
            </div>
        </div>
    </div>
    @endcomponent
    </form>
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row">
    <div class="table-responsive">
            <table class="table table-bordered table-striped" id="comments_table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @endcomponent
</section>
<!-- /.content -->

@endsection

@section('javascript')
@php $asset_v = env('APP_VERSION'); @endphp
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    __page_leave_confirmation('#product_add_form');
    onScan.attachTo(document, {
        suffixKeyCodes: [13], // enter-key expected at the end of a scan
        reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
        onScan: function(sCode, iQty) {
            $('input#sku').val(sCode);
        },
        onScanError: function(oDebug) {
            console.log(oDebug);
        },
        minLength: 2,
        ignoreIfFocusOn: ['input', '.form-control'],
        onKeyDetect: function(
        iKeyCode) { // output all potentially relevant key events - great for debugging!
            console.log('Pressed: ' + iKeyCode);
        }
    });

    $('#notSaleChek').on('ifChecked', function() {
        $('#subsChek').iCheck('uncheck');
    })
    $('#subsChek').on('ifChecked', function() {
        $('#notSaleChek').iCheck('uncheck');
    })

});
$(document).ready(function() {
    $('#users').select2();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //comments list
        var comments_table = $('#comments_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/view-notification',
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

            columns: [{
                    data: 'customers.name',
                    name: 'customers.name'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'push_text',
                    name: 'push_text'
                },
                {
                    data: 'date',
                    name: 'date'
                }
                // {
                //     data: 'action',
                //     name: 'action'
                // },
            ],
        });
        var booking_form_validator = $('form#add_comment_form').validate({
            submitHandler: function(form) {
                $(form).find('button[type="submit"]').attr('disabled', true);
                var data = $(form).serialize();

                $.ajax({
                    method: "POST",
                    url: $(form).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('#add_comment_form')[0].reset();
                            toastr.success(result.msg);
                            comments_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                        $(form).find('button[type="submit"]').attr('disabled',
                            false);
                        window.setTimeout(function () {
                            window.location = result.redirect;
                        }, 2000);
                    }
                });
            }
        });
        $(document).on('click', 'button.delete_comment_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_variation,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'get',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            comments_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
    });
  
    </script>
@endsection