<?php

class Registration_model extends CI_Model
{


    function insert_data($name, $path_name)
    {
        $data = array(
                      'name'    => $name,
                      'path'    => $path_name
                     );

        $this->db->insert('table', $data);

        return $this->db->insert_id();
    }
    
    public function saveUserRegData($data)
    {
        $this->db->insert("api_cartravel_business_agencies", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateProfile($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_business_agencies', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateCoverPhoto($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_business_agencies', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateUserRegData($dataArr, $whereArr)
    {        
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_business_agencies', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    } 

    public function checkRegBusiness($uniid)
    {
        // $result = $this->db->query("SELECT * FROM `api_adwaitha_users` where `user_email` = '$mail'");
        $result = $this->db->query("SELECT * FROM `api_cartravel_business_agencies` where `user_uniid` = '$uniid'");
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function userUpdateStatus($id)
    {
        $querys = $this->db->query("SELECT * FROM `api_cartravel_users` WHERE `uniid` = '$id' AND `user_status`='Active'");

        if($querys->num_rows() == 0){

            $this->db->query("UPDATE `api_cartravel_users` set user_status='Active' where uniid = '$id'");

            if ($this->db->affected_rows() > 0) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if($querys->num_rows() == 1){
            return 'Activated';
        }
    }

    public function getStates()
    {
        $result = $this->db->query("SELECT `country_code`,`state_code`,`state_name` FROM `api_cartravel_states`  ORDER BY `api_cartravel_states`.`state_name` ASC");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getDistrict($stateCode)
    {
        $result = $this->db->query("SELECT `country_code`,`state_code`,`district_code`, `district_name` FROM `api_cartravel_districts` where `state_code` = '$stateCode' ORDER BY `district_name` ASC");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getCities($whereArr)
    {
        $this->db->select('s.state_name, c.state_code, c.district_code, c.city_code, c.city_name, c.metropolitan');
        $this->db->from('api_cartravel_cities c');
        $this->db->join('api_cartravel_states s', 's.state_code = c.state_code', 'left');
        if($whereArr != 0)
        {
            $this->db->where($whereArr);    
        }
        
        $this->db->order_by('c.city_name', 'ASC');
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function getPlaces($stCode, $distCode, $cityCode)
    {
        $result = $this->db->query("SELECT `place_code`, `place_name` FROM `api_cartravel_places` where `state_code` = '$stCode' AND `district_code` = '$distCode' AND `city_code` = '$cityCode' ORDER BY `api_cartravel_places`.`place_name` ASC");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getKeywords($bussCode)
    {
        $result = $this->db->query("SELECT `id`, `businessType`, `keywordName`, `keywordID` FROM `api_cartravel_keywords` where `businessType` = '$bussCode' ORDER BY `id` ASC");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getProfessions()
    {
        $result = $this->db->query("SELECT `profession_id`, `profession_name` FROM `api_cartravel_professions` ORDER BY `api_cartravel_professions`.`id` ASC");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function chkWebLink($webLink)
    {
        $webLink = xss_clean(trim($this->input->post('businessWebsite')));

        $result = $this->db->query("SELECT `user_Website_Url` FROM `api_cartravel_business_agencies` where `user_Website_Url` = '$webLink'");

        if($result->num_rows() >= 1)
        {
            return  $result->result();
        }
        else
        {
            return false;
        }
    }

    public function getRegCategoryData($whereArr, $uid, $cKey = NULL)
    {
        if($whereArr == 'all')
        {
            $result = $this->db->query("SELECT cid, user_Business_Category, cartravels_id, user_Name, user_Surname, user_Proffession, uesr_Business_Name, user_Owner_Name, user_Email, user_Mobile_No, user_Alter_Mobile_No, user_State, user_District, user_City, user_Place, user_Street, user_Landmark, user_Door_No, user_Pin_Code, user_Longitude, user_Latitude, user_Business_Website_Name, user_Website_Url, user_Facebook_ID, user_Profile_Photo, user_Cover_Photo, user_Desc, user_Area, user_Status, user_Keywords, user_Date_of_Establishment FROM `api_cartravel_business_agencies` where `user_Business_Category` IN ('CarTravelsOffices', 'OwnerCumDrivers', 'SelfDrivingOffices', 'OptingDrivers', 'ToursAndTravels', 'Ads')  ORDER BY `api_cartravel_business_agencies`.`cid` ASC");
        }
        else
        {
            $this->db->select('ba.user_uniid, ba.cid, ba.user_Business_Category, ba.cartravels_id, ba.user_Name, ba.user_Surname, ba.user_Proffession, ba.uesr_Business_Name, ba.user_Owner_Name, ba.user_Email, ba.user_Mobile_No, ba.user_Alter_Mobile_No, ba.user_State, ba.user_District, ba.user_City, ba.user_Place, ba.user_Street, ba.user_Landmark, ba.user_Door_No, ba.user_Pin_Code, ba.user_Longitude, ba.user_Latitude, ba.user_Business_Website_Name, ba.user_Website_Url, ba.user_Facebook_ID, ba.user_Profile_Photo, ba.user_Cover_Photo, ba.user_Desc, ba.user_Area, ba.user_Status, ba.user_Keywords, ba.user_Date_of_Establishment,ba.user_Membership_Type, ba.user_Positions, ba.user_Membership_Date, cf.favourite, cr.ratings as myRating, cr.review as myReviewComment, avg(r.ratings) as avgRating, count(r.ratings) as ratingCount, GROUP_CONCAT(r.review SEPARATOR "#") as allReviews');

            $this->db->from('api_cartravel_business_agencies ba');
            $this->db->join("api_cartravel_cate_favourite cf", "cf.uniid = '$uid' AND cf.cid = ba.cid", 'left');
            $this->db->join("api_cartravel_cat_ratings cr", "cr.uniid = '$uid' AND cr.cid = ba.cid", 'left');
            $this->db->join("api_cartravel_cat_ratings r", "r.cid = ba.cid", 'left');

            if(array_key_exists('user_Business_Category', $whereArr))
            {
                if($whereArr['user_Business_Category'] == 'CarTravelsOffices')
                {
                    $names = array('CarTravelsOffices', 'OwnerCumDrivers');
                    $this->db->where_in('user_Business_Category', $names);

                    if(!empty($whereArr['user_City']) && !empty($whereArr['user_State']))
                    {
                        $wr = array(
                            "user_City" => $whereArr['user_City'], 
                            "user_State" => $whereArr['user_State'],  
                            "user_Keywords like " => "%$cKey%"
                        );
                        $this->db->where($wr);
                    }
                    else if(!empty($whereArr['user_State']))
                    {
                        $wr = array(
                            "user_State" => $whereArr['user_State'],  
                            "user_Keywords like " => "%$cKey%"
                        );
                        $this->db->where($wr);
                    }
                }
                else
                {
                    $this->db->where($whereArr);
                }
            }
            else
            {
                $this->db->where($whereArr);
            }
            
            
            // $this->db->order_by('cid', "ASC");
            // $this->db->order_by('avgRating DESC');
            // $this->db->order_by('user_Positions ASC, user_Membership_Type ASC');
            $this->db->order_by('user_Membership_Type ASC, user_Positions ASC');
            $this->db->group_by('cid');
            $result = $this->db->get();
        }

        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function deleteRegistrationCategory($carTravelsID, $cid, $buninessCat, $uniid)
    {

        $this->db->query("DELETE FROM `api_booking_remainders` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_accbw` WHERE `uniid` ='$uniid'");

        $this->db->query("DELETE FROM `api_cartravel_ads` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_bookings` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_business_gallery` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_cate_favourite` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_cat_ratings` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_dropping_cars` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_enquiry` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_favourite` WHERE `uniid` = '$uniid'");

        $this->db->query("DELETE FROM `api_cartravel_gps_tracking` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_hotel_bookings` WHERE `hotel_user_uniid` = '$uniid' OR `hotel_owner_uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_hotel_info` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_jobs` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_notifications` WHERE `receiver_uniid` = '$uniid' OR `sender_uniid`= '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_others` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_payments` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_report_post` WHERE `reporter_uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_sdv` WHERE `uniid` = '$uniid'");

        $this->db->query("DELETE FROM `api_cartravel_tdacars` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_tenders` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_tours_travels` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_cartravel_vc` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_driver_share` WHERE `share_uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_insurance_remainders` WHERE `uniid` = '$uniid'");
        $this->db->query("DELETE FROM `api_sos_share` WHERE `sos_uniid` = '$uniid'");


        $this->db->query("DELETE FROM `api_cartravel_addmembers` WHERE `sender_uniid` = '$uniid' ");

        $this->db->query("DELETE FROM `api_cartravel_add_places` WHERE `uniid` = '$uniid' ");

        $this->db->query("DELETE FROM `api_cartravel_gps` WHERE  `uniid` = '$uniid' ");

        $this->db->query("DELETE FROM `api_cartravel_sos_numbers` WHERE  `uniid` = '$uniid' ");

        $this->db->query("DELETE FROM `api_cartravel_users` WHERE `uniid` = '$uniid'");

        $this->db->query("DELETE FROM `api_cartravel_business_agencies` WHERE `cartravels_id` = '$carTravelsID' AND `cid` = '$cid' AND `user_Business_Category` = '$buninessCat' AND `user_uniid` = '$uniid' ");

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    // $this->db->select("user_uniid,cartravels_id,user_Name,user_Surname,user_Owner_name,uesr_Business_name,user_Email,user_Longitude,user_Latitude");
    public function getBusinessAgenciesCount($city,$state)
    {
        $this->db->select("count(*) as count,user_Business_Category");
        $this->db->from('api_cartravel_business_agencies');
        if( !empty($city) && !empty($state))
        {
            $this->db->where('user_City',$city);
            $this->db->where('user_State',$state);
        }
        elseif (!empty($state)) {
            $this->db->where('user_State',$state);
        }
        $this->db->group_by('user_Business_Category');
        return $this->db->get()->result();
    }
    public function getBusinessAgencies($city,$state)
    {
        $this->db->select("user_Business_Category,user_uniid,cartravels_id,user_Name,user_Surname,user_Owner_name,uesr_Business_name,user_Email,user_Longitude,user_Latitude");
        $this->db->from('api_cartravel_business_agencies');
        if( !empty($city) && !empty($state))
        {
            $this->db->where('user_City',$city);
            $this->db->where('user_State',$state);
        }
        elseif (!empty($state)) {
            $this->db->where('user_State',$state);
        }
        $this->db->where('user_Business_Category !=','NormalUser');
        return $this->db->get()->result();
        
    }
    public function getRegCategoryCount($category, $city, $state)
    {
        if(!empty($category) && !empty($city) && !empty($state))
        {
            $whereArr = array(
                'user_Business_Category' =>  $category,
                'user_City' =>  $city,
                'user_State' =>  $state
            );
        }
        elseif (!empty($category) && !empty($state)) {
            $whereArr = array(
                'user_Business_Category' =>  $category,
                'user_State' =>  $state
            );
        }
        elseif (!empty($category)) {
           $whereArr = array(
                'user_Business_Category' =>  $category
            );
        }
        $this->db->select("count(*) as `TotalRec`");
        $this->db->from('api_cartravel_business_agencies');
        $this->db->where($whereArr);
        $this->db->order_by('cid', "DESC");
        $result = $this->db->get();

        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }
}

?>