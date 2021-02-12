MembershipID
MembershipType
SpouseName1
SpouseCNICNO1
SpouseDateOfBirth1
SpouseAge1
SpouseBloodGroup1
SpouseName2
SpouseCNICNO2
SpouseDateOfBirth2
SpouseAge2
SpouseBloodGroup2
SpouseName3
SpouseCNICNO3
SpouseDateOfBirth3
SpouseAge3
SpouseBloodGroup3
SpouseName4
SpouseCNICNO4
SpouseDateOfBirth4
SpouseAge4
SpouseBloodGroup4
SpouseOrChildName1
SpouseOrChildCNICNO1
SpouseOrChildDateOfBirth1
ChildAge1
SpouseOrChildBloodGroup1
SpouseOrChildName2
SpouseOrChildCNICNO2
SpouseOrChildDateOfBirth2
ChildAge2
SpouseOrChildBloodGroup2\
SpouseOrChildName3
SpouseOrChildCNICNO3
SpouseOrChildDateOfBirth3
ChildAge3
SpouseOrChildBloodGroup3
SpouseOrChildName4
SpouseOrChildCNICNO4
SpouseOrChildDateOfBirth4
ChildAge4
SpouseOrChildBloodGroup4
SpouseOrChildName5
SpouseOrChildCNICNO5
SpouseOrChildDateOfBirth5
ChildAge5
SpouseOrChildBloodGroup5
SpouseOrChildName6
SpouseOrChildCNICNO6
SpouseOrChildDateOfBirth6
ChildAge6
SpouseOrChildBloodGroup6
SpouseOrChildName7
SpouseOrChildCNICNO7
SpouseOrChildDateOfBirth7
ChildAge7
SpouseOrChildBloodGroup7
SpouseOrChildName8
SpouseOrChildCNICNO8
SpouseOrChildDateOfBirth8
ChildAge8
SpouseOrChildBloodGroup8





// echo "<pre>";
        // print_r($data);
        // exit;
        $arr = array(
            'SpouseName1',
            'SpouseName2',
            'SpouseName3',
            'SpouseName4',
            'SpouseOrChildName1',
            'SpouseOrChildName2',
            'SpouseOrChildName3',
            'SpouseOrChildName4',
            'SpouseOrChildName5',
            'SpouseOrChildName6',
            'SpouseOrChildName7',
            'SpouseOrChildName8',
        );
        
        

        foreach($data as $key=> $val){
           for($i=0;$i<count($data);$i++){
         
           
           if($i==62)
           break;
           
           //echo $data[$key][$i] ;
            
           
            // $datas = array(

            //     'MembershipID'          => $data[$key][$i],
            //     'MembershipType'        => $data[$key][$i],
            //     'Name'                  => $data[$key][$i],
            //     'Gender'                 => '',
            //     'Age'                    => '',
            //     'Religion'              => '',
            //     'S/O-D/O-W/O'            => ''  ,
            //     'CNICNO'                => $data[$key][$i],
            //     'BloodGroup'             =>'',
            //     'Profession'             => $data[$key][$i],
            //     'BScale'                 => $data[$key][$i],
            //     'PresentPosting'         => $data[$key][$i],
            //     'NatureOfBusiness'       => $data[$key][$i],
            //     'DateOfBirth'            => $data[$key][$i],
            //     'DateOfBirthInWords'     => $data[$key][$i],
            //     'MaritalStatus'          => $data[$key][$i],
            //     'Education'              => $data[$key][$i],
            //     'Address'                => $data[$key][$i],
            //     'City'                   => $data[$key][$i],
            //     'AddressSince'           => $data[$key][$i],
            //     'ResidentailPhoneNo'     => $data[$key][$i],
            //     'OfiicePhoneNo'         => $data[$key][$i],
            //     'FaxNo'                 => $data[$key][$i],
            //     'MobileNo'              => $data[$key][$i],
            //     'Email'                 => $data[$key][$i],
            //     'Proposer1Name'         => $data[$key][$i],
            //     'Proposer1MembershipNo' => $data[$key][$i],
            //     'Proposer1PhoneNo'      => $data[$key][$i],
            //     'Proposer2Name'         => $data[$key][$i],
            //     'Proposer2MembershipNo' => $data[$key][$i],
            //     'Proposer2PhoneNo'       => $data[$key][$i],
            //     'AppicationDate'        => $data[$key][$i],
            //     'ApprovedFlag'           => $data[$key][$i],
            //     'ApprovalDate'           => $data[$key][$i],
            //     'Last_Month_Of_Billing'  => $data[$key][$i],
            //     'MonthlyCharges'         => $data[$key][$i],
            //     'PrintBill'              => $data[$key][$i],
            //     'OpeningBalance'        => $data[$key][$i],
            //     'MaxBillNo'             => $data[$key][$i],
            //     'TmpOpeningBalance'      => $data[$key][$i],
            //     'Closing_No'            => $data[$key][$i],
            //     'ClosingDate'           => $data[$key][$i],
            //     'Closing_Remarks'       => $data[$key][$i],
            //     'Terminate'             => $data[$key][$i],
            //     'Termination_Remarks'    => $data[$key][$i],
            //     'is_import' => 0,
            //     'is_spouse' => 1
            // );
            // print_r($datas);

            // $dta = array(
                
            //     'MembershipID' =>$data[$key][$i],
            //     'MembershipType' =>$data[$key][$i],
            //     'Name' =>$data[$key][$i],
            //     'CNICNO' =>$data[$key][$i],
            //     'Age' =>$data[$key][$i],
            //     'BloodGroup' =>$data[$key][$i],
            // );
            
            if(isset($data[$key][2]) && !empty($data[$key][2])){
                echo $data[$key][2];
                break;
                
            }
            if(isset($data[$key][7]) && !empty($data[$key][7])){
                echo $data[$key][7];
                break;
            
            }
            
            
            
                // if($data[$key][$i]!=""){
                //      if(in_array($data[$key][$i],$index)){
                //      $ar2 =[];

                //      }
                // }

           }
            
        }$data = array(
                    'MembershipID ' => $data[$i][0],
                    'MembershipType ' => $data[$i][1],
                    'Name ' => $data[$i][2],
                    'CNICNO ' => $data[$i][3],
                    'DateOfBirth' => $data[$i][4];
                );

                f(isset($data[$i][2]) && !empty($data[$i][2])){
                
              DB::table('import_data_table')->insert(['MembershipID'=>$data[$i][0],'MembershipType'=>$data[$i][1],'Name'=>$data[$i][2],'CNICNO'=>$data[$i][3],'DateOfBirth'=>$data[$i][4],'Age'=>$data[$i][5],'BloodGroup'=>$data[$i][6],'is_import'=>0,'is_spouse'=>1]);
              die();
              
                
            }