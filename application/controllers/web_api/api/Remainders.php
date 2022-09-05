<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remainders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		
        $this->load->model('api/Remainders_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied ";
        echo time();
    }

    public function addInsurance()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$travelID = xss_clean($this->input->post('travelID'));
			$webRem = xss_clean($this->input->post('webRem'));

			// vehicle details
			$regNumber = xss_clean($this->input->post('regNumber'));
			$modelName = xss_clean($this->input->post('modelName'));
			$year = xss_clean($this->input->post('year'));

			// insurance details
			$insuranceCompany = xss_clean($this->input->post('insuranceCompany'));
			$policyNumber = xss_clean($this->input->post('policyNumber'));
			$insuredName = xss_clean($this->input->post('insuredName'));

			// $insFromDate = xss_clean($this->input->post('insFromDate'));
			// $insToDate = xss_clean($this->input->post('insToDate'));

			// $pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));
			// $fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));


			if(base64_decode($webRem) == date('Y-m-d'))
			{
				$insFromDate = xss_clean($this->input->post('insFromDate'));
				// $insFromTime = xss_clean($this->input->post('insFromTime'));
				$insToDate = xss_clean($this->input->post('insToDate'));
				// $insToTime = xss_clean($this->input->post('insToTime'));

				$insFromDate = date('d-m-Y H:i A', strtotime($insFromDate.' 01:00'));
				$insToDate = date('d-m-Y H:i A', strtotime($insToDate.' 01:00'));

				$pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));
				$fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));
				
				$pollutionValidDate = date('d-m-Y H:i A', strtotime($pollutionValidDate.' 01:00'));
				$fitnessValidDate = date('d-m-Y H:i A', strtotime($fitnessValidDate.' 01:00'));
			}
			else
			{
				$insFromDate = xss_clean($this->input->post('insFromDate'));
				$insToDate = xss_clean($this->input->post('insToDate'));
				$pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));
				$fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));
			}


			$data = array(
				"uniid" => $uniid,
				"cartravel_id" => $travelID,
				"ins_reg_number" => $regNumber,
				"ins_model_name" => $modelName,
				"ins_year" => $year,
				"ins_insurance_company" => $insuranceCompany,
				"ins_policy_number" => $policyNumber,
				"ins_insured_name" => $insuredName,
				"ins_from_date" => $insFromDate,
				"ins_to_date" => $insToDate,
				"ins_pollution_valid_date" => $pollutionValidDate,
				"ins_fitness_valid_date" => $fitnessValidDate
			);

			$status = $this->Remainders_model->saveInsurance($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Insurance Details added Successfully";
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
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function editInsurance()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$insID = xss_clean($this->input->post('insID'));

			$uniid = xss_clean($this->input->post('uniid'));
			$travelID = xss_clean($this->input->post('travelID'));
			$webRem = xss_clean($this->input->post('webRem'));

			// vehicle details
			$regNumber = xss_clean($this->input->post('regNumber'));
			$modelName = xss_clean($this->input->post('modelName'));
			$year = xss_clean($this->input->post('year'));

			// insurance details
			$insuranceCompany = xss_clean($this->input->post('insuranceCompany'));
			$policyNumber = xss_clean($this->input->post('policyNumber'));
			$insuredName = xss_clean($this->input->post('insuredName'));

			// $insFromDate = xss_clean($this->input->post('insFromDate'));
			// $insToDate = xss_clean($this->input->post('insToDate'));

			// $pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));

			// $fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));


			if(base64_decode($webRem) == date('Y-m-d'))
			{
				$insFromDate = xss_clean($this->input->post('insFromDate'));
				// $insFromTime = xss_clean($this->input->post('insFromTime'));
				$insToDate = xss_clean($this->input->post('insToDate'));
				// $insToTime = xss_clean($this->input->post('insToTime'));

				$insFromDate = date('d-m-Y H:i A', strtotime($insFromDate.' 01:00'));
				$insToDate = date('d-m-Y H:i A', strtotime($insToDate.' 01:00'));

				$pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));
				$fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));
				
				$pollutionValidDate = date('d-m-Y H:i A', strtotime($pollutionValidDate.' 01:00'));
				$fitnessValidDate = date('d-m-Y H:i A', strtotime($fitnessValidDate.' 01:00'));
			}
			else
			{
				$insFromDate = xss_clean($this->input->post('insFromDate'));
				$insToDate = xss_clean($this->input->post('insToDate'));
				$pollutionValidDate = xss_clean($this->input->post('pollutionValidDate'));
				$fitnessValidDate = xss_clean($this->input->post('fitnessValidDate'));
			}


			$data = array(
				"cartravel_id" => $travelID,
				"ins_reg_number" => $regNumber,
				"ins_model_name" => $modelName,
				"ins_year" => $year,
				"ins_insurance_company" => $insuranceCompany,
				"ins_policy_number" => $policyNumber,
				"ins_insured_name" => $insuredName,
				"ins_from_date" => $insFromDate,
				"ins_to_date" => $insToDate,
				"ins_pollution_valid_date" => $pollutionValidDate,
				"ins_fitness_valid_date" => $fitnessValidDate
			);

			$whereArr = array(
                "insID" => $insID,
                "uniid" => $uniid
            );

			$status = $this->Remainders_model->updateInsurance($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Insurance Details Updated";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Update, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function getInsurance()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $reports = $this->Remainders_model->InsuranceDetails($uniid);
            if($reports)
            {
                $json['error'] = "false";
                $json['insurance'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['insurance'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }


    public function getInsurance_web($uid = null)
    {
		$eventArray = array();
        $uniid = xss_clean($this->input->post('uniid'));
        $remDate = xss_clean($this->input->post('remDate'));
        if($uid != '')
        {
        	$arr = array('uniid' => $uid);	
        	$reports = $this->Remainders_model->InsuranceDetails_web($arr);

        	// print_r($reports);


            if($reports)
            {
                $json['error'] = "false";
                $json['bookRemainders'] = $reports;
				
				foreach ($reports as $row) {

					$rowArray = array(
					    'id' => $row->insID, 
					    'title' => $row->ins_reg_number, 
					    'start' => date("Y-m-d", strtotime($row->ins_to_date)), 
					);

				    array_push($eventArray, $rowArray);
				}
            }

            echo json_encode($eventArray);
        }
        else
        {	
        	$arr = array('uniid' => $uniid, "ins_to_date like " => "$remDate%");
        	$reports = $this->Remainders_model->InsuranceDetails_web($arr);


            if($reports)
            {
            	$json['insCount'] = count($reports);
                $json['error'] = "false";
                $json['insRemainders'] = $reports;
                $html = "<table class='table table-bordered remainderTable'>";
                $html .= "<tr><th colspan='7'>Insurance on ".$remDate.", ".count($reports)."</th></tr>";
                foreach ($reports as $r) {
                	$html .= "<tr>";
	                $html .= "<td data-toggle='modal' data-target='#editInsuranceRemainder' onclick='editInsurance(".$r->insID.")'>".$r->ins_reg_number."</td>
	                <td data-toggle='modal' data-target='#editInsuranceRemainder' onclick='editInsurance(".$r->insID.")'>".$r->ins_model_name."</td>
	                <td data-toggle='modal' data-target='#editInsuranceRemainder' onclick='editInsurance(".$r->insID.")'>".date('d-m-Y', strtotime($r->ins_to_date))."</td>
	                <td> <a href='https://wa.me/?text=Vehicle: ".$r->ins_reg_number.", %0aInsurance Start: ".$r->ins_from_date.", %0aInsurace Expiry: ".$r->ins_to_date."'><i class='fa fa-share-square'></i></a> </td>";

	                $html .= "</tr>";

                }
                
                $html .= "</table>";

                $json['html'] = $html;
            }
            else
            {
            	$json['insCount'] = 0;
                 $json['error'] = 'true';
                 $json['insRemainders'] = 0;
                 $json['html'] = 'No Insurance Data Found';
            }

            echo json_encode($json);
        }
    }














	public function removeInsurance()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $uniid = xss_clean($this->input->post('uniid'));
			$insID = xss_clean($this->input->post('insID'));

			$data = $this->Remainders_model->deleteInsurance($uniid, $insID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Removed Successful";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to remove, Pleae try again";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function getVehicleNumbers()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $reports = $this->Remainders_model->InsuranceVehicleDetails($uniid);
            if($reports)
            {
                $json['error'] = "false";
                $json['vehiclenos'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['vehiclenos'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }








    public function addBookingRemainders()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$travelID = xss_clean($this->input->post('travelID'));
			$webRem = xss_clean($this->input->post('webRem'));

			// vehicle details
			$bkrCustomerName = xss_clean($this->input->post('bkrCustomerName'));
			$bkrCustomerMobile = xss_clean($this->input->post('bkrCustomerMobile'));
			$bkrPickupPlace = xss_clean($this->input->post('bkrPickupPlace'));

			// insurance details
			$bkrKeyword = xss_clean($this->input->post('bkrKeyword'));
			$bkrAllocatedVehicleNo = xss_clean($this->input->post('bkrAllocatedVehicleNo'));
			$bkrDesc = xss_clean($this->input->post('bkrDesc'));

			

			// $bkrAudioFile = xss_clean($this->input->post('bkrAudioFile'));



			if(base64_decode($webRem) == date('Y-m-d'))
			{
				$bkrFromDate = xss_clean($this->input->post('bkrFromDate'));
				$bkrFromTime = xss_clean($this->input->post('bkrFromTime'));
				$bkrToDate = xss_clean($this->input->post('bkrToDate'));
				$bkrToTime = xss_clean($this->input->post('bkrToTime'));

				$bkrFromDate = date('d-m-Y h:i A', strtotime($bkrFromDate.' '.$bkrFromTime));
				$bkrToDate = date('d-m-Y h:i A', strtotime($bkrToDate.' '.$bkrToTime));
			}
			else
			{
				$bkrFromDate = xss_clean($this->input->post('bkrFromDate'));
				$bkrToDate = xss_clean($this->input->post('bkrToDate'));
			}




	        if(!empty($_FILES['bkrAudioFile']['name']))
	        {
                $config['upload_path'] = 'assets/remainders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['bkrAudioFile']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('bkrAudioFile'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/remainders/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }





			$bkrStatus = xss_clean($this->input->post('bkrStatus'));


			$data = array(
				"uniid" => $uniid,
				"cartravel_id" => $travelID,
				"bkr_customer_name" => $bkrCustomerName,
				"bkr_customer_mobile" => $bkrCustomerMobile,
				"bkr_pickup_place" => $bkrPickupPlace,
				"bkr_keyword" => $bkrKeyword,
				"bkr_allockted_vehicleno" => $bkrAllocatedVehicleNo,
				"bkr_desc" => $bkrDesc,
				"bkr_from_date" => $bkrFromDate,
				"bkr_to_date" => $bkrToDate,
				"bkr_audio_file" => $dcAudio,
				"bkr_status" => $bkrStatus
			);

			$status = $this->Remainders_model->saveBookingRemainder($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Booking Remainder Details added Successfully";
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
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}



	public function editBookingRemainders()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$bkrID = xss_clean($this->input->post('bkrID'));

			$uniid = xss_clean($this->input->post('uniid'));
			$travelID = xss_clean($this->input->post('travelID'));
			$webRem = xss_clean($this->input->post('webRem'));

			// vehicle details
			$bkrCustomerName = xss_clean($this->input->post('bkrCustomerName'));
			$bkrCustomerMobile = xss_clean($this->input->post('bkrCustomerMobile'));
			$bkrPickupPlace = xss_clean($this->input->post('bkrPickupPlace'));

			// insurance details
			$bkrKeyword = xss_clean($this->input->post('bkrKeyword'));
			$bkrAllocatedVehicleNo = xss_clean($this->input->post('bkrAllocatedVehicleNo'));
			$bkrDesc = xss_clean($this->input->post('bkrDesc'));

			// $bkrFromDate = xss_clean($this->input->post('bkrFromDate'));
			// $bkrToDate = xss_clean($this->input->post('bkrToDate'));

			// $bkrAudioFile = xss_clean($this->input->post('bkrAudioFile'));


			if(base64_decode($webRem) == date('Y-m-d'))
			{
				$bkrFromDate = xss_clean($this->input->post('bkrFromDate'));
				$bkrFromTime = xss_clean($this->input->post('bkrFromTime'));
				$bkrToDate = xss_clean($this->input->post('bkrToDate'));
				$bkrToTime = xss_clean($this->input->post('bkrToTime'));

				$bkrFromDate = date('d-m-Y h:i A', strtotime($bkrFromDate.' '.$bkrFromTime));
				$bkrToDate = date('d-m-Y h:i A', strtotime($bkrToDate.' '.$bkrToTime));
			}
			else
			{
				$bkrFromDate = xss_clean($this->input->post('bkrFromDate'));
				$bkrToDate = xss_clean($this->input->post('bkrToDate'));
			}




	        if(!empty($_FILES['bkrAudioFile']['name']))
	        {
                $config['upload_path'] = 'assets/remainders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['bkrAudioFile']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('bkrAudioFile'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/remainders/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }


			$bkrStatus = xss_clean($this->input->post('bkrStatus'));


			$data = array(
				"cartravel_id" => $travelID,
				"bkr_customer_name" => $bkrCustomerName,
				"bkr_customer_mobile" => $bkrCustomerMobile,
				"bkr_pickup_place" => $bkrPickupPlace,
				"bkr_keyword" => $bkrKeyword,
				"bkr_allockted_vehicleno" => $bkrAllocatedVehicleNo,
				"bkr_desc" => $bkrDesc,
				"bkr_from_date" => $bkrFromDate,
				"bkr_to_date" => $bkrToDate,
				"bkr_audio_file" => $dcAudio,
				"bkr_status" => $bkrStatus
			);

			$whereArr = array(
                "bkrID" => $bkrID,
                "uniid" => $uniid
            );

			$status = $this->Remainders_model->updateBookingRemainder($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Booking Remainder Details Updated";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Update, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function getBookingRemainder()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $reports = $this->Remainders_model->bookingRemainderDetails($uniid);
            if($reports)
            {
                $json['error'] = "false";
                $json['bookRemainders'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['bookRemainders'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getOneBookingRemainder()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $bkrID = xss_clean($this->input->post('bkrID'));
            $arr = array('bkrID' => $bkrID);
            $reports = $this->Remainders_model->bookingRemainderDetails_web($arr);
            if($reports)
            {
                $json['error'] = "false";
                $json['bookRemainders'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['bookRemainders'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getOneInsuranceRemainder()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $insID = xss_clean($this->input->post('insID'));
            $arr = array('insID' => $insID);
            $reports = $this->Remainders_model->InsuranceVehicleDetails_web($arr);
            if($reports)
            {
                $json['error'] = "false";
                $json['insRemainders'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['insRemainders'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }


    public function getBookingRemainder_web($uid = null)
    {
		$eventArray = array();
        $uniid = xss_clean($this->input->post('uniid'));
        $remDate = xss_clean($this->input->post('remDate'));
        if($uid != '')
        {
        	$arr = array('uniid' => $uid);	
        	$reports = $this->Remainders_model->bookingRemainderDetails_web($arr);

            if($reports)
            {
                $json['error'] = "false";
                $json['bookRemainders'] = $reports;
				
				foreach ($reports as $row) {

					$rowArray = array(
					    'id' => $row->bkrID, 
					    'title' => $row->bkr_customer_name, 
					    'start' => date("Y-m-d", strtotime($row->bkr_from_date)), 
					);

				    array_push($eventArray, $rowArray);
				}
            }

            echo json_encode($eventArray);
        }
        else
        {	
        	$arr = array('uniid' => $uniid, "bkr_from_date like " => "$remDate%");
        	$reports = $this->Remainders_model->bookingRemainderDetails_web($arr);

            if($reports)
            {
                $json['error'] = "false";
                $json['bookRemainders'] = $reports;
                $html = "<table class='table table-bordered remainderTable'>";
                $html .= "<tr><th colspan='7'>Bookings on ".$remDate.", ".count($reports)."</th></tr>";
                foreach ($reports as $r) {
                	$html .= "<tr>";
	                $html .= "<td data-toggle='modal' data-target='#editBookingRemainder' onclick='editBooking(".$r->bkrID.")'>".$r->bkr_customer_name."</td>
	                <td data-toggle='modal' data-target='#editBookingRemainder' onclick='editBooking(".$r->bkrID.")'>".$r->bkr_from_date."</td>
	                <td> <a href='tel:".$r->bkr_customer_mobile."'><i class='fa fa-phone-square'></i></a> </td>
	                <td> <a href='https://wa.me/+91".$r->bkr_customer_mobile."?text=https://play.google.com/store/apps/details?id=cartravels.co'><i class='fa fa-comments' ></i></a> </td>
	                <td> <a href='https://wa.me/?text=Customer: ".$r->bkr_customer_name.", %0aVehicle: ".$r->bkr_keyword.", %0aBooked from: ".$r->bkr_from_date.", %0aBooked Until: ".$r->bkr_to_date."'><i class='fa fa-share-square'></i></a> </td>";
	                $html .= "</tr>";

                }
                
                $html .= "</table>";

                $json['html'] = $html;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['bookRemainders'] = 0;
                 $json['html'] = 'No Booking Data Found';
            }

            echo json_encode($json);
        }
    }

	public function removeBookingRemainder()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $uniid = xss_clean($this->input->post('uniid'));
			$bkrID = xss_clean($this->input->post('bkrID'));

			$data = $this->Remainders_model->deleteBookingRemainder($uniid, $bkrID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Removed Successful";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to remove, Pleae try again";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	
	public function allocateDriver()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$travelID = xss_clean($this->input->post('travelID'));
			$bkrVehicleNo = xss_clean($this->input->post('bkrVehicleNo'));

			// Driver Name
			$bkrDriverName = xss_clean($this->input->post('bkrDriverName'));

			$wr = array(
				"uniid" => $uniid,
				"cartravel_id" => $travelID
			);

			$data = array(
				"bkr_alloted_driver" => $bkrDriverName,
				"bkr_allockted_vehicleno" => $bkrVehicleNo
			);

			$status = $this->Remainders_model->updateDriverAllocation($wr, $data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Driver allocated Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to allocate, Try again.";
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