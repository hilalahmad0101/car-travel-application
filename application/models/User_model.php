<?php

class User_model extends CI_Model
{

    public function saveData($data)
    {
        $this->db->insert("api_cartravel_users", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
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

    public function checkedemail($mobile)
    {
        $result = $this->db->query("SELECT `uniid`, `user_name`, `user_mobile`, `user_email`, `user_password`, `user_token`, `user_status`, `mobileVerification`, `emailVerification` FROM `api_cartravel_users` where `user_mobile` = '$mobile'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function checkMobile($mobile)
    {
        $result = $this->db->query("SELECT `user_name`, `user_mobile`, `uniid`, `user_email`, `user_password`, `user_token`, `user_status` FROM `api_cartravel_users` where `user_mobile` = '$mobile'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function updatePassCode($code, $uniid)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `code`='$code' where uniid = '$uniid' AND `user_status`='Active'");

        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePassword64($code, $uniid)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_passwordEnc`='$code' where uniid = '$uniid' AND `user_status`='Active'");

        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkedPassCode($code, $uniid)
    {
        // $result = $this->db->query("SELECT * FROM `api_cartravel_users` where `user_email` = '$mail'");
        $result = $this->db->query("SELECT `uniid` FROM `api_cartravel_users` where `code` = '$code' AND `uniid` = '$uniid'");
        if($result->num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function checkPassword($currentPwd, $uniid)
    {
        $result = $this->db->query("SELECT `user_password` FROM `api_cartravel_users` where `user_password` = '$currentPwd' AND `uniid` = '$uniid'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }


    public function newPasswordUpdating($uniid, $code, $pwd)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_password`='$pwd' where uniid = '$uniid' AND code=$code");

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function chgPasswordUpdating($uniid, $pwd)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_password`='$pwd' where uniid = '$uniid'");

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
    public function get_event_calls()
    {
        $result = $this->db->query("SELECT * FROM `api_event_cal`");
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

    public function get_exp_categorys()
    {
        $result = $this->db->query("SELECT * FROM `api_exp_category`");
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

    public function get_income_source()
    {
        $result = $this->db->query("SELECT * FROM `api_income_source`");
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


    // type list

    public function get_exp_cat_list()
    {
        $result = $this->db->query("SELECT `expCat_name` FROM `api_expense_category_list`");
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


    public function get_exp_type_list()
    {
        $result = $this->db->query("SELECT `expType_name` FROM `api_expense_type_list`");
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


    public function get_inc_source_type_list()
    {
        $result = $this->db->query("SELECT `incSourceType_name` FROM `api_incsource_type_list`");
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

    public function getDeviseToken($mobile)
    {
        $result = $this->db->query("SELECT `user_DeviseTokenId`, `uniid`, `user_mobile` FROM `api_cartravel_users` where `user_mobile` = '$mobile'");
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

    public function newDeviseTokenUpdating($uniid, $mobile, $dToken)
    {
        $this->db->where(array('uniid'=>$uniid, 'user_mobile'=>$mobile));
        $this->db->update('api_cartravel_users', array('user_DeviseTokenId'=>$dToken));

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function newUserLocationUpdating($uniid, $mobile, $uLocation)
    {
        $this->db->where(array('user_uniid'=>$uniid, 'user_Mobile_No'=>$mobile));
        $this->db->update('api_cartravel_business_agencies', array('user_location'=>$uLocation));

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function postDetails($uniid, $pid)
    {
        // $uniid = xss_clean($this->input->get('uid'));
        // $pid = xss_clean($this->input->get('pid'));

        // if($this->input->get('pid') == '' && $this->input->get('uid') == '')
        // {
        //     redirect(base_url());
        // }

        // $uniid = $this->uri->segment(4);
        // $pid = $this->uri->segment(3);

        if($pid == '')
        {
            return false;
        }

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
        }
        elseif(!empty($tda_car_image))
        {
            $postImage = $tda_car_image;
            $cat = "Today Available Cars";
            $postTitle = $cat.' - '.$tda_car_type;
            $postDesc = $postTitle;
        }
        elseif(!empty($vc_image))
        {
            $postImage = $vc_image;
            $cat = "Visiting Cards";
            $postTitle = $cat.' - '.$vc_desc;
            $postDesc = $postTitle;
        }
        elseif(!empty($other_image))
        {
            $postImage = $other_image;
            $cat = "Others";
            $postTitle = $cat.' - '.$other_title;
            $postDesc = $postTitle.' - '.$other_desc;
        }
        elseif(!empty($tourp_image))
        {
            $postImage = $tourp_image;
            $cat = "Tour Packages";
            $postTitle = $cat.' - '.$tour_package_name;
            $postDesc = $postTitle.' - '.$tour_description.', Days: '.$tour_plan_days.', Places: '.$tour_keywords;
        }
        elseif(!empty($vehicle_images))
        {
            $postImage = $vehicle_images;
            $cat = "Dropping Cars";
            $postTitle = $cat.' - '.$pickupCity.' to '.$dropCity;
            $postDesc = $postTitle.', Available Seats '.$available_seats.', Ticket Cost: '.$ticket_fair.', Date: '.$journey_date;
        }




        elseif(!empty($result->tend_image))
        {
            $postImage = $result->tend_image;
            $cat = "Tenders";
            $postTitle = $cat.' - '.$result->tend_title;
            $postDesc = $result->tend_desc;
        }

        elseif(!empty($result->job_image))
        {
            $postImage = $result->job_image;
            $cat = "Jobs";
            $postTitle = $cat.' - '.$result->job_salary_from.' to '.$result->job_salary_to;
            $postDesc = $result->job_description;
        }

        elseif(!empty($result->accbw_image))
        {
            $postImage = $result->accbw_image;
            $cat = "Accident / Breakdown";
            $postTitle = $result->accbw_title;
            $postDesc = $result->accbw_dedication;
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


        return $data;


        $this->db->close();

    }
}

?>