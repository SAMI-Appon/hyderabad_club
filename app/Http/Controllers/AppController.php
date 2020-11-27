<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Http\Request;



class AppController extends Controller
{
     public function __construct() 
     {
       
     }
    
    public function login(Request $request)
    { 
        $email    = $request->input('email');
        $password = $request->input('password');
        $contact  = Contact::where('email',$email)->first();
        if(!$contact){
            return response()->json([
                'status' => 'error',
                'msg' => 'User Not Found',
            ]);
        }
        $Hash = \Hash::check($password, $contact->password);
        if($Hash){
            $family_members  = Contact::where('contact_id',$contact['contact_id'])->where('relationship','!=','parent')->get();
            return response()->json([
                'status' =>  'sucess',
                'data'   =>  ['user'=>$contact,'home_data'=>['https://www.adspeed.com/placeholder-300x250.gif','https://www.adspeed.com/placeholder-300x250.gif','https://www.adspeed.com/placeholder-300x250.gif','family_members'=>$family_members]]
                
            ]);
        } 
        return response()->json([
            'status' => 'error',
            'msg' => 'Wrong password',
        ]);

    }
}
