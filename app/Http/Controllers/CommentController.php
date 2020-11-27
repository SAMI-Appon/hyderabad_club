<?php

namespace App\Http\Controllers;
use App\Comments;
use App\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Egulias\EmailValidator\Warning\Comment;

class CommentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $cmd = Comments::with('customers')
                ->latest()
                ->get();

            return Datatables::of($cmd)
                ->addColumn('action', function ($cmd) {
                    $btn =
                        '<button  cmd-id="' .
                        $cmd->id .
                        '" cus-id="' .
                        $cmd->contact_id .
                        '" class="btn btn-xs btn-primary edit_cmd_button"><i class="glyphicon glyphicon-edit"></i> edit</button>
                   &nbsp;<button data-href="' .
                        action('CommentController@destroy', [$cmd->id]) .
                        '" class="btn btn-xs btn-danger delete_comment_button"><i class="glyphicon glyphicon-trash"></i>Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $business_id = $business_id = request()
            ->session()
            ->get('user.business_id');
        $customers = Contact::customersDropdown($business_id, false, true, true);

        return view('comments.index', compact('customers'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        if ($request->cmd_id) {
            $comments = Comments::Where('id',$request->cmd_id)->first();
            $output = ['success' => true, 'msg' => 'Comment Updated succesfully'];
        } else {
            $comments = new Comments();
            $output = ['success' => true, 'msg' => 'Comment added succesfully'];
        }

        $comments->contact_id = $request->customer_id;
        $comments->message = $request->message;
        $comments->save();

        return $output;
    }

    public function destroy(Request $request)
    {
      
        if (request()->ajax()) {
            try {
                
                $brand = Comments::findOrFail($request->cmd_id);
                $brand->delete();

                $output = ['success' => true,
                            'msg' => 'Comment deleted successfully'
                            ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
            }

            return $output;
        }
    }
}
