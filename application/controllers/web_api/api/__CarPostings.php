<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarPostings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/CarPosting_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        // echo date('Y-m-d H:i:s'+1y);
        echo "<br>";
        $end = date('Y-m-d', strtotime('+1 years'));
        echo $end;
        echo "<br>";echo "<br>";
    }


	public function file_check($str)
	{
        $allowed_mime_type_arr = array('jpg','JPG','PNG','image/gif','image/jpeg','image/png','image/x-png');
        $mime = pathinfo($_FILES['vehicle_images']['name'], PATHINFO_EXTENSION);

        if(isset($_FILES['vehicle_images']['name']) && $_FILES['vehicle_images']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }










    public function addDroppingCars()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

        $this->form_validation->set_rules('pickupCity', 'Pickup City', 'required');
        $this->form_validation->set_rules('dropCity', 'Drop City', 'required');
        $this->form_validation->set_rules('pickupLat', 'Pickup Lat', 'required');
        $this->form_validation->set_rules('pickupLong', 'Pickup Long', 'required');
        $this->form_validation->set_rules('dropLat', 'Drop Lat', 'required');
        $this->form_validation->set_rules('dropLong', 'Drop Long', 'required');
        $this->form_validation->set_rules('available_seats', 'Available Seats', 'required');
        $this->form_validation->set_rules('ticket_fair', 'Ticket Fair', 'required');
        $this->form_validation->set_rules('journey_date', 'Date', 'required');
        $this->form_validation->set_rules('journey_time', 'Time', 'required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('driver_name', 'Driver Name', 'required');
        $this->form_validation->set_rules('driver_mobile', 'Driver Name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$pickupCity = xss_clean($this->input->post('pickupCity'));
			$dropCity = xss_clean($this->input->post('dropCity'));

			$pickupLat = xss_clean($this->input->post('pickupLat'));
			$pickupLong = xss_clean($this->input->post('pickupLong'));
			$dropLat = xss_clean($this->input->post('dropLat'));
			$dropLong = xss_clean($this->input->post('dropLong'));

			$available_seats = xss_clean($this->input->post('available_seats'));
			$ticket_fair = xss_clean($this->input->post('ticket_fair'));
			$journey_date = xss_clean($this->input->post('journey_date'));
			$journey_time = xss_clean($this->input->post('journey_time'));
			$vehicle_type = xss_clean($this->input->post('vehicle_type'));
			$vehicle_images = xss_clean($this->input->post('vehicle_images'));
			$driver_name = xss_clean($this->input->post('driver_name'));
			$driver_mobile = xss_clean($this->input->post('driver_mobile'));
			$location = xss_clean($this->input->post('location'));

			$via_cities_list = xss_clean($this->input->post('via_cities_list'));

	        if(!empty($_FILES['vehicle_images']['name']))
	        {
                $config['upload_path'] = 'assets/dropingCars/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vehicle_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vehicle_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/dropingCars/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/dropingCars/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/dropingCars/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"pickupCity" => $pickupCity,
				"dropCity" => $dropCity,
				"pickupLat" => $pickupLat,
				"pickupLong" => $pickupLong,
				"dropLat" => $dropLat,
				"dropLong" => $dropLong,
				"available_seats" => $available_seats,
				"ticket_fair" => $ticket_fair,
				"journey_date" => $journey_date,
				"journey_time" => $journey_time,
				"vehicle_type" => $vehicle_type,
				"vehicle_images" => $pPicture,
				"driver_name" => $driver_name,
				"driver_mobile" => $driver_mobile,
				"location" => $location,
				"audio_file_path" => $dcAudio,
				"via_cities_list" => $via_cities_list
			);

			$status = $this->CarPosting_model->saveDroppingCars($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Dropping Cars Added Successfully";
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

	public function myDroppingCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("dc.uniid" => $uniid);
			
			$mycarsList = $this->CarPosting_model->listMyDroppingCars($whereArr);
			
			if($mycarsList)
			{
				$json['error'] = "false";
				$json['myDroppingCarsList'] = $mycarsList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myDroppingCarsList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allDroppingCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));

			$whereArr = array("location" => $cityName);
			
			$carsList = $this->CarPosting_model->listMyDroppingCars($whereArr);
			
			if($carsList)
			{
				$json['error'] = "false";
				$json['droppingCarsList'] = $carsList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['droppingCarsList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function getAllPostingCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$sourceCity = xss_clean($this->input->post('sourceCity'));
			$destinationCity = xss_clean($this->input->post('destinationCity'));
			$journeyDate = xss_clean($this->input->post('journeyDate'));

			$whereArr = array("pickupCity" => $sourceCity, "dropCity" => $destinationCity, "journey_date" => $journeyDate);
			
			// $carsList = $this->CarPosting_model->listDroppingCars($whereArr);
			$carsList = $this->CarPosting_model->listMyDroppingCars($whereArr);
			
			if($carsList)
			{
				$json['error'] = "false";
				$json['carsList'] = $carsList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['carsList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


    public function editDroppingCars()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

        $this->form_validation->set_rules('pickupCity', 'Pickup City', 'required');
        $this->form_validation->set_rules('dropCity', 'Drop City', 'required');
        $this->form_validation->set_rules('pickupLat', 'Pickup Lat', 'required');
        $this->form_validation->set_rules('pickupLong', 'Pickup Long', 'required');
        $this->form_validation->set_rules('dropLat', 'Drop Lat', 'required');
        $this->form_validation->set_rules('dropLong', 'Drop Long', 'required');
        $this->form_validation->set_rules('available_seats', 'Available Seats', 'required');
        $this->form_validation->set_rules('ticket_fair', 'Ticket Fair', 'required');
        $this->form_validation->set_rules('journey_date', 'Date', 'required');
        $this->form_validation->set_rules('journey_time', 'Time', 'required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('driver_name', 'Driver Name', 'required');
        $this->form_validation->set_rules('driver_mobile', 'Driver Name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');

        $this->form_validation->set_rules('vehicle_images', '', 'callback_file_check');

		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$pickupCity = xss_clean($this->input->post('pickupCity'));
			$dropCity = xss_clean($this->input->post('dropCity'));

			$pickupLat = xss_clean($this->input->post('pickupLat'));
			$pickupLong = xss_clean($this->input->post('pickupLong'));
			$dropLat = xss_clean($this->input->post('dropLat'));
			$dropLong = xss_clean($this->input->post('dropLong'));

			$available_seats = xss_clean($this->input->post('available_seats'));
			$ticket_fair = xss_clean($this->input->post('ticket_fair'));
			$journey_date = xss_clean($this->input->post('journey_date'));
			$journey_time = xss_clean($this->input->post('journey_time'));
			$vehicle_type = xss_clean($this->input->post('vehicle_type'));
			$vehicle_images = xss_clean($this->input->post('vehicle_images'));
			$driver_name = xss_clean($this->input->post('driver_name'));
			$driver_mobile = xss_clean($this->input->post('driver_mobile'));
			$location = xss_clean($this->input->post('location'));

			$via_cities_list = xss_clean($this->input->post('via_cities_list'));

	        if(!empty($_FILES['vehicle_images']['name']))
	        {
                $config['upload_path'] = 'assets/dropingCars/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vehicle_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vehicle_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/dropingCars/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/dropingCars/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/dropingCars/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"pickupCity" => $pickupCity,
				"dropCity" => $dropCity,
				"pickupLat" => $pickupLat,
				"pickupLong" => $pickupLong,
				"dropLat" => $dropLat,
				"dropLong" => $dropLong,
				"available_seats" => $available_seats,
				"ticket_fair" => $ticket_fair,
				"journey_date" => $journey_date,
				"journey_time" => $journey_time,
				"vehicle_type" => $vehicle_type,
				"vehicle_images" => $pPicture,
				"driver_name" => $driver_name,
				"driver_mobile" => $driver_mobile,
				"location" => $location,
				"audio_file_path" => $dcAudio,
				"via_cities_list" => $via_cities_list
			);

			$whereArr = array(
                "dpID" => $postID,
                "uniid" => $uniid
            );

			$status = $this->CarPosting_model->updateDroppingCars($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Dropping Cars Edit Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteDroppingCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$vehicle_images = xss_clean($this->input->post('vehicle_images'));

			// if(!empty($vehicle_images))
			// {
			// 	$str = ltrim($vehicle_images,"https://cartravels.com");
			// 	$str = "../".$str;
			// 	unlink($str);
			// }
			

			$data = $this->CarPosting_model->removeDroppingCars($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Post Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Deleted Post";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}
















    public function todayAvailableCars()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$vehicle_type = xss_clean($this->input->post('vehicle_type'));
			$location = xss_clean($this->input->post('location'));

	        if(!empty($_FILES['vehicle_images']['name']))
	        {
                $config['upload_path'] = 'assets/todayAvailableCars/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vehicle_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vehicle_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/todayAvailableCars/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/todayAvailableCars/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/todayAvailableCars/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"tda_car_image" => $pPicture,
				"tda_car_type" => $vehicle_type,
				"tda_location" => $location,
				"tda_voice_msg" => $dcAudio,
				"tda_date" => date('Y-m-d'),
				"updated_date" => date('Y-m-d H:i:s'),
				"tda_availability" => 1,
				"tda_booked_status" => 0
			);

			$status = $this->CarPosting_model->saveTodayAvailableCars($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Today Available Car Added Successfully";
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

	public function myTodayCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("t.uniid" => $uniid);
			
			$mycarsList = $this->CarPosting_model->listMyTodayCars($whereArr);
			
			if($mycarsList)
			{
				$json['error'] = "false";
				$json['myTodayCarsList'] = $mycarsList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myTodayCarsList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allTodayAvailableCars()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('location'));

			$whereArr = array("tda_location" => $cityName, "tda_date" => date("Y-m-d"), "tda_availability" => 1);
			
			$carsList = $this->CarPosting_model->listMyTodayCars($whereArr);
			
			if($carsList)
			{
				$json['error'] = "false";
				$json['todayCarsList'] = $carsList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['todayCarsList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function editTodayAvailableCars()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('vehicle_images', '', 'callback_file_check');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$vehicle_type = xss_clean($this->input->post('vehicle_type'));
			$location = xss_clean($this->input->post('location'));


	        if(!empty($_FILES['vehicle_images']['name']))
	        {
                $config['upload_path'] = 'assets/todayAvailableCars/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vehicle_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vehicle_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/todayAvailableCars/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/todayAvailableCars/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/todayAvailableCars/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"tda_car_image" => $pPicture,
				"tda_car_type" => $vehicle_type,
				"tda_location" => $location,
				"tda_voice_msg" => $dcAudio,

				"updated_date" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "tdaID" => $postID,
                "uniid" => $uniid
            );

			$status = $this->CarPosting_model->updateTodayAvailableCars($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Today Available Car edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteTodayAvailableCar()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$vehicle_images = xss_clean($this->input->post('vehicle_images'));

			// if(!empty($vehicle_images))
			// {
			// 	$str = ltrim($vehicle_images,"https://cartravels.com");
			// 	$str = "../".$str;
			// 	unlink($str);
			// }

			$data = $this->CarPosting_model->removeTodayAvailableCar($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Post Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Deleted Post";
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