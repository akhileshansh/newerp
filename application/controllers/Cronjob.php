<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends CI_Controller
{
      function __construct() {
        parent::__construct();
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("classteacher_model");
        $this->load->model("student_model");
		date_default_timezone_set("Asia/Kolkata");
         $this->sch_setting_detail = $this->setting_model->getSetting();
         $this->load->helper(array('directory', 'customfield', 'custom'));
          
         $this->load->helper('language');
    }
	public function index()
	{
       $resultlist = $this->stuattendence_model->searchAttendenceByDate(date('Y-m-d'));
       $student_details=$this->student_model->findAllStudent();

        $time = date('h:i:s a', time());
        
       	if($resultlist=='0'){
       		if(!empty($student_details)){
       			foreach($student_details as $student){
		       		$array = array(
		            'student_session_id' => $student['student_session_id'],
		            'attendence_type_id' =>5,
		        	'remark' => 'By RFID',
		         	'date' => date('Y-m-d'),
		            'attendance_time'=>$time,
		            );
             		$insert_id = $this->stuattendence_model->rfidadd($array);
       			}
       		}
       	}else{
	       	if(!empty($student_details)){
	       	 	foreach($student_details as $student){
		       		$array = array(
		            'student_session_id' => $student['student_session_id'],
		            'attendence_type_id' =>4,
		        	'remark' => 'By RFID',
		         	'date' => date('Y-m-d'),
		            'attendance_time'=>$time,
		            );
		             $insert_id = $this->stuattendence_model->rfidadd($array);
	       	    }
	       	}
       	}
        
        
	}

   
}
