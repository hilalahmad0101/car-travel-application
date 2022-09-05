<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareTracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		
        $this->load->model('api/ShareTracking_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        echo "<br>";
        $end = date('Y-m-d', strtotime('+1 years'));
        echo $end;
    }

    public function getDriverSharedLocation()
    {
        $driverCode = xss_clean($this->input->get('driverCode'));

        $whereArr = array(
            "sd.share_code" => $driverCode
        );

        $data = $this->ShareTracking_model->get_getDriverSharedLocations($whereArr);

        if($data)
        {
            $json['error'] = "false";
            $json['driver'] = $data;
        }
        else
        {
            $json['error'] = "true";
            $json['driver'] = "No Data";
        }

        echo json_encode($json);
    }


    public function getSOSSharedLocation()
    {
        $driverCode = xss_clean($this->input->post('sosCode'));

        $whereArr = array(
            "ss.sos_code" => $driverCode
        );

        $data = $this->ShareTracking_model->get_getSOSLocations($whereArr);

        if($data)
        {
            $json['error'] = "false";
            $json['driver'] = $data;
        }
        else
        {
            $json['error'] = "true";
            $json['driver'] = "No Data";
        }

        echo json_encode($json);
    }
}