<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Tenders_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function postTender()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
		
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');

        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$title = xss_clean($this->input->post('title'));
			$desc = xss_clean($this->input->post('desc'));
			$location = xss_clean($this->input->post('location'));


	        if(!empty($_FILES['tender_images']['name']))
	        {
                $config['upload_path'] = 'assets/tenders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['tender_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('tender_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/tenders/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_tender']['name']))
	        {
                $config['upload_path'] = 'assets/tenders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_tender']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_tender'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/tenders/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"tend_title" => $title,
				"tend_desc" => $desc,
				"tend_location" => $location,
				"tend_image" => $pPicture,
				"tend_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$pid = $this->Tenders_model->saveTender($data);
			if(!empty($pid))
			{
				$json['error'] = "false";
				$json['message'] = "Tender Posted Successfully";
				$json['postId'] = $pid;
				$json['image'] = $pPicture;
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post Tender, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

    public function editTender()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');

        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$title = xss_clean($this->input->post('title'));
			$desc = xss_clean($this->input->post('desc'));
			$location = xss_clean($this->input->post('location'));


	        if(!empty($_FILES['tender_images']['name']))
	        {
                $config['upload_path'] = 'assets/tenders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['tender_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('tender_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/tenders/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_tender']['name']))
	        {
                $config['upload_path'] = 'assets/tenders/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_tender']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_tender'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/tenders/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"tend_title" => $title,
				"tend_desc" => $desc,
				"tend_location" => $location,
				"tend_image" => $pPicture,
				"tend_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "tendID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->Tenders_model->updateTender($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Tender Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit Tender, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteTender()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Tenders_model->removeTender($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Tender Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Delete Tender";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function myTenders()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("t.uniid" => $uniid);
			
			$myTendersList = $this->Tenders_model->listMyTenders($whereArr);
			
			if($myTendersList)
			{
				$json['error'] = "false";
				$json['myTendersList'] = $myTendersList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myTendersList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allTenders()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("tend_location like " => "%$cityName%");
			$TendersList = $this->Tenders_model->listMyTenders($whereArr);
			if($TendersList)
			{
				$json['error'] = "false";
				$json['TendersList'] = $TendersList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['TendersList'] = 0;
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