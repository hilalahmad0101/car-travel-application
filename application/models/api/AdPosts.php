<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdPosts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/AdPost_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
        echo "<br>";
        echo "<br>";
        $end = date('Y-m-d H:i:s', strtotime('+1 month'));
        echo $end."<br>";
        $end2 = date('Y-m-d H:i:s');
        echo $end2."<br>";

        $nextMonth = date(strtotime('+1 month'));
        echo date('Y-m-d H:i:s', 1607415337)." On <br> oneM ";
        echo $nextMonth."<br>";
        echo time()."<br>";
        $diff = $nextMonth - time();
        echo date('Y-m-d H:i:s', $diff)."<br>";

        $start_date = date_create("2016-01-02");
        $end_date   = date_create("2016-01-21");
         
        //difference between two dates
        $diff = date_diff($start_date,$end_date);
         
        //find the number of days between two dates
        echo "Difference between two dates: ".$diff->format("%a"). " Days ";
    }

    public function addAdPost()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));

            $adDisplayType = xss_clean($this->input->post('adDisplayType'));
            $adLocation = xss_clean($this->input->post('adLocation'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));

            $businessCategory = xss_clean($this->input->post('businessCategory'));
            $adTitle = xss_clean($this->input->post('adTitle'));
            $adDesc = xss_clean($this->input->post('adDesc'));
            $btnLineText = xss_clean($this->input->post('btnLineText'));
            $btnName = xss_clean($this->input->post('btnName'));

            $btnAction = xss_clean($this->input->post('btnAction'));

            if(!empty($_FILES['adImage']['name']))
	        {
                $config['upload_path'] = 'assets/ads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['adImage']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('adImage'))
                {
                    $uploadData = $this->upload->data();
                    $adPicture = $uploadData['file_name'];
                    $adPicture = base_url().'assets/ads/'.$adPicture;
                }
                else { $adPicture = ''; }
            }
            else { $adPicture = ''; }

            $data = array(
				"uniid" => $uniid,
				"ad_display_type" => $adDisplayType,
				"ad_location" => $adLocation,
				"cartravel_id" => $cartravelID,
				"ad_image" => $adPicture,

                "ad_business_cat" => $businessCategory,
                "ad_title" => $adTitle,
                "ad_desc" => $adDesc,
                "ad_btn_line_text" => $btnLineText,
                "ad_btn_name" => $btnName,
                "ad_btn_action" => $btnAction,

				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->AdPost_model->postAd($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Ad Posted Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Post, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function editAdPost()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $ad_id = xss_clean($this->input->post('ad_id'));
            $db_path = xss_clean($this->input->post('file_path'));

            $uniid = xss_clean($this->input->post('uniid'));

            $adDisplayType = xss_clean($this->input->post('adDisplayType'));
            $adLocation = xss_clean($this->input->post('adLocation'));// ba, boa, hpa, pa
            $cartravelID = xss_clean($this->input->post('cartravelID'));
            $businessCategory = xss_clean($this->input->post('businessCategory')); //ba, boa

            $adTitle = xss_clean($this->input->post('adTitle'));    //boa, hpa, pa
            $adDesc = xss_clean($this->input->post('adDesc'));      //boa, hpa, pa
            $btnLineText = xss_clean($this->input->post('btnLineText'));    //boa, hpa, pa
            $btnName = xss_clean($this->input->post('btnName'));    //boa, hpa, pa
            $btnAction = xss_clean($this->input->post('btnAction')); //ba, boa, hpa, pa


            $len = strlen("https://cartravels.com/web_api/");
            $new_path = substr($db_path, $len, strlen($db_path)-$len); 
            
            if(isset($_POST['file_path']))
            {
                if(file_exists($new_path))
                {
                    $return = unlink($new_path);
                    if($return){
                        echo "Succes";
                    }else{
                        echo "Fail";
                    }                    
                }
            }

            if(!empty($_FILES['adImage']['name']))
            {
                $config['upload_path'] = 'assets/ads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['adImage']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('adImage'))
                {
                    $uploadData = $this->upload->data();
                    $adPicture = $uploadData['file_name'];
                    $adPicture = base_url().'assets/ads/'.$adPicture;
                }
                else { $adPicture = ''; }
            }
            else { $adPicture = ''; }

            $data = array(
                "ad_display_type" => $adDisplayType,
                "ad_location" => $adLocation,
                "cartravel_id" => $cartravelID,
                "ad_image" => $adPicture,
                "updated_on" => date('Y-m-d H:i:s')
            );

            $wrArr = array(
                "uniid" => $uniid,
                "adID" => $ad_id, 
                "ad_status" => "Live",
                "payment_sts" => "Captured"
            );

            switch ($adDisplayType) 
            {
                case 'bookingad':
                        $data["ad_business_cat"] = $businessCategory;
                        $data["ad_title"] = $adTitle;
                        $data["ad_desc"] = $adDesc;
                        $data["ad_btn_line_text"] = $btnLineText;
                        $data["ad_btn_name"] = $btnName;
                        $data["ad_btn_action"] = $btnAction;
                    break;
                case 'postingad':
                        $data["ad_title"] = $adTitle;
                        $data["ad_desc"] = $adDesc;
                        $data["ad_btn_line_text"] = $btnLineText;
                        $data["ad_btn_name"] = $btnName;
                        $data["ad_btn_action"] = $btnAction;
                    break;
                case 'bannerad':
                        $data["ad_business_cat"] = $businessCategory;
                    break;
                case 'homepagead':
                        $data["ad_title"] = $adTitle;
                        $data["ad_desc"] = $adDesc;
                        $data["ad_btn_line_text"] = $btnLineText;
                        $data["ad_btn_name"] = $btnName;
                        $data["ad_btn_action"] = $btnAction;
                    break;
                
                default:
                    break;
            }

            $status = $this->AdPost_model->updatePostAd($data, $wrArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Ad Edited Successfully";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Edit / Expired / Payment Not Done";
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

	public function getAdsInfo()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$uniid = xss_clean($this->input->post('uniid'));
			$adInfo = $this->AdPost_model->adsList($uniid);
			if($adInfo)
			{
				$json['error'] = "false";
				$json['adInfo'] = $adInfo;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['adInfo'] = 0;
			}
		}
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
	}

    public function getAd()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $adLocation = xss_clean($this->input->post('adLocation'));
            $adType = xss_clean($this->input->post('adType'));
            $adInfo = $this->AdPost_model->adDetails($adLocation, $adType);
            if($adInfo)
            {
                $json['error'] = "false";
                $json['adInfo'] = $adInfo;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['adInfo'] = 0;
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getCategoryAd()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $adLocation = xss_clean($this->input->post('adLocation'));
            $adType = xss_clean($this->input->post('adType'));
            $businessCategory = xss_clean($this->input->post('businessCategory'));
            $adInfo = $this->AdPost_model->adCategoryDetails($adLocation, $adType, $businessCategory);
            if($adInfo)
            {
                $json['error'] = "false";
                $json['adInfo'] = $adInfo;
            }
            else
            {
                 $json['error'] = 'true';
                 $json['adInfo'] = 0;
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