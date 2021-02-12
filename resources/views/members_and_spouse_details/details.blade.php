<html>
    <head>

    </head>
<body>
    <table width="100%">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>MemberShip Type</th>
                <th>Name</th>
                <th>CNIC</th>
                <th>Mobile No</th>
                <th>Spouse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details AS $detail)
                <tr style="text-align:center">
                    <td>{{$detail->MembershipID}}</td>
                    <td>{{$detail->MembershipType}}</td>
                    <td>{{$detail->Name}}</td>
                    <td>{{$detail->CNICNO}}</td>
                    <td>{{$detail->MobileNo}}</td>
                    <td>{{$detail->is_spouse}}</td>
                    <td><a href="{{url('/edit_member/'.$detail->id)}}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>