@extends('layouts.app')
@section('title', __('home.home'))

@section('content')

@if(Session::has('msg'))
<div class="alert alert-success text-center">{{Session::get('msg')}}</div>
@endif

<div class="col-sm-2 mt-5">
  <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Order By <i class="fa fa-angle-down" aria-hidden="true"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{url('/import-orderby/parents')}}">Parents</a>
    <a class="dropdown-item" href="{{url('/import-orderby/spouse')}}">Spouse/Child</a>
    <a class="dropdown-item" href="{{url('/import-orderby/import')}}">Imported</a>
    <a class="dropdown-item" href="{{url('/import-data')}}">All</a>
  </div>
</div>
</div>
@if(isset($order_by))
  <div class="col-sm-3"><h4 style="font-weight:bold">{{$order_by}}</h4></div>
@endif
<table class="table text-center">
  <thead>
    <tr>
      <th>#NO</th>
      <th>Membersip ID</th>
      <th>Membership Type</th>
      <th>Name</th>
      <th>Date Of Birth</th>
      <th>CNIC</th>
      <th>Mobile No</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=$details->perPage()*($details->currentPage()-1);?>

    @foreach($details AS $detail)

    @if(empty($detail->MembershipID) || empty($detail->MembershipType) || empty($detail->Name) || empty($detail->prefix) || empty($detail->first_name) || empty($detail->middle_name) || empty($detail->last_name) || empty($detail->Gender) || empty($detail->Age) || empty($detail->Religion) || empty($detail->SO_DO_WO) || empty($detail->CNICNO) || empty($detail->BloodGroup) || empty($detail->Profession) || empty($detail->PresentPosting) || empty($detail->NatureOfBusiness) || empty($detail->DateOfBirth) || empty($detail->DateOfBirthInWords) || empty($detail->MaritalStatus) || empty($detail->Education) || empty($detail->Address) || empty($detail->City) || empty($detail->AddressSince) || empty($detail->ResidentailPhoneNo) || empty($detail->OfiicePhoneNo) || empty($detail->FaxNo) || empty($detail->MobileNo) || empty($detail->Email) || empty($detail->Proposer1Name) || empty($detail->Proposer1MembershipNo) || empty($detail->Proposer1PhoneNo) || empty($detail->Proposer2Name) || empty($detail->Proposer2MembershipNo) || empty($detail->Proposer2PhoneNo) || empty($detail->AppicationDate) || empty($detail->ApprovedFlag) || empty($detail->ApprovalDate) || empty($detail->Last_Month_Of_Billing) || empty($detail->MonthlyCharges) || empty($detail->PrintBill) || empty($detail->OpeningBalance) || empty($detail->MaxBillNo) || empty($detail->TmpOpeningBalance) || empty($detail->Closing_No) || empty($detail->ClosingDate) || empty($detail->Closing_Remarks) || empty($detail->Terminate) || empty($detail->Termination_Remarks) || empty($detail->relationship) || !isset($detail->is_import) ||  !isset($detail->is_spouse) || empty($detail->image) || empty($detail->state) || empty($detail->country) || empty($detail->zipcode) || empty($detail->type) || empty($detail->Profession) || empty($detail->Religion) || empty($detail->SO_DO_WO) || empty($detail->OfiicePhoneNo) || empty($detail->FaxNo) || empty($detail->alternate_number) || empty($detail->tax_number) || empty($detail->password) || empty($detail->supplier_business_name))
     
      <tr class="bg-danger">
        <td>{{++$i}}</td>
        <td>{{$detail->MembershipID }}</td>
        <td>{{$detail->MembershipType}}</td>
        <td>{{$detail->Name }}</td>
        <td>{{$detail->DateOfBirth }}</td>
        <td>{{$detail->CNICNO}}</td>
        <td>{{$detail->MobileNo}}</td>
        <td>
          <a href="{{url('import-import/'.$detail->id)}}"><i class="fas fa-file-import text-success" style="font-size:17px"></i></a>
          <a href="{{url('import_edit/'.$detail->id)}}" class="mr-5"><i class="fa fa-edit" style="font-size:17px"></i></a>
          <a href="{{url('import-delete/'.$detail->id)}}"><i class="fa fa-trash text-danger" style="font-size:17px"></i></a>
        </td>
        
      </tr>
      @else
        <tr class="bg-success">
        <td>{{++$i}}</td>
        <td>{{$detail->MembershipID }}</td>
        <td>{{$detail->MembershipType}}</td>
        <td>{{$detail->Name }}</td>
        <td>{{$detail->DateOfBirth }}</td>
        <td>{{$detail->CNICNO}}</td>
        <td>{{$detail->MobileNo}}</td>
        <td>
          <a href="{{url('import-import/'.$detail->id)}}"><i class="fas fa-file-import text-success" style="font-size:17px"></i></a>
          <a href="{{url('import_edit/'.$detail->id)}}" class="mr-5"><i class="fa fa-edit" style="font-size:17px"></i></a>
          <a href="{{url('import-delete/'.$detail->id)}}"><i class="fa fa-trash text-danger" style="font-size:17px"></i></a>
        </td>
        
      </tr>
      @endif
    @endforeach
  </tbody>
</table>
{{ $details->links() }}
@endsection

