<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller 
{

	public function index()
	{
    	$this->load->view('ins/header_view');
    	$this->load->view('profile_view');
	}

	public function profile()
	{
		$data['cartravelID'] = $this->uri->segment(1);
		$this->load->view('website/web_page_view', $data);
	}
}
