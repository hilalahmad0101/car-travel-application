<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->helper('form_helper');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('api/Registration_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function regBusinessCategory()
	{
		$this->form_validation->set_rules('userID', 'User ID', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        $this->form_validation->set_rules('businessCategory', 'Business Category', 'required', array(
                'required'      => 'You have not provided %s.'
        ));

        if($this->input->post('businessName'))
        {
        	$this->form_validation->set_rules('businessName', 'Business Name', 'required', array(
	                'required'      => 'You have not provided %s.'
	        ));
        }

        if($this->input->post('ownerName'))
        {
            $this->form_validation->set_rules('ownerName', 'Owner Name', 'required', array(
	                'required'      => 'You have not provided %s.'
	        ));	
        }

		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[api_cartravel_business_agencies.user_email]', array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));

        $this->form_validation->set_rules('mobile','Mobile Number', 'required|exact_length[10]|is_unique[api_cartravel_business_agencies.user_Mobile_No]|is_unique[api_cartravel_business_agencies.user_Alter_Mobile_No]', array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));

        if($this->input->post('alterMobile'))
        {
	        $this->form_validation->set_rules('alterMobile','Alternate Mobile Number', 'required|exact_length[10]|is_unique[api_cartravel_business_agencies.user_Alter_Mobile_No]|is_unique[api_cartravel_business_agencies.user_Mobile_No]', array(
	                'required'      => 'You have not provided %s.',
	                'is_unique'     => 'This %s already exists.'
	        ));
	    }

		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('district', 'District', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');

		$this->form_validation->set_rules('pointArea', 'Please Point Your Business Location', 'required');

		$this->form_validation->set_rules('street', 'Street', 'required');
		$this->form_validation->set_rules('landmark', 'Street', 'required');
		$this->form_validation->set_rules('doorNumber', 'Door Number', 'required');
		$this->form_validation->set_rules('pincode', 'Pincode/Zipcode', 'required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');

		if($this->input->post('facebookID'))
        {
			$this->form_validation->set_rules('facebookID', 'Facebook ID', 'required');
		}
		
		if($this->form_validation->run() == true)
		{
			$userID = xss_clean($this->input->post('userID'));
			$businessCategory = xss_clean($this->input->post('businessCategory'));

			if($businessCategory == 'NormalUser')
			{
				$user_Cover_Photo = 'https://cartravels.com/assets/img/default_bg2.jpg';
			}
			else
			{
				$user_Cover_Photo = '';
			}
			
			$fullName = xss_clean($this->input->post('fullName'));
			$surname = xss_clean($this->input->post('surname'));

			$businessName = xss_clean($this->input->post('businessName'));
			$ownerName = xss_clean($this->input->post('ownerName'));
			$email = xss_clean($this->input->post('email'));
			$mobile = xss_clean($this->input->post('mobile'));
			$alterMobile = xss_clean($this->input->post('alterMobile'));

			$pointArea = xss_clean($this->input->post('pointArea'));

			$state = xss_clean($this->input->post('state'));
			$district = xss_clean($this->input->post('district'));
			$city = xss_clean($this->input->post('city'));

			$place = xss_clean($this->input->post('place'));
			$profession = xss_clean($this->input->post('profession'));

			$street = xss_clean($this->input->post('street'));
			$landmark = xss_clean($this->input->post('landmark'));
			$doorNumber = xss_clean($this->input->post('doorNumber'));
			$pincode = xss_clean($this->input->post('pincode'));
			$longitude = xss_clean($this->input->post('longitude'));
			$latitude = xss_clean($this->input->post('latitude'));
			$businessWebsiteName = xss_clean($this->input->post('businessWebsiteName'));

			$websiteUrl = xss_clean($this->input->post('websiteUrl'));
			$websiteUrl = preg_replace("/[^a-zA-Z0-9.]/", "", $websiteUrl);

			$facebookID = xss_clean($this->input->post('facebookID'));
			$keywords = xss_clean($this->input->post('keywords'));

			$user_location = $city.', '.$state;

			$data = array(
				"user_Business_Category" => $businessCategory,
				"user_uniid" => $userID,
				"cartravels_id" => $websiteUrl,
				"user_Name" => $fullName,
				"user_Surname" => $surname,
				"user_Proffession" => $profession,
				"uesr_Business_Name" => $businessName,
				"user_Owner_Name" => $ownerName,
				"user_Email" => $email,
				"user_Mobile_No" => $mobile,
				"user_Alter_Mobile_No" => $alterMobile,
				"user_Area" => $pointArea,
				"user_location" => $user_location,
				"user_State" => $state,
				"user_District" => $district,
				"user_City" => $city,
				"user_Place" => $place,
				"user_Street" => $street,
				"user_Landmark" => $landmark,
				"user_Door_No" => $doorNumber,
				"user_Pin_Code" => $pincode,
				"user_Longitude" => $longitude,
				"user_Latitude" => $latitude,
				"user_Business_Website_Name" => $businessWebsiteName,
				"user_Website_Url" => $websiteUrl,
				"user_Facebook_ID" => $facebookID,
				"user_Keywords" => $keywords,
				"user_Cover_Photo" => $user_Cover_Photo,
				"user_Start_Date" => date('Y-m-d'),
				"user_End_Date" => date('Y-m-d', strtotime('+1 years')),
				"user_Reg_Date" => date('Y-m-d H:i:s')
			);

			$status = $this->Registration_model->saveUserRegData($data);
			// $status = true;

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "User Registration Successfull";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = validation_errors();
		}
		echo json_encode($json);
	}

    public function uploadRegisteredProfileImage()
	{
		$uniid = xss_clean($this->input->post('uniid'));
		$pPicture = '';
		if(isset($_FILES["profilePic"]["name"]))  
		{  
		    $config['upload_path'] = 'assets/profiles/';  
		    $config['allowed_types'] = '*';
		    $this->load->library('upload', $config);  
		    if(!$this->upload->do_upload('profilePic'))  
		    {  
		         echo $this->upload->display_errors();  
		    }  
		    else  
		    {  
		         $uploadData = $this->upload->data(); 
		         $pPicture = $uploadData['file_name'];
		         $pPicture = 'https://www.cartravels.com/web_api/assets/profiles/'.$pPicture; 
		    }
		}

		$data = array(
			"user_Profile_Photo" => $pPicture
		);

		$whereArr = array(
			"user_uniid" => $uniid
		);

		$status = $this->Registration_model->updateProfile($data, $whereArr);

		if($status)
		{
			$json['error'] = "false";
			$json['message'] = "Pofile Image Uploaded";
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Sorry! Unable to Upload, Try again.";
		}
		echo json_encode($json);
	}

	public function uploadRegisteredCoverImage()
	{
		$uniid = xss_clean($this->input->post('uniid'));
		$pPicture = '';
		if(isset($_FILES["coverPhoto"]["name"]))  
		{  
		    $config['upload_path'] = 'assets/profiles/';  
		    $config['allowed_types'] = '*';
		    $this->load->library('upload', $config);  
		    if(!$this->upload->do_upload('coverPhoto'))  
		    {  
		         echo $this->upload->display_errors();  
		    }  
		    else  
		    {  
		         $uploadData = $this->upload->data(); 
		         $pPicture = $uploadData['file_name'];
		         $pPicture = 'https://www.cartravels.com/web_api/assets/profiles/'.$pPicture; 
		    }
		}

		$data = array(
			"user_Cover_Photo" => $pPicture
		);

		$whereArr = array(
			"user_uniid" => $uniid
		);

		$status = $this->Registration_model->updateCoverPhoto($data, $whereArr);

		if($status)
		{
			$json['error'] = "false";
			$json['message'] = "Cover Photo Uploaded";
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Sorry! Unable to Upload, Try again.";
		}
		echo json_encode($json);
	}

	public function uploadProfilePhoto()
	{
		if($this->input->method(TRUE) == 'POST')
		{

	        if(!empty($_FILES['profileImage']['name']))
	        {
                $config['upload_path'] = 'assets/profiles/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['profileImage']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('profileImage'))
                {
                    $uploadData = $this->upload->data();
                    $pPicture = $uploadData['file_name'];
                    $pPicture = base_url().'assets/profiles/'.$pPicture;
                }
                else { $pPicture = ''; }
            }
            else { $pPicture = ''; }

            $dataArr = array(

				"user_Profile_Photo" => $pPicture
			);

			$userID = xss_clean($this->input->post('userID'));
			$businessCategory = xss_clean($this->input->post('businessCategory'));
			$mobile = xss_clean($this->input->post('mobile'));

			$whereArr = array(
				"user_Business_Category" => $businessCategory, 
				"user_uniid" => $userID,
				"user_Mobile_No" => $mobile
			);

			$status = $this->Registration_model->updateUserRegData($dataArr, $whereArr);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "User Profile Updated";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
        }
        else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function uploadCoverPhoto()
	{
		if($this->input->method(TRUE) == 'POST')
		{

	        if(!empty($_FILES['bannerImage']['name']))
	        {
                $config['upload_path'] = 'assets/profiles/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['bannerImage']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('bannerImage'))
                {
                    $uploadData = $this->upload->data();
                    $bPicture = $uploadData['file_name'];
                    $bPicture = base_url().'assets/profiles/'.$bPicture;
                }
                else { $bPicture = ''; }
            }
            else { $bPicture = ''; }

            $dataArr = array(

				"user_Cover_Photo" => $bPicture
			);

			$userID = xss_clean($this->input->post('userID'));
			$businessCategory = xss_clean($this->input->post('businessCategory'));
			$mobile = xss_clean($this->input->post('mobile'));

			$whereArr = array(
				"user_Business_Category" => $businessCategory, 
				"user_uniid" => $userID,
				"user_Mobile_No" => $mobile
			);

			$status = $this->Registration_model->updateUserRegData($dataArr, $whereArr);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "User Profile Updated";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
        }
        else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function editCategoryProfile()
	{	

		if($this->input->method(TRUE) == 'POST')
		{

			$userID = xss_clean($this->input->post('userID'));
			$businessCategory = xss_clean($this->input->post('businessCategory'));

			$yearOfEstablishment = xss_clean($this->input->post('yearOfEstablishment'));
			
			$fullName = xss_clean($this->input->post('fullName'));
			$surname = xss_clean($this->input->post('surname'));

			$businessName = xss_clean($this->input->post('businessName'));
			$ownerName = xss_clean($this->input->post('ownerName'));
			$email = xss_clean($this->input->post('email'));
			$mobile = xss_clean($this->input->post('mobile'));
			$alterMobile = xss_clean($this->input->post('alterMobile'));

			$pointArea = xss_clean($this->input->post('pointArea'));

			$state = xss_clean($this->input->post('state'));
			$district = xss_clean($this->input->post('district'));
			$city = xss_clean($this->input->post('city'));

			$place = xss_clean($this->input->post('place'));
			$profession = xss_clean($this->input->post('profession'));

			$street = xss_clean($this->input->post('street'));
			$landmark = xss_clean($this->input->post('landmark'));
			$doorNumber = xss_clean($this->input->post('doorNumber'));
			$pincode = xss_clean($this->input->post('pincode'));
			$longitude = xss_clean($this->input->post('longitude'));
			$latitude = xss_clean($this->input->post('latitude'));
			$businessWebsiteName = xss_clean($this->input->post('businessWebsiteName'));
			$websiteUrl = xss_clean($this->input->post('websiteUrl'));
			$facebookID = xss_clean($this->input->post('facebookID'));
			$keywords = xss_clean($this->input->post('keywords'));

			$dataArr = array(
				"user_Name" => $fullName,
				"user_Surname" => $surname,
				"cartravels_id" => $websiteUrl,
				"user_Proffession" => $profession,
				"uesr_Business_Name" => $businessName,
				"user_Owner_Name" => $ownerName,
				"user_Email" => $email,
				"user_Mobile_No" => $mobile,
				"user_Alter_Mobile_No" => $alterMobile,
				"user_Area" => $pointArea,
				"user_State" => $state,
				"user_District" => $district,
				"user_City" => $city,
				"user_Place" => $place,
				"user_Street" => $street,
				"user_Landmark" => $landmark,
				"user_Door_No" => $doorNumber,
				"user_Pin_Code" => $pincode,
				"user_Longitude" => $longitude,
				"user_Latitude" => $latitude,
				"user_Business_Website_Name" => $businessWebsiteName,
				"user_Website_Url" => $websiteUrl,
				"user_Facebook_ID" => $facebookID,
				"user_Keywords" => $keywords,
				"user_Date_of_Establishment" => $yearOfEstablishment
			);


			$whereArr = array(
				"user_Business_Category" => $businessCategory, 
				"user_uniid" => $userID,
				"user_Mobile_No" => $mobile
			);

			$status = $this->Registration_model->updateUserRegData($dataArr, $whereArr);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "User Registration Updated";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

    public function chkWebsiteLink()
    {
        $webLink = xss_clean(trim($this->input->post('businessWebsite')));

        $webSts = $this->Registration_model->chkWebLink($webLink);

		if ($webSts) 
		{
			$json['data'] = $webSts;
			$json['wStatus'] = 1;
		}
		else
		{
			$json['wStatus'] = 0;
		}
		echo json_encode($json);
    }

	public function checkRegBusinessCategory()
    {
    	
    	$uniid = xss_clean($this->input->post('uniid'));
        $result = $this->Registration_model->checkRegBusiness($uniid);

        if(!empty($result))
		{
			unset($result[0]->user_Positions);
			unset($result[0]->user_Address);
			unset($result[0]->user_Desc);
			unset($result[0]->user_Image_Gallery);

			$json['data'] = $result; 
			$json['status'] = 1;
		}
		else
		{
			$json['status'] = 0;
		}

        echo json_encode($json);
    }

	public function listStates()
	{
		if($this->input->post('baseName') === "CarTravels")
		{
			$data = $this->Registration_model->getStates();
			echo json_encode($data);
		}
		else
		{
			echo "Bad Request";
		}
	}

	public function listDistricts()
	{
	    $stateCode = $this->input->post('stateCode');
		$data = $this->Registration_model->getDistrict($stateCode);
		
		if ($data) 
		{
			$json['districts'] = $data;
			$json['dStatus'] = 1;
		}
		else
		{
			$json['dStatus'] = 0;
			$json['districts'] = 'No Districts Found';
		}
		echo json_encode($json);
	}

	public function listCities()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $stateCode = $this->input->post('stateCode');
	        $districtCode = $this->input->post('districtCode');

	        if(!empty($stateCode) && !empty($districtCode))
	        {
	        	$whereArr = array("c.state_code" => $stateCode, "c.district_code" => $districtCode);
	        }
	        else if(!empty($stateCode))
	        {
	        	$whereArr = array("c.state_code"=> $stateCode);	
	        }
	        else
	        {
	        	$whereArr = 0;
	        }

			$data = $this->Registration_model->getCities($whereArr);

			if ($data) 
			{
				$json['cities'] = $data;
				$json['cStatus'] = 1;
			}
			else
			{
				$data['cStatus'] = 0;
				$json['cities'] = 'No Cities Found';
			}
		}
		else
		{
			 $json['cStatus'] = 0;
			 $json['cities'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function listAllCities()
	{
		if($this->input->method(TRUE) == 'POST')
		{
	        $stateCode = $this->input->post('stateCode');
	        $districtCode = $this->input->post('districtCode');

	        if(!empty($stateCode) && !empty($districtCode))
	        {
	        	$whereArr = array("c.state_code" => $stateCode, "c.district_code" => $districtCode);
	        }
	        else if(!empty($stateCode))
	        {
	        	$whereArr = array("c.state_code"=> $stateCode);	
	        }
	        else
	        {
	        	$whereArr = 0;
	        }

			$data = $this->Registration_model->getCities($whereArr);

			if ($data) 
			{
				$json['cities'] = $data;
				$json['cStatus'] = 1;
			}
			else
			{
				$data['cStatus'] = 0;
				$json['cities'] = 'No Cities Found';
			}
		}
		else
		{
			 $json['cStatus'] = 0;
			 $json['cities'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function listPlaces()
	{
		$stateCode = $this->input->post('stateCode');
        $districtCode = $this->input->post('districtCode');
        $cityCode = $this->input->post('cityCode');
        $metropolitan = $this->input->post('metropolitan');
        if($metropolitan == 1)
        {
        	$data = $this->Registration_model->getPlaces($stateCode, $districtCode, $cityCode);

        	if ($data) 
			{
				$json['places'] = $data;
				$json['pStatus'] = 1;
			}
			else
			{
				$data['pStatus'] = 0;
				$json['places'] = 'No Places Found';
			}
        }
		else
		{
			$data['pStatus'] = 0;
			$json['places'] = 'No Places Found';
		}
		echo json_encode($json);
	}

	public function listKeywords()
	{
		$businessType = $this->input->post('businessType');
        if($businessType)
        {
        	$data = $this->Registration_model->getKeywords($businessType);

        	if ($data) 
			{
				$json['keywords'] = $data;
				$json['kStatus'] = 1;
			}
			else
			{
				$data['kStatus'] = 0;
				$json['keywords'] = 'No Keywords Found';
			}
        }
        else
		{
			$data['kStatus'] = 0;
			$json['keywords'] = 'No Keywords Found';
		}
		echo json_encode($json);
	}

	public function listProfessions()
	{

    	$data = $this->Registration_model->getProfessions();

    	if ($data) 
		{
			$json['professions'] = $data;
			$json['pStatus'] = 1;
		}
		else
		{
			$data['pStatus'] = 0;
			$json['professions'] = 'No Profession Found';
		}

		echo json_encode($json);
	}

	public function businessListings()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$businessCategory = xss_clean($this->input->post('businessCategory'));
			$listingCity = xss_clean($this->input->post('listingCity'));
			$listingState = xss_clean($this->input->post('listingState'));
			$uniid = xss_clean($this->input->post('uniid'));
			
			$selectedKeyword = xss_clean($this->input->post('selectedKeyword'));

			if($businessCategory == "all")
			{
				$whereArr = "all";
			}
			else if(!empty($businessCategory) && !empty($listingState) && !empty($listingCity))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_City" => $listingCity, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else if(!empty($businessCategory) && !empty($listingState))
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_State" => $listingState, "user_Keywords like " => "%$selectedKeyword%");
			}
			else
			{
				$whereArr = array("user_Business_Category" => $businessCategory, "user_Keywords like " => "%$selectedKeyword%");
			}
			
			$result = $this->Registration_model->getRegCategoryData($whereArr, $uniid, $selectedKeyword);
			if($result)
			{
				$json['listings'] = $result;
			}
			else
			{
				$json['listings'] = "No Data Found";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function selectedBusinessCat()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$catUniid = xss_clean($this->input->post('catUniid'));
			$uniid = xss_clean($this->input->post('myUniid'));
			$cid = xss_clean($this->input->post('cid'));

			$whereArr = array("ba.user_uniid" => $catUniid, "ba.cid" => $cid);

			$result = $this->Registration_model->getRegCategoryData($whereArr, $uniid);
			if($result)
			{
				$json['listings'] = $result;
			}
			else
			{
				$json['listings'] = "No Data Found";
			}
		}
		else
		{
			 $json['error'] = 'true';
			 $json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function deleteRegistration()
	{
	    $carTravelsID = $this->input->post('carTravelsID');
	    $cid = $this->input->post('cid');
	    $buninessCat = $this->input->post('buninessCat');
	    $uniid = $this->input->post('uniid');

		$data = $this->Registration_model->deleteRegistrationCategory($carTravelsID, $cid, $buninessCat, $uniid);

		if($data)
		{
			$json['error'] = 'false';
		    $json['message'] = "User Registrations Deleted";
		}
		else
		{
			$json['error'] = 'true';
		    $json['message'] = "Sorry unable to Deleted";
		}
		echo json_encode($json);
	}
public function getAllAgencies()
{if($this->input->method(TRUE) == 'POST')
	{
		$city = xss_clean($this->input->post('locationCity'));
		$state = xss_clean($this->input->post('locationState'));
	$data = $this->Registration_model->getBusinessAgencies($city,$state);
	if(!empty($data))
	{
		$json['error'] = "false";
		$json['agencies'] = $data;
	}
	else
	{
		$json['error'] = "true";
		$json['agencies'] = "No Data Found";
	}
}
else
{
	$json['error'] = "true";
	$json['message'] = "Unknown Method";
}
	echo json_encode($json);

}

public function getAllAgenciesCount()
{if($this->input->method(TRUE) == 'POST')
	{
		$city = xss_clean($this->input->post('locationCity'));
		$state = xss_clean($this->input->post('locationState'));
	$data = $this->Registration_model->getBusinessAgenciesCount($city,$state);
	if(!empty($data))
	{
		$json['error'] = "false";
		$json['agencies'] = $data;
	}
	else
	{
		$json['error'] = "true";
		$json['agencies'] = "No Data Found";
	}
}
else
{
	$json['error'] = "true";
	$json['message'] = "Unknown Method";
}
	echo json_encode($json);

}
	public function getCount()
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$city = xss_clean($this->input->post('locationCity'));
			$state = xss_clean($this->input->post('locationState'));
			$this->data['CarTravelsOffices'] = $this->Registration_model->getRegCategoryCount('CarTravelsOffices', $city, $state);
			$this->data['SelfDrivingOffices'] = $this->Registration_model->getRegCategoryCount('SelfDrivingOffices', $city, $state);
			$this->data['OptingDrivers'] = $this->Registration_model->getRegCategoryCount('OptingDrivers', $city, $state);
			$this->data['ToursAndTravels'] = $this->Registration_model->getRegCategoryCount('ToursAndTravels', $city, $state);
			$this->data['Mechanics'] = $this->Registration_model->getRegCategoryCount('Mechanics', $city, $state);
			$this->data['HotelsAndResorts'] = $this->Registration_model->getRegCategoryCount('HotelsAndResorts', $city, $state);
			$this->data['Ads'] = $this->Registration_model->getRegCategoryCount('Ads', $city, $state);
			$this->data['Drivers'] = $this->Registration_model->getRegCategoryCount('Drivers', $city, $state);
			$this->data['NormalUser'] = $this->Registration_model->getRegCategoryCount('NormalUser', $city, $state);
			$this->data['Tenders'] = $this->Registration_model->getRegCategoryCount('Tenders', $city, $state);
			$this->data['OwnerCumDrivers'] = $this->Registration_model->getRegCategoryCount('OwnerCumDrivers', $city, $state);
			$json = $this->data;
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