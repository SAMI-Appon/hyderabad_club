@extends('layouts.app')
@section('title', $title ?? 'Notifications')

@section('content')

<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3>{{ $title ?? 'Notifications' }}</h3>
        </div>
        <div class="col-md-4 col-xs-12 mt-15 pull-right">
        </div>
    </div>



    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All Notifications'])
        @slot('tool')
        <div class="box-tools">
            <a href="{{ route('add_notification') }}" class="btn btn-block btn-primary">
                <i class="fa fa-plus"></i> @lang('messages.add')</a>
        </div>
        @endslot
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="comments_table">
                <thead>
                    <tr>
                        <th>Event Image</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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
            ajax: '/view-notification',
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

            columns: [{
                    data: 'img',
                    name: 'img'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
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