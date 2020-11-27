@extends('layouts.app')
@section('title', $title ?? 'Comments List')

@section('content')

<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3>{{ $title ?? 'Comments List' }}</h3>
        </div>
        <div class="col-md-4 col-xs-12 mt-15 pull-right">
        </div>
    </div>



    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All Comments'])
        @slot('tool')
        <div class="box-tools">
            <button type="button" class="btn btn-block btn-primary btn-modal" id="add_new_cmd_btn">
                <i class="fa fa-plus"></i> @lang('messages.add')</button>
        </div>
        @endslot
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="comments_table">
                <thead>
                    <tr>
                        <th>Comments</th>
                        <th>Customers Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        @endcomponent

        <div class="modal fade" id="add_cmd_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            @include('comments.create',['customers' => $customers])
        </div>

    </section>
    <!-- /.content -->

    @endsection

    @section('javascript')
    <script type="text/javascript">
    $(document).ready(function() {
        //comments list
        var comments_table = $('#comments_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/comments',
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

            columns: [{
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'customers.name',
                    name: 'customers.name'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        });

        comments_table.on('draw', function() {
            $('.edit_cmd_button').click(function() {

                var msg = $(this).parent().siblings(":first").text();
                var cmd_id = $(this).attr("cmd-id");
                var cus_id = $(this).attr("cus-id");

                if ($('.sel2').find("option[value='" + cus_id + "']").length) {
                    $('.sel2').val(cus_id).trigger('change');
                }
                $('#message').val(msg);
                $('#cmd_id').val(cmd_id);
                // customer_id
                $('div#add_cmd_modal').modal('show');


            })
        });

        $('button#add_new_cmd_btn').click(function() {
            $('div#add_cmd_modal').modal('show');
        });


        $('.sel2').select2({
            width: '100%'
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

                            $('div#add_cmd_modal').modal('hide');
                            toastr.success(result.msg);
                            comments_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                        $(form).find('button[type="submit"]').attr('disabled',
                            false);
                    }
                });
            }
        });

        $('#add_cmd_modal').on('hidden.bs.modal', function(e) {

            reset_booking_form();
        });

        function reset_booking_form() {
            $('select#customer_id').val('').change();
            $('#message').val('');
            $('#cmd_id').val('');
        }


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