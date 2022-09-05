<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SOSContacts_model extends CI_Model
{

    public function saveSOS($data)
    {
        $this->db->insert("api_cartravel_sos_numbers", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listSOS($whereArr)
    {
        $this->db->select('sos.*, sbc.user_Email as sos_email, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name');
        $this->db->from('api_cartravel_sos_numbers sos');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = sos.uniid', 'left');
        $this->db->join('api_cartravel_business_agencies sbc', 'sbc.user_Mobile_No = sos.sos_number', 'left');
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

    public function removeSOS($uid, $sid)
    {
        $this->db->query("DELETE FROM `api_cartravel_sos_numbers` WHERE `uniid` = '$uid' AND `sos_id` = '$sid'");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function acceptingSOS($mobile, $sToken)
    {
        $this->db->where("sos_number", $mobile);
        $this->db->update('api_cartravel_sos_numbers', array('sos_status'=> 1, 'sos_accepted_code'=>$sToken));

        if ($this->db->affected_rows() == 1) 
        {
            $whereArr = array("sos.sos_number" => $mobile, "sos_accepted_code" => $sToken);
            return $this->listSOS($whereArr);
        }
        else
        {
            return false;
        }
    }

}

?>