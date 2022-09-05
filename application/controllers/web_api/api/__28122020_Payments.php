<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'razorpay/Razorpay.php';
use Razorpay\Api\Api;

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/Payments_model');
        
        // $this->pay = new Api('rzp_live_2M9VnWBIpebUbz', RzPk);
        $this->pay = new Api('rzp_test_e4LZqpTKGfvqEX', "CHBbxZqckMLFrukdUEpX1HP2");

        $expectedSignature = hash_hmac('SHA256', 'order_GA35qwZxNryJSq|pay_GA36APiqbs2GTt', RzPk);
        // echo $expectedSignature;
        // exit;
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function paytest()
    {
    	$payment = $this->pay->payment->fetch('pay_GC6gLnS7RnUaaT');

    	echo "<pre>";
    	print_r($payment);
    	echo "</pre>";

    }

   	public function getPaymentsRequired()
   	{
   		if($this->input->method(TRUE) == 'POST')
		{
			$paymentCategory = xss_clean($this->input->post('paymentCategory'));
			if(!empty($paymentCategory))
			{
				$paymentsList = $this->Payments_model->adsPaymentsList($paymentCategory);

				// print_r($paymentsList);
				// exit;
			}
			else
			{
				$paymentsList = false;
			}
			
			if($paymentsList)
			{
				$json['error'] = "false";
				$json['data'] = $paymentsList;
			}
			else
			{
				$json['error'] = "true";
				$json['data'] = "No Payments Data";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
   	}



   	public function RazorPay()
   	{
   		if($this->input->method(TRUE) == 'POST')
		{
			$product_id = xss_clean($this->input->post('product_id'));
	   		$uniid = xss_clean($this->input->post('uniid'));
	   		$payCategory = xss_clean($this->input->post('paymentCategory'));

	   		$payerData = $this->Payments_model->payerDetails($uniid);

	   		$n = ($payerData->user_Owner_Name)?$payerData->user_Owner_Name:ucwords($payerData->user_Name.' '.$payerData->user_Surname); 
	   		$e = $payerData->user_Email;
	   		$m = $payerData->user_Mobile_No;

	   		if(!empty($payCategory))
			{
				$paymentsList = $this->Payments_model->adsPaymentsList($payCategory);
				$subscriptionAmount = $paymentsList->subscription_amount;
				$subscriptionGst = $paymentsList->subscription_gst;

				$plan_details['price'] = $subscriptionAmount + ($subscriptionAmount/100)*$subscriptionGst;
			}
			else
			{
				$paymentsList = false;
			}

	   		$orderID = strtoupper(uniqid('CT_'));
	        $txnid = uniqid("TXN-");

	         $orderData = [
	             'receipt' => $orderID,
	             'amount' => ($plan_details['price'])*100,
	             'currency' => 'INR',
	             'payment_capture' => 1
	         ];
	         $razorpayOrder = $this->pay->order->create($orderData);
	         $options = array(
	             'key' => RzPk,
	             'currency' => 'INR',
	             'name' => 'CarTravels',
	             "description" => "IndianTravelCommunity",
	             "image" => base_url('assets/payments/logo.jpg'),
	             'prefill' => array(
	                'name' => $n,
	                'email' => $e,
	                'contact' => $m,
	             ),
	             "theme" => "#ee2120",
	             "order_id" => $razorpayOrder['id'],
	             "notes" => array('merchant_order_id' => $orderID)
	         );
	        $json['options'] = $options;

	        $saveData = array(
	        	"c_order_id" => $orderID,
	        	"razorpay_order_id" => $razorpayOrder['id'],
	        	"payment_subscription_type" => $payCategory,
	        	"Amount" => $subscriptionAmount,
	        	"Amount_gst" => ($subscriptionAmount/100)*$subscriptionGst,
	        	"uniid" => $uniid,
	        	"created_on" => time()
	        );

	        $this->Payments_model->saveTransactions($saveData);
	    }
	    else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
   	}

   	public function RazorPayResponse()
   	{
   		$payment = $this->pay->payment->fetch('pay_GC6gLnS7RnUaaT');

		$attributes = $this->input->post("attributes");
		$attributes = json_decode($attributes, true);
   		$order  = $this->pay->utility->verifyPaymentSignature($attributes);
   		print_r(var_dump($order));
   		print_r($attributes);
   		print_r($order);
   	}
}


?>