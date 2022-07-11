<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller
{
   public $result;
	public function __construct()
    {
        parent::__construct();

        $this->load->model("staff_model");
         
        $this->load->library('Enc_lib');
         $this->result=$this->login();
         }
         
        function setting(){
            $data=$this->setting_model->get();
           $setting=[];
            
            $setting['acyear']=$this->academicYear($data[0]['session']);
              array_push($setting,$setting);

              return $setting[0];
        }


         function academicYear($academy){
             $current = explode('-', $academy);
            return $current[0];
         }

         function academicstartDate($academy){ 
             $current = explode('-', $academy);
             $starDate='01-04-'.$current[0];
           
             return $starDate;
         }
         function academicendDate($academy){
            if($academy){
                $current = explode('-', $academy);
             $starDate='30-03-'.$current[1];
           
             return $starDate;
            }
             
         }

         function academicstatus($status){
            if ($status != 0) {
                return intval(1);
            }else{
                return intval(0);
            }
         }
         function castchange($data,$type){
            if($type=='integer'){
                return intval($data);
            } else{
                return $data;
            }

         }
         //Accedemic details

         function acadmicFunction(){
            $academicYearList=[];
                    $academic=$this->session_model->getAllSession();
                     foreach($academic as $academy){
                        if(!empty($academy['session'])){
                            $academicYear=$this->academicYear($academy['session']);
                        }else{
                            $academicYear='';
                        }
                        
                        $academicstartDate=$this->academicstartDate($academy['session']);
                        $academicendDate=$this->academicendDate($academy['session']);
                        $academicstatus=$this->academicstatus($academy['active']);
                        $acd['academicYear']=$academicYear;
                        $acd['academicStartDate']=$academicstartDate;
                        $acd['academicEndDate']=$academicendDate;
                        $acd['status']=$academicstatus;
                        $acd['academicLabel']=$academy['session'];

                        array_push($academicYearList,$acd);
                     }

                     return $academicYearList;
         }

         //================Class List ===============//
         function classList($data=NULL,$section=null){
             $class=[];
             
            $classList=$this->classsection_model->getByID();
            $i=0;
          
            foreach($classList as $c){
                $i++;
               
               
                  if($section){
                     $vehicles = $c->vehicles;
                   
                       foreach ($vehicles as $key => $value) {
                        $clas['acyear']=$data;
                        $clas['className']=$c->class.' '.$value->section;
                        $clas['gradeName']='Grade'.' '.$c->class;
                        $clas['sectionName']=$value->section;
                        $clas['status']=1;
                       
                          array_push($class,$clas);
                       }
                  }
               
              
            }
          
              return $class;
         }


          function gradeList($data=NULL){
             $grade=[];
             
            $gradeList=$this->classsection_model->ZendagetByID();
            $i=0;
          
            foreach($gradeList as $c){
                $i++;
                 $grad['gradeName']='Grade'.' '.$c->class;
                 $grad['gradePriority']=intval($c->id);
                 $grad['status']=1;
                 $grad['intialGrade']=0;
                array_push($grade,$grad);
            }
          
              return $grade;
         }
         
         function sectionList($data=NULL){
             $section=[];
             
            $section_result      = $this->section_model->get();
            $i=1;
            foreach($section_result as $c){
                
                 $sc['sectionName']=$c['section'];
                 //$sc['sectionPriority']=intval($c['id']);
                 $sc['sectionPriority']=intval($i++);
                 $sc['status']=1;
                  
                array_push($section,$sc);
            }
          
              return $section;
         }

         function academicDetails(){
               $academicYearList=[];
               $classList=[];
               
              if($this->result==true){
                  $academicYearList=$this->acadmicFunction();
                    $school        = $this->setting();
                    $gradeList=$this->gradeList($school['acyear']);
                     $sectionList=$this->sectionList($school['acyear'],'yes');   
                  $classList=$this->classList($school['acyear'],'yes');  
                  
                   $arr =array('status' => 200, 'academicYearList' => $academicYearList,'gradeList'=>$gradeList,'sectionList'=>$sectionList,'classList'=>$classList);
              }else{
                  $arr =array('status' => 401, 'message' => 'Unauthorized.');
                   
              }
               echo json_encode($arr);
         }


	function login(){  
        $schoolcode=$this->input->get_request_header('schoolCode', true);
		  $login_post = array(
                'email'    => $this->input->get_request_header('username', true),
                'password' => $this->input->get_request_header('password', true),
            );
            if($schoolcode=='110044'){
                  $result= $this->staff_model->zendacheckLogin($login_post);
            if($result){
                 return true;
              }else{
                 return false;
                   
              }
          }else{
            return false;
          } 
          
            
	}
  

  //========Step 2============//

    function studentRoster($id=null){
        if($this->result==true){

            
             $users=[];
            if(!empty($id)){
              
             $student = $this->student_model->zendget($id);
               $users['dateLastModified']=$student['dateLastModified'];
                $users['identifier']=$student['identifier'];
                $users['studentFullName']=$student['studentFirstName'].' '.$student['middlename'].' '.$student['studentLastName'];
                $users['studentFirstName']=$student['studentFirstName'];
                $users['studentLastName']=$student['studentLastName'];
                $users['gender']=$student['gender'];
                $users['email']=$student['email'];
                $users['phone']=$student['phone'];
                $users['currentClass']=$student['currentClass'].' '.$student['section'];
                if($student['guardian_is']=='father'){
                    $parrent='father';
                    $crupt_name=explode(' ', $student['father_name']);
               
                    $panno=$student['father_pan_card'];
                    $users['parentfullName']=$student['father_name'];
                    $users['parentFirstName']=$crupt_name[0];
                    $users['parentLastName']=$crupt_name[1];
                }else{
                    $parrent='mother';
                    $crupt_name=explode(' ', $student['mother_name']);
               
                    $panno=$student['mother_pan_card'];
                    $users['parentfullName']=$student['mother_name'];
                    $users['parentFirstName']=$crupt_name[0];
                    $users['parentLastName']=$crupt_name[1];
                }
                $users['parentDOB']='';
                $users['parentGender']='';
                $users['parentResidenceAddress']=$student['permanent_address'];
                $users['parentResidenceZipCode']='';
                $users['PANNumber']=$panno;
                if($parrent!='father'){
                    $crupt_name=explode(' ', $student['father_name']);
                    $users['guardian2fullName']=$student['father_name'];
                    $users['guardian2FirstName']=$crupt_name[0];
                    $users['guardian2LastName']=$crupt_name[1];
                    $users['guardian2Email']='';
                    $users['guardian2Phone']='';
              
                }else{
                     $crupt_name=explode(' ', $student['mother_name']);
                    $users['guardian2fullName']=$student['mother_name'];
                    $users['guardian2FirstName']=$crupt_name[0];
                    $users['guardian2LastName']=$crupt_name[1];
                    $users['guardian2Email']='';
                    $users['guardian2Phone']='';
                }
                    $users['guardian3fullName']='';
                    $users['guardian3FirstName']='';
                    $users['guardian3LastName']='';
                    $users['guardian3Email']='';
                    $users['guardian3Phone']='';
                 
              
            }else{
            
             $student = $this->student_model->zendget();
              foreach($student as $key=>$value){
                
                $usr['dateLastModified']=$value['updated_at'];
                $usr['identifier']=$value['identifier'];
                $usr['studentFullName']=$value['studentFirstName'].' '.$value['middlename'].' '.$value['studentLastName'];
                $usr['studentFirstName']=$value['studentFirstName'];
                $usr['studentLastName']=$value['studentLastName'];
                $usr['gender']=$value['gender'];
                $usr['email']=$value['email'];
                $usr['phone']=$value['phone'];
                $usr['currentClass']=$value['currentClass'].' '.$value['section'];
                if($value['guardian_is']=='father'){
                    $parrent='father';
                    $crupt_name=explode(' ', $value['father_name']);
               
                    $panno=$value['father_pan_card'];
                    $usr['parentfullName']=$value['father_name'];
                    $usr['parentFirstName']=$crupt_name[0];
                    $usr['parentLastName']=$crupt_name[1];
                }else{
                    $parrent='mother';
                    $crupt_name=explode(' ', $value['mother_name']);
               
                    $panno=$value['mother_pan_card'];
                    $usr['parentfullName']=$value['mother_name'];
                    $usr['parentFirstName']=$crupt_name[0];
                    $usr['parentLastName']=$crupt_name[1];
                }
                $usr['parentDOB']='';
                $usr['parentGender']='';
                $usr['parentResidenceAddress']=$value['permanent_address'];
                $usr['parentResidenceZipCode']='';
                $usr['PANNumber']=$panno;
                if($parrent!='father'){
                    $crupt_name=explode(' ', $value['father_name']);
                    $usr['guardian2fullName']=$value['father_name'];
                    $usr['guardian2FirstName']=$crupt_name[0];
                    $usr['guardian2LastName']=$crupt_name[1];
                    $usr['guardian2Email']='';
                    $usr['guardian2Phone']='';
              
                }else{
                     $crupt_name=explode(' ', $value['mother_name']);
                    $usr['guardian2fullName']=$value['mother_name'];
                    $usr['guardian2FirstName']=$crupt_name[0];
                    $usr['guardian2LastName']=$crupt_name[1];
                    $usr['guardian2Email']='';
                    $usr['guardian2Phone']='';
                }
                  $usr['guardian3fullName']='';
                    $usr['guardian3FirstName']='';
                    $usr['guardian3LastName']='';
                    $usr['guardian3Email']='';
                    $usr['guardian3Phone']='';
                array_push($users,$usr);
            }
            }
           
            $arr =array('status' => 200, 'users' => $users);
        
        }else{
            $arr =array('status' => 401, 'message' => 'Unauthorized.');
        }
        echo json_encode($arr);

    }
    
    
    
    function payableInvoices($id=null){
         if($this->result==true){
         if($id){
            $student = $this->student_model->zendgetfilter($id);
            if($student){
            $studentsession=$this->student_model->get_studentsession($student['student_session_id']);
            $student_due_fee      = $this->studentfeemaster_model->zendagetStudentFees($student['student_session_id']);
            $data=[];
           
            foreach($student_due_fee as $stud){
              
                 $fees=[];
                   foreach ($stud->fees as $fee_key => $fee_value) {
                    $fee_deposits = json_decode(($fee_value->amount_detail));
                    if(empty($fee_deposits)){
                    $fs['componentName']=$fee_value->code;
                    $fs['componentAmount']=$fee_value->amount;
                    $fs['itemStartDate']=date('Y-m-d',strtotime($stud->created_at));
                    array_push($fees,$fs);
                    }
                    
                      
                   }
                if(!empty($fees)){   
                $dt['invoiceNo']=$stud->invoiceNo;
                $dt['registerNo']=$id;
                $dt['studentName']=@$student['studentFirstName'].' '.@$student['middlename'].' '.@$student['studentLastName'];
                $dt['academicYear']=$studentsession['session'];
                $dt['invoiceCreationDate']=date('Y-m-d',strtotime($stud->created_at));
               
                $dt['componentList']='';
                   $dt['componentList']=$fees;
                array_push($data,$dt);
                }
            }
             $arr =array('status' => 200, 'invoiceList' => $data);
        }else{
            $arr =array('status' => 200, 'message' => 'RegisterNo not founds');
        }
             
         }
        else{
                  $arr =array('status' => 404, 'message' => 'Missing Parameters');
      }
    }      
         
       else{
            $arr =array('status' => 401, 'message' => 'Unauthorized.');
       }
       echo json_encode($arr);
    }
    
    
    function studentAnnualFee($id){
        if($this->result==true){
           if($id){
                $student = $this->student_model->zendgetfilter($id);
                if($student){
                $studentsession=$this->student_model->get_studentsession($student['student_session_id']);
                $student_due_fee      = $this->studentfeemaster_model->zendagetStudentFees($student['student_session_id']);
                $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($id);
                $total_amount           = 0;
                $total_deposite_amount  = 0;
                $total_fine_amount      = 0;
                $total_fees_fine_amount = 0;
                $total_discount_amount = 0;
                $total_balance_amount  = 0;
                $alot_fee_discount     = 0;
                $data=[];

                foreach ($student_due_fee as $key => $fee) {

                $dt['registerNo']=$id;
                $dt['studentName']=@$student['studentFirstName'].' '.@$student['middlename'].' '.@$student['studentLastName'];
            
                    foreach ($fee->fees as $fee_key => $fee_value) {
                        $fee_paid         = 0;
                        $fee_discount     = 0;
                        $fee_fine         = 0;
                        $fees_fine_amount = 0;
                        if (!empty($fee_value->amount_detail)) {
                            $fee_deposits = json_decode(($fee_value->amount_detail));
                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                $fee_paid     = $fee_paid + $fee_deposits_value->amount;
                                $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                $fee_fine     = $fee_fine + $fee_deposits_value->amount_fine;
                        }
                    }
                    if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                        $fees_fine_amount       = $fee_value->fine_amount;
                        $total_fees_fine_amount = $total_fees_fine_amount + $fee_value->fine_amount;
                    }

                    $total_amount          = $total_amount + $fee_value->amount;
                    $total_discount_amount = $total_discount_amount + $fee_discount;
                    $total_deposite_amount = $total_deposite_amount + $fee_paid;
                    $total_fine_amount     = $total_fine_amount + $fee_fine;
                    $feetype_balance       = $fee_value->amount - ($fee_paid + $fee_discount);
                    $total_balance_amount  = number_format((float)$total_balance_amount + $feetype_balance, 2, '.', '');

            }
             $dt['annualFeeAmount']=$total_balance_amount;
                    $dt['currencyCode']="INR";
                    $dt['academicYear']=$studentsession['session'];
                    $dt['annualFeeGeneratedDate']=date('Y-m-d',strtotime($fee->created_at));;
                     array_push($data,$dt);
          }
         $arr =array('status' => 200, 'annualFees' => $data);
         }else{
            $arr =array('status' => 404, 'message' => 'RegisterNo not founds');
         }
           }else{
            $arr =array('status' => 404, 'message' => 'Missing Parameters');
           }
        }else{
            $arr =array('status' => 401, 'message' => 'Unauthorized.');
        }
        echo json_encode($arr);
    }
    
      function updatePayment(){
         if($this->result==true){
            $params   = json_decode(file_get_contents('php://input'), true);
            $updatepay=[];
            $inv=[];
            $deposited_fees=[];
            if($params['paymentSyncList']){
                
             
                  $deposited_fees = $this->studentfeemaster_model->update_deposit_collections($params['paymentSyncList']);
             
            }
           $arr =array('message'=>'Success','status' => 200, 'transactionList' => $deposited_fees);
         }else{
            $arr =array('status' => 401, 'message' => 'Unauthorized.');
       }
        echo json_encode($arr);
    }
    
     function updateloan(){
        if($this->result==true){
            $loan_fees=[];
          $params=json_decode(file_get_contents('php://input'),true);
          if($params){
            if($params['registerNo'] && $params['loanApplicationNo']){
                $loan_fees = $this->studentfeemaster_model->update_loan($params);
            }
            $arr=$loan_fees;
          }
        }else{
             $arr =array('status' => 401, 'message' => 'Unauthorized.');
        }
        echo json_encode($arr);
    }
}