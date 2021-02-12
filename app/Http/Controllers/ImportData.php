<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\import_data_table;

class ImportData extends Controller
{
    public function index(){
        $details = DB::table('import_data_table')->paginate('300');
        
        return view('import_data.import_data')->with(compact('details'));
    }


    public function import($id){
        $data = DB::table('import_data_table')->where('id',$id)->get();
        //generating QR code
        $s=  \App\Helpers\CommonHelpers:: encrypt_user_id($data[0]->id);
        $qr_code = \App\Helpers\CommonHelpers::qrcode_genrate($s,$data[0]->id.'-'.$data[0]->id.'-'.date('YmdHis').'.png');
        
        $contact = array(
            'business_id'           => 1,
            'name'                  => $data[0]->Name,
            'prefix'                => $data[0]->prefix,
            'first_name'            => $data[0]->first_name,
            'middle_name'           => $data[0]->middle_name ,
            'last_name'             => $data[0]->last_name,
            'relationship'          => $data[0]->relationship,
            'email'                 => $data[0]->Email,
            'contact_id'            => $data[0]->MembershipID,
            'city'                  => $data[0]->City,
            'address_line_1'        => $data[0]->Address,
            'dob'                   => $data[0]->DateOfBirth,
            'mobile'                => $data[0]->MobileNo,
            'marital_status'        => $data[0]->MaritalStatus,
            'qualification'         => $data[0]->Education,
            'proposer_name'         => $data[0]->Proposer1Name,
            'proposer_member_id'    => $data[0]->Proposer1MembershipNo,
            'proposer_number'       => $data[0]->Proposer1PhoneNo,
            'seconder_name'         => $data[0]->Proposer2Name,
            'seconder_member_id'    => $data[0]->Proposer2MembershipNo,
            'seconder_number'       => $data[0]->Proposer2PhoneNo,
            'image'                 => $data[0]->image,
            'application_date'      => $data[0]->AppicationDate,
            'approval_date'         => $data[0]->ApprovalDate,
            'age'                   => $data[0]->Age,
            'MembershipType'        => $data[0]->MembershipType,
            'CNIC'                  => $data[0]->CNICNO,
            'qr_code'              => $qr_code,
            'created_by'            => 1
        );

        foreach($contact AS $data){
            if($data == "" && empty($data)){
                 return redirect()->back()->with('msg','Please fill all fields');

            }
        }
        
        DB::table('contacts')->insert($contact);
        DB::table('import_data_table')->where('id',$id)->update(['is_import'=>1]);
        return redirect('/import-data')->with('msg','Data Has Been Imported To Contacts');
    }

    public function importEdit($id){
        $data = DB::table('import_data_table')->where('id',$id)->get();
    
        return view('import_data.import_edit')->with(compact('data'));
    }

    public function importUpdate(Request $req,$id){
        
        $data = $req->all();
        unset($data['_token']);
        
        if($req->file('image')){
             $data['image']=  \App\Helpers\CommonHelpers::uploadSingleFile($req->file('image'), 'upload/import_data_table_images/', 'png,gif,jpeg,jpg');
             if(isset($data['old_image']) &&file_exists($data['old_image'])){
                 unlink($data['old_image']);
                }
        }
        unset($data['old_image']);
        
        DB::table('import_data_table')->where('id',$id)->update($data);
        
        return redirect('/import-data')->with('msg','Record has been Updated');
    }

    public function importDelete($id){
        DB::table('import_data_table')->where('id',$id)->delete();
        return redirect('import-data')->with('msg','Data Has Been Deleted');
    }

    public function orderBy($id){
        if(isset($id) && $id == 'spouse'){
            
            $details = DB::table('import_data_table')->where('is_spouse',1)->paginate('300');
            $order_by = "Order By Spouse/Child";
            return view('import_data.import_data')->with(compact('details','order_by'));
        
        }elseif(isset($id) && $id == 'import'){
            
            $details = DB::table('import_data_table')->where('is_import',0)->paginate('300');
            $order_by = "Order By Import";
            return view('import_data.import_data')->with(compact('details','order_by'));
        
        }elseif(isset($id) && $id == 'parents'){
            
            $details = DB::table('import_data_table')->where('is_spouse',0)->paginate('300');
            $order_by = "Order By Parents";
            return view('import_data.import_data')->with(compact('details','order_by'));
        
        }
        return redirect('/import-data');
    }
}
