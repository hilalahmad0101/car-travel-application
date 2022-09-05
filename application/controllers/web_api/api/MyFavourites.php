<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyFavourites extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/MyFavourites_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function addFavoutite()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('postID', 'Post ID', 'required');		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$postID = xss_clean($this->input->post('postID'));

			$data = array(
				"uniid" => $uniid,
				"pid" => $postID
			);

			$status = $this->MyFavourites_model->saveFavourite($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Favourite Added Successfully";
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

	public function deleteFavourite()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $uniid = xss_clean($this->input->post('uniid'));
			$postID = xss_clean($this->input->post('postID'));

			$data = $this->MyFavourites_model->removeFavourite($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Favourite Deleted";
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




	// Category Favourite
    public function addCatFavourite()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('catID', 'Category ID', 'required');		
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$catID = xss_clean($this->input->post('catID'));

			$data = array(
				"uniid" => $uniid,
				"cid" => $catID
			);

			$status = $this->MyFavourites_model->saveCatFavourite($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Favourite Added Successfully";
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

	public function deleteCatFavourite()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $uniid = xss_clean($this->input->post('uniid'));
			$catID = xss_clean($this->input->post('catID'));

			$data = $this->MyFavourites_model->removeCatFavourite($uniid, $catID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Favourite Deleted";
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