<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model
{
    public function saveRating($data)
    {
        $this->db->insert("api_cartravel_cat_ratings", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateRating($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_cat_ratings', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getEnqSendingData($whereArr, $uid, $cKey)
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
        
        // $this->db->order_by('cid ASC, user_Business_Category ASC');
        // $this->db->order_by(array('cid' => "ASC", 'user_Business_Category' => "ASC"));
        $this->db->order_by('user_Business_Category ASC, user_Membership_Type ASC, user_Positions ASC, user_Membership_Date ASC, cid ASC');

        // SELECT * FROM `api_cartravel_business_agencies` WHERE (user_Business_Category = "CarTravelsOffices" OR user_Business_Category = "OwnerCumDrivers") AND user_location = "Anantapur, Andhra Pradesh" AND user_Keywords LIKE "%%" ORDER BY `user_Membership_Type` ASC, user_Positions ASC, user_Membership_Date ASC, cid ASC

        // SELECT * FROM `api_cartravel_business_agencies` WHERE (user_Business_Category = "CarTravelsOffices" OR user_Business_Category = "OwnerCumDrivers") AND user_location = "Anantapur, Andhra Pradesh" AND user_Keywords LIKE "%%" ORDER BY `user_Membership_Type` ASC, user_Positions ASC, user_Membership_Date ASC, cid ASC

        $this->db->group_by('cid');
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

    public function sendEnquiry($data)
    {
        $this->db->insert("api_cartravel_enquiry", $data);
        $booking_id = $this->db->insert_id();

        if ($this->db->affected_rows() > 0)
        {
            return $booking_id;
        }
        else
        {
            return false;
        }
    }
}

?>