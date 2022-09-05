<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmsEmail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		
        $this->load->model('api/Authentication_model');

        $this->smsUrl = "http://bhashsms.com/api/sendmsg.php?";
    }
   
    public function sendSOSSmsEmail($sosNumber, $sosEmail, $sosName, $inDanger, $sosCode)
	{
		$alertLocation = "https://www.myct.me/app.php?sos=".$sosCode;

		if(empty($sosCode))
		{
			$loginJson['error'] = "true";
			$loginJson['alert'] = "SOS Location is Empty";
		}
		else
		{
			$loginJson['error'] = "false";

			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $sosNumber;
			$text  = "This is ".$inDanger.". I need some help. It's not an emergency. [https://myct.me/cartravels/app.php?sos=".$sosCode."] for more info";
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
			curl_setopt($ch, CURLOPT_URL,$this->smsUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			$response = curl_exec($ch);


			if($response)
			{
				$loginJson['alert_sts'] = 1;
			}
			else
			{
				$loginJson['alert_sts'] = 0;
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

			$mail->setFrom('info@geolandmarks.com', 'CarTravels - SOS Alert');
			$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - SOS Alert');

			// Add a recipient
			$mail->addAddress($sosEmail);

			// Email subject
			$mail->Subject = 'SOS Alert - '.$inDanger.' - Need Help';

			// Set email format to HTML
			$mail->isHTML(true);



			$text  = "This is ".$inDanger.". I need some help. It's not an emergency. [https://myct.me/cartravels/app.php?sos".$sosCode."] for more info";


			// Email body content
			$message = "<div style='font-family: sans-serif;'><h3>SOS Alert - Car Travels</h3> <br>
			<h3 style='padding: 5px;margin:0px;'>Hi, This is <span style='color:red;'>".$inDanger."</span></h3><br><br>
			<h1 style='padding: 5px;margin:0px;'>I Need Help</h1>
			
			It's not an emergency.<br><br>
			<a href=".$alertLocation." style='text-align:center; border:1px solid black; padding: 5px; border-radius: 5px; font-size: 12px; background-color: #ddd; text-decoration:none; width:200px;' target='_blank'>".$alertLocation."</a> <br><br>Thanks <br>Team </div>";

			$mail->Body = $message;

	        // Send email
			if ($mail->send()) 
			{   
				$loginJson['mail_sts'] = 1;
			}
			else 
			{
			    $loginJson['mail_sts'] = 0;
			}
			$loginJson["successData"] = array('sosName' => $sosName, 'sosNumber' => $sosNumber);

		}
		return $loginJson;
	}

}
