<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function getProfile($cid)
    {
        $this->db->select('*');
        $this->db->where('cartravels_id', $cid);
        $result = $this->db->get('api_cartravel_business_agencies');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }


    public function getRegUserData($cid)
    {
        $this->db->select('ba.*, s.`state_code` as stateCode, d.`district_code` as district_code, c.`city_code` as city_code, c.`metropolitan` as metropolitan');
        $this->db->from('api_cartravel_business_agencies ba');
        $this->db->join('api_cartravel_states s', 's.state_name = ba.user_State', 'left');
        $this->db->join('api_cartravel_districts d', 'd.district_name = ba.user_District AND d.state_code = s.`state_code`', 'left');
        $this->db->join('api_cartravel_cities c', 'c.city_name = ba.user_City AND d.district_code = d.`district_code` AND d.state_code = s.`state_code`', 'left');
        $this->db->where('cartravels_id', $cid);
        $result = $this->db->get();
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }
   
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

    public function listMyGroupPostingsWeb($whereArr)
    {
        $this->db->select('`p`.postingID, `p`.uniid as myUniid, p.sdvID as selfDriving, p.tdaID as todayAvailCars, p.vcID as visitingCard,p.otherID as others,p.tpID as tourPackage,p.dpID as droppingCars,p.accID as Accident, p.jobID as Jobs, p.tendID as Tenders, `sdv`.*, `tda`.*, `vc`.*, `otr`.*, `tt`.*, `dp`.*, `acc`.*, `job`.*, `tend`.*, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo, p.post_location, p.favourite');
        $this->db->from('api_cartravel_postings p');
        
        $this->db->join('api_cartravel_sdv sdv', 'sdv.uniid = p.uniid AND sdv.sdvID = p.sdvID', 'left');
        $this->db->join('api_cartravel_tdacars tda', 'tda.uniid = p.uniid AND tda.tdaID = p.tdaID', 'left');
        $this->db->join('api_cartravel_vc vc', 'vc.uniid = p.uniid AND vc.vcID = p.vcID', 'left');
        $this->db->join('api_cartravel_others otr', 'otr.uniid = p.uniid AND otr.otherID = p.otherID', 'left');
        $this->db->join('api_cartravel_tours_travels tt', 'tt.uniid = p.uniid AND tt.tpID = p.tpID', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', 'dp.uniid = p.uniid AND dp.dpID = p.dpID', 'left');

        $this->db->join('api_cartravel_accbw acc', 'acc.uniid = p.uniid AND acc.accID = p.accID', 'left');
        $this->db->join('api_cartravel_jobs job', 'job.uniid = p.uniid AND job.jobID = p.jobID', 'left');
        $this->db->join('api_cartravel_tenders tend', 'tend.uniid = p.uniid AND tend.tendID = p.tendID', 'left');

        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = p.uniid', 'left');
        $this->db->where($whereArr);
        $this->db->order_by('postingID', 'DESC');
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

    public function getPlaces($cityCode)
    {
        $result = $this->db->query("SELECT `place_code`, `place_name` FROM `api_cartravel_places` where `city_code` = '$cityCode'  ORDER BY `api_cartravel_places`.`place_name` ASC");
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

    public function get_state_districts_data($stateCode)
    {
        $result = $this->db->query("SELECT `district_code`, `district_name` FROM `api_cartravel_districts` WHERE `state_code` = '$stateCode'  ORDER BY `api_cartravel_districts`.`district_name` ASC");
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

    public function get_state_districts_cities_data($districtCode)
    {
        $result = $this->db->query("SELECT `city_code`, `city_name` FROM `api_cartravel_cities` WHERE `district_code` = '$districtCode' AND `metropolitan` = 1 ORDER BY `api_cartravel_cities`.`city_name` ASC");
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


    public function getCities($stCode,$distCode)
    {
        $result = $this->db->query("SELECT `city_code`, `city_name`, `metropolitan` FROM `api_cartravel_cities` where `state_code` = '$stCode' AND `district_code` = '$distCode' ORDER BY `api_cartravel_cities`.`city_name` ASC");
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

    public function listSOS($whereArr)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_sos_numbers');
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

    public function searchCustomWebUrl($weburl)
    {
        $this->db->select('cartravels_id');
        $this->db->from('api_cartravel_business_agencies');
        $this->db->where('user_Website_Url', "$weburl");
        $result = $this->db->get();
        if($result->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    } 
}

?>