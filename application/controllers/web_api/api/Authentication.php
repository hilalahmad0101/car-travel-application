<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Authentication_model');

        $this->url = "http://bhashsms.com/api/sendmsg.php?";
    }
    
    public function index()
    {
        echo "Unknown Method & access denied <br>";
    }


    public function test()
    {
    	print_r($this->input->post());
    }

	public function chkUserMobile()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

		$OTP = rand(100000,999999);
		$mobileNumber = xss_clean($this->input->post('mobileNumber'));
		$email = xss_clean($this->input->post('email'));

		$data = $this->Authentication_model->checkMobile($mobileNumber);

		if(!empty($data))
		{
			$loginJson['data']['mobile'] = "Exist";
			$loginJson['data']['details'] = $data;
		}
		else
		{
			$loginJson['data']['mobile'] = "notExist";
			$loginJson['data']['details'] = $data;

			$user = "jnana325";
			$pass = "Jnana325@";
			$sender = "JKATTA";
			$phone  = $mobileNumber;
$text  = $OTP." is the OTP that you have Requested to Login to CarTravels.com. Please don%27t share with any one.

Regards
CarTravels.com";

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
				$loginJson['OTP'] = $OTP;
				$loginJson['OTP_STS'] = "SMS OTP Sent Successfully, Please check your Messages";
			}
			else
			{
				$loginJson['OTP'] = $OTP;
				$loginJson['OTP_STS'] = "SMS Faild Please try again";
			}


				$this->load->library('PHPMailer_Lib');
	        
				// PHPMailer object
				$mail = $this->phpmailer_lib->load();

				// SMTP configuration
				$mail->isSMTP();
				$mail->Host     = 'smtp.hostinger.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'info@geolandmarks.com';
				$mail->Password = 'CFNv9YnrKYZahKrE';
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom('info@geolandmarks.com', 'CarTravels');
				$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels');

				// Add a recipient
				$mail->addAddress($email);

				// Email subject
				$mail->Subject = 'OTP - Car Travels';

				// Set email format to HTML
				$mail->isHTML(true);

				// Email body content
				$message = "<div style='font-family: sans-serif;'><h3>verification OTP - Car Travels</h3> <br>
				Hi, ".$email."<br><br>
				Thanks for Creating an account with us.<br><br>
				
				Enter this verification code to complete the process.<br><br>
				<div style='text-align:center; border:1px solid black; padding: 5px; border-radius: 5px; font-size: 20px; font-weight: 800; background-color: #ddd; letter-spacing: 10px; text-decoration:none; width:200px;'>".$OTP."</div> <br><br>Thanks <br>Team";

				$mail->Body = $message;
    







				// $loginJson["mailSendSts"] = $mail->send();
				// $loginJson["smsSendSts"] = $response;


		        // Send email
				if ($mail->send()) 
				{   
					$loginJson['error'] = "false";
					$loginJson['message'] = "OTP Sent Successfully, Please check your E-Mail";
					$loginJson['mail_sts'] = 1;
				}
				else 
				{
					$loginJson['error'] = "true";
				    $loginJson['message'] = "Sorry! Unable to send Email OTP, Please try again.";
				    $loginJson['mail_sts'] = 0;
				}



				// if($response)
				// {
				// 	$loginJson['OTP'] = $OTP;
				// 	$loginJson['OTP_STS'] = "OTP Sent Successfully, Please check your E-Mail and Messages";
				// }
				// else
				// {
				// 	$loginJson['OTP'] = $OTP;
				// 	$loginJson['OTP_STS'] = "Faild Please try again";
				// }



				// if($response != '' && $mail->send() == true)
				// {
				// 	$loginJson['OTP'] = $OTP;
				// 	$loginJson['error'] = "false";
				// 	$loginJson['message'] = "SMS & Email OTP Sent Successfully, Please check.";
				// 	$loginJson['mail_sts'] = 1;
				// }
				// else if($response != '' && $mail->send() == false)
				// {
				// 	$loginJson['OTP'] = $OTP;
				// 	$loginJson['error'] = "false";
				// 	$loginJson['message'] = "SMS OTP Sent & Email OTP Not Sent, Please check your Messages.";
				// 	$loginJson['mail_sts'] = 0;
				// }
				// else if($response == '' && $mail->send() == true)
				// {
				// 	$loginJson['OTP'] = $OTP;
				// 	$loginJson['error'] = "false";
				// 	$loginJson['message'] = "SMS OTP not Sent & Email OTP Sent, Please check your Emails.";
				// 	$loginJson['mail_sts'] = 1;
				// }
				// else
				// {
				// 	$loginJson['error'] = "true";
				//     $loginJson['message'] = "Sorry! Unable to send Email and SMS OTP, Please try again.";
				//     $loginJson['mail_sts'] = 0;
				//     $loginJson['mail_sts'] = 0;
				// }









		}
		echo json_encode($loginJson);
	}

    public function signup()
	{	
		$this->form_validation->set_rules('mobileOTP', 'OTP', 'required');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[api_cartravel_users.user_email]', array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));

        $this->form_validation->set_rules('mobile','Mobile Number', 'required|exact_length[10]|is_unique[api_cartravel_users.user_mobile]', array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[25]');

		$this->form_validation->set_rules('confirmPassword', 'Conform Password', 'required|matches[password]');
		
        $this->form_validation->set_rules('deviseTokenID', 'User Devise Token', 'required');


		if($this->form_validation->run() == true)
		{
			// $name = xss_clean($this->input->post('name'));
			$email = xss_clean($this->input->post('email'));
			$mobile = xss_clean($this->input->post('mobile'));
			$mobileOTP = xss_clean($this->input->post('mobileOTP'));

			$deviseTokenID = xss_clean($this->input->post('deviseTokenID'));
			
			$password = xss_clean($this->input->post('password'));
			$pwd = sha1($password);
			$pwd64 = base64_encode($password);

			$pwdToken = rand(100000, 999999);

			$uniid = str_shuffle($email.$pwd.time());
			$uniid = str_replace('@', '', $uniid);
			$uniid = str_replace('.', '', $uniid);

			$token = sha1($uniid);

			$data = array(
				"uniid" => $uniid,
				"user_email" => $email,
				"user_mobile" => $mobile,
				"user_password" => $pwd,
				"user_passwordEnc" => $pwd64,
				"user_token" => $token,
				"user_DeviseTokenId" => $deviseTokenID,
				"user_name" => '',
				"user_status" => 'Active',
				"mobileVerification" => "Active",
				"mobileOTP" => $mobileOTP,
				"emailOTP" => $pwdToken,
				"created_date" => date('Y-m-d H:i:s')
			);

			$status = $this->Authentication_model->saveData($data);
			// $status = true;

			if($status == true)
			{

				$json['data']['token'] = $token;
				$json['data']['Uniid'] = $uniid;
				

				$this->load->library('PHPMailer_Lib');
	        
				// PHPMailer object
				$mail = $this->phpmailer_lib->load();

				// SMTP configuration
				$mail->isSMTP();
				$mail->Host     = 'smtp.hostinger.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'info@geolandmarks.com';
				$mail->Password = 'CFNv9YnrKYZahKrE';
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom('info@geolandmarks.com', 'CarTravels');
				$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels');

				// Add a recipient
				$mail->addAddress($email);

				// Email subject
				$mail->Subject = 'Account Created - CarTravels';

				// Set email format to HTML
				$mail->isHTML(true);

				// Email body content
				$message = "<div style='font-family: sans-serif;'><h3>Account has been created successfully - CarTravels.com</h3> <br>
				Hi, ".$email."<br><br>
				Register your business<br><br>
				
				Enter this verification code to complete the process.<br><br>
				
				<div style='text-align:center; border:1px solid black; padding: 5px; border-radius: 5px; font-size: 20px; font-weight: 800; background-color: #ddd; letter-spacing: 10px; text-decoration:none; width:200px;'>".$pwdToken."</div> <br><br>

				Thanks <br><b>cartravels.com</b>";

				$mail->Body = $message;
    
		        // Send email
				if (!$mail->send()) 
				{
				    $json['error'] = "true";
				    $json['message'] = "Sorry! Unable to send activation code, Please try again.";
				    $json['status'] = 0;

				} 
				else 
				{
					$json['error'] = "false";
					$json['message'] = "Thanks, Account created successfully, Please Activate your account through verify your E-Mail";
					$json['status'] = 1;
				}
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}

		echo json_encode($json);
	}

	public function user_activate($id)
	{
		$status = $this->Authentication_model->userUpdateStatus($id);

		if ($status == 1) 
		{
			echo "<h3>Account activated successfully, Please login now.</h3>";
		}

		else if ($status == 'Activated')
		{
			echo "<h3>Account already activated, Please login now.</h3>";
		}

		else
		{
			echo "<h3>Sorry!, Unable to activate, Contact Admin.</h3>";
		}
	}

    public function signin()
	{
		// header('Content-Type: application/json');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobileNumber = xss_clean($this->input->post('mobileNumber'));
			$email = xss_clean($this->input->post('email'));

			$password = xss_clean($this->input->post('password'));

			$pwd = sha1($password);

			$data = $this->Authentication_model->checkedemail($email, $mobileNumber);

			if($data)
			{
				if($data->user_password == $pwd)
				{
					$pwd64 = base64_encode($password);
					$this->Authentication_model->updatePassword64($pwd64, $data->uniid);

					if($data->user_status == 'Active')
					{
						unset($data->user_password);

						$loginJson['data']['token'] = $data->user_token;
						$loginJson['data']['Uniid'] = $data->uniid;
						$loginJson['data']['details'] = $data;
						$loginJson['error'] = "false";
					}
					else
					{
						$loginJson['error'] = "true";
						$loginJson['message'] = "Sorry!, Please activate your acount.";
					}
				}
				else
				{
					$loginJson['error'] = "true";
					$loginJson['message'] = "Sorry!, incorrect Password";
				}
			}
			else
			{
				$loginJson['error'] = "true";
				$loginJson['message'] = "Sorry! Check your login Credentials";
			}
		}
		else
		{
			$loginJson['error'] = "true";
			$loginJson['message'] = validation_errors();
		}

		echo json_encode($loginJson);
	}

	public function forgotPassword()
	{

		$this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobileNumber = xss_clean($this->input->post('mobileNumber'));
			// $email = xss_clean($this->input->post('email'));
			// $email = 'prathap599@gmail.com';

			$data = $this->Authentication_model->checkMobile($mobileNumber);
			


			if($data)
			{
				if($data->user_status == 'Active')
				{
					$email = $data->user_email;
					$forgotJson['uniid'] = $data->uniid;

					$pwdToken = rand(100000, 999999);

					$codeUpdateSts = $this->Authentication_model->updatePassCode($pwdToken, $data->uniid);

					if($codeUpdateSts == true)
					{

						$user = "jnana325";
						$pass = "Jnana325@";
						$sender = "JKATTA";
						$phone  = $mobileNumber;
$text  = $pwdToken." is the OTP that you have Requested to Forgot Password to CarTravels.com. Please don%27t share with any one.

Regards
CarTravels.com";

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
						curl_setopt($ch, CURLOPT_URL,'http://bhashsms.com/api/sendmsg.php?');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
						$response = curl_exec($ch);


						if($response)
						{
							$forgotJson['OTP'] = $pwdToken;
							$forgotJson['OTP_STS'] = "OTP Sent Successfully, Please check your E-Mail and Messages";
							$forgotJson['sms_status'] = 1;
							$forgotJson['sms_text'] = $text;
						}
						else
						{
							$forgotJson['OTP_STS'] = "SMS Faild Please Check your email";
							$forgotJson['sms_status'] = 0;
						}



						$this->load->library('PHPMailer_Lib');
	        
						// PHPMailer object
						$mail = $this->phpmailer_lib->load();

						// SMTP configuration
						$mail->isSMTP();
						$mail->Host     = 'smtp.hostinger.com';
						$mail->SMTPAuth = true;
						$mail->Username = 'info@geolandmarks.com';
						$mail->Password = 'CFNv9YnrKYZahKrE';
						$mail->SMTPSecure = 'ssl';
						$mail->Port     = 465;

						$mail->setFrom('info@geolandmarks.com', 'CarTravels');
						$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels');

						// Add a recipient
						$mail->addAddress($email);

						// Email subject
						$mail->Subject = 'Reset password - Car Travels';

						// Set email format to HTML
						$mail->isHTML(true);

						// Email body content
						$message = "<div style='font-family: sans-serif;'><h3>Reset Password - Car Travels</h3> <br>
						Hi, ".$email." <br><br>
						Someone, hopefully you, has requested to reset the password for your Account.<br><br>
						If you did not perform this request, you can safely ignore this email.<br><br> 
						Otherwise, Enter this code to complete the process.<br><br>
						<div style='text-align:center; border:1px solid black; padding: 5px; border-radius: 5px; font-size: 20px; font-weight: 800; background-color: #ddd; letter-spacing: 10px; text-decoration:none; width:200px;'>".$pwdToken."</div> <br><br>Thanks <br>Team";

						$mail->Body = $message;
	        
				        // Send email
						if (!$mail->send()) 
						{
						    $forgotJson['error'] = "true";
						    $forgotJson['message'] = "Sorry! Unable to send verify code, Please try again.";
						    $forgotJson['status'] = 0;
						} 
						else 
						{
							$forgotJson['error'] = "false";
							$forgotJson['message'] = "Thanks, Mail has been sent, Please verify your code and change password.";
							$forgotJson['status'] = 1;
						}
					}
					else
					{
						$forgotJson['error'] = "true";
						$forgotJson['message'] = "Sorry! Unable to generate verify code, Please try again...";
						$forgotJson['status'] = 0;
					}

				}
				else
				{
					$forgotJson['error'] = "true";
					$forgotJson['message'] = "Sorry!, Please activate your acount.";
				}
			}
			else
			{
				$forgotJson['error'] = "true";
				$forgotJson['message'] = "Sorry! Mobile Number does not exists.";
			}
		}
		else
		{
			$forgotJson['error'] = "true";
			$forgotJson['message'] = validation_errors();
		}

		echo json_encode($forgotJson);
	}

	public function resetCode()
	{
		// header('Content-Type: application/json');
		$this->form_validation->set_rules('passcode', 'Code', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$passCode = xss_clean($this->input->post('passcode'));
			$uniid = xss_clean($this->input->post('uniid'));
			$data = $this->Authentication_model->checkedPassCode($passCode, $uniid);
			if($data == true)
			{
				$codeJson['status'] = 1;
			}
			else
			{
				$codeJson['error'] = "true";
				$codeJson['message']= "Sorry! Verify code doesn't match, Please try again.";
				$codeJson['status'] = 0;
			}
		}
		else
		{
			$codeJson['error'] = "true";
			$codeJson['message'] = validation_errors();
		}

		echo json_encode($codeJson);
	}

    public function updateChangePassword()
    {
		// header('Content-Type: application/json');
		
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
		$this->form_validation->set_rules('passcode', 'Code', 'required');

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[25]');
		$this->form_validation->set_rules('confirmPassword', 'Conform Password', 'required|matches[password]');

		if($this->form_validation->run() == true)
		{

			$uniid = xss_clean($this->input->post('uniid'));
			$code = xss_clean($this->input->post('passcode'));
			// $password = xss_clean($this->input->post('password'));
			$password = sha1(xss_clean($this->input->post('password')));

			$data = $this->Authentication_model->newPasswordUpdating($uniid, $code, $password);

			if($data == true)
			{
				$cpJson['error'] = "false";
				$cpJson['message'] = "Password updated successfully, Please Login.";
				$cpJson['status'] = 1;
			}
			else
			{
				$cpJson['error'] = "true";
				$cpJson['message']= "Sorry! Password not updated, Don't use previous password !";
				$cpJson['status'] = 0;	
			}
		}
		else
		{
			$cpJson['error'] = "true";
			$cpJson['message'] = validation_errors();
		}

		echo json_encode($cpJson);
    }

	public function changePassword()
    {
		// header('Content-Type: application/json');
		
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
		$this->form_validation->set_rules('currentPassword', 'Current Password', 'required');

		$this->form_validation->set_rules('newPassword', 'Password', 'required|min_length[6]|max_length[25]');
		$this->form_validation->set_rules('confirmNewPassword', 'Conform Password', 'required|matches[newPassword]');

		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$currentPassword = sha1(xss_clean($this->input->post('currentPassword')));

			$newPassword = sha1(xss_clean($this->input->post('newPassword')));

			$rdata = $this->Authentication_model->checkPassword($currentPassword, $uniid);

			if(($rdata)?$rdata->user_password:'' == $currentPassword)
			{
				$data = $this->Authentication_model->chgPasswordUpdating($uniid, $newPassword);

				if($data == true)
				{
					$cpJson['error'] = "false";
					$cpJson['message'] = "Password updated successfully, Please Login.";
					$cpJson['status'] = 1;
				}
				else
				{
					$cpJson['error'] = "true";
					$cpJson['message']= "Sorry! Password not updated, Don't use previous password !";
					$cpJson['status'] = 0;	
				}
			}
			else
			{
				$cpJson['error'] = "true";
				$cpJson['message']= "Sorry! your Password doesn't match, Please try again.";
				$cpJson['status'] = 0;
			}
		}
		else
		{
			$cpJson['error'] = "false";
			$cpJson['message'] = validation_errors();
		}
		echo json_encode($cpJson);
    }

    public function deviseToken()
    {
		$mobile = xss_clean($this->input->post('mobile'));

		$result = $this->Authentication_model->getDeviseToken($mobile);

		if(!empty($result))
		{
			$data['data'] = $result;
		}
		else
		{
			$data['data'] = "No Devise Token";
		}

		echo json_encode($data);
    }


    public function updateDeviseTokenId()
    {
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
		
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|exact_length[10]', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('deviseTokenID', 'User Devise Token', 'required');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobile = xss_clean($this->input->post('mobile'));
			$uniid = xss_clean($this->input->post('uniid'));
			$deviseTokenID = xss_clean($this->input->post('deviseTokenID'));

			$data = $this->Authentication_model->newDeviseTokenUpdating($uniid, $mobile, $deviseTokenID);

			if($data == true)
			{
				$cpJson['error'] = "false";
				$cpJson['message'] = "Devise Token Updated Successfully";
				$cpJson['status'] = 1;
			}
			else
			{
				$cpJson['error'] = "true";
				$cpJson['message'] = "Sorry! Unable to update Devise Token";
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

    public function updateNotifyLocation()
    {
		if($this->input->method(TRUE) == 'POST')
		{
			$mobile = xss_clean($this->input->post('mobile'));
			$uniid = xss_clean($this->input->post('uniid'));
			$userLocation = xss_clean($this->input->post('userLocation'));

			$data = $this->Authentication_model->newUserLocationUpdating($uniid, $mobile, $userLocation);

			if($data == true)
			{
				$cpJson['status'] = 1;
			}
			else
			{
				$cpJson['status'] = 0;
			}
		}
		else
		{
			$cpJson['error'] = "true";
			$cpJson['message'] = "Unknown Method";
		}
		echo json_encode($cpJson);
    }

}