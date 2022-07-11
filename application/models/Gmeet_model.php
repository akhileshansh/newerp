<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gmeet_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null)
    {
        $this->db->select()->from('gmt_live_classess');
        if ($id != null) {
            $this->db->where('gmt_live_classess.id', $id);
        } else {
            $this->db->order_by('gmt_live_classess.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    // public function remove($id)
    // {
    //     $this->db->trans_start(); # Starting Transaction
    //     $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
    //     //=======================Code Start===========================
    //     $this->db->where('id', $id);
    //     $this->db->delete('hostel');
    //     $message = DELETE_RECORD_CONSTANT . " On hostel id " . $id;
    //     $action = "Delete";
    //     $record_id = $id;
    //     $this->log($message, $record_id, $action);
    //     //======================Code End==============================
    //     $this->db->trans_complete(); # Completing transaction
    //     /* Optional */
    //     if ($this->db->trans_status() === false) {
    //         # Something went wrong.
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         //return $return_value;
    //     }
    // }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function addLiveClass($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('gmt_live_classess', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  gmt_live_classess id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
        } else {
            $this->db->insert('gmt_live_classess', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On gmt_live_classess id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
            return $insert_id;
        }
    }


    public function getLiveClassList()
    
     {
        $this->db->select('*');
       
        $this->db->from('gmt_live_classess');
         $this->db->where('session_id',$this->current_session);


        $query = $this->db->get();
       return $query->result_array();

    }
    public function getSectionClass($id=null)
    {

       
       $this->db->select('gmt_live_classess_section.*,classes.class,sections.section');
       $this->db->from('gmt_live_classess_section');
       $this->db->join('classes', 'classes.id=gmt_live_classess_section.class_id');
       $this->db->join('sections', 'sections.id=gmt_live_classess_section.section_id');
       $this->db->where('gmt_live_classess_section.gmt_live_classess_id', $id);

       $query        = $this->db->get();
       return $query->result();
    }

      public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('gmt_live_classess');

        $this->db->where('gmt_live_classess_id', $id);
        $this->db->delete('gmt_live_classess_section');
        $message   = DELETE_RECORD_CONSTANT . " On  gmt live classess  id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function gmeetredirect($id=NULL){
          $this->db->where('id', $id);
          $this->db->select('gmeet_url');
         
          $this->db->from('gmt_live_classess');
          $query        = $this->db->get();
         return $query->row_array();
    }

    public function getStudentLiveClassListoldnew($class_id,$section_id){

         $this->db->select('gmt_live_classess.*,gmt_live_classess_section.class_id,gmt_live_classess_section.section_id,classes.class,sections.section,staff.name AS staff_name,staff.employee_id,staff_designation.designation');
       
        $this->db->from('gmt_live_classess');
         $this->db->join('gmt_live_classess_section', 'gmt_live_classess_section.gmt_live_classess_id=gmt_live_classess.id');
         $this->db->where('gmt_live_classess_section.class_id',$class_id);
         $this->db->where('gmt_live_classess_section.section_id',$section_id);
         $this->db->join('classes', 'classes.id=gmt_live_classess_section.class_id');
         $this->db->join('sections', 'sections.id=gmt_live_classess_section.section_id');
         $this->db->join('staff', 'staff.id=gmt_live_classess.staff_id');
         $this->db->join('staff_designation', "staff_designation.id = staff.designation", "left");
         $this->db->where('session_id',$this->current_session);
         $this->db->group_by('gmt_live_classess_id');

        $query = $this->db->get();
       return $query->result_array();
    }
      public function getStudentLiveClassList($class_id,$section_id){
 $this->db->select('gmt_live_classess.*,gmt_live_classess_section.class_id,gmt_live_classess_section.section_id,classes.class,sections.section,staff.name AS staff_name,staff.employee_id,staff_designation.designation,staff_roles.role_id as role_id,roles.name as staff_role');
       
        $this->db->from('gmt_live_classess');
         $this->db->join('gmt_live_classess_section', 'gmt_live_classess_section.gmt_live_classess_id=gmt_live_classess.id');
         $this->db->where('gmt_live_classess_section.class_id',$class_id);
         $this->db->where('gmt_live_classess_section.section_id',$section_id);
         $this->db->join('classes', 'classes.id=gmt_live_classess_section.class_id');
         $this->db->join('sections', 'sections.id=gmt_live_classess_section.section_id');
         $this->db->join('staff', 'staff.id=gmt_live_classess.staff_id');
         $this->db->join('staff_designation', "staff_designation.id = staff.designation", "left");
         $this->db->join('staff_roles', 'staff_roles.staff_id=staff.id');
        $this->db->join('roles', 'roles.id=staff_roles.role_id');
         $this->db->where('session_id',$this->current_session);
         $this->db->group_by('gmt_live_classess_id');

        $query = $this->db->get();
       return $query->result_array();
    }
    public function gmeetstatus($data='')
    {
         if($data){
            $update_rows = array('status' => $data['chg_status']);
           $this->db->where('id', $data['gmeet_id']);
            $this->db->update('gmt_live_classess', $update_rows);
            return true;
         }else{
            return false;
         }
    }
    
    //  public function getstaffDetailsold($id = null){
    //      $this->db->select("staff.*,staff_designation.designation");
    //     $this->db->from('staff');
    //     $this->db->join('staff_designation', "staff_designation.id = staff.designation", "left");
      
    //     if ($id != null) {
    //         $this->db->where('staff.id', $id);
    //     }
    //     $query = $this->db->get();
    //     if ($id != null) {
    //         return $query->row_array();
    //     } else {
    //         return $query->result_array();
    //     }
    // }
    
    public function getstaffDetails($id = null){
         $this->db->select("staff.*,staff_designation.designation,staff_roles.role_id as role_id,roles.name as staff_role");
        $this->db->from('staff');
        $this->db->join('staff_designation', "staff_designation.id = staff.designation", "left");
     
     $this->db->join('staff_roles', 'staff_roles.staff_id=staff.id');
     $this->db->join('roles', 'roles.id=staff_roles.role_id');
        if ($id != null) {
            $this->db->where('staff.id', $id);
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
}
