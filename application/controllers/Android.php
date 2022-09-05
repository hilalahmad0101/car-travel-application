<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Android extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
    }
    
    public function index()
    {
        redirect('https://play.google.com/store/apps/details?id=cartravels.co&hl=en_IN&gl=US');
    }
}

?>