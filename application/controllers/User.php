<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
        $this->load->model('User_model');
        $this->load->model('Profile_model');
        $this->load->model('api/Registration_model');
        $this->load->model('Businesslistings_model');
        $this->load->model('api/AdPost_model');

        $this->data['totalStates'] = $this->Registration_model->getStates();

        $this->url = "http://bhashsms.com/api/sendmsg.php?";
        $this->isUserLoggedIn = $this->session->userdata('isCTUserLoggedIn');
        if(!$this->isUserLoggedIn)
        { 
            redirect(base_url().'login'); 
        }
    }

    public function index()
    {
        $cartravelId = $this->session->userdata('details')->cartravels_id;
        $uniid = $this->session->userdata('details')->uniid;

        $data['user'] = $this->Profile_model->getRegUserData($this->session->userdata('details')->cartravels_id);
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($data['user']->user_Business_Category);
        $data['states'] = $this->data['totalStates'];


        // echo "<pre>";
        // print_r($this->session->userdata());
        // print_r($data);
        // echo "</pre>";

    	$this->load->view("ins/header", $data);
    	$this->load->view("user/user_menu");
    	$this->load->view("user/user_body");
		$this->load->view("ins/footer");
    }


    public function editCategoryProfile()
    {   

        if($this->input->method(TRUE) == 'POST')
        {

            $userID = xss_clean($this->input->post('userID'));
            $businessCategory = xss_clean($this->input->post('businessCategory'));

            $yearOfEstablishment = xss_clean($this->input->post('yearOfEstablishment'));
            
            $fullName = xss_clean($this->input->post('userName'));
            $surname = xss_clean($this->input->post('surName'));

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
            // $websiteUrl = preg_replace("/[^a-zA-Z0-9.]/", "", $websiteUrl);
            $facebookID = xss_clean($this->input->post('facebookID'));
            $KeyWords = xss_clean($this->input->post('KeyWords'));

            // print_r($KeyWords);

            if(empty($KeyWords))
            {
                $KeyWords = "";
            }
            else
            {
                $KeyWords = implode("#", $KeyWords);
            }


            $dataArr = array(
                "user_Business_Category" => $businessCategory,
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
                "user_Keywords" => $KeyWords,

                "user_Date_of_Establishment" => $yearOfEstablishment
            );


            $whereArr = array(
                "user_uniid" => $userID,
                "user_Mobile_No" => $mobile
            );

            $status = $this->Registration_model->updateUserRegData($dataArr, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "User Registration Updated";

                // $arr = (object) array('cartravels_id' => $websiteUrl);
                // $this->session->set_userdata('details', $arr);
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


    public function addTodayAvailableCars($pid = null)
    {

        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords('CarTravelsOffices');
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        if($pid != null)
        {
            $this->load->view("user/edit_today_available_cars");
        }
        else
        {
            $this->load->view("user/today_available_cars");    
        }
        
        $this->load->view("ins/footer");
    }


    public function addDroppingCars($pid = null)
    {

        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords('CarTravelsOffices');
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        
        if($pid != null)
        {
            $this->load->view("user/edit_dropping_cars");
        }
        else
        {
            $this->load->view("user/dropping_cars");
        }
        $this->load->view("ins/footer");
    }

    public function set_ctype()
    {
        $cType = $this->input->post('cType');
        if($cType == 'Car')
        {
            $this->session->set_userdata('vType', 'SelfDrivingOffices');
        }
        else
        {
            $this->session->set_userdata('vType', 'Bikes');
        }        
    }

    public function addSelfDrivingCars($pid = null)
    {
        if(!$this->session->has_userdata('vType'))
        {
            $this->session->set_userdata('vType', 'SelfDrivingOffices');
        }

        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        

        if($pid != null)
        {
            $this->load->view("user/edit_self_driving_cars");
        }
        else
        {
            $this->load->view("user/self_driving_cars");
        }

        $this->load->view("ins/footer");
    }

    public function addTourpackage($pid = null)
    {

		$data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
		$data['profession'] = $this->Registration_model->getProfessions();
    	$data['keywords'] = $this->Registration_model->getKeywords('ToursAndTravels');
		$data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

    	$this->load->view("ins/header", $data);
    	$this->load->view("user/user_menu");
    	

        if($pid != null)
        {
            $this->load->view("user/edit_tour_package");
        }
        else
        {
            $this->load->view("user/tour_package");
        }

		$this->load->view("ins/footer");
    }

    public function addJobs($pid = null)
    {
        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        

        if($pid != null)
        {
            $this->load->view("user/edit_jobs");
        }
        else
        {
            $this->load->view("user/jobs");
        }

        $this->load->view("ins/footer");
    }

    public function addTender($pid = null)
    {
        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        $this->load->view("user/tenders");
        $this->load->view("ins/footer");
    }


    public function addVisitingCard($pid = null)
    {
        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        

        if($pid != null)
        {
            $this->load->view("user/edit_promote_visiting_card");
        }
        else
        {
            $this->load->view("user/promote_visiting_card");
        }

        $this->load->view("ins/footer");
    }


    public function addOthers($pid = null)
    {
        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $data['data'] = $this->User_model->postDetails($this->session->userdata('ctuid'), $pid);
        $data['pid'] = $pid;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");

        if($pid != null)
        {
            $this->load->view("user/edit_others");
        }
        else
        {
            $this->load->view("user/others");
        }

        $this->load->view("ins/footer");
    }


    public function addAccident($pid = null)
    {
        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords($this->session->userdata('vType'));
        $data['states'] = $this->data['totalStates'];

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        $this->load->view("user/accident_breakdown");
        $this->load->view("ins/footer");
    }

    public function addAds()
    {

        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords('CarTravelsOffices');
        $data['states'] = $this->data['totalStates'];

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/user_menu");
        $this->load->view("user/ads_view");
        $this->load->view("ins/footer");
    }


    public function myPosts()
    {

        $data['user'] = $this->Registration_model->checkRegBusiness($this->session->userdata('ctuid'));
        $data['profession'] = $this->Registration_model->getProfessions();
        $data['keywords'] = $this->Registration_model->getKeywords('CarTravelsOffices');
        $data['states'] = $this->data['totalStates'];

        $adInfo = $this->AdPost_model->adsList($this->session->userdata('ctuid'));
        $data['adInfo'] = array_reverse($adInfo);

        $whereArr = array("p.uniid" => $this->session->userdata('ctuid'));

        $data['myPostings'] = $this->Profile_model->listMyGroupPostingsWeb($whereArr);

        // echo "<pre>";
        // print_r($data['adInfo']);
        // echo "</pre>";

        $this->load->view("ins/header", $data);
        $this->load->view("user/my_posts_view");
        $this->load->view("ins/footer");
    }


    public function logout()
    {
    	$this->isCTUserLoggedIn = $this->session->userdata('isCTUserLoggedIn');
        if(!empty($this->isCTUserLoggedIn)){ 
            $this->session->unset_userdata('isCTUserLoggedIn');
            $this->session->unset_userdata('ctuid');
            $this->session->unset_userdata('details');
            redirect(base_url());
        }
        else
        {
            redirect(base_url());
        }
    }


    public function listDCPlaces()
    {
        $cityCode = $_GET['cityCode'];
        $data = $this->Profile_model->getPlaces($cityCode);
        if ($data) 
        {
            echo json_encode($data);
        }
        else
        {
            echo json_encode($data);
        }   
    }

    public function addDistrictsRec()
    {
        $stateCode = $_GET['stateCode'];
        
        $data = $this->Profile_model->get_state_districts_data($stateCode);
        if($data)
        {
            echo json_encode($data);
        }
        else
        {
            echo json_encode($data);
        }
    }

    public function listDCities()
    {
        $stateCode = $_GET['stateCode'];
        $districtCode = $_GET['districtCode'];
        $data = $this->Profile_model->getCities($stateCode, $districtCode);
        if ($data) 
        {
            echo json_encode($data);
        }
        else
        {
            echo json_encode($data);
        }   
    }

    public function getSOS()
    {
        // header('Content-Type: application/json');

        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));

            $whereArr = array("uniid" => $uniid);
            
            $sosList = $this->Profile_model->listSOS($whereArr);

            // echo "<pre>";
            // print_r($sosList);
            // echo "</pre>";

            if($sosList)
            {
                echo "<table class='table table-bordered'>";
                foreach ($sosList as $key => $value) 
                {
                    ?>
                    <tr>
                        <td><?php echo $value->sos_type; ?></td>
                        <td><?php echo $value->sos_name; ?></td>
                        <td><?php echo $value->sos_number; ?></td>
                        <td><?php 
                                if($value->sos_status == 1)
                                {
                                    echo "<i class='fa fa-check-circle text-success'></i> ";
                                    echo "<i style='cursor:pointer;' value='".$value->sos_id."' number='".$value->sos_number."'  onclick='deleteSOSContact(this);' class='fa fa-trash text-danger'></i>";
                                }
                                else
                                {
                                    echo "<i class='fa fa-close text-danger'></i> ";

                                    echo "<i style='cursor:pointer;' value='".$value->sos_id."' number='".$value->sos_number."'  onclick='deleteSOSContact(this);' class='fa fa-trash text-danger'></i>";
                                }
                            ?></td>
                    </tr>
                    <?php
                }
                echo "</table>";
            }
            else
            {
                echo "<table class='table table-bordered'><tr>";
                echo "<td colspan='4'><center>No Data</center></td>";
                echo "</tr></table>";
            }
        }
        else
        {
            echo "Unknown Method";
        }
    }

    public function searchCartravelsId()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $websiteUrl = $this->input->post("websiteUrl");

            $result = $this->Profile_model->searchCustomWebUrl($websiteUrl);
        
            if($result)
            {
                $json['error'] = "false";
                $json['message'] = "Web URL already Registered";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Web URL Available";
            }
        }
        else
        {
            echo "Unknown Request";
        }
        echo json_encode($json);
    }


    public function uploadRegisteredProfileImage()
    {
        $uniid = xss_clean($this->input->post('uniid'));
        $pPicture = '';
        if(isset($_FILES["profilePic"]["name"]))  
        {  
            $config['upload_path'] = 'assets/profiles';  
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
                 $pPicture = base_url().'assets/profiles/'.$pPicture; 
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
                 $pPicture = base_url().'assets/profiles/'.$pPicture; 
            }
        }

        $data = array(
            "user_Cover_Photo" => $pPicture
        );

        $whereArr = array(
            "user_uniid" => $uniid
        );

        $status = $this->Registration_model->updateProfile($data, $whereArr);

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

    public function test()
    {
        $arr = (object) array('cartravels_id' => 'chinnac');
        $this->session->set_userdata('detailss', $arr);
    }
}