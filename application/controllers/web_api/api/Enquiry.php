<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/Enquiry_model');
        $this->load->model('api/Notifications_model');
        $this->smsurl = "http://bhashsms.com/api/sendmsg.php?";
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        echo "<br>";
        $end = date('Y-m-d H:i:s', strtotime('+1 day'));
        echo $end."\n \n";


        for ($i=1; $i <= 20; $i++) { 
        	echo "$i \n";
        	if($i %10 === 0)
        	{
        		sleep(3);
        		echo "\n \n".$i."\n\n";
        	}
        }
    }



















    public function enquiryNow()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
		
		$rchar = chr(rand(65,90));
		$userKey = $rchar.rand(100000,999999);

		if($this->input->method(TRUE) == 'POST')
		{
			$businessCategory = xss_clean($this->input->post('enquiryType'));
			$listingCity = xss_clean($this->input->post('listingCity'));
			$listingState = xss_clean($this->input->post('listingState'));
			$uniid = xss_clean($this->input->post('uniid'));
			
			$selectedKeyword = xss_clean($this->input->post('preferredVehicle'));

			$min = xss_clean($this->input->post('min'));

			if($businessCategory == "all")
			{
				$whereArr = "all";
			}
			else if(!empty($businessCategory) && !empty($listingState) && !empty($listingCity))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_City" => $listingCity, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else if(!empty($businessCategory) && !empty($listingState))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_Keywords like " => "%$selectedKeyword%");
			}
			
			$result = $this->Enquiry_model->getEnqSendingData($whereArr, $uniid, $selectedKeyword, $min);

			
			// $i = 1;
			foreach ($result as $n) 
			{
				$enquiryType = xss_clean($this->input->post('enquiryType'));

				$uniid = xss_clean($this->input->post('uniid'));
				$postUniid = $n->user_uniid;

				if($uniid != $postUniid)
				{
					$pickupCity = xss_clean($this->input->post('pickupCity'));
					$dropCity = xss_clean($this->input->post('dropCity'));
					$departDate = xss_clean($this->input->post('departDate'));
					$departTime = xss_clean($this->input->post('departTime'));
					$returnDate = xss_clean($this->input->post('returnDate'));
					$returnTime = xss_clean($this->input->post('returnTime'));

					$trip = xss_clean($this->input->post('trip'));
					$tripType = xss_clean($this->input->post('tripType'));


					$preferredVehicle = xss_clean($this->input->post('preferredVehicle'));

					$data = array(
						"enquiryType" => $enquiryType,
						"enq_user_key" => $userKey,
						"uniid" => $uniid,
						"ownerUniid" => $postUniid,
						"enq_pickup_city" => $pickupCity,
						"enq_drop_city" => $dropCity,
						"enq_depart_date" => $departDate,
						"enq_depart_time" => $departTime,
						"enq_return_date" => $returnDate,
						"enq_return_time" => $returnTime,
						"enq_trip" => $trip,
						"enq_trip_type" => $tripType,
						"enq_preferred_vehicle" => $preferredVehicle,

						"enq_date" => date('Y-m-d H:i:s')
					);


					$status = $this->Enquiry_model->sendEnquiry($data);

					$body = "Enquiry : ".$pickupCity." to ".$dropCity;
		            $img = '';
		            $title = "Enquiry";
		            $uniid = $n->user_uniid;
		            $pid = $status;

					$this->Notifications_model->cityNotifications($n->user_DeviseTokenId, $body, $img, $title, $uniid, $pid);
				}

				// if($i %10 === 0)
				// {
				// 	sleep(10);
				// }
				// $i++;
			}

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Enquiry Sent Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "No data found! Unable to Send Enquiry, Try again.";
			}
		}
		else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
		echo json_encode($json);
	}

























    public function webEnquirysNow()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

		
		$rchar = chr(rand(65,90));
		$userKey = $rchar.rand(100000,999999);

		if($this->input->method(TRUE) == 'POST')
		{
			$yourName = xss_clean($this->input->post('yourName'));
			$yourNumber = xss_clean($this->input->post('yourNumber'));
			$yourEmail = xss_clean($this->input->post('yourEmail'));


			$businessCategory = xss_clean($this->input->post('enquiryType'));
			$listingCity = xss_clean($this->input->post('listingCity'));
			$listingState = xss_clean($this->input->post('listingState'));
			$uniid = xss_clean($this->input->post('uniid'));
			
			$selectedKeyword = xss_clean($this->input->post('preferredVehicle'));

			$min = xss_clean($this->input->post('min'));

			if(!empty($businessCategory) && !empty($listingState) && !empty($listingCity))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_City" => $listingCity, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else if(!empty($businessCategory) && !empty($listingState))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_Keywords like " => "%$selectedKeyword%");
			}
			
			$result = $this->Enquiry_model->getEnqSendingData($whereArr, $uniid, $selectedKeyword, 'WebEnquiryLimit');

			echo "<pre>";
			print_r($result);
			echo "</pre>";
			// exit;


			
			if($result)
			{	
				$i = 1;
				$enqLists = '';
				foreach ($result as $n) 
				{
					if(!empty($n->uesr_Business_Name))
					{
						$user_Name = $n->uesr_Business_Name;
						$user_Name = ucwords($user_Name);
					}
					else
					{
						$user_Name = $n->user_Name." ".$n->user_Surname;
						$user_Name = ucwords($user_Name);
					}

					$enqLists .= $i.') '.$user_Name.', '.$n->user_Mobile_No.'<br>';
					$enquiryType = xss_clean($this->input->post('enquiryType'));

					$uniid = xss_clean($this->input->post('uniid'));
					$postUniid = $n->user_uniid;

					if($uniid != $postUniid)
					{
						$pickupCity = xss_clean($this->input->post('pickupCity'));
						$dropCity = xss_clean($this->input->post('dropCity'));
						$departDate = xss_clean($this->input->post('departDate'));
						$departTime = xss_clean($this->input->post('departTime'));
						$returnDate = xss_clean($this->input->post('returnDate'));
						$returnTime = xss_clean($this->input->post('returnTime'));

						$trip = xss_clean($this->input->post('trip'));
						$tripType = xss_clean($this->input->post('tripType'));


						$preferredVehicle = xss_clean($this->input->post('preferredVehicle'));

						$data = array(
							"enquiryType" => $enquiryType,
							"enq_user_key" => $userKey,
							"uniid" => $uniid,
							"ownerUniid" => $postUniid,
							"enq_pickup_city" => $pickupCity,
							"enq_drop_city" => $dropCity,
							"enq_depart_date" => $departDate,
							"enq_depart_time" => $departTime,
							"enq_return_date" => $returnDate,
							"enq_return_time" => $returnTime,
							"enq_trip" => $trip,
							"enq_trip_type" => $tripType,
							"enq_preferred_vehicle" => $preferredVehicle,

							"enq_date" => date('Y-m-d H:i:s')
						);


						// $status = $this->Enquiry_model->sendEnquiry($data);
						$status = false;

						$body = "Enquiry : ".$pickupCity." to ".$dropCity;
			            $img = '';
			            $title = "Enquiry";
			            $uniid = $n->user_uniid;
			            $pid = $status;

$smsText = "CarTravels.com Enquiry:
Name: ".$yourName."
No: ".$yourNumber."
Type : ".$trip."
Vehicle: ".$preferredVehicle."
From: ".$pickupCity."
To: ".$dropCity."
Date: ".date('d-m-Y', strtotime($departDate)).' '.date('h:i A', strtotime($departTime));

$mailText = "CarTravels.com Enquiry: <br>
Name: ".$yourName."<br>
No: ".$yourNumber."<br>
Type : ".$trip."<br>
Vehicle: ".$preferredVehicle."<br>
From: ".$pickupCity."<br>
To: ".$dropCity."<br>
Date: ".date('d-m-Y', strtotime($departDate)).' '.date('h:i A', strtotime($departTime));


						$this->Notifications_model->cityNotifications($n->user_DeviseTokenId, $body, $img, $title, $uniid, $pid);
						$this->Enquiry_model->sendSMS($n->user_Mobile_No, $smsText);
						$this->Enquiry_model->sendEmail($n->user_Email, 'CarTravels Enquiry', 'Enquiry - '.date("d-m-Y"), $mailText);
					}

					// if($i %10 === 0)
					// {
					// 	sleep(10);
					// }
					$i++;
				}

				echo $enqLists;


				$this->Enquiry_model->sendSMS($yourNumber, $enqLists);
				$this->Enquiry_model->sendEmail($yourEmail, 'CarTravels Enquiries', 'Enquiry - '.date("d-m-Y"), $enqLists);
			}
			else
			{
				$status = false;
			}

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Enquiry Sent Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "No data found! Unable to Send Enquiry, Try again.";
			}
		}
		else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
		echo json_encode($json);
	}
























































	public function enquirySendingList()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$businessCategory = xss_clean($this->input->post('businessCategory'));
			$listingCity = xss_clean($this->input->post('listingCity'));
			$listingState = xss_clean($this->input->post('listingState'));
			$uniid = xss_clean($this->input->post('uniid'));
			
			$selectedKeyword = xss_clean($this->input->post('selectedKeyword'));

			$min = xss_clean($this->input->post('min'));

			if($businessCategory == "all")
			{
				$whereArr = "all";
			}
			else if(!empty($businessCategory) && !empty($listingState) && !empty($listingCity))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_City" => $listingCity, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else if(!empty($businessCategory) && !empty($listingState))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_Keywords like " => "%$selectedKeyword%");
			}
			
			$result = $this->Enquiry_model->getEnqSendingData($whereArr, $uniid, $selectedKeyword, $min);
			if($result)
			{
				$json['listings'] = $result;
			}
			else
			{
				$json['listings'] = "No Data Found";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}
















	// public function enquiryNow()
	// {
	// 	if($this->input->method(TRUE) == 'POST')
	// 	{
	// 		$enquiryType = xss_clean($this->input->post('enquiryType'));

	// 		$uniid = xss_clean($this->input->post('uniid'));
	// 		$postUniid = xss_clean($this->input->post('ownerUniid'));

	// 		$pickupCity = xss_clean($this->input->post('pickupCity'));
	// 		$dropCity = xss_clean($this->input->post('dropCity'));
	// 		$departDate = xss_clean($this->input->post('departDate'));
	// 		$departTime = xss_clean($this->input->post('departTime'));
	// 		$returnDate = xss_clean($this->input->post('returnDate'));
	// 		$returnTime = xss_clean($this->input->post('returnTime'));

	// 		$trip = xss_clean($this->input->post('trip'));
	// 		$tripType = xss_clean($this->input->post('tripType'));

	// 		$userKey = xss_clean($this->input->post('randomKey'));

	// 		$preferredVehicle = xss_clean($this->input->post('preferredVehicle'));

	// 		$data = array(
	// 			"enquiryType" => $enquiryType,
	// 			"enq_user_key" => $userKey,
	// 			"uniid" => $uniid,
	// 			"ownerUniid" => $postUniid,
	// 			"enq_pickup_city" => $pickupCity,
	// 			"enq_drop_city" => $dropCity,
	// 			"enq_depart_date" => $departDate,
	// 			"enq_depart_time" => $departTime,
	// 			"enq_return_date" => $returnDate,
	// 			"enq_return_time" => $returnTime,
	// 			"enq_trip" => $trip,
	// 			"enq_trip_type" => $tripType,
	// 			"enq_preferred_vehicle" => $preferredVehicle,

	// 			"enq_date" => date('Y-m-d H:i:s')
	// 		);

	// 		$status = $this->Enquiry_model->sendEnquiry($data);

	// 		if($status)
	// 		{
	// 			$json['error'] = "false";
	// 			$json['message'] = "Enquiry Sent Successfully";
	// 		}
	// 		else
	// 		{
	// 			$json['error'] = "true";
	// 			$json['message'] = "Sorry! Unable to Send Enquiry, Try again.";
	// 		}
	// 	}
	// 	else
 //        {
 //             $json['error'] = 'true';
 //             $json['message'] = "Unknown Method";
 //        }
	// 	echo json_encode($json);
	// }




















	public function getEnquiries()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$wrArr1 = array("enq.uniid" => $uniid);
			$enquiries = $this->Enquiry_model->listResEnquiries($wrArr1);
			
			if($enquiries)
			{
				$json['error'] = "false";
				$json['enquiries'] = $enquiries;

				for ($i=0; $i < count($enquiries); $i++) 
				{ 
					$wrArr2 = array("enq.uniid" => $uniid,"enq_user_key" => $json['enquiries'][$i]->enq_user_key, "enq.enq_owner_acceptance_status" => 1);
					$enqResponces = $this->Enquiry_model->respondedEnquiries($wrArr2);
					$json['enquiries'][$i]->enqResponces = $enqResponces;
				}
			}
			else
			{
				 $json['error'] = 'true';
				 $json['enquiries'] = 0;
			}
			echo json_encode($json);
		}
	}

	public function getOwnerEnquiries()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('ownerUniid'));

			$wrArr = array("enq.ownerUniid" => $uniid);
			
			$enquiries = $this->Enquiry_model->listEnquiries($wrArr);
			
			if($enquiries)
			{
				$json['error'] = "false";
				$json['enquiries'] = $enquiries;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['enquiries'] = 0;
			}
			echo json_encode($json);
		}
	}

    public function ownerEnquiryAcceptance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $enquiryID = xss_clean($this->input->post('enquiryID'));
            $enquiryCode = xss_clean($this->input->post('enquiryCode'));
            $ownerUniid = xss_clean($this->input->post('ownerUniid'));

            $enquiryTourAttachType = xss_clean($this->input->post('enquiryTourAttachType'));

		    $targetDir = "assets/enqTourTravels/";
		    $allowTypes = array('jpg','JPG', 'png', 'PNG', 'jpeg','JPEG','pdf', 'PDF'); 
		    if(!empty($_FILES))
		    {
		    	$fileNames = array_filter($_FILES['enquiry_tour_images']['name']); 
		    }
		    else
		    {
		    	$fileNames = "";
		    }
            
		    if(!empty($fileNames))
		    { 
		        foreach($_FILES['enquiry_tour_images']['name'] as $key=>$val)
		        { 
		            // File upload path 
		            $fileName = basename($_FILES['enquiry_tour_images']['name'][$key]); 
		            $targetFilePath = $targetDir . $fileName; 
		             
		            // Check whether file type is valid 
		            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
		            if(in_array($fileType, $allowTypes)){ 
		                // Upload file to server 
		                if(move_uploaded_file($_FILES["enquiry_tour_images"]["tmp_name"][$key], $targetFilePath)){ 
		                    $files[] = base_url().$targetFilePath; 
		                }else{ 
		                    $errorUpload .= $_FILES['enquiry_tour_images']['name'][$key].' | '; 
		                } 
		            }else{ 
		                $errorUploadType .= $_FILES['enquiry_tour_images']['name'][$key].' | '; 
		            }
		        }

		        $pPicture = implode("#",$files);
			}

			if($enquiryTourAttachType == "Image" || $enquiryTourAttachType == "PDF")
			{
				$tp['enquiryTourAttachType'] = $enquiryTourAttachType;
				$tp['enquiryTourImages'] = $pPicture;

				$TourPackagesInfo = json_encode($tp);
			}
			else if($enquiryTourAttachType == "NotAvailable")
			{
				$tp['enquiryTourAttachType'] = "Not Available";
				$TourPackagesInfo = json_encode($tp);
			}

			$selfDrivingInfo = xss_clean($this->input->post('selfDrivingInfo'));

            $minKM = xss_clean($this->input->post('minKM'));
            $perKM = xss_clean($this->input->post('perKM'));
            $extKM = xss_clean($this->input->post('extKM'));
            $tourForCouple = xss_clean($this->input->post('tourForCouple'));
            $driverBatha = xss_clean($this->input->post('driverBatha'));
            $tollTax = xss_clean($this->input->post('tollTax'));
            $parkingFee = xss_clean($this->input->post('parkingFee'));
            $nightHalt = xss_clean($this->input->post('nightHalt'));

            $tdaTotalAmount = xss_clean($this->input->post('tdaTotalAmount'));
            $fareComments = xss_clean($this->input->post('fareComments'));

            $update = array(
                "enq_owner_acceptance_status" => 1,
                "enq_min_km" => $minKM,
                "enq_per_km" => $perKM,
                "enq_ext_km" => $extKM,
                "enq_tour_couple" => $tourForCouple,
                "enq_driver_batha" => $driverBatha,
                "enq_toll_tax" => $tollTax,
                "enq_parking_fee" => $parkingFee,
                "enq_night_halt" => $nightHalt,
                "enq_total_amount" => $tdaTotalAmount,
                "enq_fare_comments" => $fareComments,
                "enq_owner_acceptance_datetime" => date('Y-m-d H:i:s')
            );
            if(!empty($selfDrivingInfo))
            {
            	$update["enq_self_driving_info"] = $selfDrivingInfo;
            }
            if ($TourPackagesInfo) {
            	$update["enq_tour_package_info"] = $TourPackagesInfo;
            }	

            $whereArr = array(
                "enquiryID" => $enquiryID,
                "enq_user_key" => $enquiryCode,
                "ownerUniid" => $ownerUniid
            );

			$wrQuoted = array("enq_user_key" => $enquiryCode, "enq_owner_acceptance_status" => 1);
			$wrQuotedAccepted = array("enq_user_key" => $enquiryCode, "enq_owner_acceptance_status" => 1, "enq_user_read_status" => 200);

			$enqResponces = $this->Enquiry_model->respondedEnquiriesCount($wrQuoted);
			$enqResponcesAccepted = $this->Enquiry_model->respondedEnquiriesCount($wrQuotedAccepted);

			if($enqResponces < 10)
			{
				if($enqResponcesAccepted != 1)
				{
					$status = $this->Enquiry_model->updateOwnerEnquiryAcceptance($update, $whereArr);

		            if($status == true)
		            {
		                $json['error'] = "false";
		                $json['message'] = "Enquiry Responsed";
		            }
		            else
		            {
		                $json['error'] = "true";
		                $json['message'] = "Sorry! Unable to give Response, Try again.";
		            }	
				}
				else
				{
		            $json['error'] = "true";
					$json['message'] = "Sorry! Enquiry Closed.";
		        }
	        }
	        else
	        {
	        	$json['error'] = "true";
				$json['message'] = "Sorry! Maximum Responded limit Reached.";
	        }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function senderEnquiryAcceptance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
			$enquiryID = xss_clean($this->input->post('enquiryID'));
            $enquiryCode = xss_clean($this->input->post('enquiryCode'));

            $uniid = xss_clean($this->input->post('uniid'));
            $ownerUniid = xss_clean($this->input->post('ownerUniid'));

            $enqTourSingleNo = xss_clean($this->input->post('enqTourSingleNo'));
            $enqTourCoupleNo = xss_clean($this->input->post('enqTourCoupleNo'));
            $enqTourChildNo = xss_clean($this->input->post('enqTourChildNo'));

            $enqTotalAmount = xss_clean($this->input->post('enqTotalAmount'));

			$wrArr = array("enq.uniid" => $uniid, "enq.enquiryID" => $enquiryID, "enq.enq_user_key" => $enquiryCode);


            $smsMailData = $this->Enquiry_model->listEnquiries($wrArr);

			if($smsMailData)
			{
				$smd = $smsMailData[0];
				if($smd->enq_user_key != '')
				{
					if(!empty($smd->enqOwner_userName) && !empty($smd->enqOwner_userSurname))
					{
						$pidFullName = $smd->enqOwner_userName.' '.$smd->enqOwner_userSurname;
					}
					else
					{
						$pidFullName = $smd->enqOwner_ownerName;
					}


					$smsText = "CarTravels.com Enquiry Confirmation\n From: ".$smd->enq_pickup_city."\n To: ".$smd->enq_drop_city."\n Category : Enquiry -> Booking\n Enquiry No: ".$smd->enquiryID."\n Journey Date: ".$smd->enq_depart_date."\n Departure Time: ".$smd->enq_depart_time."\n Total Amount: Rs.".$smd->enq_total_amount."\n Vehicle Type: ".$smd->enq_preferred_vehicle."\n Trip : ".$smd->enq_trip_type.", Booking Accepted\n Please report 15 minutes before dep time.\n Driver Name & Number : ".$pidFullName.", ".$smd->enqOwner_ownerMobile;


					$table = "<table style='border-collapse:collapse; border:1px solid #ddd; width:100%; font-family: sans-serif;'>";

						$table .= "<tr>";
						$table .= "<th style='width:48%;'><img src='https://www.cartravels.com/web/images/car-travels-logo.png' style='float: left;padding: 10px; width: 200px;'></th>";
						$table .= "<th></th>";
						$table .= "<th style='float: right;width:48%;'><a href='https://play.google.com/store/apps/details?id=cartravels.co' target='_blank'><img src='https://cartravels.com/assets/img/android.png' style='width:50px; padding: 5px;'></a><img src='https://cartravels.com/assets/img/ios.png' style='width:50px; padding: 5px;'></th>";
						$table .= "</tr>";

						$table .= "<tr>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>
						<span style='font-size: 20px;font-weight: 600;'>CarTravels.com </span><br>Booked on : ".$smd->enq_date." </td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'></td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px; text-align:right;'>Enquiry No : <b>".$smd->enquiryID."</b> 
						<br> Category : Enquiry to Booking</td>";
						$table .= "</tr>";

						$table .= "<tr>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>From : <b>".$smd->enq_pickup_city."</b></td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> <img src='https://cartravels.com/assets/img/arrow.png'> </td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>To : <b>".$smd->enq_drop_city."</b></td>";
						$table .= "</tr>";



						$table .= "<tr>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>Journey Date : ".$smd->enq_depart_date." <br> Journey Time : ".$smd->enq_depart_time."</td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'> </td>";
						$table .= "</tr>";


						$table .= "<tr><td style='border: 1px solid #ddd; padding: 5px;'>";
						$table .= "<table>";
						$table .= "<tr> <td colspan='3'> Vehicle Details</td> </tr>";
						$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Vehicle Type </td> <td>:</td> <td> ".$smd->enq_preferred_vehicle."</td> </tr>";
						$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'> Trip </td> <td>:</td> <td> ".$smd->enq_trip_type." Booking Accepted</td> </tr>";
						$table .= "</table>";
						$table .= "</td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>  </td>";
						$table .= "<td style='border: 1px solid #ddd; padding: 5px;'>";
						$table .= "<table>";
						$table .= "<tr> <td colspan='3'> Payment Details</td> </tr>";
						$table .= "<tr> <td style='border: 1px solid #ddd; padding: 5px;'>Total Amount </td> <td>:</td> <td> ".$smd->enq_total_amount."</td> </tr>";
						$table .= "</table>";
						$table .= "</td>";

						$table .= "</tr>";
						$table .= "<tr>";
						$table .= "<th>";

						$table .= "<div style='font-family: sans-serif; float: left;'>
						<h3 style='padding:5px; text-align:left;'> Driver Name : <span style='color:red;'> ".$pidFullName."</span> <br> Driver Number : <span style='color:red;'> ".$smd->enqOwner_ownerMobile."</span>
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


					$mail->addAddress($smd->enqUser_email);			// Add a recipient
					$mail->Subject = $smd->enquiryID.' - Booking';	// Email subject
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
					$phone  = $smd->enqUser_ownerMobile;
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
                "enq_user_read_status" => 200,
                "enq_user_read_datetime" => date('Y-m-d H:i:s')
            );


            if(!empty($enqTotalAmount))
            {
				$update["enq_tour_single_nos"] = $enqTourSingleNo;
				$update["enq_tour_child_nos"] = $enqTourChildNo;
				$update["enq_tour_couple_nos"] = $enqTourCoupleNo;
				$update["enq_total_amount"] = $enqTotalAmount;
            }

            $whereArr = array(
                "enquiryID" => $enquiryID,
                "uniid" => $uniid,
                "enq_owner_acceptance_status" => 1
            );


            $status = $this->Enquiry_model->updateOwnerEnquiryAcceptance($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Accepted";

                $wrArrReject = array("uniid" => $uniid,"enq_owner_acceptance_status" =>1,  "enq_user_read_status" => 0, "enq_user_key" => $enquiryCode);

				$UpdateRejData = array(
					"enq_user_read_status" => 400,
					"enq_user_read_datetime" => date('Y-m-d H:i:s')
				);

				$sts = $this->db->update('api_cartravel_enquiry', $UpdateRejData, $wrArrReject);
				$json["rejMsg"] = $sts;
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Accepted, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function senderEnquiryRejectAll()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $enquiryCode = xss_clean($this->input->post('enquiryCode'));

            $uniid = xss_clean($this->input->post('uniid'));

            $update = array(
                "enq_user_read_status" => 400,
				"enq_user_read_datetime" => date('Y-m-d H:i:s')
            );

            $wrArrReject = array(
            	"uniid" => $uniid,
            	"enq_user_key" => $enquiryCode,
            	"enq_owner_acceptance_status" =>1,  
            	"enq_user_read_status" => 0
            );

            $sts = $this->Enquiry_model->updateOwnerEnquiryAcceptance($update, $wrArrReject);

            if($sts)
            {
                $json['error'] = "false";
                $json['message'] = "Rejected or Cancelled All";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Reject or Cancel, Try again";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

	public function enquiryOwnerCloseSts()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$enquiryID = xss_clean($this->input->post('enquiryID'));

			$wrArray = array('enquiryID' => $enquiryID);
			$updateClose = array('enq_owner_close_sts' => 1);

			$data = $this->Enquiry_model->updateEnquiryAlertClose($wrArray, $updateClose);

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