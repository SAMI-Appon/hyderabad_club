@extends('layouts.app')
@section('title','Edit-Memeber')

@section('content')
<br>
<form action="{{url('/import-update/'.$data->id)}}" class="mt-2" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            @if($data->is_spouse == 0)
            <label>Membership ID</label>
            @else
            <label>Family Member OF</label>
            @endif
            <input type="text" class="form-control" name="parent[MembershipID]" value="{{$data->MembershipID}}">
        </div>
        <div class="form-group col-md-3">
            <label>Membership Type</label>
            <input type="text" class="form-control" name="parent[MembershipType]" value="{{$data->MembershipType}}">
        </div>
        <div class="form-group col-md-3">
            <label>Type</label>
            <input type="text" class="form-control" name="parent[type]" value="{{$data->type}}">
        </div>
        <div class="form-group col-md-3">
            <label>Prefix</label>
            <input type="text" class="form-control" name="parent[prefix]" value="{{$data->prefix}}">
        </div>
        <div class="form-group col-md-3">
            <label>First Name</label>
            <input type="text" class="form-control" name="parent[first_name]" value="{{$data->first_name}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>middle_name</label>
            <input type="text" class="form-control" name="parent[middle_name]" value="{{$data->middle_name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Last Name</label>
            <input type="text" class="form-control" name="parent[last_name]" value="{{$data->last_name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Name</label>
            <input type="text" class="form-control" name="parent[Name]" value="{{$data->Name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Gender</label>
            <input type="text" class="form-control" name="parent[Gender]" value="{{$data->Gender}}">
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Age</label>
            <input type="text" class="form-control" name="parent[Age]" value="{{$data->Age}}">
        </div>
        <div class="form-group col-md-3">
            <label>Religion</label>
            <input type="text" class="form-control" name="parent[Religion]" value="{{$data->Religion}}">
        </div>
        <div class="form-group col-md-3">
            <label>S/O-D/O-W/O</label>
            <input type="text" class="form-control" name="parent[SO_DO_WO]" value="{{$data->SO_DO_WO }}">
        </div>
        <div class="form-group col-md-3">
            <label>CNICNO</label>
            <input type="text" class="form-control" name="parent[CNICNO]" value="{{$data->CNICNO}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>BloodGroup</label>
            <input type="text" class="form-control" name="parent[BloodGroup]" value="{{$data->BloodGroup}}">
        </div>
        <div class="form-group col-md-3">
            <label>Profession</label>
            <input type="text" class="form-control" name="parent[Profession]" value="{{$data->Profession}}">
        </div>
        <div class="form-group col-md-3">
            <label>Supplier Business Name</label>
            <input type="text" class="form-control" name="parent[supplier_business_name]"
                value="{{$data->supplier_business_name}}">
        </div>
        <div class="form-group col-md-3">
            <label>PresentPosting</label>
            <input type="text" class="form-control" name="parent[PresentPosting]" value="{{$data->PresentPosting}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Nature Of Business </label>
            <input type="text" class="form-control" name="parent[NatureOfBusiness]" value="{{$data->NatureOfBusiness}}">
        </div>
        <div class="form-group col-md-3">
            <label>Date Of Birth</label>
            <input type="text" class="form-control" name="parent[DateOfBirth]" value="{{$data->DateOfBirth}}">
        </div>
        <div class="form-group col-md-3">
            <label>Date Of Birth In Words</label>
            <input type="text" class="form-control" name="parent[DateOfBirthInWords]"
                value="{{$data->DateOfBirthInWords}}">
        </div>
        <div class="form-group col-md-3">
            <label>MaritalStatus</label>
            <input type="text" class="form-control" name="parent[MaritalStatus]" value="{{$data->MaritalStatus}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Qualification</label>
            <input type="text" class="form-control" name="parent[Education]" value="{{$data->Education}}">
        </div>
        <div class="form-group col-md-3">
            <label>Address</label>
            <input type="text" class="form-control" name="parent[Address]" value="{{$data->Address}}">
        </div>
        <div class="form-group col-md-3">
            <label>City</label>
            <input type="text" class="form-control" name="parent[City]" value="{{$data->City}}">
        </div>
        <div class="form-group col-md-3">
            <label>State</label>
            <input type="text" class="form-control" name="parent[state]" value="{{$data->state}}">
        </div>
        <div class="form-group col-md-3">
            <label>Country</label>
            <input type="text" class="form-control" name="parent[country]" value="{{$data->country}}">
        </div>
        <div class="form-group col-md-3">
            <label>Zip Code</label>
            <input type="text" class="form-control" name="parent[zipcode]" value="{{$data->zipcode}}">
        </div>
        <div class="form-group col-md-3">
            <label>AddressSince</label>
            <input type="text" class="form-control" name="parent[AddressSince]" value="{{$data->AddressSince}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>ResidentailPhoneNo</label>
            <input type="text" class="form-control" name="parent[ResidentailPhoneNo]"
                value="{{$data->ResidentailPhoneNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>OfiicePhoneNo</label>
            <input type="text" class="form-control" name="parent[OfiicePhoneNo]" value="{{$data->OfiicePhoneNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>FaxNo</label>
            <input type="text" class="form-control" name="parent[FaxNo]" value="{{$data->FaxNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>MobileNo</label>
            <input type="text" class="form-control" name="parent[MobileNo]" value="{{$data->MobileNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>Landline</label>
            <input type="text" class="form-control" name="parent[landline]" value="{{$data->landline}}">
        </div>
        <div class="form-group col-md-3">
            <label>Alternate Number</label>
            <input type="text" class="form-control" name="parent[alternate_number]" value="{{$data->alternate_number}}"
                >
        </div>
        <div class="form-group col-md-3">
            <label>Tax No</label>
            <input type="text" class="form-control" name="parent[tax_number]" value="{{$data->tax_number}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" class="form-control" name="parent[Email]" value="{{$data->Email}}">
        </div>
        <div class="form-group col-md-3">
            <label>Password</label>
            <input type="password" class="form-control" name="parent[password]" value="{{$data->password}}">
        </div>
        <div class="form-group col-md-3">
            <label>Proposer1Name</label>
            <input type="text" class="form-control" name="parent[Proposer1Name]" value="{{$data->Proposer1Name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Proposer1MembershipNo</label>
            <input type="text" class="form-control" name="parent[Proposer1MembershipNo]"
                value="{{$data->Proposer1MembershipNo}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Proposer2Name</label>
            <input type="text" class="form-control" name="parent[Proposer2Name]" value="{{$data->Proposer2Name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Proposer2MembershipNo</label>
            <input type="text" class="form-control" name="parent[Proposer2MembershipNo]"
                value="{{$data->Proposer2MembershipNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>Proposer2PhoneNo</label>
            <input type="text" class="form-control" name="parent[Proposer2PhoneNo]" value="{{$data->Proposer2PhoneNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>AppicationDate</label>
            <input type="text" class="form-control" name="parent[AppicationDate]" value="{{$data->AppicationDate}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>ApprovedFlag</label>
            <input type="text" class="form-control" name="parent[ApprovedFlag]" value="{{$data->ApprovedFlag}}">
        </div>
        <div class="form-group col-md-3">
            <label>ApprovalDate</label>
            <input type="text" class="form-control" name="parent[ApprovalDate]" value="{{$data->ApprovalDate}}">
        </div>
        <div class="form-group col-md-3">
            <label>Last_Month_Of_Billing</label>
            <input type="text" class="form-control" name="parent[Last_Month_Of_Billing]"
                value="{{$data->Last_Month_Of_Billing}}">
        </div>
        <div class="form-group col-md-3">
            <label>MonthlyCharges</label>
            <input type="text" class="form-control" name="parent[MonthlyCharges]" value="{{$data->MonthlyCharges}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>PrintBill</label>
            <input type="text" class="form-control" name="parent[PrintBill]" value="{{$data->PrintBill}}">
        </div>
        <div class="form-group col-md-3">
            <label>OpeningBalance</label>
            <input type="text" class="form-control" name="parent[OpeningBalance]" value="{{$data->OpeningBalance}}">
        </div>
        <div class="form-group col-md-3">
            <label>MaxBillNo</label>
            <input type="text" class="form-control" name="parent[MaxBillNo]" value="{{$data->MaxBillNo}}">
        </div>
        <div class="form-group col-md-3">
            <label>TmpOpeningBalance</label>
            <input type="text" class="form-control" name="parent[TmpOpeningBalance]" value="{{$data->TmpOpeningBalance}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Closing No</label>
            <input type="text" class="form-control" name="parent[Closing_No]" value="{{$data->Closing_No}}">
        </div>
        <div class="form-group col-md-3">
            <label>Closing Date</label>
            <input type="text" class="form-control" name="parent[ClosingDate]" value="{{$data->ClosingDate}}">
        </div>
        <div class="form-group col-md-3">
            <label>Closing Remarks</label>
            <input type="text" class="form-control" name="parent[Closing_Remarks]" value="{{$data->Closing_Remarks}}">
        </div>
        <div class="form-group col-md-3">
            <label>Terminate</label>
            <input type="text" class="form-control" name="parent[Terminate]" value="{{$data->Terminate}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Termination Remarks</label>
            <input type="text" class="form-control" name="parent[Termination_Remarks]"
                value="{{$data->Termination_Remarks}}">
        </div>
        <div class="form-group col-md-3">
            <label>Relationship</label>
            {{-- <input type="text" class="form-control"   name="relationship" value="{{$data->relationship}}"> --}}
            <div class="form-group">
                <select class="form-control" name="parent[relationship]">
                    <option value="">Select Relation</option>
                    <option value="spouse" <?php if($data->relationship == 'spouse') echo "selected"; ?>>Spouse
                    </option>
                    <option value="son" <?php if($data->relationship == 'son') echo "selected"; ?>>Son</option>
                    <option value="daughter" <?php if($data->relationship == 'daughter') echo "selected"; ?>>Daughter
                    </option>
                    <option value="parent" <?php if($data->relationship == 'parent') echo "selected"; ?>>Parent
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Propoer 1 Signature</label>
            <input type="file" class="form-control-file" name="Proposer1Signature" value="">
            @if(file_exists($data->Proposer1Signature))
            <img src="{{asset($data->Proposer1Signature)}}" alt="" width="50%" height="100px">
            <input type="hidden" value="{{$data->Proposer1Signature}}" name="OldProposer1Signature">
            @endif
        </div>
        <div class="form-group col-md-3">
            <label>Propoer 2 Signature</label>
            <input type="file" class="form-control-file" name="Proposer2Signature" value="">
            @if(file_exists($data->Proposer2Signature))
            <img src="{{asset($data->Proposer2Signature)}}" alt="" width="50%" height="100px">
            <input type="hidden" value="{{$data->Proposer2Signature}}" name="OldProposer2Signature">
            @endif
        </div>
        {{-- <div class="form-group col-md-3">
                <label>is_import</label>`
                <input type="text" class="form-control"   name="is_import" value="{{$data->is_import}}">
    </div>
    <div class="form-group col-md-3">
        <label>is_spouse</label>
        <input type="text" class="form-control" name="is_spouse" value="{{$data->is_spouse}}">
    </div> --}}
    <div class="form-group col-md-3">
        <label>Image</label>
        <input type="file" class="form-control-file" name="image" value="">
        @if(file_exists($data->image))
        <img src="{{asset($data->image)}}" alt="" width="50%" height="100px">
        <input type="hidden" value="{{$data->image}}" name="old_image">
        @endif
    </div>
    </div>
    <div class="form-row">
        @for($i=0; $i<12; $i++) 
        
    
    <div class="form-group col-md-12">
     Famaliy Members
    </div>
    
    <div class="form-row">
        <div class="col-md-3">
            <label>Prefix</label>
            <input type="text" class="form-control" name="family[{{$i}}][prefix]" value="{{$spouse[$i]->prefix}}">
        </div>
        <div class="col-md-3">
            <label>First Name</label>
            <input type="text" class="form-control" name="family[{{$i}}][first_name]" value="{{$spouse[$i]->first_name}}">
        </div>
        <div class="col-md-3">
            <label>Middle Name</label>
            <input type="text" class="form-control" name="family[{{$i}}][middle_name]" value="{{$spouse[$i]->middle_name}}">
        </div>
        <div class="col-md-3">
            <label>Last Name</label>
            <input type="text" class="form-control" name="family[{{$i}}][last_name]" value="{{$spouse[$i]->last_name}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Name</label>
            <input type="text" class="form-control" name="family[{{$i}}][Name]" value="{{$spouse[$i]->Name}}">
        </div>
        <div class="form-group col-md-3">
            <label>Marital Status</label>
            <input type="text" class="form-control" name="family[{{$i}}][MaritalStatus]" value="{{$spouse[$i]->MaritalStatus}}">
        </div>
        <div class="form-group col-md-3">
            <label>Relationship</label>
            <select class="form-control" name="family[{{$i}}][relationship]">
                <option value="">Select Relation</option>
                <option value="spouse">Spouse</option>
                <option value="son">Son</option>
                <option value="daughter">Daughter</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Date Of Birth</label>
            <input type="text" class="form-control" name="family[{{$i}}][DateOfBirth]" value="{{$spouse[$i]->DateOfBirth}}">
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" class="form-control" name="family[{{$i}}][Email]" value="{{$spouse[$i]->Email}}">
        </div>
        <div class="form-group col-md-3">
            <label>Qualification</label>
            <input type="text" class="form-control" name="family[{{$i}}][Education]" value="{{$spouse[$i]->Education}}">
        </div>
       
    <div class="form-group col-md-3">
        <label>Mobile No</label>
        <input type="text" class="form-control" name="family[{{$i}}][MobileNo]" value="{{$spouse[$i]->MobileNo}}">
    </div>
    <div class="form-group col-md-3">
        <label>Photo</label>
        <input type="file" class="form-control-file" name="family[{{$i}}][image]">
        @if(file_exists($spouse[$i]->image))
        <img src="{{asset($spouse[$i]->image)}}" alt="" width="50%" height="100px">
        @endif
        <input type="hidden" value="{{@$spouse[$i]->image}}" name="family[{{$i}}][old_images]">

    </div>
    <input type="hidden" value={{$spouse[$i]->id}} name="family[{{$i}}][ID]">
    </div>
    @endfor
    <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
@endsection