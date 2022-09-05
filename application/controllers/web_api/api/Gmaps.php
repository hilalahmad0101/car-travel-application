<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmaps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Gmaps_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function updateLatLong()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));

            $lat = xss_clean($this->input->post('Latitude'));
            $long = xss_clean($this->input->post('Longitude'));

            $update = array(
                "live_lat" => $lat,
                "live_long" => $long
            );

            $whereArr = array(
                "user_uniid" => $uniid,
                "cid" => $cid
            );

            if($uniid == '7446n6228i209e2189m3c3mf378ci4oa2582c2784b9c3198059aa221hdffd2n1782lg')
            {
            	$insertData = array(
	            	"uniid" => $uniid,
	                "latitude" => $lat,
	                "longitude" => $long,
	                "updated_on" => date('Y-m-d H:i:s')
	            );
	            $insStatus = $this->Gmaps_model->saveGPSTrackLiveLocation($insertData);
            }

            $status = $this->Gmaps_model->updateLiveLatLong($update, $whereArr);
            

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Updated Lat Long";
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
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }




    public function addPlaces()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('add_place_type', 'Place Type', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('add_place_name', 'Place Name', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('latitude', 'latitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('longitude', 'longitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('area_radius', 'Area Radius', 'required');
		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$add_place_type = xss_clean($this->input->post('add_place_type'));
			$add_place_name = xss_clean($this->input->post('add_place_name'));
			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));
			$area_radius = xss_clean($this->input->post('area_radius'));

			$data = array(
				"uniid" => $uniid,
				"place_Type" => $add_place_type,
				"place_Name" => $add_place_name,
				"place_Latitude" => $latitude,
				"place_Longitude" => $longitude,
				"area_radius" => $area_radius,

				"inserted_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Gmaps_model->saveAddPlace($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Place Added Successfully";
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


    public function editAddPlaces()
	{		
		if($this->input->method(TRUE) == "POST")
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$placeId = xss_clean($this->input->post('placeId'));

			$add_place_type = xss_clean($this->input->post('add_place_type'));
			$add_place_name = xss_clean($this->input->post('add_place_name'));
			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));
			$area_radius = xss_clean($this->input->post('area_radius'));

			$notification_status = xss_clean($this->input->post('notification_status'));

			$updateData = array(
				"place_Type" => $add_place_type,
				"place_Name" => $add_place_name,
				"place_Latitude" => $latitude,
				"place_Longitude" => $longitude,
				"area_radius" => $area_radius,
				"updated_on" => date('Y-m-d H:i:s'),
				"notification_status" => $notification_status
			);

			$whereArr = array('uniid' => $uniid, 'place_id' => $placeId);

			$status = $this->Gmaps_model->updateAddPlace($whereArr, $updateData);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Place Updated Successfully";
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
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}



	public function getAddPlaces()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			
			$addPlacesList = $this->Gmaps_model->listAddPlaces($uniid);
			
			if($addPlacesList)
			{
				$json['error'] = "false";
				$json['addPlacesList'] = $addPlacesList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['addPlacesList'] = 0;
			}
			echo json_encode($json);
		}
	}


	public function addGPSLiveLocation()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('latitude', 'latitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('longitude', 'longitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));
		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));

			$data = array(
				"uniid" => $uniid,
				"latitude" => $latitude,
				"longitude" => $longitude,

				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Gmaps_model->saveGPSLiveLocation($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Place Added Successfully";
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

	public function updateGPSLiveLocation()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('latitude', 'latitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('longitude', 'longitude', 'required', array(
                'required'      => 'You have not provided %s.'
        ));
		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));

			$data = array(

				"latitude" => $latitude,
				"longitude" => $longitude,

				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Gmaps_model->updateGPSLiveLocation($uniid, $data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Place Added Successfully";
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

	public function getGPSLiveLocation()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			
			$liveLocation = $this->Gmaps_model->getGPSLiveLocation($uniid);
			
			if($liveLocation)
			{
				$json['error'] = "false";
				$json['liveLocation'] = $liveLocation;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['liveLocation'] = 0;
			}
			echo json_encode($json);
		}
	}
}

?>