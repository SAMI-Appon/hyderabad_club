@extends('layouts.app')
@section('title','Edit-Memeber')

@section('content')
<br>
    <form action="{{url('/import-update/'.$data[0]->id)}}" class="mt-2" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                @if($data[0]->is_spouse == 0)
                <label>Membership ID</label>
                @else
                <label>Family Member OF</label>
                @endif
                <input type="text" class="form-control"   name="MembershipID" value="{{$data[0]->MembershipID}}">
            </div>
            <div class="form-group col-md-3">
                <label>Membership Type</label>
                <input type="text" class="form-control"   name="MembershipType" value="{{$data[0]->MembershipType}}">
            </div>
            <div class="form-group col-md-3">
                <label>Type</label>
                <input type="text" class="form-control"   name="type" value="{{$data[0]->type}}">
            </div>
            <div class="form-group col-md-3">
                <label>Prefix</label>
                <input type="text" class="form-control"   name="prefix" value="{{$data[0]->prefix}}">
            </div>
            <div class="form-group col-md-3">
                <label>First Name</label>
                <input type="text" class="form-control"   name="first_name" value="{{$data[0]->first_name}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>middle_name</label>
                <input type="text" class="form-control"   name="middle_name" value="{{$data[0]->middle_name}}">
            </div>
            <div class="form-group col-md-3">
                <label>Last Name</label>
                <input type="text" class="form-control"   name="last_name" value="{{$data[0]->last_name}}">
            </div>
            <div class="form-group col-md-3">
                <label>Name</label>
                <input type="text" class="form-control"   name="Name" value="{{$data[0]->Name}}">
            </div>
            <div class="form-group col-md-3">
                <label>Gender</label>
                <input type="text" class="form-control"   name="Gender" value="{{$data[0]->Gender}}">
            </div>
            
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Age</label>
                <input type="text" class="form-control"   name="Age" value="{{$data[0]->Age}}">
            </div>
            <div class="form-group col-md-3">
                <label>Religion</label>
                <input type="text" class="form-control"   name="Religion" value="{{$data[0]->Religion}}">
            </div>
            <div class="form-group col-md-3">
                <label>S/O-D/O-W/O</label>
                <input type="text" class="form-control"   name="SO_DO_WO" value="{{$data[0]->SO_DO_WO }}">
            </div>
            <div class="form-group col-md-3">
                <label>CNICNO</label>
                <input type="text" class="form-control"   name="CNICNO" value="{{$data[0]->CNICNO}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>BloodGroup</label>
                <input type="text" class="form-control"   name="BloodGroup" value="{{$data[0]->BloodGroup}}">
            </div>
            <div class="form-group col-md-3">
                <label>Profession</label>
                <input type="text" class="form-control"   name="Profession" value="{{$data[0]->Profession}}">
            </div>
            <div class="form-group col-md-3">
                <label>Supplier Business Name</label>
                <input type="text" class="form-control"   name="supplier_business_name" value="{{$data[0]->supplier_business_name}}">
            </div>
            <div class="form-group col-md-3">
                <label>PresentPosting</label>
                <input type="text" class="form-control"   name="PresentPosting" value="{{$data[0]->PresentPosting}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nature Of Business </label>
                <input type="text" class="form-control"   name="NatureOfBusiness" value="{{$data[0]->NatureOfBusiness}}">
            </div>
            <div class="form-group col-md-3">
                <label>Date Of Birth</label>
                <input type="text" class="form-control"   name="DateOfBirth" value="{{$data[0]->DateOfBirth}}">
            </div>
            <div class="form-group col-md-3">
                <label>Date Of Birth In Words</label>
                <input type="text" class="form-control"   name="DateOfBirthInWords" value="{{$data[0]->DateOfBirthInWords}}">
            </div>
            <div class="form-group col-md-3">
                <label>MaritalStatus</label>
                <input type="text" class="form-control"   name="MaritalStatus" value="{{$data[0]->MaritalStatus}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Qualification</label>
                <input type="text" class="form-control"   name="Education" value="{{$data[0]->Education}}" > 
            </div>
            <div class="form-group col-md-3">
                <label>Address</label>
                <input type="text" class="form-control"   name="Address" value="{{$data[0]->Address}}">
            </div>
            <div class="form-group col-md-3">
                <label>City</label>
                <input type="text" class="form-control"   name="City" value="{{$data[0]->City}}">
            </div>
            <div class="form-group col-md-3">
                <label>State</label>
                <input type="text" class="form-control"   name="state" value="{{$data[0]->state}}">
            </div>
            <div class="form-group col-md-3">
                <label>Country</label>
                <input type="text" class="form-control"   name="country" value="{{$data[0]->country}}">
            </div>
            <div class="form-group col-md-3">
                <label>Zip Code</label>
                <input type="text" class="form-control"   name="zipcode" value="{{$data[0]->zipcode}}">
            </div>
            <div class="form-group col-md-3">
                <label>AddressSince</label>
                <input type="text" class="form-control"   name="AddressSince" value="{{$data[0]->AddressSince}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>ResidentailPhoneNo</label>
                <input type="text" class="form-control"   name="ResidentailPhoneNo" value="{{$data[0]->ResidentailPhoneNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>OfiicePhoneNo</label>
                <input type="text" class="form-control"   name="OfiicePhoneNo" value="{{$data[0]->OfiicePhoneNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>FaxNo</label>
                <input type="text" class="form-control"   name="FaxNo" value="{{$data[0]->FaxNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>MobileNo</label>
                <input type="text" class="form-control"   name="MobileNo" value="{{$data[0]->MobileNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>Landline</label>
                <input type="text" class="form-control"   name="landline" value="{{$data[0]->landline}}">
            </div>
            <div class="form-group col-md-3">
                <label>Alternate Number</label>
                <input type="text" class="form-control"   name="alternate_number" value="{{$data[0]->alternate_number}}">
            </div>
            <div class="form-group col-md-3">
                <label>Tax No</label>
                <input type="text" class="form-control"   name="tax_number" value="{{$data[0]->tax_number}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Email</label>
                <input type="text" class="form-control"   name="Email" value="{{$data[0]->Email}}">
            </div>
            <div class="form-group col-md-3">
                <label>Password</label>
                <input type="password" class="form-control"   name="password" value="{{$data[0]->password}}">
            </div>
            <div class="form-group col-md-3">
                <label>Proposer1Name</label>
                <input type="text" class="form-control"   name="Proposer1Name" value="{{$data[0]->Proposer1Name}}">
            </div>
            <div class="form-group col-md-3">
                <label>Proposer1MembershipNo</label>
                <input type="text" class="form-control"   name="Proposer1MembershipNo" value="{{$data[0]->Proposer1MembershipNo}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Proposer2Name</label>
                <input type="text" class="form-control"   name="Proposer2Name" value="{{$data[0]->Proposer2Name}}">
            </div>
            <div class="form-group col-md-3">
                <label>Proposer2MembershipNo</label>
                <input type="text" class="form-control"   name="Proposer2MembershipNo" value="{{$data[0]->Proposer2MembershipNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>Proposer2PhoneNo</label>
                <input type="text" class="form-control"   name="Proposer2PhoneNo" value="{{$data[0]->Proposer2PhoneNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>AppicationDate</label>
                <input type="text" class="form-control"   name="AppicationDate" value="{{$data[0]->AppicationDate}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>ApprovedFlag</label>
                <input type="text" class="form-control"   name="ApprovedFlag" value="{{$data[0]->ApprovedFlag}}">
            </div>
            <div class="form-group col-md-3">
                <label>ApprovalDate</label>
                <input type="text" class="form-control"   name="ApprovalDate" value="{{$data[0]->ApprovalDate}}">
            </div>
            <div class="form-group col-md-3">
                <label>Last_Month_Of_Billing</label>
                <input type="text" class="form-control"   name="Last_Month_Of_Billing" value="{{$data[0]->Last_Month_Of_Billing}}">
            </div>
            <div class="form-group col-md-3">
                <label>MonthlyCharges</label>
                <input type="text" class="form-control"   name="MonthlyCharges" value="{{$data[0]->MonthlyCharges}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>PrintBill</label>
                <input type="text" class="form-control"   name="PrintBill" value="{{$data[0]->PrintBill}}">
            </div>
            <div class="form-group col-md-3">
                <label>OpeningBalance</label>
                <input type="text" class="form-control"   name="OpeningBalance" value="{{$data[0]->OpeningBalance}}">
            </div>
            <div class="form-group col-md-3">
                <label>MaxBillNo</label>
                <input type="text" class="form-control"   name="MaxBillNo" value="{{$data[0]->MaxBillNo}}">
            </div>
            <div class="form-group col-md-3">
                <label>TmpOpeningBalance</label>
                <input type="text" class="form-control"   name="TmpOpeningBalance" value="{{$data[0]->TmpOpeningBalance}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Closing No</label>
                <input type="text" class="form-control"   name="Closing_No" value="{{$data[0]->Closing_No}}">
            </div>
            <div class="form-group col-md-3">
                <label>Closing Date</label>
                <input type="text" class="form-control"   name="ClosingDate" value="{{$data[0]->ClosingDate}}">
            </div>
            <div class="form-group col-md-3">
                <label>Closing Remarks</label>
                <input type="text" class="form-control"   name="Closing_Remarks" value="{{$data[0]->Closing_Remarks}}">
            </div>
            <div class="form-group col-md-3">
                <label>Terminate</label>
                <input type="text" class="form-control"   name="Terminate" value="{{$data[0]->Terminate}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Termination Remarks</label>
                <input type="text" class="form-control"   name="Termination_Remarks" value="{{$data[0]->Termination_Remarks}}">
            </div>
            <div class="form-group col-md-3">
                <label>Relationship</label>
                {{-- <input type="text" class="form-control"   name="relationship" value="{{$data[0]->relationship}}"> --}}
                <div class="form-group">
                    <select class="form-control" name="relationship">
                        <option value="">Select Relation</option>
                        <option value="spouse" <?php if($data[0]->relationship == 'spouse') echo "selected"; ?>>Spouse</option>
                        <option value="son" <?php if($data[0]->relationship == 'son') echo "selected"; ?>>Son</option>
                        <option value="daughter" <?php if($data[0]->relationship == 'daughter') echo "selected"; ?>>Daughter</option>
                        <option value="parent" <?php if($data[0]->relationship == 'parent') echo "selected"; ?>>Parent</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>Propoer 1 Signature</label>
                <input type="file" class="form-control-file"   name="Proposer1Signature" value="">
                @if(file_exists($data[0]->Proposer1Signature))
                <img src="{{asset($data[0]->Proposer1Signature)}}" alt="" width="50%" height="100px">
                <input type="hidden" value="{{$data[0]->Proposer1Signature}}" name="OldProposer1Signature">
                @endif
            </div>
            <div class="form-group col-md-3">
                <label>Propoer 2 Signature</label>
                <input type="file" class="form-control-file"   name="Proposer2Signature" value="">
                @if(file_exists($data[0]->Proposer2Signature))
                <img src="{{asset($data[0]->Proposer2Signature)}}" alt="" width="50%" height="100px">
                <input type="hidden" value="{{$data[0]->Proposer2Signature}}" name="OldProposer2Signature">
                @endif
            </div>
            {{-- <div class="form-group col-md-3">
                <label>is_import</label>`
                <input type="text" class="form-control"   name="is_import" value="{{$data[0]->is_import}}">
            </div>
            <div class="form-group col-md-3">
                <label>is_spouse</label>
                <input type="text" class="form-control"   name="is_spouse" value="{{$data[0]->is_spouse}}">
            </div>     --}}
            <div class="form-group col-md-3">
                <label>Image</label>
                <input type="file" class="form-control-file"   name="image" value="">
                @if(file_exists($data[0]->image))
                <img src="{{asset($data[0]->image)}}" alt="" width="50%" height="100px">
                <input type="hidden" value="{{$data[0]->image}}" name="old_image">
                @endif
            </div>
            <div class="row">
            <div class="form-group col-md-10" style="margin-left:20px">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
            </div>
        </div>
        {{-- <div class="form-row">
            <div class="form-group col-md-3">
                <label>Image</label>
                <input type="file" class="form-control-file"   name="image" value="">
            </div>
            <div class="form-group col-md-3">
                @if(file_exists($data[0]->image))
                <img src="{{asset($data[0]->image)}}" alt="" width="50%" height="100px">
                <input type="hidden" value="{{$data[0]->image}}" name="old_image">
                @endif
            </div>
            <div class="form-group col-md-3"></div>
            <div class="form-group col-md-3"></div>     
        </div>  --}}
        {{-- <div class="col-sm-12 float-right">
            <input type="submit" class="btn btn-primary" value="Update">
        </div> --}}
      <div class="row">
        <div class="col-md-12"></div>      
     </div>      
      
           
    </form>
@endsection
