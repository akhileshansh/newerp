<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Gmeet extends Admin_Controller
{

    public $sch_setting_detail = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('encoding_lib');
        $this->load->model("classteacher_model");
        $this->load->model("timeline_model");
        $this->load->model("Gmeet_model");
        $this->load->model("Staff_model"); 
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->role;
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('gmeet', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Gmeet Info');
       
        $data['title']       = 'Live Classes';
        $data['sch_setting'] = $this->sch_setting_detail;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $subjectlist            = $this->subject_model->get();
        $data['subjectlist']    = $subjectlist;
        $roles                  = $this->role_model->get();
        $role            = $this->customlib->getStaffRole();
        $userdata = $this->customlib->getUserData();
        $data['role'] = $userdata['role_id'];
        $data["roles"]          = $roles;

        $data['staff_id'] = $this->customlib->getStaffID();

        $role            = $this->customlib->getStaffRole();
        $role_id        = json_decode($role)->id;
        $data['role_id'] = $role_id;

        $data['liveClassResult']  = $this->Gmeet_model->getLiveClassList();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/gmeet/liveClassessList', $data);
        $this->load->view('layout/footer', $data);
    }

   
    public function delete($id)
    {


        $this->Gmeet_model->remove($id);
        redirect('admin/gmeet', 'refresh');
    }

    public function getbyRole()
    {
        $role_id = $this->input->get('role_id');
        $resultlist          = $this->staff_model->getStaffbyrole($role_id);
        echo json_encode($resultlist);
    }


    public function liveClasStore()
    {

        if (!$this->rbac->hasPrivilege('gmeet', 'can_add')) {
            access_denied();
        }

        $section_id    = $this->input->post('section_id');
        $userdata = $this->customlib->getUserData();
        $role_id = $userdata['role_id'];
        $this->form_validation->set_rules('class_title', $this->lang->line('class_title'), 'trim|required|xss_clean');
       // $this->form_validation->set_rules('section_id', $this->lang->line('section_id'), 'trim|required|xss_clean|numeric|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('auto_publish_date', $this->lang->line('auto_publish_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('duration', $this->lang->line('duration'), 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required|xss_clean');
        if ($role_id != '2') {
            $this->form_validation->set_rules('role', $this->lang->line('role'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('staff_id', $this->lang->line('staff_id'), 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('class_id', $this->lang->line('class_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('gmeet_url', $this->lang->line('gmeet_url'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'class_title' => form_error('class_title'),
                'auto_publish_date' => form_error('auto_publish_date'),
                'duration' => form_error('duration'),
                'role' => form_error('role'),
                'staff_id' => form_error('staff_id'),
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
                'gmeet_url' => form_error('gmeet_url'),
                'description' => form_error('description'),
            );

            $array = array('status' => 0, 'error' => $msg, 'message' => '');
        } else {
            // $role_id = $this->customlib->getStaffID();

            if ($role_id == 2) {
                $staff_id = $userdata['id'];
                $created_by = $userdata['id'];
                $roles_id = $role_id;
            } else {
                $staff_id    = $this->input->post('staff_id');
                $roles_id = $this->input->post('role');
                $created_by = $userdata['id'];
            }
            $data = array(
                'class_title' => $this->input->post('class_title'),
                'date' => $this->input->post('auto_publish_date'),
                'duration' => $this->input->post('duration'),
                'role_id' => $roles_id,
                'session_id' => $this->setting_model->getCurrentSession(),
                'created_by' => $created_by,
                'staff_id' => $staff_id,
                'gmeet_url' => $this->input->post('gmeet_url'),
                'description' => $this->input->post('description')
            );
            //  print_r($data);dei();
            $section = $this->input->post('section_id');
            $liveClassId = $this->Gmeet_model->addLiveClass($data);
            if (is_array($section) && !empty($section)) {
                if ($liveClassId) {
                    foreach ($section as $row) {
                        $sectionData = array(
                            'gmt_live_classess_id' => $liveClassId,
                            'class_id' => $this->input->post('class_id'),
                            'section_id' => $row
                        );
                        $this->db->insert('gmt_live_classess_section', $sectionData);
                    }
                }
            }
            $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));

            // $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            // redirect('admin/gmeet');
        }
        echo json_encode($array);
    }

    function start($id = null, $class = null)
    {
        $liveClassId = $this->Gmeet_model->gmeetredirect($id);
        if ($liveClassId) {

            redirect($liveClassId['gmeet_url']);
        } else {
            redirect('admin/gmeet');
        }
    }


    function chgstatus()
    {
        $data = $_POST;
        if ($data) {

            $status = $this->Gmeet_model->gmeetstatus($data);

            $arr = array('status' => 1, 'message' => $this->lang->line('success_message'));
        } else {

            $arr = array('status' => 0, 'message' => $this->lang->line('check_your_form_status'));
        }
        echo json_encode($arr);
    }
}