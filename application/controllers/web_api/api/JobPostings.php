<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobPostings extends CI_Controller
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
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function postJob()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('jobType', 'Job Type', 'required');
        $this->form_validation->set_rules('jobTitle', 'Job Title', 'required');

        $this->form_validation->set_rules('salaryFrom', 'Salary From', 'required');
        $this->form_validation->set_rules('salaryTo', 'salary To', 'required');

        $this->form_validation->set_rules('salaryBased', 'Salary Based Type', 'required');

        $this->form_validation->set_rules('jobDescription', 'Job Description', 'required');
        $this->form_validation->set_rules('jobLocation', 'Job Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$jobType = xss_clean($this->input->post('jobType'));
			$jobTitle = xss_clean($this->input->post('jobTitle'));
			$salaryFrom = xss_clean($this->input->post('salaryFrom'));
			$salaryTo = xss_clean($this->input->post('salaryTo'));
			$salaryBased = xss_clean($this->input->post('salaryBased'));
			$jobDescription = xss_clean($this->input->post('jobDescription'));
			$jobLocation = xss_clean($this->input->post('jobLocation'));


	        if(!empty($_FILES['job_images']['name']))
	        {
                $config['upload_path'] = 'assets/jobs/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['job_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('job_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/jobs/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_job']['name']))
	        {
                $config['upload_path'] = 'assets/jobs/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_job']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_job'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/jobs/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"uniid" => $uniid,
				"job_type" => $jobType,
				"job_title" => $jobTitle,
				"job_salary_from" => $salaryFrom,
				"job_salary_to" => $salaryTo,
				"job_salary_based" => $salaryBased,
				"job_description" => $jobDescription,
				"job_location" => $jobLocation,
				"job_image" => $pPicture,
				"job_audio" => $dcAudio,
				"job_status" => 1,
				"job_date" => date('Y-m-d'),
				"updated_on" => date('Y-m-d H:i:s')
			);

			$pid = $this->JobPosting_model->saveJobPosting($data);
			if(!empty($pid))
			{
				$json['error'] = "false";
				$json['message'] = "Job Posted Successfully";
				$json['postId'] = $pid;
				$json['image'] = $pPicture;
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to add Job, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function myPostingJobs()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));

			$whereArr = array("j.uniid" => $uniid);
			
			$myjobList = $this->JobPosting_model->listMyPostingJobs($whereArr);
			
			if($myjobList)
			{
				$json['error'] = "false";
				$json['myjobList'] = $myjobList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['myjobList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function allPostingJobs()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$cityName = xss_clean($this->input->post('cityName'));
			$whereArr = array("job_location like " => "%$cityName%");
			$jobList = $this->JobPosting_model->listMyPostingJobs($whereArr);
			if($jobList)
			{
				$json['error'] = "false";
				$json['jobList'] = $jobList;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['jobList'] = 0;
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function editPostJob()
	{
		$this->form_validation->set_rules('postID', 'Post ID', 'required');
		$this->form_validation->set_rules('uniid', 'User ID', 'required');

		$this->form_validation->set_rules('jobType', 'Job Type', 'required');
        $this->form_validation->set_rules('jobTitle', 'Job Title', 'required');

        $this->form_validation->set_rules('salaryFrom', 'Salary From', 'required');
        $this->form_validation->set_rules('salaryTo', 'salary To', 'required');

        $this->form_validation->set_rules('salaryBased', 'Salary Based Type', 'required');

        $this->form_validation->set_rules('jobDescription', 'Job Description', 'required');
        $this->form_validation->set_rules('jobLocation', 'Job Location', 'required');
		
		if($this->form_validation->run() == true)
		{
			$postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$jobType = xss_clean($this->input->post('jobType'));
			$jobTitle = xss_clean($this->input->post('jobTitle'));
			$salaryFrom = xss_clean($this->input->post('salaryFrom'));
			$salaryTo = xss_clean($this->input->post('salaryTo'));
			$salaryBased = xss_clean($this->input->post('salaryBased'));
			$jobDescription = xss_clean($this->input->post('jobDescription'));
			$jobLocation = xss_clean($this->input->post('jobLocation'));


	        if(!empty($_FILES['job_images']['name']))
	        {
                $config['upload_path'] = 'assets/jobs/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['job_images']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('job_images'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/jobs/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

	        if(!empty($_FILES['audio_file_job']['name']))
	        {
                $config['upload_path'] = 'assets/jobs/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_job']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_job'))
                {
                    $uploadData = $this->upload->data();
                    $dcAudio = $uploadData['file_name'];
                    $dcAudio = base_url().'assets/jobs/'.$dcAudio;
                }
                else { $dcAudio = ''; }
            }
            else { $dcAudio = ''; }

			$data = array(
				"job_type" => $jobType,
				"job_title" => $jobTitle,
				"job_salary_from" => $salaryFrom,
				"job_salary_to" => $salaryTo,
				"job_salary_based" => $salaryBased,
				"job_description" => $jobDescription,
				"job_location" => $jobLocation,
				"job_image" => $pPicture,
				"job_audio" => $dcAudio,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$whereArr = array(
                "jobID" => $postID,
				"uniid" => $uniid
            );

			$status = $this->JobPosting_model->updateJobPosting($data, $whereArr);

			if($status)
			{
				$json['error'] = "false";
				$json['message'] = "Job Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Edit Job, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

	public function deletePostJob()
	{
		if($this->input->method(TRUE) == 'POST')
		{
		    $postID = xss_clean($this->input->post('postID'));
			$uniid = xss_clean($this->input->post('uniid'));

			$data = $this->JobPosting_model->removeJobPosting($uniid, $postID);

			if($data)
			{
				$json['error'] = "false";
			    $json['message'] = "Job Deleted";
			}
			else
			{
				$json['error'] = "true";
			    $json['message'] = "Sorry unable to Deleted Job";
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