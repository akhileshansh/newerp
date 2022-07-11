<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Zenda extends Student_Controller
{

    public $setting = "";

    public function __construct()
    {

        parent::__construct();
        $this->api_config = $this->paymentsetting_model->getActiveMethod();
        $this->setting = $this->setting_model->get();
        // $this->load->library('Paytm_lib');
        //===================================================
    }

    public function index()
    {

        $params = $this->session->userdata('params');
        $data = array();
        $data['params'] = $params;
        $data['setting'] = $this->setting;
        $data['api_error'] = array();
        $student_id = $params['student_id'];
        $total = $params['total'];
        $data['student_id'] = $student_id;
        $amount = number_format((float)($params['fine_amount_balance'] + $params['total']), 2, '.', '');
        $data['total'] = $amount;
        $data['symbol'] = $params['invoice']->symbol;
        $data['currency_name'] = $params['invoice']->currency_name;
        $data['name'] = $params['name'];
        $data['admission_no'] = $params['admission_no'];
        $data['guardian_phone'] = $params['guardian_phone'];
        $data['guardian_name'] = $params['guardian_name'];
        $data['guardian_email'] = $params['guardian_email'];
        $data['student_fees_master_array'] = $data['params']['student_fees_master_array'];
        $posted = $_POST;
        $paytmParams = array(

            "TXN_AMOUNT" => $data['total'],
                    );
       
        $this->load->view('student/zenda', $data);
    }


    public function paynow()
    {
        $params = $this->session->userdata('params');
        
            if (!empty($params['guardian_email'])) {
                $keys = 'emailId';
                $value = $params['guardian_email'];
            } else {
                $keys = 'phone';
                $value = $params['guardian_phone'];
            }

            if (!empty($params['guardian_name'])) {
                $fathername = $params['guardian_name'];
            } else {
                $fathername = "vikash";
            }

           
            $regiNo = $params['admission_no'];
            $studentName = $params['name'];
              $total = number_format((float)($params['fine_amount_balance'] + $params['total']), 2, '.', '');
             
            $website=$params["paytm_website"];
            $api_publishable_key=$params['api_publishable_key'];
            $secret=$params['key'];
            
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $website.'/nexquare/embed/create/session',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>'{
                    "merchant": {
                        "confirmationURL": "' . base_url('students/zenda/callback') . '"
                    },
                    "parent": {
                        "fullName": "' . $fathername . '",
                        
                         "' . $keys . '":"' . $value . '"
                    },
                    "student": {
                        "registerNo": "'.$regiNo.'",
                        "fullName": "'.trim($studentName).'"
                    },
                    "s2s": {
                        "amount": '.$total.'
                    },
                    "landing": {
                        "to": "fee-payment-summary"
                    }
                }
                ',
                  CURLOPT_HTTPHEADER => array(
                    'client-id:'.$api_publishable_key,
                    'client-secret:'.$secret,
                    'Content-Type: application/json',
                    
                  ),
                ));

                $result = curl_exec($curl);
                $responses = json_decode($result, true);
                curl_close($curl);
                  if ($responses) {
                        $result = curl_close($curl);
                        redirect($responses['redirectURL']);
                }
    }

     public function callback()
    {

         $session = $this->input->get('sessionId');
        
         $params = $this->session->userdata('params');
         $bulk_fees = array();
         $params     = $this->session->userdata('params');
          $website=$params["paytm_website"];
            $api_publishable_key=$params['api_publishable_key'];
            $secret=$params['key'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $website.'/nexquare/embed/transaction/' . $session,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'client-id:'.$api_publishable_key,
                'client-secret:'.$secret,
                'Content-Type: application/json',
                    
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        
        $status=$data->transaction[0]->paymentStatus;
  
        $orderId=$data->transaction[0]->orderId;
        if ($response!='' && $orderId!='') {
            if($status!="Failed") {
               
                foreach ($params['student_fees_master_array'] as $fee_key => $fee_value) {
    
                    $json_array = array(
                        'amount'          =>  $fee_value['amount_balance'],
                        'date'            => date('Y-m-d'),
                        'amount_discount' => 0,
                        'amount_fine'     => $fee_value['fine_balance'],
                        'description'     => "Online fees deposit through Zenda order ID: " . $orderId,
                        'received_by'     => '',
                        'payment_mode'    => 'Zenda',
                    );
    
                    $insert_fee_data = array(
                        'student_fees_master_id' => $fee_value['student_fees_master_id'],
                        'fee_groups_feetype_id'  => $fee_value['fee_groups_feetype_id'],
                        'amount_detail'          => $json_array,
                    );
                    $bulk_fees[] = $insert_fee_data;
                    //========
                }
                $send_to     = $params['guardian_phone'];
                $inserted_id = $this->studentfeemaster_model->fee_deposit_bulk($bulk_fees, $send_to);
                if ($inserted_id) {
                     $this->session->set_userdata('orderId',$orderId);
                    redirect(base_url("students/payment/successinvoice"));
                } else {
                    redirect(base_url('students/payment/paymentfailed'));
                }
            } else {
                redirect(base_url('students/payment/paymentfailed'));
            }
        }else{
             redirect(base_url('students/payment/paymentfailed'));
        }
      
    }

}
