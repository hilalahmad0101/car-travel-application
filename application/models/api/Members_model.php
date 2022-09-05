<?php

class Members_model extends CI_Model
{ 
    public function put_addMember($data)
    {
        $this->db->insert("api_cartravel_addmembers", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_addMembers($whereArr)
    {
        $this->db->select('m.mid, m.group_name, bc.user_Business_Category, bc.uesr_Business_Name,  bc.user_Name, bc.user_Surname, bc.user_Proffession, bc.user_Mobile_No, bc.user_Alter_Mobile_No, bc.user_Owner_Name, bc.uesr_Business_Name, bc.user_Website_Url, bc.user_Profile_Photo, m.user_cid, m.user_cartravels_id, m.Longitude, m.Latitude,  m.code_status, d.share_code');
        $this->db->from('api_cartravel_addmembers m');
        
        // $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = m.user_uniid', 'left');
        // $this->db->join('api_driver_share d', 'd.driver_cid = m.user_cid', 'left');

        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = m.user_uniid', 'left');
        $this->db->join('api_driver_share d', 'd.driver_cid = m.user_cid AND d.share_uniid = m.sender_uniid', 'left');


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


    public function get_ChkMembers($whereArr)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_addmembers');
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

    public function get_addServiceMembers($whereArr)
    {
        $this->db->select('bc.user_Business_Category, bc.uesr_Business_Name,  bc.user_Name, bc.user_Surname, bc.user_Owner_Name, bc.uesr_Business_Name, bc.user_Profile_Photo, m.user_cid, m.user_cartravels_id, m.Longitude, m.Latitude,  m.code_status, m.service_status');
        $this->db->from('api_cartravel_addmembers m');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = m.sender_uniid', 'left');
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

    public function updateLatLongAddMember($dataArr, $whereArr)
    {        
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_addmembers', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete_timeout_addMember()
    {

        $status = $this->db->query('DELETE FROM `api_cartravel_addmembers` WHERE `api_cartravel_addmembers`.`added_date` < ');

         $old =  "2020-08-15 14:39:34";


        if($old < $chkDate)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
    }

    public function removeAddMember($uid, $mid)
    {
        $this->db->query("DELETE FROM `api_cartravel_addmembers` WHERE `sender_uniid` = '$uid' AND `mid` = '$mid'");
        if($this->db->affected_rows() > 0)
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