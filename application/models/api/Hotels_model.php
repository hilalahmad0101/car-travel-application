<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels_model extends CI_Model
{
    public function saveHotel($data)
    {
        $this->db->insert("api_cartravel_hotel_info", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateHotelInfo($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_hotel_info', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function hotelInfoList($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_cartravel_hotel_info');
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