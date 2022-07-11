<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cashfree extends Student_Controller
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
        $amount=number_format((float)($params['fine_amount_balance']+$params['total']), 2, '.', '');
        $data['total'] = $amount;
        $data['symbol'] = $params['invoice']->symbol;
        $data['currency_name'] = $params['invoice']->currency_name;
        $data['name'] = $params['name'];
        $data['guardian_phone'] = $params['guardian_phone'];
        $data['guardian_name'] = $params['guardian_name'];
        $data['guardian_email']= $params['guardian_email'];
        $data['student_fees_master_array']=$data['params']['student_fees_master_array'];
        $posted = $_POST;
        $paytmParams = array();
        $ORDER_ID = time();
        $CUST_ID = time();
       
       
        $paytmParams = array(
            "appId" => $this->api_config->api_publishable_key,
            'orderId'=>$ORDER_ID,
            "api_secret_key" => $this->api_config->api_secret_key,
            "orderAmount" => $data['total'],
            'customerName'=>$params['name'],
            'customerPhone'=>$params['guardian_phone'],
            'customerEmail'=>($params['guardian_email'])? $params['guardian_email']:'Vikash@gmail.com',
            'orderCurrency'=>'INR',
            'orderNote'=>'Fee payment',
            "returnUrl" => base_url() . "students/cashfree/cashfree_response",
            "notifyUrl" => base_url() . "students/cashfree/cashfree_response",
        );
      
          //$data['transactionURL'] = $transactionURL;
        $data['paytmParams'] = $paytmParams;
        $this->load->view('student/cashfree', $data);
    }


    public function paynow()
    {
        $params = $this->session->userdata('params');

        $data = array();
        $data['params'] = $params;
        $data['setting'] = $this->setting;
        $data['api_error'] = array();
        $student_id = $params['student_id'];
        $total = $params['total'];
        $data['student_id'] = $student_id;
        $amount=number_format((float)($params['fine_amount_balance']+$params['total']), 2, '.', '');
        $data['total'] = $amount;
        $data['symbol'] = $params['invoice']->symbol;
        $data['currency_name'] = $params['invoice']->currency_name;
        $data['name'] = $params['name'];
        $data['guardian_phone'] = $params['guardian_phone'];
        $data['guardian_name'] = $params['guardian_name'];
        $data['guardian_email']= $params['guardian_email'];
        $data['student_fees_master_array']=$data['params']['student_fees_master_array'];
        
        $paytmParams = array();
        $ORDER_ID = time();
        $CUST_ID = time();

        $mode = $this->api_config->paytm_website;;
        $secretKey = $this->api_config->api_secret_key;
        $postData = array(
            "appId" => $this->api_config->api_publishable_key,
            'orderId'=>$ORDER_ID,
             "orderAmount" => $data['total'],
            'customerName'=>$params['name'],
            'customerPhone'=>$params['guardian_phone'],
            'customerEmail'=>($params['guardian_email'])? $params['guardian_email']:'Vikash@gmail.com',
            'orderCurrency'=>'INR',
            'orderNote'=>'Fee payment',
            "returnUrl" => base_url() . "students/cashfree/cashfree_response",
            "notifyUrl" => base_url() . "students/cashfree/cashfree_response",
        );
        ksort($postData);
        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }
        
        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);
 
        if ($mode == "PROD") {
            $url = "https://www.cashfree.com/checkout/post/submit";
        } else {
            $url = "https://test.cashfree.com/billpay/checkout/post/submit";
        }
        
 
      ?>
        <body onload="document.frm1.submit()">
        <form action="<?php echo $url; ?>" name="frm1" method="post">
          <p>Please wait.......</p>
          <input type="hidden" name="signature" value='<?php echo $signature; ?>' />
          <input type="hidden" name="orderNote" value='<?php echo $postData['orderNote']; ?>' />
          <input type="hidden" name="orderCurrency" value='<?php echo $postData['orderCurrency']; ?>' />
          <input type="hidden" name="customerName" value='<?php echo $postData['customerName']; ?>' />
          <input type="hidden" name="customerEmail" value='<?php echo $postData['customerEmail']; ?>' />
          <input type="hidden" name="customerPhone" value='<?php echo $postData['customerPhone']; ?>' />
          <input type="hidden" name="orderAmount" value='<?php echo $postData['orderAmount']; ?>' />
          <input type="hidden" name="notifyUrl" value='<?php echo $postData['notifyUrl']; ?>' />
          <input type="hidden" name="returnUrl" value='<?php echo $postData['returnUrl']; ?>' />
          <input type="hidden" name="appId" value='<?php echo $postData['appId']; ?>' />
          <input type="hidden" name="orderId" value='<?php echo $postData['orderId']; ?>' />
        </form>
      </body><?php

           
    }

     public function cashfree_response()
    {   
         $params = $this->session->userdata('params');
        $secretkey = $this->api_config->api_secret_key;
        $orderId = $_POST["orderId"];
        $orderAmount = $_POST["orderAmount"];
        $referenceId = $_POST["referenceId"];
        $txStatus = $_POST["txStatus"];
        $paymentMode = $_POST["paymentMode"];
        $txMsg = $_POST["txMsg"];
        $txTime = $_POST["txTime"];
        $signature = $_POST["signature"];
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
         if($txStatus=='SUCCESS' && $computedSignature===$signature){
              foreach ($params['student_fees_master_array'] as $fee_key => $fee_value) {
    
                    $json_array = array(
                        'amount'          =>  $fee_value['amount_balance'],
                        'date'            => date('Y-m-d'),
                        'amount_discount' => 0,
                        'amount_fine'     => $fee_value['fine_balance'],
                        'description'     => "Online fees deposit through Cashfree order ID: " . $orderId,
                        'received_by'     => '',
                        'payment_mode'    => 'Cashfree',
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
                    redirect(base_url("students/payment/successinvoice"));
                } else {
                    redirect(base_url('students/payment/paymentfailed'));
                }
         }else{
             redirect(base_url('students/payment/paymentfailed'));
         }
          
    }

}
