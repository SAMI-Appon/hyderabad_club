<?php

namespace App\Http\Controllers;
use App\Comments;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CommentController extends Controller
{

    // public function index()
    // {
    //     if (request()->ajax()) {
    //         $business_id = request()->session()->get('user.business_id');

    //         $variations = VariationTemplate::where('business_id', $business_id)
    //                     ->with(['values'])
    //                     ->select('id', 'name', DB::raw("(SELECT COUNT(id) FROM product_variations WHERE product_variations.variation_template_id=variation_templates.id) as total_pv"));

    //         return Datatables::of($variations)
    //             ->addColumn(
    //                 'action',
    //                 '<button data-href="{{action(\'VariationTemplateController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_variation_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
    //                     &nbsp;
    //                     @if(empty($total_pv))
    //                     <button data-href="{{action(\'VariationTemplateController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_variation_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
    //                     @endif'
    //             )
    //             ->editColumn('values', function ($data) {
    //                 $values_arr = [];
    //                 foreach ($data->values as $attr) {
    //                     $values_arr[] = $attr->name;
    //                 }
    //                 return implode(', ', $values_arr);
    //             })
    //             ->removeColumn('id')
    //             ->removeColumn('total_pv')
    //             ->rawColumns([2])
    //             ->make(false);
    //     }

    //     return view('variation.index');
    // }
}
