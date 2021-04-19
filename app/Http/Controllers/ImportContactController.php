<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ImportContact;
use Illuminate\Support\Facades\Hash;

class ImportContactController extends Controller
{
    public function index(){
        $details = DB::table('import_data_table')->where('is_import',0)->where('is_spouse',0)->paginate('300');
        return view('import_data.import_data')->with(compact('details'));
    }


    public function import($id){
        $data = DB::table('import_data_table')->where('id',$id)->get();
        $n = $data ;
        
        // //generating QR code
         $s=  \App\Helpers\CommonHelpers:: encrypt_user_id($data[0]->id);
          $qr_code = \App\Helpers\CommonHelpers::qrcode_genrate($s,$data[0]->id.'-'.$data[0]->id.'-'.date('YmdHis').'.png');
        
        $contact = array(
            'business_id'           => 1,
            'type'                  => 'customer',
            'name'                  => $data[0]->Name,
            'qr_code'               => $qr_code,
            'signature_proposer'    => $data[0]->Proposer1Signature,
            'signature_seconder'    => $data[0]->Proposer2Signature,
            // 'type'                  => $data[0]->type,
            'prefix'                => $data[0]->prefix,
            'first_name'            => $data[0]->first_name,
            'middle_name'           => $data[0]->middle_name ,
            'last_name'             => $data[0]->last_name,
            'relationship'          => $data[0]->relationship,
            'email'                 => $data[0]->Email,
            'password'              => Hash::make($data[0]->password),
            'contact_id'            => $data[0]->MembershipID,
            'city'                  => $data[0]->City,
            'tax_number'            => $data[0]->tax_number,
            'state'                 => $data[0]->state,
            'country'               => $data[0]->country,
            'zip_code'              => $data[0]->zipcode,
            'address_line_1'        => $data[0]->Address,
            'dob'                   => $data[0]->DateOfBirth,
            'mobile'                => $data[0]->MobileNo,
            'landline'              => $data[0]->landline,
            'alternate_number'      => $data[0]->alternate_number, 
            'Religion'              => $data[0]->Religion,
            'SO_DO_WO'              => $data[0]->SO_DO_WO,
            'BloodGroup'            => $data[0]->BloodGroup,
            'Profession'            => $data[0]->Profession,
            'supplier_business_name' => $data[0]->supplier_business_name,
            'PresentPosting'        => $data[0]->PresentPosting,
            'DateOfBirthInWords'    => $data[0]->DateOfBirthInWords,
            'FaxNo'                 => $data[0]->FaxNo,
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
            // 'qr_code'               =>  $qr_code,
            'created_by'            =>  1
        );
        //check if any parent field is empty then redirect back
        foreach($contact AS $data){
            if($data == "" OR empty($data)){
                return redirect()->back()->with('msg','Please fill all fields of membersipID '.$contact['contact_id']);
            }
        }
        
<<<<<<< HEAD:app/Http/Controllers/ImportData.php
        DB::table('contacts')->insert($contact);
        DB::table('import_data_table')->where('id',$id)->update(['is_import'=>1]);
        
        $new_data = DB::table('import_data_table')->where('MembershipID',$n[0]->MembershipID)->where('is_spouse',1)->get();
        // dd($new_data);
=======
        DB::table('contacts')->insert($contact);//insert data in contact
        DB::table('import_data_table')->where('id',$id)->update(['is_import'=>1]);//set import 1
        
        $f = $n[0]->MembershipID;
        if(is_numeric($f[0])){
           $f =  (int)$n[0]->MembershipID;;
        }
            
        
       //get the spouse data by parent membership ID
        $new_data = DB::table('import_data_table')->where('MembershipID',$f)->where('is_spouse',1)->get();

>>>>>>> a6b3ba015e0386ba606ffd306ca3902d9342b20b:app/Http/Controllers/ImportContactController.php
        foreach($new_data AS $spouse_data){
            if(!empty($spouse_data->Name)){
            
                 $new_s=  \App\Helpers\CommonHelpers:: encrypt_user_id($spouse_data->id);
                 $new_qr_code = \App\Helpers\CommonHelpers::qrcode_genrate($new_s,$spouse_data->id.'-'.$spouse_data->id.'-'.date('YmdHis').'.png');

                $array = array(
                    'business_id'    => 1,
                    'prefix'         => $spouse_data->prefix,
                    'type'           =>'customer',
                    'first_name'     => $spouse_data->first_name,
                    'middle_name'    => $spouse_data->middle_name,
                    'last_name'      => $spouse_data->last_name,
                    'name'           => $spouse_data->Name,
                    'marital_status' => $spouse_data->MaritalStatus,
                    'relationship'   => $spouse_data->relationship,
                    'dob'            => $spouse_data->DateOfBirth,
                    'email'          => $spouse_data->Email,
                    'qualification'  => $spouse_data->Education,
                    'mobile'         => $spouse_data->MobileNo,
                    'image'          => $spouse_data->image,
                    //'id'            => $spouse_data->id,
                    'created_by'     =>  1,
                    'contact_id'     => $contact['contact_id'],//parent membership ID
                    'qr_code'        =>  $new_qr_code,
                );

               DB::table('contacts')->insert($array);//insert record in contact
               DB::table('import_data_table')->where('id',$spouse_data->id)->update(['is_import'=>1]);//set import 1
            }   
        }
        
        return redirect('/import-data')->with('msg','Data Has Been Imported To Contacts');
    }

    public function importEdit($id){
        $data = DB::table('import_data_table')->where('id',$id)->first();
        $f = $data->MembershipID;
        if(is_numeric($f[0])){
           $f =  (int)$data->MembershipID;;
        }
            
        
        $spouses = DB::table('import_data_table')->where('MembershipID',$f)->where('is_spouse',1)->get();
    
        return view('import_data.import_edit')->with(compact('data','spouses'));
    }

    public function importUpdate(Request $req,$id){
        $data = $req->all();
        if(isset($data['family'])){
            
            foreach($data['family'] AS $key=>$val){            
           
            if(@$data['family'][$key]['image']){
                 $data['family'][$key]['image'] =  \App\Helpers\CommonHelpers::uploadSingleFile($data['family'][$key]['image'], 'upload/import_data_table_images/', 'png,gif,jpeg,jpg');
                 DB::table('import_data_table')->where('id',$data['family'][$key]['ID'])->update(['prefix'=>$data['family'][$key]['prefix'],'first_name'=>$data['family'][$key]['first_name'],'middle_name'=>$data['family'][$key]['middle_name'],'last_name'=>$data['family'][$key]['last_name'],'Name'=>$data['family'][$key]['Name'],'MaritalStatus'=>$data['family'][$key]['MaritalStatus'],'relationship'=>$data['family'][$key]['relationship'],'DateOfBirth'=>$data['family'][$key]['DateOfBirth'],'Email'=>$data['family'][$key]['Email'],'Education'=>$data['family'][$key]['Education'],'MobileNo'=>$data['family'][$key]['MobileNo'],'image'=>$data['family'][$key]['image']]);
            }else{
                DB::table('import_data_table')->where('id',$data['family'][$key]['ID'])->update(['prefix'=>$data['family'][$key]['prefix'],'first_name'=>$data['family'][$key]['first_name'],'middle_name'=>$data['family'][$key]['middle_name'],'last_name'=>$data['family'][$key]['last_name'],'Name'=>$data['family'][$key]['Name'],'MaritalStatus'=>$data['family'][$key]['MaritalStatus'],'relationship'=>$data['family'][$key]['relationship'],'DateOfBirth'=>$data['family'][$key]['DateOfBirth'],'Email'=>$data['family'][$key]['Email'],'Education'=>$data['family'][$key]['Education'],'MobileNo'=>$data['family'][$key]['MobileNo']]);
             }  
            }
        }
          
        
        unset($data['_token']);
        
        if($req->file('image')){
             $data['parent']['image']=  \App\Helpers\CommonHelpers::uploadSingleFile($req->file('image'), 'upload/import_data_table_images/', 'png,gif,jpeg,jpg');
             if(isset($data['old_image']) &&file_exists($data['old_image'])){
                 unlink($data['old_image']);
                }
        }
        if($req->file('Proposer1Signature')){
             $data['parent']['Proposer1Signature']=  \App\Helpers\CommonHelpers::uploadSingleFile($req->file('Proposer1Signature'), 'upload/import_data_table_images/proposers_signatures/', 'png,gif,jpeg,jpg');
             if(isset($data['OldProposer1Signature']) &&file_exists($data['OldProposer1Signature'])){
                 unlink($data['OldProposer1Signature']);
                }
        }
        if($req->file('Proposer2Signature')){
             $data['parent']['Proposer2Signature']=  \App\Helpers\CommonHelpers::uploadSingleFile($req->file('Proposer2Signature'), 'upload/import_data_table_images/proposers_signatures/', 'png,gif,jpeg,jpg');
             if(isset($data['OldProposer2Signature']) &&file_exists($data['Proposer2Signature'])){
                 unlink($data['OldProposer2Signature']);
                }
        }
       
        unset($data['old_image']);
        unset($data['OldProposer1Signature']);
        unset($data['OldProposer2Signature']);
        
        DB::table('import_data_table')->where('id',$id)->update($data['parent']);

        
        return redirect('/import-data')->with('msg','Record has been Updated');
    }

    public function importDelete($id){
        //getting membersgip ID by using parent ID
        $id = DB::table('import_data_table')->where('id',$id)->first();
        //getting the membvership ID so we can delete all the records based on Membersip ID
        $MembershipID = DB::table('import_data_table')->where('MembershipID',$id->MembershipID)->get();
        
        
        foreach($MembershipID AS $id){
            DB::table('import_data_table')->where('MembershipID',$id->MembershipID)->delete();
        }

         return redirect('/import-data')->with('msg','Record has been Deleted');
    }

    // public function orderBy($id){
    //     if(isset($id) && $id == 'spouse'){
            
    //         $details = DB::table('import_data_table')->where('is_spouse',1)->where('is_import',0)->paginate('300');
    //         $order_by = "Order By Spouse/Child";
    //         return view('import_data.import_data')->with(compact('details','order_by'));
        
    //     }elseif(isset($id) && $id == 'import'){
            
    //         $details = DB::table('import_data_table')->where('is_import',1)->paginate('300');
    //         $order_by = "Order By Imported";
    //         return view('import_data.import_data')->with(compact('details','order_by'));
        
    //     }elseif(isset($id) && $id == 'parents'){
            
    //         $details = DB::table('import_data_table')->where('is_spouse',0)->where('is_import',0)->paginate('300');
    //         $order_by = "Order By Parents";
    //         return view('import_data.import_data')->with(compact('details','order_by'));
        
    //     }
    //     return redirect('/import-data');
    // }

    //search function
    function search(Request $req){
        
        $data = $req->all();
        
        $details = DB::table('import_data_table')
                        ->where('MembershipID', 'like', '%'.$data['search'].'%')
                        ->orWhere('Name', 'like', '%'.$data['search'].'%')
                        ->orWhere('MembershipType', 'like', '%'.$data['search'].'%')
                        ->orWhere('CNICNO', 'like', '%'.$data['search'].'%')
                        ->orWhere('MobileNo', 'like', '%'.$data['search'].'%')
                        ->paginate('300');
                                     
        return view('import_data.import_data')->with(compact('details'));   
    }
}