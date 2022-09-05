<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Bookings_model');
        $this->smsurl = "http://bhashsms.com/api/sendmsg.php?";
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        // echo date('Y-m-d H:i:s'+1y);
        echo "<br>";
        $end = date('Y-m-d', strtotime('+1 years'));
        echo $end;
    }
 
    public function bookNow()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$postUniid = xss_clean($this->input->post('postUniid'));
			$booking_category = xss_clean($this->input->post('category'));
			$booking_pid = xss_clean($this->input->post('pid'));

			$postLabel = xss_clean($this->input->post('postLabel'));
			$postID = xss_clean($this->input->post('postID'));
			
			$selectedSeats = xss_clean($this->input->post('selectedSeats'));
			$totalFare = xss_clean($this->input->post('totalFare'));

			$noOfHours = xss_clean($this->input->post('noOfHours'));
			$hoursFare = xss_clean($this->input->post('hoursFare'));

			$tourSingle = xss_clean($this->input->post('tourSingle'));
			$tourCouple = xss_clean($this->input->post('tourCouple'));
			$tourChild = xss_clean($this->input->post('tourChild'));
			$tourCalcAmount = xss_clean($this->input->post('tourCalcAmount'));

			$sdRequestDate = xss_clean($this->input->post('sdRequestDate'));
			$sdRequestTime = xss_clean($this->input->post('sdRequestTime'));

			$tpRequestDate = xss_clean($this->input->post('tpRequestDate'));

			$booking_pickup_city = xss_clean($this->input->post('pickupCity'));
			$booking_drop_city = xss_clean($this->input->post('dropCity'));
			$booking_depart_date = xss_clean($this->input->post('departDate'));
			$booking_depart_time = xss_clean($this->input->post('departTime'));
			$booking_return_date = xss_clean($this->input->post('returnDate'));
			$booking_return_time = xss_clean($this->input->post('returnTime'));
			$booking_trip = xss_clean($this->input->post('trip'));
			$booking_trip_type = xss_clean($this->input->post('tripType'));

			$data = array(
				"uniid" => $uniid,
				"ownerUniid" => $postUniid,
				"booking_category" => $booking_category,
				"booking_pid" => $booking_pid,
				"postLabel" => $postLabel,
				"postID" => $postID,
				"booking_pickup_city" => $booking_pickup_city,
				"booking_drop_city" => $booking_drop_city,
				"booking_depart_date" => $booking_depart_date,
				"booking_depart_time" => $booking_depart_time,
				"booking_return_date" => $booking_return_date,
				"booking_return_time" => $booking_return_time,
				"booking_trip" => $booking_trip,
				"booking_trip_type" => $booking_trip_type,

				"booking_date" => date('Y-m-d H:i:s')
			);

			switch ($postLabel) {
				case "sdvID":
					$data["sdv_hours"] = $noOfHours;
					$data["sdv_HoursFare"] = $hoursFare;
					$data["sdv_request_date"] = $sdRequestDate;
					$data["sdv_request_time"] = $sdRequestTime;
					$tableName = "api_cartravel_sdv";
					break;
				case "tdaID":
					$tableName = "api_cartravel_tdacars";
					break;
				case "vcID":
					$tableName = "api_cartravel_vc";
					break;
				case "otherID":
					$tableName = "api_cartravel_others";
					break;
				case "tpID":
					$data["tp_single"] = $tourSingle;
					$data["tp_couple"] = $tourCouple;
					$data["tp_child"] = $tourChild;
					$data["tp_calc_amount"] = $tourCalcAmount;
					$data["tp_request_date"] = $tpRequestDate;
					$tableName = "api_cartravel_tours_travels";
					break;
				case "dpID":
					$data["booking_seats"] = $selectedSeats;
					$data["booking_ticket_fare"] = $totalFare;
					$tableName = "api_cartravel_dropping_cars";
					break;
				case "accID":
					$tableName = "api_cartravel_accbw";
					break;
				case "jobID":
					$tableName = "api_cartravel_jobs";
					break;
				case "tendID":
					$tableName = "api_cartravel_tenders";
					break;
			  default:
			    $tableName = "UnknownTable";
			}

			$updateWr = array(
				"postingID" => $booking_pid,
				"$postLabel" => $postID
			);

			$whereArr = array(
				"$postLabel" => $postID
			);

			$status = $this->Bookings_model->saveBooking($data, $updateWr, $whereArr, $tableName);

			if($status)
			{
				$json['error'] = "false";
				$json['bookingID'] = $status;
				$json['message'] = "Booked Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Booking, Try again.";
			}
		}
		else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
		echo json_encode($json);
	}

	public function getBookings()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			// $bookingID = xss_clean($this->input->post('bookingID'));

			$wrArr = array("b.uniid" => $uniid);
			// $wrArr = array("b.uniid" => $uniid, "b.bookingID" => $bookingID);
			
			$bookings = $this->Bookings_model->listBookings($wrArr);
			
			if($bookings)
			{
				$json['error'] = "false";
				$json['bookings'] = $bookings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['bookings'] = 0;
			}
			echo json_encode($json);
		}
	}

	public function getOwnerBookings()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('ownerUniid'));

			$wrArr = array("b.ownerUniid" => $uniid);
			
			$bookings = $this->Bookings_model->listBookings($wrArr);
			
			if($bookings)
			{
				$json['error'] = "false";
				$json['bookings'] = $bookings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['bookings'] = 0;
			}
			echo json_encode($json);
		}
	}

    public function ownerBookingAcceptance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $bookingID = xss_clean($this->input->post('bookingID'));
            $ownerUniid = xss_clean($this->input->post('ownerUniid'));

			$wrArr = array("b.ownerUniid" => $ownerUniid, "b.bookingID" => $bookingID);

            $smsMailData = $this->Bookings_model->listBookings($wrArr);            
            

if($smsMailData)
{
	$smd = $smsMailData[0];

	if($smd->postLabel === 'dpID')
	{

$smsText = "CarTravels.com Mobile Ticket:
From: ".$smd->booking_pickup_city."
To: ".$smd->booking_drop_city."
Category : ".$smd->booking_category."

Booking No: ".$smd->bookingID."

Journey Date: ".$smd->dp_journey_date."
Departure Time: ".$smd->dp_journey_time."
No of Seats: ".$smd->booking_seats."
Total Amount: Rs.".$smd->booking_ticket_fare."
Car Type: ".$smd->dp_vehicle_type."
Booking Accepted
Please report 15 minutes before dep time.
Driver Name & Number : ".$smd->dp_driver_name.", ".$smd->dp_driver_mobile;


			$table = "<table style='border-collapse:collapse; border:1px solid #ddd; width:100%; font-family: sans-serif;'>";

				$table .= "<tr>";
				$table .= "<th><img src='https://www.cartravels.com/web/images/car-travels-logo.png' style='float: left;padding: 10px; width: 250px;'></th>";
				$table .= "<th></th>";
				$table .= "<th style='float: right;'><a href='https://play.google.com/store/apps/details?id=cartravels.co' target='_blank'><img src='https://cartravels.com/assets/img/android.png' style='width:50px; padding: 5px;'></a><img src='https://cartravels.com/assets/img/ios.png' style='width:50px; padding: 5px;'></th>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>
				<span style='font-size: 20px;font-weight: 600;'>Category : ".$smd->booking_category." </span><br>Booked on : ".$smd->booking_date." </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px; text-align:right;'>Booking No : <b>".$smd->bookingID."</b> <br> </td>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>From : <b>".$smd->booking_pickup_city."</b></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> <img src='https://cartravels.com/assets/img/arrow.png'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>To : <b>".$smd->booking_drop_city."</b></td>";
				$table .= "</tr>";



				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>Journey Date : ".$smd->dp_journey_date." <br> Journey Time : ".$smd->dp_journey_time."</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "</tr>";


				$table .= "<tr><td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Vehicle Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Car Type </td> <td>:</td> <td> ".$smd->dp_vehicle_type."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> Trip </td> <td>:</td> <td>Booking Accepted</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>  </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Payment Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Number of Seats </td> <td>:</td> <td> ".$smd->booking_seats."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Total Amount </td> <td>:</td> <td> ".$smd->booking_ticket_fare."</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";

				$table .= "</tr>";
				$table .= "<tr>";
				$table .= "<th>";

				$table .= "<div style='font-family: sans-serif; float: left;'>
				<h3 style='padding:5px; text-align:left;'> Driver Name : <span style='color:red;'> ".$smd->dp_driver_name."</span> <br> Driver Number : <span style='color:red;'> ".$smd->dp_driver_mobile."</span>
				</h3></div>";

				$table .= "</th><th></th><th></th></tr>";
				$table .= "<tr>
								<th style='width:45%;border: 1px solid #ddd; padding: 5px;' colspan='3'>
									<img src='https://www.cartravels.com/assets/img/ctimage.jpg' style='width: 100%;'>
								</th>
							</tr>";
			$table .= "</table>";


			$this->load->library('PHPMailer_Lib');		// PHPMailer object
			$mail = $this->phpmailer_lib->load();
			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'info@geolandmarks.com';
			$mail->Password = 'CFNv9YnrKYZahKrE';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;

			$mail->setFrom('info@geolandmarks.com', 'CarTravels - Booking Confirmation');
			$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - Booking Confirmation');


			$mail->addAddress($smd->bookie_email);		// Add a recipient
			$mail->Subject = $smd->bookingID.' - Booking';	// Email subject
			$mail->isHTML(true);						// Set email format to HTML
			$mail->Body = $table;

			if ($mail->send()) 							// Send email
			{   
				$json['mail_sts'] = 1;
			}
			else 
			{
			    $json['mail_sts'] = 0;
			}



			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $smd->bookie_ownerMobile;
			$priority  = "ndnd";
			$stype  = "normal";

			$postData = array(
			    'user' => $user,
			    'pass' => $pass,
			    'sender' => $sender,
			    'phone' => $phone,
			    'text' => $smsText,
			    'priority' => $priority,
			    'stype' => $stype
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->smsurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			$response = curl_exec($ch);

			if($response)
			{
				$json['alert_sts'] = 1;
			}
			else
			{
				$json['alert_sts'] = 0;
			}
	}
	else if($smd->postLabel === 'sdvID')
	{

$smsText = "CarTravels.com Mobile Confirmation:
Category : ".$smd->booking_category."
Booking No: ".$smd->bookingID."
Vehicle Required Date: ".$smd->sdv_request_date."
Vehicle Required Time: ".$smd->sdv_request_time."
No of Hours: ".$smd->sdv_hours."
Total Amount: Rs.".$smd->sdv_HoursFare."
Car Type: ".$smd->sdv_name." (".$smd->sdv_vehicle_year.")
Fuel Type: ".$smd->sdv_fuel_type."
Booking Accepted";

			$table = "<table style='border-collapse:collapse; border:1px solid #ddd; width:100%; font-family: sans-serif;'>";

				$table .= "<tr>";
				$table .= "<th><img src='https://www.cartravels.com/web/images/car-travels-logo.png' style='float: left;padding: 10px; width: 250px;'></th>";
				$table .= "<th></th>";
				$table .= "<th style='float: right;'><a href='https://play.google.com/store/apps/details?id=cartravels.co' target='_blank'><img src='https://cartravels.com/assets/img/android.png' style='width:50px; padding: 5px;'></a><img src='https://cartravels.com/assets/img/ios.png' style='width:50px; padding: 5px;'></th>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>
				<span style='font-size: 20px;font-weight: 600;'>Category : ".$smd->booking_category." </span><br>Booked on : ".$smd->booking_date." </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px; text-align:right;'>Booking No : <b>".$smd->bookingID."</b> <br> </td>";
				$table .= "</tr>";


				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>Vehicle Pickup Date : ".$smd->sdv_request_date." <br> Vehicle Pickup Time : ".$smd->sdv_request_time."</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "</tr>";


				$table .= "<tr><td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Vehicle Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Car Type </td> <td>:</td> <td> ".$smd->sdv_name." (".$smd->sdv_vehicle_year.")  (".$smd->sdv_fuel_type.")</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> Self Driving </td> <td>:</td> <td>Booking Accepted</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>  </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Payment Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Number of Hours </td> <td>:</td> <td> ".$smd->sdv_hours."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Total Amount </td> <td>:</td> <td> ".$smd->sdv_HoursFare."</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";

				$table .= "</tr>";


				$table .= "<tr>
								<th style='width:45%;border: 1px solid #ddd; padding: 5px;' colspan='3'>
									<img src='https://www.cartravels.com/assets/img/ctimage.jpg' style='width: 100%;'>
								</th>
							</tr>";
			$table .= "</table>";

			$this->load->library('PHPMailer_Lib');		// PHPMailer object
			$mail = $this->phpmailer_lib->load();

			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'info@geolandmarks.com';
			$mail->Password = 'CFNv9YnrKYZahKrE';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;

			$mail->setFrom('info@geolandmarks.com', 'CarTravels - Booking Confirmation');
			$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - Booking Confirmation');


			$mail->addAddress($smd->bookie_email);		// Add a recipient
			$mail->Subject = $smd->bookingID.' - Booking';	// Email subject
			$mail->isHTML(true);						// Set email format to HTML
			$mail->Body = $table;

			if ($mail->send()) 							// Send email
			{   
				$json['mail_sts'] = 1;
			}
			else 
			{
			    $json['mail_sts'] = 0;
			}



			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $smd->bookie_ownerMobile;
			$priority  = "ndnd";
			$stype  = "normal";

			$postData = array(
			    'user' => $user,
			    'pass' => $pass,
			    'sender' => $sender,
			    'phone' => $phone,
			    'text' => $smsText,
			    'priority' => $priority,
			    'stype' => $stype
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->smsurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			$response = curl_exec($ch);

			if($response)
			{
				$json['alert_sts'] = 1;
			}
			else
			{
				$json['alert_sts'] = 0;
			}
	}
	else if($smd->postLabel === 'tpID')
	{
		$tpMembers = '';
		if(!empty($smd->tp_single))
		{
			$tpMembers .= $smd->tp_single." Singles, ";	
		}
		if(!empty($smd->tp_couple))
		{
			$tpMembers .= $smd->tp_couple." Couples, ";	
		}
		if(!empty($smd->tp_child))
		{
			$tpMembers .= $smd->tp_child." Childs, ";	
		}

		if(!empty($smd->pid_userName) && !empty($smd->pid_userSurname))
		{
			$pidFullName = $smd->pid_userName.' '.$smd->pid_userSurname;
		}
		else
		{
			$pidFullName = $smd->pid_ownerName;
		}

		

		$smd->tp_calc_amount;

$smsText = "CarTravels.com Mobile Confirmation:
Category: ".$smd->booking_category."
Booking No: ".$smd->bookingID."
Tour Package Name: ".$smd->tour_package_name."
Members: ".$tpMembers."
Tour Request Date: ".$smd->tp_request_date."
Tour Plan Days: ".$smd->tour_plan_days."
Total Amount: Rs.".$smd->tp_calc_amount."
Tour Travel Details: ".$pidFullName.", ".$smd->pid_ownerMobile."
Booking Accepted";



			$table = "<table style='border-collapse:collapse; border:1px solid #ddd; width:100%; font-family: sans-serif;'>";

				$table .= "<tr>";
				$table .= "<th><img src='https://www.cartravels.com/web/images/car-travels-logo.png' style='float: left;padding: 10px; width: 250px;'></th>";
				$table .= "<th></th>";
				$table .= "<th style='float: right;'><a href='https://play.google.com/store/apps/details?id=cartravels.co' target='_blank'><img src='https://cartravels.com/assets/img/android.png' style='width:50px; padding: 5px;'></a><img src='https://cartravels.com/assets/img/ios.png' style='width:50px; padding: 5px;'></th>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>
				<span style='font-size: 20px;font-weight: 600;'>Category : ".$smd->booking_category." </span><br>Booked on : ".$smd->booking_date." </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px; text-align:right;'>Booking No : <b>".$smd->bookingID."</b> <br> </td>";
				$table .= "</tr>";


				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>Tour Package Request Date : ".$smd->tp_request_date." <br> Members : ".$tpMembers."</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;text-align:right;'>Tour Package Name <b>".$smd->tour_package_name."</b></td>";
				$table .= "</tr>";


				$table .= "<tr><td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Tour Plan Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Tour Places </td> <td>:</td> <td> ".str_replace('#', ', ', $smd->tour_keywords)." </td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> No.of.Days </td> <td>:</td> <td>".$smd->tour_plan_days."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> Tour </td> <td>:</td> <td>Booking Accepted</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>  </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Payment Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Members </td> <td>:</td> <td> ".$tpMembers."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Total Amount </td> <td>:</td> <td> ".$smd->tp_calc_amount."</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";

				$table .= "</tr>";
				$table .= "<tr>";
				$table .= "<th>";

				$table .= "<div style='font-family: sans-serif; float: left;'>
				<h3 style='padding:5px; text-align:left;'> Traveller Name : <span style='color:red;'> ".$pidFullName."</span> <br> Traveller Number : <span style='color:red;'> ".$smd->pid_ownerMobile."</span>
				</h3></div>";

				$table .= "</th><th></th><th></th></tr>";

				$table .= "<tr>
								<th style='width:45%;border: 1px solid #ddd; padding: 5px;' colspan='3'>
									<img src='https://www.cartravels.com/assets/img/ctimage.jpg' style='width: 100%;'>
								</th>
							</tr>";
			$table .= "</table>";


			$this->load->library('PHPMailer_Lib');		// PHPMailer object
			$mail = $this->phpmailer_lib->load();

			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'info@geolandmarks.com';
			$mail->Password = 'CFNv9YnrKYZahKrE';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;

			$mail->setFrom('info@geolandmarks.com', 'CarTravels - Booking Confirmation');
			$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - Booking Confirmation');


			$mail->addAddress($smd->bookie_email);		// Add a recipient
			$mail->Subject = $smd->bookingID.' - Booking';	// Email subject
			$mail->isHTML(true);						// Set email format to HTML
			$mail->Body = $table;

			if ($mail->send()) 							// Send email
			{   
				$json['mail_sts'] = 1;
			}
			else 
			{
			    $json['mail_sts'] = 0;
			}



			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $smd->bookie_ownerMobile;
			$priority  = "ndnd";
			$stype  = "normal";

			$postData = array(
			    'user' => $user,
			    'pass' => $pass,
			    'sender' => $sender,
			    'phone' => $phone,
			    'text' => $smsText,
			    'priority' => $priority,
			    'stype' => $stype
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->smsurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			$response = curl_exec($ch);

			if($response)
			{
				$json['alert_sts'] = 1;
			}
			else
			{
				$json['alert_sts'] = 0;
			}
	}
}

            $minKM = xss_clean($this->input->post('minKM'));
            $perKM = xss_clean($this->input->post('perKM'));
            $extKM = xss_clean($this->input->post('extKM'));
            $driverBatha = xss_clean($this->input->post('driverBatha'));
            $tollTax = xss_clean($this->input->post('tollTax'));
            $parkingFee = xss_clean($this->input->post('parkingFee'));
            $nightHalt = xss_clean($this->input->post('nightHalt'));

            $tdaTotalAmount = xss_clean($this->input->post('tdaTotalAmount'));

            $fareComments = xss_clean($this->input->post('fareComments'));


            $update = array(
                "booking_owner_acceptance_status" => 1,
                "tda_min_km" => $minKM,
                "tda_per_km" => $perKM,
                "tda_ext_km" => $extKM,
                "tda_driver_batha" => $driverBatha,
                "tda_toll_tax" => $tollTax,
                "tda_parking_fee" => $parkingFee,
                "tda_night_halt" => $nightHalt,
                "tda_total_amount" => $tdaTotalAmount,
                "fare_comments" => $fareComments,
                "booking_owner_acceptance_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "bookingID" => $bookingID,
                "ownerUniid" => $ownerUniid
            );

            $status = $this->Bookings_model->updateOwnerBookingAcceptance($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Booking Accepted";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to accept Booking, Try again.";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function bookieReadAcceptance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $bookingID = xss_clean($this->input->post('bookingID'));
            $uniid = xss_clean($this->input->post('uniid'));

			$wrArr = array("b.uniid" => $uniid, "b.bookingID" => $bookingID);

            $smsMailData = $this->Bookings_model->listBookings($wrArr);

if($smsMailData)
{
	$smd = $smsMailData[0];
	if($smd->postLabel === 'tdaID')
	{
		if(!empty($smd->pid_userName) && !empty($smd->pid_userSurname))
		{
			$pidFullName = $smd->pid_userName.' '.$smd->pid_userSurname;
		}
		else
		{
			$pidFullName = $smd->pid_ownerName;
		}


$smsText = "CarTravels.com Mobile Ticket:
From: ".$smd->booking_pickup_city."
To: ".$smd->booking_drop_city."
Category : ".$smd->booking_category."

Booking No: ".$smd->bookingID."

Journey Date: ".$smd->booking_depart_date."
Departure Time: ".$smd->booking_depart_time."
Total Amount: Rs.".$smd->tda_total_amount."
Car Type: ".$smd->tda_car_type."
Trip : ".$smd->booking_trip.", Booking Accepted
Please report 15 minutes before dep time.
Driver Name & Number : ".$pidFullName.", ".$smd->pid_ownerMobile;


			$table = "<table style='border-collapse:collapse; border:1px solid #ddd; width:100%; font-family: sans-serif;'>";

				$table .= "<tr>";
				$table .= "<th><img src='https://www.cartravels.com/web/images/car-travels-logo.png' style='float: left;padding: 10px; width: 250px;'></th>";
				$table .= "<th></th>";
				$table .= "<th style='float: right;'><a href='https://play.google.com/store/apps/details?id=cartravels.co' target='_blank'><img src='https://cartravels.com/assets/img/android.png' style='width:50px; padding: 5px;'></a><img src='https://cartravels.com/assets/img/ios.png' style='width:50px; padding: 5px;'></th>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>
				<span style='font-size: 20px;font-weight: 600;'>CarTravels.com </span><br>Booked on : ".$smd->booking_user_read_datetime." </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px; text-align:right;'>Booking No : <b>$smd->bookingID</b> <br> Category : ".$smd->booking_category."</td>";
				$table .= "</tr>";

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>From : <b>".$smd->booking_pickup_city."</b></td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> <img src='https://cartravels.com/assets/img/arrow.png'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>To : <b>".$smd->booking_drop_city."</b></td>";
				$table .= "</tr>";



				$table .= "<tr>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>Journey Date : ".$smd->booking_depart_date." <br> Journey Time : ".$smd->booking_depart_time."</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
				$table .= "</tr>";


				$table .= "<tr><td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Vehicle Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Car Type </td> <td>:</td> <td> ".$smd->tda_car_type."</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> Trip </td> <td>:</td> <td> ".$smd->booking_trip." Booking Accepted</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>  </td>";
				$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>";
				$table .= "<table>";
				$table .= "<tr> <td colspan='3'> Payment Details</td> </tr>";
				$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Total Amount </td> <td>:</td> <td> ".$smd->tda_total_amount."</td> </tr>";
				$table .= "</table>";
				$table .= "</td>";

				$table .= "</tr>";
				$table .= "<tr>";
				$table .= "<th>";

				$table .= "<div style='font-family: sans-serif; float: left;'>
				<h3 style='padding:5px; text-align:left;'> Driver Name : <span style='color:red;'> ".$pidFullName."</span> <br> Driver Number : <span style='color:red;'> ".$smd->pid_ownerMobile."</span>
				</h3></div>";
				$table .= "</th><th></th><th></th></tr>";
				$table .= "<tr>
								<th style='width:45%;border: 1px solid #ddd; padding: 5px;' colspan='3'>
									<img src='https://www.cartravels.com/assets/img/ctimage.jpg' style='width: 100%;'>
								</th>
							</tr>";
			$table .= "</table>";


			$this->load->library('PHPMailer_Lib');
			$mail = $this->phpmailer_lib->load();			// PHPMailer object


			$mail->isSMTP();
				$mail->Host     = 'smtp.hostinger.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'info@geolandmarks.com';
				$mail->Password = 'CFNv9YnrKYZahKrE';
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom('info@geolandmarks.com', 'CarTravels - Booking Confirmation');
				$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - Booking Confirmation');


			$mail->addAddress($smd->bookie_email);			// Add a recipient
			$mail->Subject = $smd->bookingID.' - Booking';	// Email subject
			$mail->isHTML(true);				// Set email format to HTML
			$mail->Body = $table;

			if ($mail->send()) 					// Send email
			{   
				$loginJson['mail_sts'] = 1;
			}
			else 
			{
			    $loginJson['mail_sts'] = 0;
			}


			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $smd->bookie_ownerMobile;
			$priority  = "ndnd";
			$stype  = "normal";

			$postData = array(
			    'user' => $user,
			    'pass' => $pass,
			    'sender' => $sender,
			    'phone' => $phone,
			    'text' => $smsText,
			    'priority' => $priority,
			    'stype' => $stype
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->smsurl);
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
	}
}

   
            $update = array(
                "booking_user_read_status" => 200,
                "booking_user_read_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "bookingID" => $bookingID,
                "uniid" => $uniid,
                "booking_owner_acceptance_status" => 1
            );



            $status = $this->Bookings_model->updateOwnerBookingAcceptance($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Readed";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to update Reader, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function bookieReject()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $bookingID = xss_clean($this->input->post('bookingID'));
            $uniid = xss_clean($this->input->post('uniid'));
            $ownerUniid = xss_clean($this->input->post('ownerUniid'));

            $pid = xss_clean($this->input->post('pid'));
            $postID = xss_clean($this->input->post('postID'));


            $update = array(
                "booking_user_read_status" => 400,
                "booking_user_read_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "bookingID" => $bookingID,
                "uniid" => $uniid,
                "ownerUniid" => $ownerUniid,
                "booking_owner_acceptance_status" => 1
            );

            $rejPWr = array(
                "postingID" => $pid,
                "uniid" => $ownerUniid
            );

            $rejPWrr = array(
                "tdaID" => $postID,
                "uniid" => $ownerUniid
            );

            $status = $this->Bookings_model->updateBookieReject($update, $whereArr, $rejPWr, $rejPWrr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Rejected or Cancelled";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Reject or Cancel Booking, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function bookieClose()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $bookingID = xss_clean($this->input->post('bookingID'));

			$wrArray = array('bookingID' => $bookingID);
			$updateClose = array('bookie_close_sts' => 1);

			$data = $this->Bookings_model->updateAlertClose($wrArray, $updateClose);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Closed";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Close";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function ownerClose()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$bookingID = xss_clean($this->input->post('bookingID'));

			$wrArray = array('bookingID' => $bookingID);
			$updateClose = array('owner_close_sts' => 1);

			$data = $this->Bookings_model->updateAlertClose($wrArray, $updateClose);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Closed";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Close";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}







	public function bookHotel()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$userUniid = xss_clean($this->input->post('userUniid'));

			$hotelID = xss_clean($this->input->post('hotelID'));
			$hotelUniid = xss_clean($this->input->post('hotelUniid'));
			$hotelBookingInfo = xss_clean($this->input->post('hotelBookingInfo'));

			$userMobile = xss_clean($this->input->post('userMobile'));
			$userEmail = xss_clean($this->input->post('userEmail'));
			$ownerMobile = xss_clean($this->input->post('ownerMobile'));
			$ownerEmail = xss_clean($this->input->post('ownerEmail'));


			$hotelCheckInDate = xss_clean($this->input->post('hotelCheckInDate'));
			$hotelCheckInTime = xss_clean($this->input->post('hotelCheckInTime'));
			$hotelCheckOutDate = xss_clean($this->input->post('hotelCheckOutDate'));
			$hotelCheckOutTime = xss_clean($this->input->post('hotelCheckOutTime'));


			$hotelBookingInfoJson = $hotelBookingInfo;
			$hotelBookingInfo = json_decode($hotelBookingInfo);


			$table = "<table style='border-collapse:collapse; border:1px solid black;'>";
			$textMsg = "Hotel Booked by : ".$userEmail.", ".$userMobile;

			$table .= "<tr>";
			$table .= "<th style='border: 1px solid black; padding: 5px;'>Room Type</th>";
			$table .= "<th style='border: 1px solid black; padding: 5px;'>Single Price</th>";
			$table .= "<th style='border: 1px solid black; padding: 5px;'>Double Price</th>";
			$table .= "</tr>";

			foreach ($hotelBookingInfo->roomInfo as $r)
			{

				$single = ($r->singlePrice)?$r->singlePrice:'-';
				$double = ($r->doublePrice)?$r->doublePrice:'-';
				$mm = '';

				foreach (explode("#", rtrim($hotelBookingInfo->amenities, "#")) as $em) {
					$mm .= "&#10004; ".$em."<br>";
				}

				$table .= "<tr>";
				$table .= "<td style='border: 1px solid black; padding: 5px;'>".$r->roomType."</td>";
				$table .= "<td style='border: 1px solid black; padding: 5px;'>".$single."</td>";
				$table .= "<td style='border: 1px solid black; padding: 5px;'>".$double."</td>";
				$table .= "</tr>";

				$textMsg .= "\n".$r->roomType.", Single:".$single.", Double:".$double."\n";
			}

			$table .= "<tr><td style='border: 1px solid black; padding: 5px;'>What is included</td><td colspan='2' style='border: 1px solid black; padding: 5px;'>".$hotelBookingInfo->whatInc."</td></tr>";
			$table .= "<tr><td style='border: 1px solid black; padding: 5px;'>What is not included</td><td colspan='2' style='border: 1px solid black; padding: 5px;'>".$hotelBookingInfo->whatNotInc."</td></tr>";
			$table .= "<tr><td style='border: 1px solid black; padding: 5px;'>Description</td><td colspan='2' style='border: 1px solid black; padding: 5px;'>".$hotelBookingInfo->desc."</td></tr>";
			$table .= "<tr><td style='border: 1px solid black; padding: 5px;'>Offers</td><td colspan='2' style='border: 1px solid black; padding: 5px;'>".$hotelBookingInfo->offers."</td></tr>";
			$table .= "<tr><td style='border: 1px solid black; padding: 5px;'>Amenities</td><td colspan='2' style='border: 1px solid black; padding: 5px;'><p>".$mm."<p></td></tr>";

			$table .= "</table>";

			$table .= "<div style='font-family: sans-serif;'><h3>Hotel Booked Information</h3> <br>
			<h3 style='padding:5px 0px;margin:0px;'>Booked by <span style='color:red;'>".$userEmail.", ".$userMobile."</span></h3><br><br>";




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

				$mail->setFrom('info@geolandmarks.com', 'CarTravels - Hotel Booked Info');
				$mail->addReplyTo('cartravels2016@gmail.com', 'CarTravels - Hotel Booked Info');

			// Add a recipient
			$mail->addAddress($ownerEmail);

			// Email subject
			$mail->Subject = $hotelID.' - Hotel Booking';

			// Set email format to HTML
			$mail->isHTML(true);

			$mail->Body = $table;

	        // Send email
			if ($mail->send()) 
			{   
				$loginJson['mail_sts'] = 1;
			}
			else 
			{
			    $loginJson['mail_sts'] = 0;
			}


			$user = "jnana325";
			$pass = "31025325";
			$sender = "JKATTA";
			$phone  = $ownerMobile;
			$priority  = "ndnd";
			$stype  = "normal";

			$postData = array(
			    'user' => $user,
			    'pass' => $pass,
			    'sender' => $sender,
			    'phone' => $phone,
			    'text' => $textMsg,
			    'priority' => $priority,
			    'stype' => $stype
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->smsurl);
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


			$data = array(
				"hotel_user_uniid" => $userUniid,
				"hotel_id" => $hotelID,
				"hotel_owner_uniid" => $hotelUniid,
				"hotel_booking_info" => $hotelBookingInfoJson,

				"hotel_user_email" => $userEmail,
				"hotel_user_mobile" => $userMobile,
				"hotel_owner_email" => $ownerEmail,
				"hotel_owner_mobile" => $ownerMobile,

				"hotel_check_in" => $hotelCheckInDate,
				"hotel_check_out" => $hotelCheckOutDate,
				"hotel_check_in_time" => $hotelCheckInTime,
				"hotel_check_out_time" => $hotelCheckOutTime,

				"booking_date" => date('Y-m-d H:i:s')
			);

			$status = $this->Bookings_model->saveHotelBooking($data);

			if($status)
			{
				$json['error'] = "false";
				$json['hotelBookingID'] = $status;
				$json['message'] = "Hotel Booked Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Booking, Try again.";
			}
		}
		else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
		echo json_encode($json);
	}

	public function getHotelBookings()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$wrArr = array("hotel_user_uniid" => $uniid);
			
			$bookings = $this->Bookings_model->listHotelBookings($wrArr);
			
			if($bookings)
			{
				$json['error'] = "false";
				$json['userHotelBookings'] = $bookings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['bookings'] = 0;
			}
			echo json_encode($json);
		}
	}

	public function getHotelOwnerBookings()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$wrArr = array("hotel_owner_uniid" => $uniid);
			
			$bookings = $this->Bookings_model->listHotelBookings($wrArr);
			
			if($bookings)
			{
				$json['error'] = "false";
				$json['ownerHotelBookings'] = $bookings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['bookings'] = 0;
			}
			echo json_encode($json);
		}
	}


	public function hotelOwnerAcceptance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $hotelBookingID = xss_clean($this->input->post('hotelBookingID'));
            $hotelID = xss_clean($this->input->post('hotelID'));
            $hotelUniid = xss_clean($this->input->post('hotelUniid'));

            $update = array(
                "booking_hotel_acceptance_status" => 200,
                "booking_hotel_acceptance_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "hotelBookID" => $hotelBookingID,
                "hotel_id" => $hotelID,
                "hotel_owner_uniid" => $hotelUniid
            );

            $status = $this->Bookings_model->updateHotelBookingAcceptance($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Hotel Booking Accepted";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Accept, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function hotelRoomsNotAvailable()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $hotelBookingID = xss_clean($this->input->post('hotelBookingID'));
            $hotelID = xss_clean($this->input->post('hotelID'));
            $hotelUniid = xss_clean($this->input->post('hotelUniid'));

            $update = array(
                "booking_hotel_acceptance_status" => 400,
                "booking_hotel_acceptance_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "hotelBookID" => $hotelBookingID,
                "hotel_id" => $hotelID,
                "hotel_owner_uniid" => $hotelUniid
            );

            $status = $this->Bookings_model->updateHotelBookingAcceptance($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "No Available Rooms";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Process, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function hotelBookieClose()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $hotelBookingID = xss_clean($this->input->post('hotelBookingID'));
            $hotelID = xss_clean($this->input->post('hotelID'));

			$wrArray = array('hotelBookID' => $hotelBookingID, 'hotel_id' => $hotelID);
			$updateClose = array('bookie_close_sts' => 1);

			$data = $this->Bookings_model->updateHotelAlertClose($wrArray, $updateClose);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Closed";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Close";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function HotelOwnerClose()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$hotelBookingID = xss_clean($this->input->post('hotelBookingID'));
            $hotelID = xss_clean($this->input->post('hotelID'));

			$wrArray = array('hotelBookID' => $hotelBookingID, 'hotel_id' => $hotelID);
			$updateClose = array('owner_close_sts' => 1);

			$data = $this->Bookings_model->updateHotelAlertClose($wrArray, $updateClose);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Closed";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Close";
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