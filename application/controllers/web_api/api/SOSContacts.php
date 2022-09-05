<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SOSContacts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/SOSContacts_model');
        $this->load->model('api/SmsEmail_model');
        $this->load->model('api/ShareUrls_model');
        $this->url = "http://bhashsms.com/api/sendmsg.php?";
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function addSOS()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

		$this->form_validation->set_rules('uniid', 'User ID', 'required');

        $this->form_validation->set_rules('type', 'SOS Type', 'required');
        $this->form_validation->set_rules('name', 'SOS Name', 'required');
        $this->form_validation->set_rules('number', 'SOS Number', 'required');
		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$type = xss_clean($this->input->post('type'));
			$name = xss_clean($this->input->post('name'));
			$number = xss_clean($this->input->post('number'));

			$myName = xss_clean($this->input->post('MyName'));

			$data = array(
				"uniid" => $uniid,
				"sos_type" => $type,
				"sos_name" => $name,
				"sos_number" => $number
			);

			$chkSOS = array("sos.sos_number" => $number);
			$sosList = $this->SOSContacts_model->listSOS($chkSOS);

			// if($sosList)
			// {
			// 	$json['error'] = "true";
			// 	$json['message'] = "Already Added as SOS Contacts";
			// 	$json['data'] = $sosList;
			// }
			// else
			// {
				$user = "jnana325";
				$pass = "31025325";
				$sender = "JKATTA";
				$phone  = $number;
				$text  = $myName." was added your number as safety. Download app and confirm. myct.me/cartravels/app";
				$priority  = "ndnd";
				$stype  = "normal";

				$postData = array(
				    'user' => $user,
				    'pass' => $pass,
				    'sender' => $sender,
				    'phone' => $phone,
				    'text' => $text,
				    'priority' => $priority,
				    'stype' => $stype
				);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$this->url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
				$response = curl_exec($ch);

				if($response)
				{
					$status = $this->SOSContacts_model->saveSOS($data);

					if($status)
					{
						$json['error'] = "false";
						$json['message'] = "SOS Added Successfully";
					}
					else
					{
						$json['error'] = "true";
						$json['message'] = "Sorry! Unable to Process, Try again.";
					}
				}
				else
				{
					$json['error'] = "true";
					$json['message'] = "Sorry! Unable to send SMS, Try again.";
				}
			// }
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Validation Errors \n ".validation_errors();
		}
		echo json_encode($json);
	}

	public function getSOS()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("sos.uniid" => $uniid);
			
			$sosList = $this->SOSContacts_model->listSOS($whereArr);
			
			if($sosList)
			{
				$json['error'] = "false";
				$json['sosList'] = $sosList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['sosList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function deleteSOS()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
		
		if($this->input->method(TRUE) == 'POST')
		{
		    $uniid = $this->input->post("uniid");
	        $sosid = $this->input->post("sosid");

			$data = $this->SOSContacts_model->removeSOS($uniid, $sosid);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "SOS Contact Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Deleted";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function notAcceptedSOS()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$mobile = xss_clean($this->input->post('mobile'));

			$whereArr = array("sos.sos_number" => $mobile);
			
			$sosList = $this->SOSContacts_model->listSOS($whereArr);
			
			if($sosList)
			{
				$json['error'] = "false";
				$json['sosList'] = $sosList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['sosList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function acceptSOS()
	{
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|exact_length[10]');
        $this->form_validation->set_rules('userToken', 'User Token', 'required');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobile = xss_clean($this->input->post('mobile'));
			$userToken = xss_clean($this->input->post('userToken'));

			$data = $this->SOSContacts_model->acceptingSOS($mobile, $userToken);

			if($data)
			{
				$cpJson['error'] = "false";
				$cpJson['message'] = "SOS accepted Successfully";
				$cpJson['status'] = 1;
				$cpJson['data'] = $data;
			}
			else
			{
				$cpJson['error'] = "true";
				$cpJson['message'] = "Sorry! Unable to accept SOS";
				$cpJson['status'] = 0;
			}
		}
		else
		{
			$cpJson['error'] = "true";
			$cpJson['vlaidationErrors'] = validation_errors();
		}
		echo json_encode($cpJson);
	}

	public function smsAlertSOS()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$sosCode = xss_clean($this->input->post('sosCode'));

			$this->form_validation->set_rules('sosCode', 'SOS Code', 'required|is_unique[api_sos_share.sos_code]', array(
	                'required'      => 'You have not provided %s.',
	                'is_unique'     => 'Duplicate Entry of %s'
	        ));

	        if($this->form_validation->run() == true)
			{
				$whereArr = array("sos.uniid" => $uniid);

				$share_date = date('Y-m-d H:i:s', strtotime('+1 day'));

				$sosData = array(
					"sos_code" => $sosCode,
					"sos_uniid" => $uniid,
					"share_date" => $share_date
				);

				$status = $this->ShareUrls_model->saveSOSShareUrl($sosData);
				
				$sosList = $this->SOSContacts_model->listSOS($whereArr);
				
				$i = 1;

				$data = array();

				foreach ($sosList as $sos) {
					
					if($sos->sos_status == 1)
					{
						$sosNumber = $sos->sos_number;
						$sosEmail = $sos->sos_email;
						$sosName = $sos->sos_name;
						if(!empty($sos->requested_user_Owner_Name))
						{
							$inDanger = $sos->requested_user_Owner_Name;
						}
						else
						{
							$inDanger = $sos->requested_user_Name." ".$sos->requested_user_Surname;
						}

						$sts = $this->SmsEmail_model->sendSOSSmsEmail($sosNumber, $sosEmail, $sosName, $inDanger, $sosCode);
						$data[$i] = $sts;
						$i++;
					}
					
				}
				
				if(!empty($data))
				{
					$json = $data;
					$json['error'] = "false";
					$json['message'] = "Alert Sent Successfully";
				}
				else
				{
					$json['error'] = "true";
					$json['message'] = "No one is accepted as sos contacts";
				}
			}
			else
			{
				 $json['error'] = 'true';
				 $json['message'] = strip_tags(validation_errors());
			}
			
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}
}

?>