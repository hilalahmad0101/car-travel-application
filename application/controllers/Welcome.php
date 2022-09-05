<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->library('form_validation');
		
        $this->load->model('Profile_model');
        $this->load->model('Businesslistings_model');
        $this->load->model('api/Registration_model');

        $this->url = "http://bhashsms.com/api/sendmsg.php?";
    }

	public function index()
	{
    	$this->load->view('home/landing_page_view');
	}

	public function profile()
	{
		// echo $this->input->get('ref');
		// echo $this->uri->segment(1);
		// exit;
		$data['cartravelID'] = $this->uri->segment(1);

		$data['profile'] = $this->Profile_model->getProfile($data['cartravelID']);
		$data['keywords'] = $this->Registration_model->getKeywords('CarTravelsOffices');

		if($this->input->get('ref') === "app" && $data['profile'] != false)
		{
			$uniid = $data['profile']->user_uniid;

			$whereArr = array("p.uniid" => $uniid);

			$data['myPostings'] = $this->Profile_model->listMyGroupPostingsWeb($whereArr);

			// print_r($this->session->userdata('details'));
			// echo $data['cartravelID'];
			// echo $this->session->userdata('details')->cartravels_id;

			if($this->session->userdata('details')) 
			{
				if($this->session->userdata('details')->cartravels_id == $data['cartravelID']){
					$this->load->view('ins/logged_header', $data);
					$this->load->view('profile_view');
		    		$this->load->view('ins/footer');
				}
				else
				{
					$this->load->view('ins/header_view', $data);
					$this->load->view('profile_view');
		    		$this->load->view('ins/footer_view');
				}
			}
			else
			{
				$this->load->view('ins/header_view', $data);
				$this->load->view('profile_view');
	    		$this->load->view('ins/footer_view');
			}

			?>
				<script type="text/javascript">
					setTimeout(
						function(){ 
							window.location.href = "https://play.app.goo.gl/?link=https://play.google.com/store/apps/details?id=cartravels.co&ddl=1&pcampaignid=web_ddl_1";
						}, 1000);
				</script>
			<?php		
		}
		
		

		else if($this->input->get('ref') == null && $data['profile'] != null)
		{
			$uniid = $data['profile']->user_uniid;

			$whereArr = array("p.uniid" => $uniid);

			$data['myPostings'] = $this->Profile_model->listMyGroupPostingsWeb($whereArr);

			// print_r($this->session->userdata('details'));
			// echo $data['cartravelID'];
			// echo $this->session->userdata('details')->cartravels_id;

			if($this->session->userdata('details')) 
			{
				if($this->session->userdata('details')->cartravels_id == $data['cartravelID']){
					$this->load->view('ins/logged_header', $data);
					$this->load->view('profile_view');
		    		$this->load->view('ins/footer');
				}
				else
				{
					$this->load->view('ins/header_view', $data);
					$this->load->view('profile_view');
		    		$this->load->view('ins/footer_view');
				}
			}
			else
			{
				$this->load->view('ins/header_view', $data);
				$this->load->view('profile_view');
	    		$this->load->view('ins/footer_view');
			}
	    }
	    else
	    {
	    	$this->load->view('website/web_page_view', $data);
	    	header("Location:".base_url()."Businesslistings/index");
	    }
	}
}
