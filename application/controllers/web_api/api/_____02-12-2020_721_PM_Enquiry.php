<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/Enquiry_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        echo "<br>";
        $end = date('Y-m-d H:i:s', strtotime('+1 day'));
        echo $end;
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
				// $json['listings1'] = $whereArr['user_Business_Category'];
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}



	public function enquiryNow()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$postUniid = xss_clean($this->input->post('ownerUniid'));

			$pickupCity = xss_clean($this->input->post('pickupCity'));
			$dropCity = xss_clean($this->input->post('dropCity'));
			$departDate = xss_clean($this->input->post('departDate'));
			$departTime = xss_clean($this->input->post('departTime'));
			$returnDate = xss_clean($this->input->post('returnDate'));
			$returnTime = xss_clean($this->input->post('returnTime'));

			$trip = xss_clean($this->input->post('trip'));
			$tripType = xss_clean($this->input->post('tripType'));

			$userKey = xss_clean($this->input->post('randomKey'));

			$preferredVehicle = xss_clean($this->input->post('preferredVehicle'));

			$data = array(
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

			if($status)
			{
				$json['error'] = "false";
				$json['bookingID'] = $status;
				$json['message'] = "Enquiry Sent Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Send Enquiry, Try again.";
			}
		}
		else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
		echo json_encode($json);
	}

	public function getEnquiries()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			
			$wrArr1 = array("enq.uniid" => $uniid);
			$enquiries = $this->Enquiry_model->listResEnquiries($wrArr1);

			
			$json['enquiries'] = $enquiries;




// $templevel=0;   

//   $valKey=0;

//   $grouparr="";
//   $grouparr=array();
//   $i = 0;
//   $j = 0;

//   foreach ($enquiries as $key => $val) {
// 	 if($valKey == $enquiries[$key]->enq_user_key)
// 	 {
// 	 	// $grouparr['enquiryCode'] = $val->enq_user_key;
// 	 	$grouparr['enquiryCode'][$j][] = $enquiries[$key];
// 	 	// $grouparr[$val->enq_user_key][] = $enquiries[$key];
// 	 }
// 	 else
// 	 {
// 	 	$valKey = $val->enq_user_key;
// 	 	$i=0;
// 	 	$j++;
// 	 }
// 	 $i++;
//   }




  			

			// $enquiries = $this->Enquiry_model->listResEnquiries($wrArr1);

			echo count($json['enquiries']);
			for ($i=0; $i < count($enquiries); $i++) 
			{ 
				echo $enquiries[$i]->enq_user_key;
				$wrArr2 = array("enq.uniid" => $uniid,"enq_user_key" => $json['enquiries'][$i]->enq_user_key, "enq.enq_owner_acceptance_status" => 1);
				$enqResponces = $this->Enquiry_model->respondedEnquiries($wrArr2);
				$json['enquiries'][$i]->enqResponces = $enqResponces;
			}

			
				

  echo json_encode($json);
  exit;

			
			if($enquiries)
			{
				$json['error'] = "false";
				// $json['enquiries'] = $enquiries;
				// $json['data'] = $grouparr;
				// $json['enquiries']['enqResponces'] = $enqResponces;
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
                "enq_owner_acceptance_status" => 1,
                "enq_min_km" => $minKM,
                "enq_per_km" => $perKM,
                "enq_ext_km" => $extKM,
                "enq_driver_batha" => $driverBatha,
                "enq_toll_tax" => $tollTax,
                "enq_parking_fee" => $parkingFee,
                "enq_night_halt" => $nightHalt,
                "enq_total_amount" => $tdaTotalAmount,
                "enq_fare_comments" => $fareComments,
                "enq_owner_acceptance_datetime" => date('Y-m-d H:i:s')
            );

            $whereArr = array(
                "enquiryID" => $enquiryID,
                "enq_user_key" => $enquiryCode,
                "ownerUniid" => $ownerUniid
            );

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
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }









































}

?>