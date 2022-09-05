<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmaps_model extends CI_Model
{
    public function updateLiveLatLong($dataArr, $whereArr)
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

    public function saveAddPlace($data)
    {
        $this->db->insert("api_cartravel_add_places", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listAddPlaces($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_cartravel_add_places');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function updateAddPlace($whereArr, $updateData)
    {        
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_add_places', $updateData);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveGPSLiveLocation($data)
    {
        $this->db->insert("api_cartravel_gps", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveGPSTrackLiveLocation($data)
    {
        $this->db->insert("api_cartravel_gps_tracking", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateGPSLiveLocation($uid, $data)
    {
        $this->db->where('uniid', $uid);
        $this->db->update('api_cartravel_gps', $data);

        if ($this->db->affected_rows() > 0) 
        {
            return true;
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


    public function updateFavourite($dataArr, $whereArr)
    {        
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_postings', $dataArr);
        if($this->db->affected_rows() == 1)
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