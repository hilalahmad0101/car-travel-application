<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION

class Businesslistings_model extends CI_Model
{
   
    public function getGPSLiveLocation($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $this->db->order_by('updated_on', 'DESC');
        $result = $this->db->get('api_cartravel_gps');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function listMyAllGroupPostings($whereArr, $min = null)
    {
        $toDate = date("Y-m-d");

        $this->db->select('`p`.postingID, `p`.posting_booking_sts, `p`.uniid as myUniid, p.sdvID as selfDriving, p.tdaID as todayAvailCars, p.vcID as visitingCard,p.otherID as others,p.tpID as tourPackage,p.dpID as droppingCars, `sdv`.*, `tda`.*, `vc`.*, `otr`.*, `tt`.*, `dp`.*, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo, p.post_location, p.favourite');
        $this->db->from('api_cartravel_postings p');
        
        $this->db->join('api_cartravel_sdv sdv', 'sdv.uniid = p.uniid AND sdv.sdvID = p.sdvID', 'left');
        $this->db->join('api_cartravel_tdacars tda', "tda.uniid = p.uniid AND tda.tdaID = p.tdaID", 'left');
        $this->db->join('api_cartravel_vc vc', 'vc.uniid = p.uniid AND vc.vcID = p.vcID', 'left');
        $this->db->join('api_cartravel_others otr', 'otr.uniid = p.uniid AND otr.otherID = p.otherID', 'left');
        $this->db->join('api_cartravel_tours_travels tt', 'tt.uniid = p.uniid AND tt.tpID = p.tpID', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', "dp.uniid = p.uniid AND dp.dpID = p.dpID", 'left');


        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = p.uniid', 'left');
        $this->db->where($whereArr);
        $this->db->order_by('postingID', 'DESC');

        // if($min != '')
        // {
        //     $this->db->limit(25, $min);            
        // }
        // else
        // {
        //     $min = 0;
        //     $this->db->limit(25, $min);
        // }
        
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












    public function listAllDroppingCars($whereArr)
    {
        $this->db->select('dc.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_dropping_cars dc');
        $this->db->join('api_cartravel_postings p', 'p.uniid = dc.uniid AND p.dpID = dc.dpID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = dc.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllTodayCars($whereArr)
    {
        $this->db->select('t.*, p.postingID, bc.user_Mobile_No as my_mobile, bc.user_Name as my_user_Name, bc.user_Surname as my_user_Surname, bc.user_Owner_Name as my_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_tdacars t');
        $this->db->join('api_cartravel_postings p', 'p.uniid = t.uniid AND p.tdaID = t.tdaID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = t.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllVCs($whereArr)
    {
        $this->db->select('vc.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_vc vc');
        $this->db->join('api_cartravel_postings p', 'p.uniid = vc.uniid AND p.vcID = vc.vcID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = vc.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllOthers($whereArr)
    {
        $this->db->select('o.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_others o');
        $this->db->join('api_cartravel_postings p', 'p.uniid = o.uniid AND p.otherID = o.otherID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = o.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllTourPackages($whereArr)
    {
        $this->db->select('tour.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_tours_travels tour');
        $this->db->join('api_cartravel_postings p', 'p.uniid = tour.uniid AND p.tpID = tour.tpID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = tour.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllSelfDrivingvv($whereArr)
    {
        $this->db->select('v.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_sdv v');
        $this->db->join('api_cartravel_postings p', 'p.uniid = v.uniid AND p.sdvID = v.sdvID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = v.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllPostingJobs($whereArr)
    {
        $this->db->select('j.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_jobs j');
        $this->db->join('api_cartravel_postings p', 'p.uniid = j.uniid AND p.jobID = j.jobID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = j.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllTenders($whereArr)
    {
        $this->db->select('t.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_tenders t');
        $this->db->join('api_cartravel_postings p', 'p.uniid = t.uniid AND p.tendID = t.tendID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = t.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listAllAccBw($whereArr)
    {
        $this->db->select('acb.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_accbw acb');
        $this->db->join('api_cartravel_postings p', 'p.uniid = acb.uniid AND p.accID = acb.accID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = acb.uniid', 'left');
        $this->db->where($whereArr);
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

    public function listOfCities($whereArr)
    {
        $this->db->select('s.state_name, c.city_code, c.city_name');
        // $this->db->select('s.state_name, c.state_code, c.district_code, c.city_code, c.city_name, c.metropolitan');
        $this->db->from('api_cartravel_cities c');
        $this->db->join('api_cartravel_states s', 's.state_code = c.state_code', 'left');
        if($whereArr != 0)
        {
            $this->db->where($whereArr);    
        }
        
        $this->db->order_by('c.state_code', 'ASC');
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


    public function getBusinessCategories($whereArr, $arrayTwo = null, $uid = null)
    {
        $this->db->select('c.*, u.user_DeviseTokenId,  cr.ratings as myRating, cr.review as myReviewComment, avg(r.ratings) as avgRating, count(r.ratings) as ratingCount, GROUP_CONCAT(r.review SEPARATOR "#") as allReviews');
        $this->db->from('api_cartravel_business_agencies c');
        $this->db->join('api_cartravel_users u', 'u.uniid = c.user_uniid', 'left');

        // $this->db->from('api_cartravel_business_agencies ba');
        $this->db->join("api_cartravel_cate_favourite cf", "cf.uniid = '$uid' AND cf.cid = c.cid", 'left');
        $this->db->join("api_cartravel_cat_ratings cr", "cr.uniid = '$uid' AND cr.cid = c.cid", 'left');
        $this->db->join("api_cartravel_cat_ratings r", "r.cid = c.cid", 'left');

        $this->db->where($whereArr);
        if($arrayTwo != null)
        {
            $this->db->where_in("user_Business_Category", $arrayTwo);
        }
        // $this->db->order_by('c.user_Membership_Type', 'ASC');
        $this->db->order_by('user_Membership_Type ASC, user_Positions ASC');
        $this->db->group_by('c.cid');
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
}

?>