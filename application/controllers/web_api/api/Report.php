<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/Report_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function sendReport()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));

            $reportTag = xss_clean($this->input->post('reportTag'));
            $reportComments = xss_clean($this->input->post('reportComments'));
            $postID = xss_clean($this->input->post('postID'));

            $pid_label = xss_clean($this->input->post('pid_label'));
            $pid = xss_clean($this->input->post('pid'));

            $data = array(
				"reporter_uniid" => $uniid,
				"report_tag" => $reportTag,
				"report_comments" => $reportComments,
				"postingID" => $postID,
				"report_label" => $pid_label,
				"report_pid" => $pid,
				"report_date" => date('Y-m-d H:i:s')
			);

			$status = $this->Report_model->save_sendReport($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Report Sent Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Send, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function getReport()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $reports = $this->Report_model->reportDetails($uniid);
            if($reports)
            {
                $json['error'] = "false";
                $json['reports'] = $reports;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['reports'] = 0;
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