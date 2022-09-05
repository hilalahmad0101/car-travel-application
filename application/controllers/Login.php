<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('Login_model');
        $this->load->model('Businesslistings_model');

        $this->url = "http://bhashsms.com/api/sendmsg.php?";

        $this->isUserLoggedIn = $this->session->userdata('isCTUserLoggedIn');
        if($this->isUserLoggedIn)
        { 
            redirect(base_url().$this->session->userdata('details')->cartravels_id); 
        }
    }
    
    public function index()
	{

		redirect(base_url());

		$this->load->view("ins/header");

		$this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');
		$this->form_validation->set_rules('userPassword', 'userPassword', 'required|min_length[6]');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobileNumber = xss_clean($this->input->post('mobileNumber'));
			$password = xss_clean($this->input->post('userPassword'));

			$pwd = sha1($password);

			$data = $this->Login_model->checkedemail($mobileNumber);

			if($data)
			{
				if($data->user_password == $pwd)
				{
					$pwd64 = base64_encode($password);
					$this->Login_model->updatePassword64($pwd64, $data->uniid);

					if($data->user_status == 'Active')
					{
						unset($data->user_password);

						$this->session->set_userdata('isCTUserLoggedIn', 1);
                        $this->session->set_userdata('ctuid', $data->uniid);
                        $this->session->set_userdata('details', $data);
                        $this->session->unset_userdata('error');

						redirect(base_url());
					}
					else
					{
						$this->session->set_userdata('error','Sorry!, Please activate your acount.');
						$this->load->view("user/login_view");
					}
				}
				else
				{
					$this->session->set_userdata('error','Sorry!, incorrect Password');
					$this->load->view("user/login_view");
				}
			}
			else
			{
				$this->session->set_userdata('error','Sorry! Check your login Credentials');
				$this->load->view("user/login_view");
			}
		}
		else
		{
			// $this->session->set_userdata('error',validation_errors());
			// $loginJson['message'] = validation_errors();
			$this->load->view("user/login_view");
		}

		// echo json_encode($loginJson);

		$this->load->view("ins/footer");
	}


	public function signin()
	{
		$this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');
		$this->form_validation->set_rules('userPassword', 'userPassword', 'required|min_length[6]');

		if($this->form_validation->run() == true)
		{
			// collect data form Login form
			$mobileNumber = xss_clean($this->input->post('mobileNumber'));
			$userPassword = xss_clean($this->input->post('userPassword'));

			$pwd = sha1($userPassword);

			$data = $this->Login_model->checkMobile($mobileNumber);

			if($data)
			{
				if($data->user_password == $pwd)
				{
					if($data->user_status == 'Active')
					{
						unset($data->user_password);

						$this->session->set_userdata('isCTUserLoggedIn', 1);
                        $this->session->set_userdata('ctuid', $data->uniid);
                        $this->session->set_userdata('details', $data);
                        $this->session->unset_userdata('error');

						$loginJson['data']['token'] = $data->user_token;
						$loginJson['data']['Uniid'] = $data->uniid;
						$loginJson['travelID'] = $data->cartravels_id;
						$loginJson['data']['details'] = $data;
						$loginJson['error'] = "false";
						$loginJson['message'] = "userLoggedIn";

					}
					else
					{
						$loginJson['error'] = "true";
						$loginJson['message'] = "Sorry!, Please activate your acount.";
					}
				}
				else
				{
					$loginJson['error'] = "true";
					$loginJson['message'] = "Sorry!, incorrect Password";
				}
			}
			else
			{
				$loginJson['error'] = "true";
				$loginJson['message'] = "Sorry! Check your login Credentials";
			}
		}
		else
		{
			$loginJson['error'] = "true";
			$loginJson['message'] = validation_errors();
		}

		echo json_encode($loginJson);
	}

}