<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareUrls extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');

        $this->load->model('api/ShareUrls_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function addShareUrl()
	{
		$this->form_validation->set_rules('share_cid', 'User CID', 'required');
        $this->form_validation->set_rules('share_code', 'Share Code', 'required');
        $this->form_validation->set_rules('shareto_mobile', 'Mobile Number', 'required');

        // $this->form_validation->set_rules('shareto_mobile', 'Mobile Number', 'required|is_unique[api_driver_share.shareto_mobile]', array(
	       //          'required'      => 'You have not provided %s.',
	       //          'is_unique'     => 'Already shard to this %s'
	       //  ));
		
		if($this->form_validation->run() == true)
		{
			$driver_cid = xss_clean($this->input->post('share_cid'));
			$share_uniid = xss_clean($this->input->post('share_uniid'));
			$share_code = xss_clean($this->input->post('share_code'));
			$shareto_mobile = xss_clean($this->input->post('shareto_mobile'));
			$share_date = date('Y-m-d H:i:s', strtotime('+1 day'));

			$data = array(
				"driver_cid" => $driver_cid,
				"share_code" => $share_code,
				"shareto_mobile" => $shareto_mobile,
				"share_date" => $share_date,
				"share_uniid" => $share_uniid
			);

			$status = $this->ShareUrls_model->saveShareUrl($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Share Added Successfully";
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
			 // $json['message'] = validation_errors();
			 $json['message'] = strip_tags(validation_errors());
		}
		echo json_encode($json);
	}

	public function stopSharing()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $cid = xss_clean($this->input->post('driver_cid'));
			$code = xss_clean($this->input->post('share_code'));

			$data = $this->ShareUrls_model->stopShareCode($cid, $code);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Stopped Successful";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Stop, Pleae try again";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function deleteShareCode()
	{
        $date = date('Y-m-d H:i:s');
		$data = $this->ShareUrls_model->removeShareCode($date);
	}
}

?>