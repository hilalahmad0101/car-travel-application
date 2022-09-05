<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenders_model extends CI_Model
{

    // today available cars
    public function saveTender($data)
    {
        $this->db->insert("api_cartravel_tenders", $data);




        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $tend_location = $data['tend_location'];
            $tendID = $insert_id;

            $postData = array("uniid" => $uniid, "tendID" => $tendID, "post_location" => $tend_location);

            $this->db->insert("api_cartravel_postings", $postData);
        }

return $this->db->insert_id();
    }


    public function updateTender($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_tenders', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeTender($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_tenders` WHERE `uniid` = '$uid' AND `tendID` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `tendID` = '$pid'");

            return true;
        }
        else
        {
            return false;
        }
    }

    public function listMyTenders($whereArr)
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

}

?>