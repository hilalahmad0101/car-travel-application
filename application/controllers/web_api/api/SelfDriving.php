<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelfDriving extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/SelfDriving_model');
        $this->load->model('api/CarPosting_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function postSelfDrivingVehicle()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
		
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('vehicleName', 'Vehicle Name', 'required');

        $this->form_validation->set_rules('hours', 'Number of Hours', 'required');

        $this->form_validation->set_rules('HoursFare1', '1 Hours Fare', 'required');
        $this->form_validation->set_rules('HoursFare12', '12 Hours Fare', 'required');
        $this->form_validation->set_rules('HoursFare24', '24 Hours Fare', 'required');

        $this->form_validation->set_rules('fuelType', 'Fuel Type', 'required');

        $this->form_validation->set_rules('vehicleYear', 'Vehicle Year', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('termsAndConditions', 'Terms and Conditions', 'required');

        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$vehicleType = xss_clean($this->input->post('vehicleType'));
			$vehicleName = xss_clean($this->input->post('vehicleName'));
			$hours = xss_clean($this->input->post('hours'));

			$HoursFare1 = xss_clean($this->input->post('HoursFare1'));
			$HoursFare12 = xss_clean($this->input->post('HoursFare12'));
			$HoursFare24 = xss_clean($this->input->post('HoursFare24'));

			$fuelType = xss_clean($this->input->post('fuelType'));
			
			$vehicleYear = xss_clean($this->input->post('vehicleYear'));
			$desc = xss_clean($this->input->post('desc'));
			$termsAndConditions = xss_clean($this->input->post('termsAndConditions'));

			$location = xss_clean($this->input->post('location'));


	        if(!empty($_FILES['sdv_images']['name']))
	        {
                $config['upload_path'] = 'assets/sdv/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['sdv_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('sdv_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/sdv/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_sdv']['name']))
	        {
                $config['upload_path'] = 'assets/sdv/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_sdv']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_sdv'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/sdv/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"sdv_image" => $pPicture,
				"sdv_type" => $vehicleType,
				"sdv_name" => $vehicleName,
				"sdv_hours" => $hours,
				"sdv_HoursFare_1" => $HoursFare1,
				"sdv_HoursFare_12" => $HoursFare12,
				"sdv_HoursFare_24" => $HoursFare24,
				"sdv_fuel_type" => $fuelType,
				"sdv_vehicle_year" => $vehicleYear,
				"sdv_vehicle_desc" => $desc,
				"sdv_terms_cond" => $termsAndConditions,
				"sdv_location" => $location,
				"sdv_voice" => $vAudio,
				"sdv_status" => 1,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$pid = $this->SelfDriving_model->saveSelfDrivingvv($data);
			if(!empty($pid))
			{
				$json['error'] = "false";
				$json['message'] = "Vehicle Posted Successfully";
				$json['postId'] = $pid;
				$json['image'] = $pPicture;
			}
		
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post Vehicle, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function editSelfDrivingVehicle()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('vehicleName', 'Vehicle Name', 'required');

        $this->form_validation->set_rules('hours', 'Number of Hours', 'required');

        $this->form_validation->set_rules('HoursFare1', '1 Hours Fare', 'required');
        $this->form_validation->set_rules('HoursFare12', '12 Hours Fare', 'required');
        $this->form_validation->set_rules('HoursFare24', '24 Hours Fare', 'required');

        $this->form_validation->set_rules('fuelType', 'Fuel Type', 'required');

        $this->form_validation->set_rules('vehicleYear', 'Vehicle Year', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('termsAndConditions', 'Terms and Conditions', 'required');

        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$vehicleType = xss_clean($this->input->post('vehicleType'));
			$vehicleName = xss_clean($this->input->post('vehicleName'));
			$hours = xss_clean($this->input->post('hours'));

			$HoursFare1 = xss_clean($this->input->post('HoursFare1'));
			$HoursFare12 = xss_clean($this->input->post('HoursFare12'));
			$HoursFare24 = xss_clean($this->input->post('HoursFare24'));

			$fuelType = xss_clean($this->input->post('fuelType'));

			$vehicleYear = xss_clean($this->input->post('vehicleYear'));
			$desc = xss_clean($this->input->post('desc'));
			$termsAndConditions = xss_clean($this->input->post('termsAndConditions'));

			$location = xss_clean($this->input->post('location'));

			$dimg = xss_clean($this->input->post('dimg'));


	        if(!empty($_FILES['sdv_images']['name']))
	        {
                $config['upload_path'] = 'assets/sdv/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['sdv_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('sdv_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/sdv/'.$pPicture;

                    if($dimg)
					{
						if(file_exists(str_replace(base_url(),"",$dimg)))
						{
							unlink(str_replace(base_url(),"",$dimg));
						}
					}
                }
                else { $pPicture = $dimg; }
            }
            else { $pPicture = $dimg; }

	        if(!empty($_FILES['audio_file_sdv']['name']))
	        {
                $config['upload_path'] = 'assets/sdv/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_sdv']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_sdv'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/sdv/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"sdv_image" => $pPicture,
				"sdv_type" => $vehicleType,
				"sdv_name" => $vehicleName,
				"sdv_hours" => $hours,
				"sdv_HoursFare_1" => $HoursFare1,
				"sdv_HoursFare_12" => $HoursFare12,
				"sdv_HoursFare_24" => $HoursFare24,
				"sdv_fuel_type" => $fuelType,
				"sdv_vehicle_year" => $vehicleYear,
				"sdv_vehicle_desc" => $desc,
				"sdv_terms_cond" => $termsAndConditions,
				"sdv_location" => $location,
				"sdv_voice" => $vAudio,
				"sdv_status" => 1,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "sdvID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->SelfDriving_model->updateSelfDrivingvv($data, $whereArr);
			$sts = $this->CarPosting_model->updateGroupPost(array("post_location" => $location), $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "S.Vehicle Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit S.Vehicle, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteSelfDrivingVehicle()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->SelfDriving_model->removeSelfDrivingvv($uniid, $postID);

			if($data === 'history')
			{
				$json['error'] = "true";
			    $json['message'] = "Someone booked this Car, You cant delete";
			}
			elseif($data == 1)
			{
				$json['error'] = "false";
			    $json['message'] = "Self Drivingvv Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Delete Self Drivingvv";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function mySelfVehicles()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("v.uniid" => $uniid);
			
			$myVehicleList = $this->SelfDriving_model->listMySelfDrivingvv($whereArr);
			
			if($myVehicleList)
			{
				$json['error'] = "false";
				$json['myVehicleList'] = $myVehicleList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myVehicleList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allSelfDVehicles()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("sdv_location like " => "%$cityName%");
			$sdVehicleList = $this->SelfDriving_model->listMySelfDrivingvv($whereArr);
			if($sdVehicleList)
			{
				$json['error'] = "false";
				$json['sdVehicleList'] = $sdVehicleList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['sdVehicleList'] = 0;
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