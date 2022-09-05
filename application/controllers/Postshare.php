<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postshare extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('Businesslistings_model');
		$this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->library('session');

    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }


    public function share()
    {
		$uniid = xss_clean($this->input->get('uid'));
		$pid = xss_clean($this->input->get('pid'));

		if($this->input->get('pid') == '' && $this->input->get('uid') == '')
		{
			redirect(base_url());
		}

  		// $uniid = $this->uri->segment(4);
		// $pid = $this->uri->segment(3);

		$querys = $this->db->query(
			"SELECT `p`.`gpost_status`, `p`.`postingID`, `p`.`posting_booking_sts`, `p`.`uniid` as `myUniid`, `p`.`sdvID` as `selfDriving`, `p`.`tdaID` as `todayAvailCars`, `p`.`vcID` as `visitingCard`, `p`.`otherID` as `others`, `p`.`tpID` as `tourPackage`, `p`.`dpID` as `droppingCars`, `p`.`accID` as `accidentCars`, `p`.`jobID` as `jobPostPID`, `p`.`tendID` as `tenderID`, 
			`sdv`.*, 
			`tda`.*, 
			`vc`.*, 
			`otr`.*, 
			`tt`.*, 
			`dp`.*,
			`acc`.*,
			`jb`.*,
			`td`.*,
			`bc`.`cartravels_id`, `bc`.`user_Mobile_No` as `requested_mobile`, `bc`.`user_Name` as `requested_user_Name`, `bc`.`user_Surname` as `requested_user_Surname`, `bc`.`user_Owner_Name` as `requested_user_Owner_Name`, `bc`.`user_Profile_Photo`, `p`.`post_location`, `p`.`favourite`, `fav`.`favourite` as `Fav` FROM `api_cartravel_postings` `p` 
			LEFT JOIN `api_cartravel_sdv` `sdv` ON `sdv`.`uniid` = `p`.`uniid` AND `sdv`.`sdvID` = `p`.`sdvID` 
			LEFT JOIN `api_cartravel_tdacars` `tda` ON `tda`.`uniid` = `p`.`uniid` AND `tda`.`tdaID` = `p`.`tdaID` 
			LEFT JOIN `api_cartravel_vc` `vc` ON `vc`.`uniid` = `p`.`uniid` AND `vc`.`vcID` = `p`.`vcID` 
			LEFT JOIN `api_cartravel_others` `otr` ON `otr`.`uniid` = `p`.`uniid` AND `otr`.`otherID` = `p`.`otherID` 
			LEFT JOIN `api_cartravel_tours_travels` `tt` ON `tt`.`uniid` = `p`.`uniid` AND `tt`.`tpID` = `p`.`tpID` 
			LEFT JOIN `api_cartravel_dropping_cars` `dp` ON `dp`.`uniid` = `p`.`uniid` AND `dp`.`dpID` = `p`.`dpID`

			LEFT JOIN `api_cartravel_accbw` `acc` ON `acc`.`uniid` = `p`.`uniid` AND `acc`.`accID` = `p`.`accID` 
			LEFT JOIN `api_cartravel_jobs` `jb` ON `jb`.`uniid` = `p`.`uniid` AND `jb`.`jobID` = `p`.`jobID` 
			LEFT JOIN `api_cartravel_tenders` `td` ON `td`.`uniid` = `p`.`uniid` AND `td`.`tendID` = `p`.`tendID` 


			LEFT JOIN `api_cartravel_favourite` `fav` ON `fav`.`pid` = `p`.`postingID` AND `fav`.`uniid` = '$uniid' 

			LEFT JOIN `api_cartravel_business_agencies` `bc` ON `bc`.`user_uniid` = `p`.`uniid` WHERE `p`.`postingID` = '$pid' ORDER BY `postingID` DESC");
    	$result = $querys->row();

    	// echo "<pre>";
    	// print_r($querys->row());
    	// echo "</pre>";

    	if($result)
    	{



		$sdv_image = $result->sdv_image;
		$sdv_type = $result->sdv_type;
		$sdv_name = $result->sdv_name;
		$sdv_hours = $result->sdv_hours;


		$tda_car_image = $result->tda_car_image;
		$tda_car_type = $result->tda_car_type;


		$vc_image = $result->vc_image;
		$vc_desc = $result->vc_desc;


		$other_image = $result->other_image;
		$other_title = $result->other_title;
		$other_desc = $result->other_desc;


		$tourp_image = $result->tourp_image;
		$tour_package_name = $result->tour_package_name;
		$tour_description = $result->tour_description;
		$tour_plan_days = $result->tour_plan_days;
		$tour_keywords = $result->tour_keywords;


		$vehicle_images = $result->vehicle_images;
		$pickupCity = $result->pickupCity;
		$dropCity = $result->dropCity;
		$available_seats = $result->available_seats;
		$ticket_fair = $result->ticket_fair;
		$journey_date = $result->journey_date;

		if(!empty($sdv_image))
		{
		    $postImage = $sdv_image;
		    $cat = "Self Driving Vehicle";
		    $postTitle = $cat.' - '.$sdv_type.' - '.$sdv_name;
		    $postDesc = $postTitle.' ('.$sdv_hours.' Hours)';
		    $edit = 'addSelfDrivingCars';
		}
		elseif(!empty($tda_car_image))
		{
		    $postImage = $tda_car_image;
		    $cat = "Today Available Cars";
		    $postTitle = $cat.' - '.$tda_car_type;
		    $postDesc = $postTitle;
		    $edit = "addTodayAvailableCars";
		}
		elseif(!empty($vc_image))
		{
		    $postImage = $vc_image;
		    $cat = "Visiting Cards";
		    $postTitle = $cat.' - '.$vc_desc;
		    $postDesc = $postTitle;
		    $edit = 'addVisitingCard';
		}
		elseif(!empty($other_image))
		{
		    $postImage = $other_image;
		    $cat = "Others";
		    $postTitle = $cat.' - '.$other_title;
		    $postDesc = $postTitle.' - '.$other_desc;
		    $edit = 'addOthers';
		}
		elseif(!empty($tourp_image))
		{
		    $postImage = $tourp_image;
		    $cat = "Tour Packages";
		    $postTitle = $cat.' - '.$tour_package_name;
		    $postDesc = $postTitle.' - '.$tour_description.', Days: '.$tour_plan_days.', Places: '.$tour_keywords;
		    $edit = 'addTourpackage';
		}
		elseif(!empty($vehicle_images))
		{
		    $postImage = $vehicle_images;
		    $cat = "Dropping Cars";
		    $postTitle = $cat.' - '.$pickupCity.' to '.$dropCity;
		    $postDesc = $postTitle.', Available Seats '.$available_seats.', Ticket Cost: '.$ticket_fair.', Date: '.$journey_date;
		    $edit = 'addDroppingCars';
		}




		elseif(!empty($result->tend_image))
		{
		    $postImage = $result->tend_image;
		    $cat = "Tenders";
		    $postTitle = $cat.' - '.$result->tend_title;
		    $postDesc = $result->tend_desc;
		    $edit = 'addTender';
		}

		elseif(!empty($result->job_image))
		{
		    $postImage = $result->job_image;
		    $cat = "Jobs";
		    $postTitle = $cat.' - '.$result->job_salary_from.' to '.$result->job_salary_to;
		    $postDesc = $result->job_description;
		    $edit = 'addJobs';
		}

		elseif(!empty($result->accbw_image))
		{
		    $postImage = $result->accbw_image;
		    $cat = "Accident / Breakdown";
		    $postTitle = $result->accbw_title;
		    $postDesc = $result->accbw_dedication;
		    $edit = 'addAccident';
		}

		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			$url = "https://";
		else  
			$url = "http://";

		$url.= $_SERVER['HTTP_HOST'];   

		$url.= $_SERVER['REQUEST_URI'];

		$data['postImage'] = $postImage;
		$data['cat'] = $cat;
		$data['postTitle'] = $postTitle;
		$data['postDesc'] = $postDesc;
		$data['url'] = $url;
		$data['postInfo'] = $result;
		$data['editPostUrl'] = $edit;
		}
		else
		{
			$url = null;
			$data['postImage'] = null;
			$data['cat'] = null;
			$data['postTitle'] = null;
			$data['postDesc'] = null;
			$data['url'] = null;
			$data['postInfo'] = null;
			$data['editPostUrl'] = null;
		}

		$this->load->view('ins/header', $data); 
		$this->load->view('website/post_details');
		$this->load->view('ins/footer'); 


		$this->db->close();

	}

	public function sss()
	{
		echo "string";
	}

}

?>
