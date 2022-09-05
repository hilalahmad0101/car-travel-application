<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyRatings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/MyRatings_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function addRating()
	{
		
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$catID = xss_clean($this->input->post('catID'));
			$ratings = xss_clean($this->input->post('ratings'));
			$reviewComment = xss_clean($this->input->post('reviewComment'));

			$data = array(
				"uniid" => $uniid,
				"cid" => $catID,
				'ratings' => $ratings,
				'review' => $reviewComment
			);

			$status = $this->MyRatings_model->saveRating($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Rating Added Successfully";
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

	public function updateRating()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $uniid = xss_clean($this->input->post('uniid'));
			$catID = xss_clean($this->input->post('catID'));
			$ratings = xss_clean($this->input->post('ratings'));
			$reviewComment = xss_clean($this->input->post('reviewComment'));

			$wrArray = array('uniid' => $uniid, 'cid' => $catID);
			$ratingsArr = array('ratings' => $ratings, 'review' => $reviewComment);

			$data = $this->MyRatings_model->updateRatings($wrArray, $ratingsArr);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Rating Updated";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Update";
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