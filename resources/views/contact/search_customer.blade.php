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
                	<form action="{{ action('ContactController@customer_show') }}" method="post" enctype='multipart/form-data' novalidate>
                    @csrf
                        <div class="row">
		                   <div class="col-md-6">
		                     	<div class="form-group">
                                    <label for="barcode_type">Customer:*</label>
                                    <select class="form-control select2 select2-hidden-accessible" required="" id="barcode_type" name="cus_id" tabindex="-1" aria-hidden="true" style="width: 330.328px;">
                                        <option value="">select</option>
                                        @foreach($users as $users)
                                        <option  value="{{ $users->contact_id }}">{{ $users->name }} ({{ $users->contact_id }})</option>
                                        @endforeach
                                    </select>
					            </div>
		                   </div>
                           <div class="col-md-6">
		                      <div class="form-group">
					             <button type="Submit" class="btn btn-primary waves-effect waves-light" style="width: 40%;margin-top:0px;color: white;">Search</button>
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
