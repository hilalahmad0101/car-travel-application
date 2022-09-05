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


   	public function getPaymentsRequired()
   	{
   		if($this->input->method(TRUE) == 'POST')
		{
			$paymentCategory = xss_clean($this->input->post('paymentCategory'));
			if(!empty($paymentCategory))
			{
				$paymentsList = $this->Payments_model->adsPaymentsList($paymentCategory);
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



   	public function payment_init()
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
	        	"product_id" => $product_id,
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

   	public function payment_response()
   	{
		$attributes = $this->input->post();
		
		// print_r($attributes);
		// print_r($attributes['payment_details']);
		// print_r($attributes['payment_status']);

		// print_r($attributes['payment_details']['razorpay_order_id']);
		// print_r($attributes['payment_details']['razorpay_payment_id']);
		// print_r($attributes['payment_status']);


		// $attributes = json_decode($attributes);

		if($attributes['payment_details']['razorpay_order_id'] != '')
		{

			$payerData = $this->Payments_model->paymentDetails($attributes['payment_details']['razorpay_order_id']);

			if($attributes['payment_status'] == 1)
			{
				$paymentSts = "Success";

				$payerData = $this->Payments_model->paymentDetails($attributes['payment_details']['razorpay_order_id']);

				$this->Payments_model->updatePaymentID($attributes['payment_details']['razorpay_order_id'], $paymentSts, $attributes['payment_details']['razorpay_payment_id']);

				if($payerData->payment_subscription_type == 'membershipPlan')
				{
					$sts = $this->Payments_model->updatePaymentStatusMembership($payerData->product_id);
					if($sts)
					{
						$json['error'] = "false";
						$json['message'] = "Membership Activated";
					}
					else
					{
						$json['error'] = "true";
						$json['message'] = "Membership Not Activated";
					}
				}
				else
				{
					$expDate = date('Y-m-d', strtotime('+1 month', $payerData->created_on));
					$expDate = strtotime($expDate);
					$sts = $this->Payments_model->updatePaymentStatusAds($payerData->product_id, $expDate, $payerData->payment_id);
					if($sts)
					{
						$json['error'] = "false";
						$json['message'] = "Ad Activated";
					}
					else
					{
						$json['error'] = "true";
						$json['message'] = "Ad Not Activated";
					}
				}
			}
			else
			{
				if($attributes['payment_status'] == 0)
				{
					$paymentSts = "Fail";
				}


				$payerData = $this->Payments_model->paymentDetails($attributes['payment_details']['razorpay_order_id']);

				$this->Payments_model->updatePaymentID($attributes['payment_details']['razorpay_order_id'], $paymentSts, "");

				if($payerData->payment_subscription_type == 'membershipPlan')
				{
					$sts = $this->Payments_model->updatePaymentStatusMembershipFail($payerData->product_id);
					if($sts)
					{
						$json['error'] = "false";
						$json['message'] = "Membership Activated";
					}
					else
					{
						$json['error'] = "true";
						$json['message'] = "Membership Not Activated";
					}
				}
				else
				{
					$sts = $this->Payments_model->updatePaymentStatusAdsFail($payerData->product_id);
					if($sts)
					{
						$json['error'] = "false";
						$json['message'] = "Ad Activated";
					}
					else
					{
						$json['error'] = "true";
						$json['message'] = "Ad Not Activated";
					}
				}


				$json['error'] = "true";
				$json['message'] = "Payment Failed";
			}

		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "OrderID is Empty";
		}

		echo json_encode($json);
   	}


   	public function res()
   	{
   		$res['payment_status'] = "success";
   		$res['payment_details']['razorpay_payment_id'] = "pay_G9P9BqLX9IeHct";
   		$res['payment_details']['razorpay_order_id'] = "order_G9P8lfEyequXM6";
   		$res['payment_details']['razorpay_signature'] = "df2bfb98f1db1008955adad1b3b4cfa46fd350f510edf4beda7404c7321036cb";

   		echo json_encode($res);
   	}
}


?>