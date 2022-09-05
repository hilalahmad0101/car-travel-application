<?php

class ShareTracking_model extends CI_Model
{ 

    public function get_getDriverSharedLocation($whereArr)
    {
        $this->db->select('md.Longitude, md.Latitude, m.did, m.share_date, m.shareto_mobile, bc.user_Business_Category, bc.uesr_Business_Name,  bc.user_Name, bc.user_Surname, bc.user_Proffession, bc.user_Mobile_No, bc.user_Alter_Mobile_No, bc.user_Owner_Name, bc.uesr_Business_Name, bc.user_Website_Url, bc.user_Profile_Photo');
        $this->db->from('api_driver_share m');
        $this->db->join('api_cartravel_addmembers md', 'md.user_cid = m.driver_cid', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.cid = m.driver_cid', 'left');
        $this->db->where($whereArr);
        $data = $this->db->get();
        if($data->num_rows() > 0)
        {
            return $data->result();
        }
        else
        {
            return false;
        }
    }

    public function get_getDriverSharedLocations($whereArr)
    {
        $this->db->select('sd.*, bc.user_Name, bc.user_Surname, bc.user_Proffession, bc.uesr_Business_Name, bc.user_Owner_Name, bc.user_Profile_Photo, bc.user_Mobile_No, bc.user_Alter_Mobile_No, bc.live_lat as Latitude, bc.live_long as Longitude');
        $this->db->from('api_driver_share sd');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.cid = sd.driver_cid', 'left');
        $this->db->where($whereArr);
        $data = $this->db->get();
        if($data->num_rows() > 0)
        {
            return $data->result();
        }
        else
        {
            return false;
        }
    }

    public function get_getSOSLocations($whereArr)
    {
        $this->db->select('ss.*, bc.user_Name, bc.user_Surname, bc.user_Proffession, bc.uesr_Business_Name, bc.user_Owner_Name, bc.user_Profile_Photo, bc.user_Mobile_No, bc.user_Alter_Mobile_No, bc.live_lat as Latitude, bc.live_long as Longitude');
        $this->db->from('api_sos_share ss');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = ss.sos_uniid', 'left');
        $this->db->where($whereArr);
        $data = $this->db->get();
        if($data->num_rows() > 0)
        {
            return $data->result();
        }
        else
        {
            return false;
        }
    }
}

?>