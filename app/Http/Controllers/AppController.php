<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\TransactionPayment;



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
            unset($contact['password']);
            return response()->json([
                'status' =>  'sucess',
                'data'   =>  ['user'=>$contact,'home_data'=>['https://www.adspeed.com/placeholder-300x250.gif','https://www.adspeed.com/placeholder-300x250.gif','https://www.adspeed.com/placeholder-300x250.gif','family_members'=>$family_members,'last_payment_details'=>$this->getPayContactDue($contact['contact_id'])]]
                
            ]);
        } 
        return response()->json([
            'status' => 'error',
            'msg' => 'Wrong password',
        ]);

    }


    public function getPayContactDue($contact_id)
    {
        
            $query = Contact::where('contacts.id', $contact_id)
                            ->join('transactions AS t', 'contacts.id', '=', 't.contact_id');
          
                $query->select(
                    \DB::raw("SUM(IF(t.type = 'sell' AND t.status = 'final', final_total, 0)) as total_invoice"),
                    \DB::raw("SUM(IF(t.type = 'sell' AND t.status = 'final', (SELECT SUM(IF(is_return = 1,-1*amount,amount)) FROM transaction_payments WHERE transaction_payments.transaction_id=t.id), 0)) as total_paid"),
                    'contacts.name',
                    'contacts.supplier_business_name',
                    'contacts.id as contact_id'
                );
            
            //Query for opening balance details
            $query->addSelect(
                \DB::raw("SUM(IF(t.type = 'opening_balance', final_total, 0)) as opening_balance"),
                \DB::raw("SUM(IF(t.type = 'opening_balance', (SELECT SUM(amount) FROM transaction_payments WHERE transaction_payments.transaction_id=t.id), 0)) as opening_balance_paid")
            );
            $contact_details = $query->first();
            
            $payment_line = new TransactionPayment();
            $contact_details->total_invoice = empty($contact_details->total_invoice) ? 0 : $contact_details->total_invoice;

            //If opening balance due exists add to payment amount
            $contact_details->opening_balance = !empty($contact_details->opening_balance) ? $contact_details->opening_balance : 0;
            $contact_details->opening_balance_paid = !empty($contact_details->opening_balance_paid) ? $contact_details->opening_balance_paid : 0;
            $ob_due = $contact_details->opening_balance - $contact_details->opening_balance_paid;
            if ($ob_due > 0) {
                $payment_line->amount += $ob_due;
            }

            $contact_details->total_paid = empty($contact_details->total_paid) ? 0 : $contact_details->total_paid;
            return $arrayName = array('contact_details' =>$contact_details ,'ob_due' =>$ob_due);
        
    }
}