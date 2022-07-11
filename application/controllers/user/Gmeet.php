<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gmeet extends Student_Controller
{
    public $school_name;
    public $school_setting;
    public $setting;
    public $payment_method;
    function __construct()
    {
        parent::__construct();

        $this->payment_method     = $this->paymentsetting_model->getActiveMethod();
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->load->model("student_edit_field_model");
        $this->config->load('mailsms');
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->load->model("Gmeet_model");
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'gmeet');
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $data['liveClassResult']  = $this->Gmeet_model->getStudentLiveClassList($student_current_class->class_id, $student_current_class->section_id);
        $data['title'] = 'Live Classes';
        $data['title_list'] = 'Live Classes';
        $this->load->view('layout/student/header');
        $this->load->view('user/gmeet/liveClassessList', $data);
        $this->load->view('layout/student/footer');
    }
    function start($id = null, $class = null)
    {
        $liveClassId = $this->Gmeet_model->gmeetredirect($id);

        if ($liveClassId) {

            redirect($liveClassId['gmeet_url']);
        } else {
            redirect('user/gmeet');
        }
    }
}