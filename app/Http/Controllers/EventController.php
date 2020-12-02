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
                    $img = '<img src="' . asset($cmd->img). '" style="
                    width: 100px;
                    height: 100px;
                ">';
                    return $img;
                })->addColumn('action', function ($cmd) {
                    $btn =
                        '<button  cmd-id="' .
                        $cmd->id .
                        '" cus-id="' .'" class="btn btn-xs btn-primary edit_cmd_button"><i class="glyphicon glyphicon-edit"></i> edit</button>
                   &nbsp;<button data-href="' .
                        action('CommentController@destroy', [$cmd->id]) .
                        '" class="btn btn-xs btn-danger delete_comment_button"><i class="glyphicon glyphicon-trash"></i>Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action','img'])
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
            'title' => 'Search Customer',
            'users' => Contact::get(),
        );
        return view('events.create')->with($data);
    }

    public function save_event(Request $request)
    {
        if($request->img){
            $img = \App\Helpers\CommonHelpers::uploadSingleFile($request->file('img'), 'images/event_img/');
            if(is_array($img)){
                return response()->json(['error' => $img['error']]);
            }  
        } 
        $event = new Events();
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->img = $img;
        $event->forever = $request->forever;
        $event->save();    
        return  redirect(route('view_event'));
    }
}
