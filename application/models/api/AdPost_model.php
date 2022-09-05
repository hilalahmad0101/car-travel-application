<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdPost_model extends CI_Model
{
    public function postAd($data)
    {
        $this->db->insert("api_cartravel_ads", $data);
        $adID = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $adID;
        }
        else
        {
            return false;
        }
    }

    public function updatePostAd($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_ads', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function adsList($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_cartravel_ads');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function adInformation($arr)
    {
        $this->db->select('*');
        $this->db->where($arr);
        $result = $this->db->get('api_cartravel_ads');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function adDetails($location, $type)
    {
        $this->db->select('*');

        $this->db->where(array(
            "ad_location like " => "%$location%", 
            "ad_display_type" => $type, 
            "ad_status" => "Live", 
            "payment_sts" => "Captured")
        );

        $this->db->order_by('rand()');
        $this->db->limit(1);
        $result = $this->db->get('api_cartravel_ads');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function adCategoryDetails($location, $type, $bCat)
    {
        $this->db->select('*');

        $this->db->where(array(
            "ad_location like " => "%$location%", 
            "ad_display_type" => $type, 
            "ad_business_cat" => $bCat, 
            "ad_status" => "Live", 
            "payment_sts" => "Captured")
        ); 

        $this->db->order_by('rand()');
        $this->db->limit(1);
        $result = $this->db->get('api_cartravel_ads');
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