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
                	<form action="{{ action('EventController@save_event') }}" method="post" enctype='multipart/form-data' novalidate>
                    @csrf
                    <input type="hidden" value="{{ @$form_data->id }}" name="event_id">
                        <div class="row">
		                   <div class="col-md-6">
		                     	<div class="form-group">
                                    <label for="barcode_type">Start Date:*</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ @$form_data->start_date }}" required>
                                </div>
                           </div>
                           <div class="col-md-6">
		                     	<div class="form-group">
                                    <label for="barcode_type">End Date:*</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ @$form_data->end_date }}" required>
                                </div>
                           </div>
                           <div class="col-md-6">
		                     	<div class="form-group">
                                    <label for="barcode_type">Image:*</label>
                                    <input type="file" class="form-control" name="img">
                                </div>
                           </div>
                           <div class="col-md-6">
		                     	<div class="form-group" style="margin-top: 27px;">
                                    <label for="barcode_type">Forever:*</label> &nbsp;&nbsp;
                                    <input type="checkbox" class="input-icheck" name="forever" value="1" required {{ @$form_data->forever == 1 ? 'checked' : '' }}>
                                </div>
		                   </div>
                           <div class="col-md-12">
		                      <div class="form-group">
					             <button type="Submit" class="btn btn-primary waves-effect waves-light" style="color: white;">Save</button>
					          </div>
                              </div>
		                   </div>
	                   </form>
                   </div>

            </div>
        </div>
        </div>
    </div>
</section>
<script>
// $(document).ready(function() {
//     $('#barcode_type').select2({
//         selectOnClose: true
//     });
// });
    
</script>
@endsection
