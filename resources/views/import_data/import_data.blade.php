@extends('layouts.app')
@section('title', __('home.home'))

@section('content')

@if(Session::has('msg'))
<div class="alert alert-success text-center">{{Session::get('msg')}}</div>
@endif
<br>
<div class="col-xs-12">
  <div class="col-sm-4" style="margin-bottom: 20px;">
    <form action="{{ url('import/search') }}">
        <div class="input-group">
          <input type="text" class="form-control ml-2" placeholder="Search" required name="search">
          <span class="input-group-btn">
            <input type="submit" class="btn btn-primary">
          </span>
        </div><!-- /input-group -->
    </form>
  </div>
</div>

@if(isset($order_by))
  <div class="col-sm-3"><h4 style="font-weight:bold">{{$order_by}}</h4></div>
@endif
<table class="table text-center" style="margin-bottom: 0">
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
    
    @if(!$details->isEmpty())
    <?php $i=$details->perPage()*($details->currentPage()-1);?>
    @foreach($details AS $detail)
    @if(!empty($detail->Name))
    @if(empty($detail->MembershipID) || empty($detail->MembershipType) || empty($detail->Name) || empty($detail->prefix) || empty($detail->first_name) || empty($detail->middle_name) || empty($detail->last_name) || empty($detail->Gender) || empty($detail->Age) || empty($detail->Religion) || empty($detail->SO_DO_WO) || empty($detail->CNICNO) || empty($detail->BloodGroup) || empty($detail->Profession) || empty($detail->PresentPosting) || empty($detail->NatureOfBusiness) || empty($detail->DateOfBirth) || empty($detail->DateOfBirthInWords) || empty($detail->MaritalStatus) || empty($detail->Education) || empty($detail->Address) || empty($detail->City) || empty($detail->AddressSince) || empty($detail->ResidentailPhoneNo) || empty($detail->OfiicePhoneNo) || empty($detail->FaxNo) || empty($detail->MobileNo) || empty($detail->Email) || empty($detail->Proposer1Name) || empty($detail->Proposer1MembershipNo) || empty($detail->Proposer1PhoneNo) || empty($detail->Proposer2Name) || empty($detail->Proposer2MembershipNo) || empty($detail->Proposer2PhoneNo) || empty($detail->AppicationDate) || empty($detail->ApprovedFlag) || empty($detail->ApprovalDate) || empty($detail->Last_Month_Of_Billing) || empty($detail->MonthlyCharges) || empty($detail->PrintBill) || empty($detail->MaxBillNo) || empty($detail->Closing_No) || empty($detail->ClosingDate) || empty($detail->Closing_Remarks) || empty($detail->Terminate) || empty($detail->Termination_Remarks) || empty($detail->relationship) || !isset($detail->is_import) ||  !isset($detail->is_spouse) || empty($detail->image) || empty($detail->state) || empty($detail->country) || empty($detail->zipcode) || empty($detail->Profession) || empty($detail->Religion) || empty($detail->SO_DO_WO) || empty($detail->OfiicePhoneNo) || empty($detail->alternate_number) || empty($detail->tax_number) || empty($detail->password) || empty($detail->supplier_business_name))
     
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
      @endif
    @endforeach
    @else
      @php $no_record = "No Record Found" @endphp
    @endif
  </tbody>
</table>
<div class="text-center">
  {{ $details->links() }}
</div>
@if(isset($no_record))
  <div class="col-sm-12 text-center">
    <h4>{{ $no_record }}</h4>
  </div>
@endif
@endsection

