<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Businesslistings extends CI_Controller 
{
	public function __construct() 
    {
	    parent::__construct();
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->load->helper('security');
	    $this->load->helper('url');
	    $this->load->model('Businesslistings_model');
	    $this->load->model('api/AdPost_model');
	    $this->CI = & get_instance();
		
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->randChar = substr(str_shuffle($string), 0, 1);

        
        if(@$this->session->has_userdata('export_type'))
        {
        	$this->selectedLocation = $this->session->userdata('export_type');
        }
        else
        {
        	$this->selectedLocation = @$this->session->userdata('export_type');
        }
    }

    public function remove_http($url) {
	   $disallowed = array('http://', 'https://');
	   foreach($disallowed as $d) {
	      if(strpos($url, $d) === 0) {
	         return str_replace($d, '', $url);
	      }
	   }
	   return $url;
	}

	public function index()
	{
		if(current_url() == 'https://cartravels.com/')
		{
			header("Location: https://cartravels.com/Businesslistings/index");
		}else if (current_url() == 'http://142.93.215.118/') {
			header("Location: http://142.93.215.118/Businesslistings/index");
		}

			$postLocation = $this->selectedLocation;
			if($postLocation == 'india' || $postLocation == 'India')
			{
				$postLocation = '';
			}
			$whereArr = array("p.post_location like" => "%$postLocation%", "p.posting_booking_sts" => 0);

			$min = xss_clean($this->input->post('min'));
			$min = 75;

			if($this->session->userdata('export_type') == '' || $this->session->userdata('export_type') == ' ')
			{
				$allPostings = false;
			}
			else
			{
				$allPostings = $this->Businesslistings_model->listMyAllGroupPostings($whereArr, $min);
			}

			$adInfo = $this->AdPost_model->adDetails($this->session->userdata('export_type'), 'WebsiteBannerAd');
			if($adInfo)
			{
				$json['adInfo'] = $adInfo[0];	
			}
			else
			{
				$json['adInfo'] = $adInfo;
			}
			
			// echo "<pre>";
			// echo $this->session->userdata('export_type');
			// print_r($adInfo);
			// echo "</pre>";
			// exit;
			
			
			$dpCars = $this->Businesslistings_model->listAllDroppingCars($whereArr, $min);
			$tdaCars = $this->Businesslistings_model->listAllTodayCars($whereArr, $min);
			$vcCards = $this->Businesslistings_model->listAllVCs($whereArr, $min);
			$otherCars = $this->Businesslistings_model->listAllOthers($whereArr, $min);
			$tpCars = $this->Businesslistings_model->listAllTourPackages($whereArr, $min);
			$sdvCars = $this->Businesslistings_model->listAllSelfDrivingvv($whereArr, $min);

			// echo "<pre>";
			// print_r($allPostings);
			// echo "</pre>";

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

			// echo "<pre>";
			// print_r($json);
			// echo "</pre>";

    	$this->load->view("ins/header", $json);
		$this->load->view("website/home_view");
		$this->load->view("website/home_posts");
		$this->load->view("ins/footer");
	}

    public function imgcompress()
    {
    	echo "Image Compress";
    	?>

	    <form action='' method='POST' enctype='multipart/form-data'>
	        <input name="image_file" type="file" accept="image/*">
	        <button type="submit">SUBMIT</button>
	    </form>

    	<?php 
    }

    public function getCityList()
    {
    	if($this->input->method(TRUE) == 'POST')
        {
	    	$searchCity = $this->input->post("searchCity");

			$whereArr = array("city_name like" => "%$searchCity%");
		    $cityData = $this->Businesslistings_model->listOfCities($whereArr);
		    echo json_encode($cityData);
		}
    }

    public function set_session($export_type, $cityCode)
    {
    	$title = str_replace('%20', ' ', $export_type);

    	$this->session->set_userdata('export_type', $title);
    	$this->session->set_userdata('city_code', $cityCode);
        echo 'Session set!';
        return;
    }

    public function set_city()
    {
    	$city = $this->input->post("searchCity");

    	$this->session->set_userdata('export_type', $city);
        $msg = 'Session set!';
        return $msg;
    }



	// public function profile()
	// {
	// 	$data['cartravelID'] = $this->uri->segment(1);
	// 	$this->load->view('website/web_page_view', $data);
	// }


    public function category($catName)
	{
		$businessCategory = $this->uri->segment(3);
		$keyword = $this->input->get('key');
		
		$cityName = trim($this->selectedLocation);
		if($this->session->has_userdata('details'))
		{
			$uid = $this->session->userdata('details')->uniid;
		}
		else { $uid ='';}
		

		if($cityName != '' && $cityName != 'india' && $cityName != 'India')
		{
			$cityState = explode(',', $cityName);
			$city = trim($cityState[0]);
			$state = trim($cityState[1]);
		}
		else
		{
			$city = "";
			$state = "";
		}

		if($cityName == '' || $cityName == ' ')
		{
			$catList = false;
		}
		else
		{
			if($keyword != '')
			{
				if($businessCategory == 'CarTravelsOffices')
				{
					$arrayTwo = array('CarTravelsOffices', 'OwnerCumDrivers');
					$whereArr = array("user_State like" => "%$state%", "user_City like" => "%$city%", "user_Keywords like" => "%$keyword%");
					$catList = $this->Businesslistings_model->getBusinessCategories($whereArr, $arrayTwo, $uid);
				}
				else
				{
					$whereArr = array("user_State like" => "%$state%", "user_City like" => "%$city%", "user_Keywords like" => "%$keyword%", "user_Business_Category" => $businessCategory);
					$catList = $this->Businesslistings_model->getBusinessCategories($whereArr, null, $uid);
				}
				
			}
			else
			{

				if($businessCategory == 'CarTravelsOffices')
				{
					$arrayTwo = array('CarTravelsOffices', 'OwnerCumDrivers');
					$whereArr = array("user_State like" => "%$state%", "user_City like" => "%$city%");
					$catList = $this->Businesslistings_model->getBusinessCategories($whereArr, $arrayTwo, $uid);
				}
				else
				{
					$whereArr = array("user_State like" => "%$state%", "user_City like" => "%$city%", "user_Business_Category" => $businessCategory);
					$catList = $this->Businesslistings_model->getBusinessCategories($whereArr, null, $uid);
				}
				
			}
		}

		
		// echo "<pre>";
		// print_r(count($catList));
		// print_r($catList);
		// print_r($allKeywords);
		// echo "</pre>";
		if($catList)
		{
			$allKeywords = array_column($catList, 'user_Keywords');
			$allKeywords = implode("#", $allKeywords);
			$allKeywords = str_replace("##","#",$allKeywords);
			$allKeywords = explode("#", $allKeywords);
			$allKeywords = array_unique($allKeywords);
		}
		else
		{
			$allKeywords = false;
		}
		

		
		
		if($catList)
		{
			$json['error'] = "false";
			$json['businessCategoryList'] = $catList;
			$json['allKeywordsList'] = $allKeywords;
		}
		else
		{
			 $json['error'] = 'true';
			 $json['businessCategoryList'] = 0;
			 $json['allKeywordsList'] = $allKeywords;
		}

		$this->load->view("ins/header", $json);
		$this->load->view("website/bookingcategories_details");
		$this->load->view("ins/footer");
	}

	// public function category($catName)
	// {
	// 	$cityName = $this->selectedLocation;
	// 	$whereArr = array("location" => $cityName);
	// 	$carsList = $this->Businesslistings_model->listAllDroppingCars($whereArr);
	// 	if($carsList)
	// 	{
	// 		$json['error'] = "false";
	// 		$json['droppingCarsList'] = $carsList;
	// 	}
	// 	else
	// 	{
	// 		 $json['error'] = 'true';
	// 		 $json['droppingCarsList'] = 0;
	// 	}
	// 	$this->load->view("ins/header", $json);
	// 	$this->load->view("website/details");
	// 	$this->load->view("ins/footer");
	// }


	public function DroppingCars()
	{

		$cityName = $this->selectedLocation;

		$whereArr = array("location" => $cityName, "journey_date >= " => date('Y-m-d'), 'dp_availability' => 1);
		
		$carsList = $this->Businesslistings_model->listAllDroppingCars($whereArr);

		// echo "<pre>";
		// print_r($carsList);
		// echo "</pre>";
		
		if($carsList)
		{
			$json['error'] = "false";
			$json['droppingCarsList'] = $carsList;
		}
		else
		{
			 $json['error'] = 'true';
			 $json['droppingCarsList'] = 0;
		}

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function TodayAvailableCars()
	{
		$cityName = $this->selectedLocation;

		$cityName = ($cityName != 'india')?$cityName:'';

		$whereArr = array("tda_location like " => "%$cityName%", "tda_date" => date("Y-m-d"), "tda_availability" => 1);
		
		$carsList = $this->Businesslistings_model->listAllTodayCars($whereArr);

		// echo "<pre>";
		// print_r($carsList);
		// echo "</pre>";
		
		if($carsList)
		{
			$json['error'] = "false";
			$json['todayCarsList'] = $carsList;
		}
		else
		{
			 $json['error'] = 'true';
			 $json['todayCarsList'] = 0;
		}

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function PromoteVCards()
	{
		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("vc_location like " =>  "%$cityName%");
		$vcCards = $this->Businesslistings_model->listAllVCs($whereArr);

		// echo "<pre>";
		// print_r($vcCards);
		// echo "</pre>";

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
		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function OtherPostings()
	{
		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("other_location like " =>  "%$cityName%");
		$otherPostings = $this->Businesslistings_model->listAllOthers($whereArr);

		// echo "<pre>";
		// print_r($otherPostings);
		// echo "</pre>";

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

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function TourPackages()
	{
		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("tour_start_location like " =>  "%$cityName%", "tp_availability" => 1);
		$tourPackages = $this->Businesslistings_model->listAllTourPackages($whereArr);

		// echo "<pre>";
		// print_r($tourPackages);
		// echo "</pre>";

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

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function SelfDVehicles()
	{
		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("sdv_location like " =>  "%$cityName%", "sdv_availability" => 1);
		$sdVehicleList = $this->Businesslistings_model->listAllSelfDrivingvv($whereArr);

		// echo "<pre>";
		// print_r($sdVehicleList);
		// echo "</pre>";

		if($sdVehicleList)
		{
			$json['error'] = "false";
			$json['sdVehicleList'] = $sdVehicleList;
		}
		else
		{
			 $json['error'] = 'true';
			 $json['sdVehicleList'] = 0;
		}

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function jobs()
	{

		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("job_location like " =>  "%$cityName%", 'job_status' => 1);
		$jobList = $this->Businesslistings_model->listAllPostingJobs($whereArr);

		// echo "<pre>";
		// print_r($jobList);
		// echo "</pre>";

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

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}

	public function tenders()
	{

		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("tend_location like " =>  "%$cityName%");
		$TendersList = $this->Businesslistings_model->listAllTenders($whereArr);

		// echo "<pre>";
		// print_r($TendersList);
		// echo "</pre>";

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

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}


	public function AccidentBreakdown()
	{
		$cityName = $this->selectedLocation;
		$cityName = ($cityName != 'india')?$cityName:'';
		$whereArr = array("accbw_location like " =>  "%$cityName%");
		$AccBwList = $this->Businesslistings_model->listAllAccBw($whereArr);

		// echo "<pre>";
		// print_r($AccBwList);
		// echo "</pre>";
		
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

		$this->load->view("ins/header", $json);
		$this->load->view("website/details");
		$this->load->view("ins/footer");
	}




	public function about()
	{
   		$this->load->view("ins/header");
		$this->load->view("website/about");
		$this->load->view("ins/footer");
	}

	public function services()
	{
   		$this->load->view("ins/header");
		$this->load->view("website/services");
		$this->load->view("ins/footer");
	}

	public function portfolio()
	{
   		$this->load->view("ins/header");
		$this->load->view("website/portfolio");
		$this->load->view("ins/footer");
	}

	public function pricing()
	{
   		$this->load->view("ins/header");
		$this->load->view("website/pricing");
		$this->load->view("ins/footer");
	}

	public function contact()
	{
   		$this->load->view("ins/header");
		$this->load->view("website/contact");
		$this->load->view("ins/footer");
	}

}
