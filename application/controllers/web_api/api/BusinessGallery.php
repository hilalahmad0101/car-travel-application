<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusinessGallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/BusinessGallery_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        echo "<br>";
        $end = date('Y-m-d H:i:s', strtotime('+1 day'));
        echo $end;
    }

    public function uploadImage()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));

            $businessCategory = xss_clean($this->input->post('businessCategory'));
            $cid = xss_clean($this->input->post('cid'));
            $gTitle = xss_clean($this->input->post('gTitle'));
            $gDescription = xss_clean($this->input->post('gDescription'));

            if (!file_exists('assets/gallery/'.$uniid))
            {
            	mkdir('assets/gallery/'.$uniid);
            	$source = 'assets/index.php'; 
            	$destination = 'assets/gallery/'.$uniid.'/index.php';
            	copy($source, $destination);                
            }

            if(!empty($_FILES['gImage']['name']))
            {
                $config['upload_path'] = 'assets/gallery/'.$uniid;
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['gImage']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('gImage'))
                {
                    $uploadData = $this->upload->data();
                    $gPicture = $uploadData['file_name'];
                    $gPicture = base_url().'assets/gallery/'.$uniid.'/'.$gPicture;
                }
                else { $gPicture = ''; }
            }
            else { $gPicture = ''; }

            $data = array(
				"uniid" => $uniid,
				"g_business_cat" => $businessCategory,
				"g_cid" => $cid,
				"g_image" => $gPicture,
                "g_title" => $gTitle,
				"g_desc" => $gDescription,

				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->BusinessGallery_model->saveGalleryImage($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Image uploaded Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to upload, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}


	public function getImageGallery()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));
			$businessCategory = xss_clean($this->input->post('businessCategory'));
			
			$gallery = $this->BusinessGallery_model->imageGalleryList($uniid, $businessCategory);
			
			if($gallery)
			{
				$json['error'] = "false";
				$json['gallery'] = $gallery;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['gallery'] = 0;
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