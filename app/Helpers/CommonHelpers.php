<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Helpers\Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CommonHelpers
{

    public static function send_email($view, $data, $to, $subject = 'Welcome !', $from_email = null, $from_name = null)
    {
        $from_name = $from_name ?? config('mail.from.address');
        $from_email = $from_email ?? config('mail.from.address');

        $data = (array) $data;
        $data['subject'] = $subject;
        $data['to'] = $to;
        $data['from_name'] = $from_name;
        $data['from_email'] = $from_email;

        $data['email_data'] = $data;
        try {
            Mail::send('emails.' . $view, $data, function ($message) use ($data) {
                $message->from($data['from_email'], $data['from_name']);
                $message->subject($data['subject']);
                $message->to($data['to']);
            });
            return true;
        } catch (Exception $ex) {
            return response()->json($ex);
        }
    }

    public static function uploadSingleFile($file, $path = 'upload/images/', $types = "png,gif,csv,jpeg,jpg", $filesize = '20000')
    {
        $path = $path . date('Y') . '/';
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $rules = array('file' => 'required|mimes:' . $types . "|max:" . $filesize);
        $validator = \Validator::make(array('file' => $file), $rules);
        if ($validator->passes()) {
            $rand = time() . "_" . \Str::random(15) . "_";
            $f_name = $rand . $file->getClientOriginalName();
            $filename = $path . $f_name;
            //full size image
            $file->move($path, $f_name);
            return $filename;
        } else {
            return ['error' => $validator->errors()->first('file')];
        }
    }

    public static function createThumbnail($file, $width, $height, $path = 'upload/images/')
    {
        $types    = "png,gif,jpeg";
        // $filesize = '20000';
        $path = $path . date('Y') . '/thumbnail/';
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $rules = array('file' => 'required|mimes:' . $types);
        $validator = \Validator::make(array('file' => $file), $rules);
        if ($validator->passes()) {
            $img = \Image::make($file->getRealPath());
            $rand = time() . "_" . \Str::random(15) . "_";
            $f_name = $rand . $file->getClientOriginalName();
            $filename = $path . $f_name;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($filename);
            return $filename;
        } else {
            return ['error' => $validator->errors()->first('file')];
        }
    }

    public static function date_format_custom($date, $month_name = true)
    {
        $format = 'd-m-Y';
        if ($month_name) {
            $format = 'd M, Y';
        }
        return date($format, strtotime($date));
    }

    public static function time_format_custom($time, $amPm = true)
    {
        $format = 'H:i';
        if ($amPm) {
            $format = 'h:i A';
        }
        return date($format, strtotime($time));
    }

    public static function date_time_full($dateTime)
    {
        return date('d M, Y | h:i A', strtotime($dateTime));
    }
    public static function today_date()
    {
        return date('Y-m-d H:i:s');
    }
    public static function rights($val)
    {
        if (auth()->user()->is_admin) {
            return false;
        } else {
            return json_decode(auth()->user()->rights)->$val ?? null;
        }
    }

    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public static function us_state()
    {   
        //these states are excluded
        // 'Oklahoma', 'Utah', 'Illinois'
        return [
            "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "District Of Columbia", "Florida", "Georgia", "Hawaii", "Idaho", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"

        ];
    }

    public static function subscribe(\App\User $user, \App\Package $package,$data)
    {
        // $package = \App\Package::whereType($user->user_role)->first();
        $subscriptionId = time();
        $refId = time();

        $res = Self::Recurring_payment($package->amount,$data['cardType'],$data['name'],$data['number'],$data['expiry'],$data['cvc']);
        $res = json_decode($res);
        if(isset($res->Error)){
            echo json_encode(array('error'=>$res->Error->messages[0]->description)); exit;
        }

        if(@$res->transaction_status=='declined'){
            echo json_encode(array('error'=>$res->bank_message)); exit;
        }
        // dd($res);
        // $subs = new CommonHelpers;  // correct
        // $subs_response = $subs->make_authorize_subs($token, $package->amount, $user);
        // $subs_response = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $subs_response));

        // $charge_reponse = null;
        // if ($subs_response->messages->resultCode == "Ok") {

        //     $customerProfileId = $subs_response->profile->customerProfileId;
        //     $paymentProfileId  = $subs_response->profile->customerPaymentProfileId;
        //     $response = $subs->create_charge($customerProfileId, $paymentProfileId, $package->amount);
        //     $response = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response));
        //     if ($response->messages->resultCode == "Ok") {
        //         $subscriptionId = $subs_response->subscriptionId;
        //         $refId = $subs_response->refId;
        //         $charge_reponse = $response;
        //     } else {
        //         return false;
        //     }
        // } else {
        //     return false;
        // }
        $refId = $res->retrieval_ref_no;
        $subscriptionId = $res->correlation_id;
        $subscription = new \App\UsersSubscription();
        $subscription->user_id = $user->id;
        $subscription->package_id = $package->id;
        $subscription->initial_amount = 0;
        $subscription->amount = $package->amount;
        $subscription->type = $user->user_role;
        $subscription->package_details = $package;
        $subscription->is_active = 1;
        $subscription->subscription_id = $subscriptionId;
        $subscription->refId = $refId;

        $ends_at = \Carbon\Carbon::now()->addMonths(1);

        $subscription->ends_at = $ends_at;
        $subscription->save();

        $invoice = new \App\SubscriptionsInvoice();
        $invoice->user_id = $user->id;
        $invoice->subscriptions_id = $subscription->id;
        $invoice->amount = $package->amount;
        $invoice->is_initial = 1;
        $invoice->status = 'paid';

        //! will come from merchant after payment 
        $invoice->transaction_id = $res->transaction_id ?? null;
        $invoice->transaction_data = $res ?? null;

        $invoice->ends_at = $ends_at;
        $invoice->save();
        
        return true;
    }

    public function make_authorize_subs($token, $amount, $user)
    {

        $refId = rand(1000000, 99999999);
        $curl = curl_init();
        $array = array(
            'ARBCreateSubscriptionRequest' =>
            array(
                'merchantAuthentication' =>
                array(
                    'name' => config('app.authorize_name'),
                    'transactionKey' => config('app.authorize_transaction_key'),
                ),
                'refId' => $refId,
                'subscription' =>
                array(
                    'name' => 'subscription',
                    'paymentSchedule' =>
                    array(
                        'interval' =>
                        array(
                            'length' => '1',
                            'unit' => 'months',
                        ),
                        'startDate' => date('Y-m-d'),
                        'totalOccurrences' => '9999',
                        'trialOccurrences' => '0',
                    ),
                    'amount' => $amount,
                    'trialAmount' => '0.00',
                    'payment' =>
                    array(
                        'opaqueData' =>
                        array(
                            'dataDescriptor' => 'COMMON.ACCEPT.INAPP.PAYMENT',
                            'dataValue' => $token,
                        ),
                    ),
                    'billTo' =>
                    array(
                        'firstName' => $user->first_name,
                        'lastName' => $user->last_name . '_' . $refId,
                    ),
                ),
            ),
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.authorize_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($array),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 6c4be427-e318-1523-be69-328a83fac092"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        }

        return  $response;
    }

    public function create_charge($customerProfileId, $paymentProfileId, $amount)
    {

        $refId = rand(1000000, 99999999);
        $arr = array(
            'createTransactionRequest' =>
            array(
                'merchantAuthentication' =>
                array(
                    'name' => config('app.authorize_name'),
                    'transactionKey' => config('app.authorize_transaction_key'),
                ),
                'refId' => $refId,
                'transactionRequest' =>
                array(
                    'transactionType' => 'authCaptureTransaction',
                    'amount' => $amount,
                    'profile' =>
                    array(
                        'customerProfileId' => $customerProfileId,
                        'paymentProfile' =>
                        array(
                            'paymentProfileId' => $paymentProfileId,
                        ),
                    ),
                    'transactionSettings' =>
                    array(
                        'setting' =>
                        array(
                            'settingName' =>  'testRequest',
                            'settingValue' => 'false',
                        ),
                    ),
                ),
            ),
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.authorize_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($arr),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 0f3fba98-0b67-9fc4-9681-fcb0c850c082"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }
    }


    public static function cancel_subs($refId, $subscriptionId)
    {

        $arr = array(
            'ARBCancelSubscriptionRequest' =>
            array(
                'merchantAuthentication' =>
                array(
                    'name' => config('app.authorize_name'),
                    'transactionKey' => config('app.authorize_transaction_key'),
                ),
                'refId' => $refId,
                'subscriptionId' => $subscriptionId,
            ),
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.authorize_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($arr),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 0f3fba98-0b67-9fc4-9681-fcb0c850c082"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }
  


    public static function do_payment($data)
    {
         
        $arr=array (
            'merchant_ref' => 'Astonishing-Sale',
            'transaction_type' => 'purchase',
            'method' => 'credit_card',
            'amount' => $data['amount'],
            'partial_redemption' => 'false',
            'currency_code' => 'USD',
            'credit_card' => 
            array (
              'type'            => $data['type'],
              'cardholder_name' => $data['name'],
              'card_number'     => str_replace(' ', '', $data['card_number']),
              'exp_date'        => str_replace(' ', '', str_replace('/','',$data['exp'])),
              'cvv'             => $data['cvv'],
            ),
        );
        $curl = curl_init();
        $api_key       = config('app.payeezy_api_key');
        $token         = config('app.payeezy_api_token');

        $arr           = json_encode($arr);
        $auth          = self::authorization_payeezy($arr); 

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL =>config('app.payeezy_api_url'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $arr,
        CURLOPT_HTTPHEADER => array(
            "apikey:$api_key",
            "cache-control:no-cache",
            "content-type:application/json",
            "postman-token:b675853a-5c4d-2a36-c220-9e1c75b79233",
            "token:$token",
            "Authorization:".$auth['Authorization'],
            "nonce:".$auth['nonce'],
            "timestamp:".$auth['timestamp']
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

 

    public static function get_min_year()
    {
        return  \App\Property::min('year_built');
    }

    public static function get_user_full_name()
    {
        return  auth('user')->user()->first_name . ' ' . auth('user')->user()->last_name;
    }
    

    public static function Recurring_payment($amount,$type,$card_name,$card_number,$exp,$cvv){

        $refId = rand(1000000, 99999999);
        // dd(str_replace(' ', '', str_replace('/','',$exp)));
        $arr =array (
            'transaction_type'  => 'recurring',
            'merchant_ref'      => $refId,
            'method'            => 'credit_card',
            'amount'            => $amount,
            'currency_code'     => 'USD',
            'credit_card'       => 
            array (
              'type'            => $type,
              'cardholder_name' => $card_name,
              'card_number'     => str_replace(' ', '', $card_number),
              'exp_date'        => str_replace(' ', '', str_replace('/','',$exp)),
              'cvv'             => $cvv,
            ),
        );
       
        $api_key       = config('app.payeezy_api_key');
        $token         = config('app.payeezy_api_token');

        $arr           = json_encode($arr);
        $auth          = self::authorization_payeezy($arr); 
        $curl          = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL =>config('app.payeezy_api_url'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $arr,
        CURLOPT_HTTPHEADER => array(
            "apikey:$api_key",
            "cache-control:no-cache",
            "content-type:application/json",
            "postman-token:b675853a-5c4d-2a36-c220-9e1c75b79233",
            "token:$token",
            "Authorization:".$auth['Authorization'],
            "nonce:".$auth['nonce'],
            "timestamp:".$auth['timestamp']

        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return  $response;
        }

    }
    public static function authorization_payeezy($data){

        $apiKey         = config('app.payeezy_api_key');
        $apiSecret      = config('app.payeezy_api_secret_key');
        $nonce          = Self::random_str(20);
        $timestamp      = strtotime('y-m-d H:i:s');
        $token          = config('app.payeezy_api_token');
        $payload        = $data;
        $data           = $apiKey . $nonce . $timestamp . $token . $payload;
        $hashAlgorithm  = "sha256";                                              
        $hmac           = hash_hmac ( $hashAlgorithm , $data , $apiSecret, false );                                
        $authorization  = base64_encode($hmac);
        $data =[
        'Authorization'=>$authorization,
        'nonce'=>$nonce,
        'timestamp'=>$timestamp
        ];
        return $data;
    }

    public static function random_str(
        $length,
        $keyspace = '0123456789101121241211514548545825118741241551'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new \Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }


    public static function qrcode_genrate($text,$file_name){
        $path=public_path('contacts_QrCode/');
        // $f =  'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.urlencode($text).'&choe=UTF-8';
        $path .= date('Y') . '/';
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        // file_put_contents($path.$file_name, file_get_contents($f));
        QrCode::size(400)->format('png')->generate($text,$path.$file_name);
        return 'Contacts_QrCode/'.date('Y/').$file_name ;

    }


    public static function encrypt_user_id($user_id){
        return base64_encode($user_id*2);
    }
    public static function decrypt_user_id($user_id){
         $user_id = base64_decode($user_id);
         return $user_id / 2;
    }
}
