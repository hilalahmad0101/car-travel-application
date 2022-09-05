<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Postings_model');
        $this->load->model('api/Gmaps_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        // echo date('Y-m-d H:i:s'+1y);
        echo "<br>";
        $end = date('Y-m-d', strtotime('+1 years'));
        echo $end;
    }


    public function promoteVCards()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$desc = xss_clean($this->input->post('desc'));
			$location = xss_clean($this->input->post('location'));

	        if(!empty($_FILES['vc_images']['name']))
	        {
                $config['upload_path'] = 'assets/vc/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vc_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vc_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/vc/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_vc']['name']))
	        {
                $config['upload_path'] = 'assets/vc/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_vc']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_vc'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/vc/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"vc_desc" => $desc,
				"vc_location" => $location,
				"vc_image" => $pPicture,
				"vc_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Postings_model->saveVC($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "VC Promote added Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post VC Promote, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

    public function editPromoteVCards()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$desc = xss_clean($this->input->post('desc'));
			$location = xss_clean($this->input->post('location'));

	        if(!empty($_FILES['vc_images']['name']))
	        {
                $config['upload_path'] = 'assets/vc/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['vc_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('vc_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/vc/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_vc']['name']))
	        {
                $config['upload_path'] = 'assets/vc/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_vc']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_vc'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/vc/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"vc_desc" => $desc,
				"vc_location" => $location,
				"vc_image" => $pPicture,
				"vc_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "vcID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->Postings_model->updateVC($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "VC Promote Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Delete VC Promote, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deletePromoteVCards()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Postings_model->removeVC($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "VC Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to VC";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function myPVCards()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("vc.uniid" => $uniid);
			
			$myVCList = $this->Postings_model->listMyVCs($whereArr);
			
			if($myVCList)
			{
				$json['error'] = "false";
				$json['myVCList'] = $myVCList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myVCList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allpromoteVCards()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("vc_location" => $cityName);
			$vcCards = $this->Postings_model->listMyVCs($whereArr);
			if($vcCards)
			{
				$json['error'] = "false";
				$json['vcCards'] = $vcCards;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['vcCards'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}






    public function postOthers()
	{
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

	        if(!empty($_FILES['other_images']['name']))
	        {
                $config['upload_path'] = 'assets/others/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['other_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('other_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/others/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_other']['name']))
	        {
                $config['upload_path'] = 'assets/others/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_other']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_other'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/others/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"other_title" => $title,
				"other_desc" => $desc,
				"other_location" => $location,
				"other_image" => $pPicture,
				"other_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Postings_model->saveOthers($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Others Post Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post Others, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

    public function editOthers()
	{
		$this->form_validation->set_rules('postID', 'User ID', 'required');
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

	        if(!empty($_FILES['other_images']['name']))
	        {
                $config['upload_path'] = 'assets/others/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['other_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('other_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/others/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_other']['name']))
	        {
                $config['upload_path'] = 'assets/others/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_other']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_other'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/others/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"other_title" => $title,
				"other_desc" => $desc,
				"other_location" => $location,
				"other_image" => $pPicture,
				"other_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "otherID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->Postings_model->updateOthers($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Others Post Edited";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit Others, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteOthers()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Postings_model->removeOthers($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Others Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Delete Others";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function myOtherPostings()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("o.uniid" => $uniid);
			
			$myOthersList = $this->Postings_model->listMyOthers($whereArr);
			
			if($myOthersList)
			{
				$json['error'] = "false";
				$json['myOthersList'] = $myOthersList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myOthersList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allOtherPostings()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("other_location" => $cityName);
			$otherPostings = $this->Postings_model->listMyOthers($whereArr);
			if($otherPostings)
			{
				$json['error'] = "false";
				$json['otherPostings'] = $otherPostings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['otherPostings'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}





    public function postAccidentBreakdown()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('accBreakTitle', 'Accident or Breakdown Title', 'required');
        $this->form_validation->set_rules('dedication', 'Description', 'required');
        $this->form_validation->set_rules('location', 'Post Location', 'required');

        $this->form_validation->set_rules('latitude', 'Post Location', 'required');
        $this->form_validation->set_rules('longitude', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$accBreakTitle = xss_clean($this->input->post('accBreakTitle'));
			$dedication = xss_clean($this->input->post('dedication'));
			$location = xss_clean($this->input->post('location'));

			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));

	        if(!empty($_FILES['accbw_images']['name']))
	        {
                $config['upload_path'] = 'assets/accbw/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['accbw_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('accbw_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/accbw/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_accbw']['name']))
	        {
                $config['upload_path'] = 'assets/accbw/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_accbw']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_accbw'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/accbw/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"accbw_title" => $accBreakTitle,
				"accbw_dedication" => $dedication,
				"accbw_location" => $location,
				"accbw_image" => $pPicture,
				"accbw_voice" => $vAudio,
				"accbw_latitude" => $latitude,
				"accbw_longitude" => $longitude,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Postings_model->saveAccBw($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Accident / Breakdown Post Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post Accident / Breakdown, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

    public function editAccidentBreakdown()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');
        $this->form_validation->set_rules('accBreakTitle', 'Accident or Breakdown Title', 'required');
        $this->form_validation->set_rules('dedication', 'Description', 'required');
        $this->form_validation->set_rules('location', 'Post Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));
			$accBreakTitle = xss_clean($this->input->post('accBreakTitle'));
			$dedication = xss_clean($this->input->post('dedication'));
			$location = xss_clean($this->input->post('location'));

			$latitude = xss_clean($this->input->post('latitude'));
			$longitude = xss_clean($this->input->post('longitude'));

	        if(!empty($_FILES['accbw_images']['name']))
	        {
                $config['upload_path'] = 'assets/accbw/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['accbw_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('accbw_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/accbw/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_accbw']['name']))
	        {
                $config['upload_path'] = 'assets/accbw/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_accbw']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_accbw'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/accbw/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"accbw_title" => $accBreakTitle,
				"accbw_dedication" => $dedication,
				"accbw_location" => $location,
				"accbw_image" => $pPicture,
				"accbw_voice" => $vAudio,
				"accbw_latitude" => $latitude,
				"accbw_longitude" => $longitude,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "accID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->Postings_model->updateAccBw($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Accident / Breakdown Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit Accident / Breakdown, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteAccidentBreakdown()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Postings_model->removeAccBw($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Accident Breakdown Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Delete Accident Breakdown";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function myAccidentBreakdown()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("acb.uniid" => $uniid);
			
			$myAccBwList = $this->Postings_model->listMyAccBw($whereArr);
			
			if($myAccBwList)
			{
				$json['error'] = "false";
				$json['myAccBwList'] = $myAccBwList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myAccBwList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allAccidentBreakdown()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("accbw_location" => $cityName);
			$AccBwList = $this->Postings_model->listMyAccBw($whereArr);
			if($AccBwList)
			{
				$json['error'] = "false";
				$json['AccBwList'] = $AccBwList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['AccBwList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}



    public function postTourPackages()
	{
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

        $this->form_validation->set_rules('tourPackateName', 'Package Name', 'required');
        $this->form_validation->set_rules('tourStartLocation', 'Start Location', 'required');

        $this->form_validation->set_rules('tourPlanDays', 'Plan Days', 'required');
        $this->form_validation->set_rules('tourContactNumber', 'Contact Number', 'required');
        $this->form_validation->set_rules('tourContactEmail', 'Contact Email', 'required');

        $this->form_validation->set_rules('postingLocation', 'Post Location', 'required');
		$this->form_validation->set_rules('keywords', 'Keywords', 'required');

		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$tourPackateName = xss_clean($this->input->post('tourPackateName'));
			$tourDescription = xss_clean($this->input->post('tourDescription'));

			$forSingle = xss_clean($this->input->post('forSingle'));
			$forCouple = xss_clean($this->input->post('forCouple'));
			$forExtraChild = xss_clean($this->input->post('forExtraChild'));

			$tourStartLocation = xss_clean($this->input->post('tourStartLocation'));

			$accommodationSts = xss_clean($this->input->post('accommodationSts'));
			$accommodationDesc = xss_clean($this->input->post('accommodationDesc'));

			$foodSts = xss_clean($this->input->post('foodSts'));
			$foodDesc = xss_clean($this->input->post('foodDesc'));

			$transportSts = xss_clean($this->input->post('transportSts'));
			$transportDesc = xss_clean($this->input->post('transportDesc'));

			$siteseeingSts = xss_clean($this->input->post('siteseeingSts'));
			$siteseeingDesc = xss_clean($this->input->post('siteseeingDesc'));

			$complimentrySts = xss_clean($this->input->post('complimentrySts'));
			$complimentryDesc = xss_clean($this->input->post('complimentryDesc'));

			$planDays = xss_clean($this->input->post('tourPlanDays'));
			$whatInc = xss_clean($this->input->post('tourWhatInc'));
			$whatNotInc = xss_clean($this->input->post('tourWhatNotInc'));

			$contactNumber = xss_clean($this->input->post('tourContactNumber'));
			$contactEmail = xss_clean($this->input->post('tourContactEmail'));

			$postingLocation = xss_clean($this->input->post('postingLocation'));
			$keywords = xss_clean($this->input->post('keywords'));






	        // if(!empty($_FILES['tour_images']['name']))
	        // {
         //        $config['upload_path'] = 'assets/tourTravels/';
         //        $config['allowed_types'] = 'jpg|jpeg|png|gif';
         //        $config['file_name'] = $_FILES['tour_images']['name'];

         //        //Load upload library and initialize configuration
         //        $this->load->library('upload',$config);
         //        $this->upload->initialize($config);
                
         //        if($this->upload->do_upload('tour_images'))
         //        {
         //            $uploadData = $this->upload->data();
         //            $pPicture = $uploadData['file_name'];
         //            $pPicture = base_url().'assets/tourTravels/'.$pPicture;
         //        }
         //        else { $pPicture = ''; }
         //    }
         //    else { $pPicture = ''; }




    $targetDir = "assets/tourTravels/";
    $allowTypes = array('jpg','png','jpeg','gif'); 



    $fileNames = array_filter($_FILES['tour_images']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['tour_images']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['tour_images']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["tour_images"]["tmp_name"][$key], $targetFilePath)){ 
                    $files[] = base_url().$targetFilePath; 
                }else{ 
                    $errorUpload .= $_FILES['tour_images']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['tour_images']['name'][$key].' | '; 
            } 
        }

        // print_r($files);
        // $pPicture = json_encode($files);
        $pPicture = implode("#",$files);
	}































	        if(!empty($_FILES['audio_file_tour']['name']))
	        {
                $config['upload_path'] = 'assets/tourTravels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_tour']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_tour'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/tourTravels/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"tour_package_name" => $tourPackateName,
				"tour_description" => $tourDescription,
				"tour_for_single" => $forSingle,
				"tour_for_couple" => $forCouple,
				"tour_for_extra_child" => $forExtraChild,

				"tour_start_location" => $tourStartLocation,

				"tour_accommodation_sts" => $accommodationSts,
				"tour_accommodation_desc" => $accommodationDesc,
				"tour_food_sts" => $foodSts,
				"tour_food_desc" => $foodDesc,
				"tour_transport_sts" => $transportSts,
				"tour_transport_desc" => $transportDesc,
				"tour_siteseeing_sts" => $siteseeingSts,
				"tour_siteseeing_desc" => $siteseeingDesc,
				"tour_complimentry_sts" => $complimentrySts,
				"tour_complimentry_desc" => $complimentryDesc,

				"tour_plan_days" => $planDays,
				"tour_what_inc" => $whatInc,
				"tour_what_not_inc" => $whatNotInc,
				"tour_contact_number" => $contactNumber,
				"tour_contact_email" => $contactEmail,
				"tour_post_location" => $postingLocation,
				"tour_keywords" => $keywords,

				"tour_package_valid" => 1,

				"tourp_image" => $pPicture,
				"tourp_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";

			// echo json_encode($data);

			// exit;


			$status = $this->Postings_model->saveTourTravels($data);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Tour Packages Post Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post Tour Packages, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

   	public function editTourPackages()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

        $this->form_validation->set_rules('tourPackateName', 'Package Name', 'required');
        $this->form_validation->set_rules('tourStartLocation', 'Start Location', 'required');

        $this->form_validation->set_rules('tourPlanDays', 'Plan Days', 'required');
        $this->form_validation->set_rules('tourContactNumber', 'Contact Number', 'required');
        $this->form_validation->set_rules('tourContactEmail', 'Contact Email', 'required');

        $this->form_validation->set_rules('postingLocation', 'Post Location', 'required');
		$this->form_validation->set_rules('keywords', 'Keywords', 'required');

		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$tourPackateName = xss_clean($this->input->post('tourPackateName'));
			$tourDescription = xss_clean($this->input->post('tourDescription'));

			$forSingle = xss_clean($this->input->post('forSingle'));
			$forCouple = xss_clean($this->input->post('forCouple'));
			$forExtraChild = xss_clean($this->input->post('forExtraChild'));

			$tourStartLocation = xss_clean($this->input->post('tourStartLocation'));

			$accommodationSts = xss_clean($this->input->post('accommodationSts'));
			$accommodationDesc = xss_clean($this->input->post('accommodationDesc'));

			$foodSts = xss_clean($this->input->post('foodSts'));
			$foodDesc = xss_clean($this->input->post('foodDesc'));

			$transportSts = xss_clean($this->input->post('transportSts'));
			$transportDesc = xss_clean($this->input->post('transportDesc'));

			$siteseeingSts = xss_clean($this->input->post('siteseeingSts'));
			$siteseeingDesc = xss_clean($this->input->post('siteseeingDesc'));

			$complimentrySts = xss_clean($this->input->post('complimentrySts'));
			$complimentryDesc = xss_clean($this->input->post('complimentryDesc'));

			$planDays = xss_clean($this->input->post('tourPlanDays'));
			$whatInc = xss_clean($this->input->post('tourWhatInc'));
			$whatNotInc = xss_clean($this->input->post('tourWhatNotInc'));

			$contactNumber = xss_clean($this->input->post('tourContactNumber'));
			$contactEmail = xss_clean($this->input->post('tourContactEmail'));

			$postingLocation = xss_clean($this->input->post('postingLocation'));
			$keywords = xss_clean($this->input->post('keywords'));

	        if(!empty($_FILES['tour_images']['name']))
	        {
                $config['upload_path'] = 'assets/tourTravels/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['tour_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('tour_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/tourTravels/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_tour']['name']))
	        {
                $config['upload_path'] = 'assets/tourTravels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_tour']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_tour'))
                {
                    $uploadData = $this->upload->data();
                    $vAudio = $uploadData['file_name'];
                    $vAudio = base_url().'assets/tourTravels/'.$vAudio;
                }
                else { $vAudio = ''; }
            }
            else { $vAudio = ''; }

			$data = array(
				"tour_package_name" => $tourPackateName,
				"tour_description" => $tourDescription,
				"tour_for_single" => $forSingle,
				"tour_for_couple" => $forCouple,
				"tour_for_extra_child" => $forExtraChild,

				"tour_start_location" => $tourStartLocation,

				"tour_accommodation_sts" => $accommodationSts,
				"tour_accommodation_desc" => $accommodationDesc,
				"tour_food_sts" => $foodSts,
				"tour_food_desc" => $foodDesc,
				"tour_transport_sts" => $transportSts,
				"tour_transport_desc" => $transportDesc,
				"tour_siteseeing_sts" => $siteseeingSts,
				"tour_siteseeing_desc" => $siteseeingDesc,
				"tour_complimentry_sts" => $complimentrySts,
				"tour_complimentry_desc" => $complimentryDesc,

				"tour_plan_days" => $planDays,
				"tour_what_inc" => $whatInc,
				"tour_what_not_inc" => $whatNotInc,
				"tour_contact_number" => $contactNumber,
				"tour_contact_email" => $contactEmail,
				"tour_post_location" => $postingLocation,
				"tour_keywords" => $keywords,

				"tour_package_valid" => 1,

				"tourp_image" => $pPicture,
				"tourp_voice" => $vAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "tpID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->Postings_model->updateTourTravels($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Tour Packages Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit Tour Packages, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deleteTourPackages()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->Postings_model->removeTourTravels($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Tour Packages Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Delete Tour Packages";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function myTourPackages()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("tour.uniid" => $uniid);
			
			$myTourPacList = $this->Postings_model->listMyTourPackages($whereArr);
			
			if($myTourPacList)
			{
				$json['error'] = "false";
				$json['myTourPacList'] = $myTourPacList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myTourPacList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allTourPackages()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("tour_start_location" => $cityName);
			$tourPackages = $this->Postings_model->listMyTourPackages($whereArr);
			if($tourPackages)
			{
				$json['error'] = "false";
				$json['tourPackages'] = $tourPackages;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['tourPackages'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}






    public function addFavourite()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $postingID = xss_clean($this->input->post('postingID'));
            $myUniid = xss_clean($this->input->post('myUniid'));

            $favourite = xss_clean($this->input->post('favourite'));

            $update = array(
                "favourite" => $favourite
            );

            $whereArr = array(
                "postingID" => $postingID,
                "uniid" => $myUniid
            );

            $status = $this->Gmaps_model->updateFavourite($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Updated Favourite";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to add Favourite, Try again.";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }




    public function sharedPost()
    {
    	if($this->input->method(TRUE) == 'POST')
		{
			$postID = xss_clean($this->input->post('pid'));
			$uniid = xss_clean($this->input->post('uid'));

			$whereArr = array("p.postingID" => $postID, "p.uniid" => $uniid);

			$allPostings = $this->Postings_model->listMyGroupPostings($whereArr);
			if($allPostings)
			{
				$json['error'] = "false";
				$json['allPostings'] = $allPostings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['allPostings'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
    }



    public function groupPostDetails()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$myUniid = xss_clean($this->input->post('uniid'));
			$pid = xss_clean($this->input->post('pid'));
			$whereArr = array("p.postingID" => $pid);

			$allPostings = $this->Postings_model->listMyAllGroupPostings($whereArr, $myUniid);
			if($allPostings)
			{
				$json['error'] = "false";
				$json['all'] = count($allPostings);
				$json['allPostings'] = $allPostings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['allPostings'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allGroupPostings()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$myUniid = xss_clean($this->input->post('uniid'));
			$postLocation = xss_clean($this->input->post('postLocation'));
			$whereArr = array("p.post_location like" => "%$postLocation%", "p.posting_booking_sts" => 0, "accID" => 0, "jobID" => 0, "tendID"=> 0);

			$min = xss_clean($this->input->post('min'));

			$allPostings = $this->Postings_model->listMyAllGroupPostings($whereArr, $myUniid, $min);
			if($allPostings)
			{
				$json['error'] = "false";
				$json['all'] = count($allPostings);
				$json['allPostings'] = $allPostings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['allPostings'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function myGroupPostings()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$whereArr = array("p.uniid" => $uniid);

			$myPostings = $this->Postings_model->listMyGroupPostings($whereArr);
			if($myPostings)
			{
				$json['error'] = "false";
				$json['myPostings'] = $myPostings;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myPostings'] = 0;
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
