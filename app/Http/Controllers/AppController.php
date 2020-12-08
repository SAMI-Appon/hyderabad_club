<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\TransactionPayment;
use App\Events;
use App\CustomersActivities;
use App\Service;

class AppController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $contact = Contact::where('email', $email)->first();
        if (!$contact) {
            return response()->json([
                'status' => 'error',
                'msg' => 'User Not Found',
            ]);
        }
        // Member Id - contact_id
        //password -  SSB-contact_id
        $Hash = \Hash::check($password, $contact->password);
        if ($Hash) {
            unset($contact['password']);

            $data = [
                'user' => [
                    'id' => $contact['id'],
                    'full_name' => $contact['name'],
                    'contact_id' => $contact['contact_id'],
                    'profile_image' => $contact['image'],
                    'qr_code' => $contact['qr_code'],
                ],
            ];

            // check parent
            if (empty($contact['customer_group_id'])) {
                $family_members = Contact::where('contact_id', $contact['contact_id'])
                    //  ->where('relationship', '!=', 'parent')
                    ->where('customer_group_id', '!=', null)
                    ->get();

                $familyMem = [];
                foreach ($family_members as $k => $val) {
                    $familyMem[$k] = [
                        'id' => $val['id'],
                        'full_name' => $val['name'],
                        'contact_id' => $val['contact_id'],
                        'profile_image' => $val['image'],
                        'relationship' => $val['relationship'],
                    ];
                }

                $data['family_members'] = $familyMem;
            }

            $data['last_payment_details'] = $this->getPayContactDue($contact['id']);

            $data['events'] = Events::where('end_date', '>=', date('YYYY-mm-dd'))
                ->orWhere('forever', 1)
                ->get('img');
            $data['services'] =  Service::get();
            $data['base_url'] = asset('/');

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

    public function get_activity(Request $request)
    {
        try {
            $customer_id = $request->input('customer_id');
            $month_search = $request->input('month_search');
            $month_date = explode('/', $month_search);

            $customer = Contact::where('id', $customer_id)->first();

            $query = CustomersActivities::with([
                'customers' => function ($query) {
                    $query->select(
                        'id',
                        'prefix',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'relationship'
                    );
                },
                'users' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                },
                'services' => function ($query) {
                    $query->select('id', 'name', 'slug', 'fee');
                },
            ]);

            // check parent and child customer
            if (empty($customer->customer_group_id)) {
                $query = $query->where('contact_id', $customer->contact_id);
            } else {
                $query = $query->where('customer_id', $customer_id);
            }

            // Month Filter
            if (!empty($month_search)) {
                $query = $query
                    ->whereYear('created_at', $month_date[1])
                    ->whereMonth('created_at', $month_date[0]);
            }

            $CustomersActivityget = $query->latest()->get();

            $output = [
                'status' => 'success',
                'data' => $CustomersActivityget,
            ];
        } catch (\Exception $e) {
            $output = ['status' => 'error', 'msg' => __('messages.something_went_wrong')];
        }

        return response()->json($output);
    }

    public function getPayContactDue($contact_id)
    {
        $query = Contact::where('contacts.id', $contact_id)->join(
            'transactions AS t',
            'contacts.id',
            '=',
            't.contact_id'
        );

        $query->select(
            \DB::raw(
                "SUM(IF(t.type = 'sell' AND t.status = 'final', final_total, 0)) as total_invoice"
            ),
            \DB::raw(
                "SUM(IF(t.type = 'sell' AND t.status = 'final', (SELECT SUM(IF(is_return = 1,-1*amount,amount)) FROM transaction_payments WHERE transaction_payments.transaction_id=t.id), 0)) as total_paid"
            ),
            'contacts.name',
            'contacts.supplier_business_name',
            'contacts.id as contact_id'
        );

        //Query for opening balance details
        $query->addSelect(
            \DB::raw("SUM(IF(t.type = 'opening_balance', final_total, 0)) as opening_balance"),
            \DB::raw(
                "SUM(IF(t.type = 'opening_balance', (SELECT SUM(amount) FROM transaction_payments WHERE transaction_payments.transaction_id=t.id), 0)) as opening_balance_paid"
            )
        );
        $contact_details = $query->first();

        $payment_line = new TransactionPayment();
        $contact_details->total_invoice = empty($contact_details->total_invoice)
            ? 0
            : $contact_details->total_invoice;

        //If opening balance due exists add to payment amount
        $contact_details->opening_balance = !empty($contact_details->opening_balance)
            ? $contact_details->opening_balance
            : 0;
        $contact_details->opening_balance_paid = !empty($contact_details->opening_balance_paid)
            ? $contact_details->opening_balance_paid
            : 0;
        $ob_due = $contact_details->opening_balance - $contact_details->opening_balance_paid;
        if ($ob_due > 0) {
            $payment_line->amount += $ob_due;
        }

        $contact_details->total_paid = empty($contact_details->total_paid)
            ? 0
            : $contact_details->total_paid;
        return $arrayName = ['contact_details' => $contact_details, 'ob_due' => $ob_due];
    }
}
