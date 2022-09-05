<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/JobPosting_model');
        $this->load->model('api/Notifications_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

	public function myNotifications()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			
			$myNotifyList = $this->Notifications_model->listMyNotifications($uniid);
			
			if($myNotifyList)
			{
				$json['error'] = "false";
				$json['total'] = count($myNotifyList);
				$json['myNotifyList'] = $myNotifyList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myNotifyList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function updateNotifyStatus()
	{
		$this->form_validation->set_rules('notification_ID', 'Notification ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('status', 'Read Status', 'required');
		
		if($this->form_validation->run() == true)
		{
			$notification_ID = xss_clean($this->input->post('notification_ID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$status = xss_clean($this->input->post('status'));

			$data = array(
				"read_status" => $status
			);

			$whereArr = array(
                "notifyID" => $notification_ID,
                "receiver_uniid" => $uniid
            );

			$status = $this->Notifications_model->updateNotificationStatus($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Readed";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Not Read";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}



	public function removeNotifications()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Notifications_model->clearMyNotifications($uniid);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Notifications deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Deleted";
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
