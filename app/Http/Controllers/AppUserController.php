<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\CustomersActivities;
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
                'status' => 'success',
                'data' => $data,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'msg' => 'Wrong password',
        ]);
    }

    public function add_activity(Request $request)
    {
        try {
            $customer_id = $request->input('customer_id');
            $user_id = $request->input('user_id');
            $service_id = $request->input('service_id');

            //  decode customer ID
            $customer_id = \App\Helpers\CommonHelpers::decrypt_user_id($customer_id);

            // check today check IN
            $CustomersActivityget = CustomersActivities::where('customer_id', $customer_id)
                ->where('user_id', $user_id)
                ->where('service_id', $service_id)
                ->whereDate('created_at', date('Y-m-d'))
                ->first();
            if ($CustomersActivityget):
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Activity today already added',
                ]);
            endif;

            // Get customer
            $customerGet = Contact::where('id', $customer_id)->select('first_name')->first();

            $data['customer_id'] = $customer_id;
            $data['user_id'] = $user_id;
            $data['service_id'] = $service_id;
            $data['contact_id'] = $customerGet->contact_id;

            // Customer Activity add
            $customersActivity = CustomersActivities::create($data);
            $output = [
                'status' => 'success',
                'data' => $customersActivity,
                'msg' => 'Activity added successfully',
            ];
        } catch (\Exception $e) {
            $output = ['status' => 'error', 'msg' => __('messages.something_went_wrong')];
        }

        return response()->json($output);
    }
}
