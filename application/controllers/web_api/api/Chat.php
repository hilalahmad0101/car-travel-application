<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Chat_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        $methods = $this->input->method(TRUE);
        echo "\n";
        print_r($methods);
        echo "\n";

        print_r($this->input->get());
    }

    public function businessCatalogue()
    {
        if($this->input->method(TRUE) === 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $images = xss_clean($this->input->post('images'));

            $item_name = xss_clean($this->input->post('item_name'));
            $price = xss_clean($this->input->post('price'));
            $desc = xss_clean($this->input->post('desc'));
            $link = xss_clean($this->input->post('link'));
            $item_code = xss_clean($this->input->post('item_code'));
            $update = date('Y-m-d H:i:s');

            $data = array(
                "uniid" => $uniid,
                "catalogue_images" => $images,
                "catalogue_item_name" => $item_name,
                "catalogue_price" => $price,
                "catalogue_desc" => $desc,
                "catalogue_link" => $link,
                "catalogue_item_code" => $item_code,
                "updated_on" => $update
            );

            $status = $this->Chat_model->saveData('api_chat_catalogue', $data);
            

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Catalogue Added";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Process, Try again.";
            }
        }
        else if($this->input->method(TRUE) === 'GET')
        {
            $uniid = xss_clean($this->input->get('uniid'));

            $whereArr = array('uniid' => $uniid);

            $data = $this->Chat_model->getData('api_chat_catalogue', $whereArr);
            

            if($data == true)
            {
                $json['error'] = "false";
                $json['catalogues'] = $data;
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to get, No Data";
            }
        }
        else if($this->input->method(TRUE) == 'PUT')
        {
            $catalogue_id = xss_clean($this->input->get('catalogue_id'));
            $uniid = xss_clean($this->input->get('uniid'));
            $images = xss_clean($this->input->get('images'));

            $item_name = xss_clean($this->input->get('item_name'));
            $price = xss_clean($this->input->get('price'));
            $desc = xss_clean($this->input->get('desc'));
            $link = xss_clean($this->input->get('link'));
            $item_code = xss_clean($this->input->get('item_code'));

            $whereArr = array(
                "api_chat_catalogue_id" => $catalogue_id,
                "uniid" => $uniid
            );

            $updateArr = array(
                "catalogue_images" => $images,
                "catalogue_item_name" => $item_name,
                "catalogue_price" => $price,
                "catalogue_desc" => $desc,
                "catalogue_link" => $link,
                "catalogue_item_code" => $item_code
            );

            $status = $this->Chat_model->updateData('api_chat_catalogue', $updateArr, $whereArr);
            

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Updated";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Update, Try again.";
            }
        }
        else if($this->input->method(TRUE) == 'DELETE')
        {
            $catalogue_id = xss_clean($this->input->get('catalogue_id'));
            $uniid = xss_clean($this->input->get('uniid'));

            $lat = xss_clean($this->input->post('Latitude'));
            $long = xss_clean($this->input->post('Longitude'));

            $whereArr = array(
                "api_chat_catalogue_id" => $catalogue_id,
                "uniid" => $uniid
            );

            $status = $this->Chat_model->removeData('api_chat_catalogue', $whereArr);
            
            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Deleted";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Delete, Try again.";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }


    public function userRegCities()
    {
    	if($this->input->method(TRUE) === 'GET')
        {
            $data = $this->Chat_model->getCitiesData('api_cartravel_business_agencies');
            
            if($data == true)
            {
                $json['error'] = "false";
                $json['catalogues'] = $data;
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to get, No Data";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getUserToken()
    {
    	if($this->input->method(TRUE) === 'GET')
        {
        	$uniid = xss_clean($this->input->get('uniid'));

            $data = $this->Chat_model->getUserToken($uniid);
            
            if($data == true)
            {
                $json['error'] = "false";
                $json['token'] = $data;
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to get, No Data";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getRegUsersList()
    {
    	if($this->input->method(TRUE) === 'POST')
        {
        	$mobileNumbers = xss_clean($this->input->post('contacts'));

            $whereArr = array($mobileNumbers);

            $data = $this->Chat_model->regUsersList('api_cartravel_business_agencies', $whereArr);
            
            if($data == true)
            {
                $json['error'] = "false";
                $json['catalogues'] = $data;
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to get, No Data";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }
}

?>