@extends('layouts.app')
@section('title', $title ?? 'Events List')

@section('content')

<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3>{{ $title ?? 'Events List' }}</h3>
        </div>
        <div class="col-md-4 col-xs-12 mt-15 pull-right">
        </div>
    </div>



    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All Events'])
        @slot('tool')
        <div class="box-tools">
            <a href="{{ route('add_event') }}" class="btn btn-block btn-primary">
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
            ajax: '/view-event',
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

       





    });
    </script>
    @endsection