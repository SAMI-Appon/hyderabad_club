<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Egulias\EmailValidator\Warning\Comment;
use App\Events;


class EventController extends Controller
{
    public function index(){
        
        if (request()->ajax()) {
            $cmd = Events::latest()->get();

            return Datatables::of($cmd)
                ->addColumn('img', function ($cmd) {
                    $img = '<img src="' . asset($cmd->img). '" style="width: 100px; height: 100px; ">';
                    return $img;
                })->addColumn('start_date', function ($cmd) {
                    return $start_date = \App\Helpers\CommonHelpers::date_format_custom($cmd->start_date);
                })->addColumn('end_date', function ($cmd) {
                    return $end_date = \App\Helpers\CommonHelpers::date_format_custom($cmd->end_date);
                })->addColumn('action', function ($cmd) {
                    $btn =
                        '<a href="' .
                        action('EventController@edit', [$cmd->id]) .
                        '" cmd-id="' .
                        $cmd->id .
                        '" cus-id="' .'" class="btn btn-xs btn-primary edit_cmd_button"><i class="glyphicon glyphicon-edit"></i> edit</a>
                   &nbsp;<button data-href="' .
                        action('EventController@destroy', [$cmd->id]) .
                        '" class="btn btn-xs btn-danger delete_comment_button"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action','img','start_date','end_date'])
                ->make(true);
        }
        $business_id = $business_id = request()
            ->session()
            ->get('user.business_id');
        $customers = Contact::customersDropdown($business_id, false, true, true);

        return view('events.index', compact('customers'));
    }

    public function add_event()
    {
        $data = array(
            'title' => 'Add Event',
        );
        return view('events.create')->with($data);
    }

    public function save_event(Request $request)
    {  
         
        if($request->event_id){
            $event = Events::Where('id',$request->event_id)->first();
        }else{
            $event = new Events();
        }

        if($request->img){
            $img = \App\Helpers\CommonHelpers::uploadSingleFile($request->file('img'), 'images/event_img/');
            if(is_array($img)){
                return response()->json(['error' => $img['error']]);
            } else{
                $event->img = $img;
            } 
        }
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        
       
        $event->forever = $request->forever;
        $event->save();    
        return  redirect(route('view_event'));
    }

    public function destroy(Request $request)
    {
        if (request()->ajax()) {
            $brand = Events::findOrFail($request->cmd_id);
                $brand->delete();

                $output = ['success' => true,
                            'msg' => 'event deleted successfully'
                            ];

            return $output;
        }
    }
    public function edit($id)
    {
        $data = array(
            'title' => 'Search Customer',
            'form_data' => Events::where('id',$id)->first(),
        );
        return view('events.create')->with($data);
    }
}
