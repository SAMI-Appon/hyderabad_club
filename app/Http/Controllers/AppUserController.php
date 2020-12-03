<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TransactionPayment;

class AppUserController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $users = User::where('username', $username)->first();

        if (!$users) {
            return response()->json([
                'status' => 'error',
                'msg' => 'User Not Found',
            ]);
        }
        
        $Hash = \Hash::check($password, $users->password);
        if ($Hash) {
            unset($users['password']);
            $data = $users;
           
            return response()->json([
                'status' => 'sucess',
                'data' => $data,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'msg' => 'Wrong password',
        ]);
    }
}
