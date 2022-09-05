<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusinessGallery_model extends CI_Model
{
    public function saveGalleryImage($data)
    {
        $this->db->insert("api_cartravel_business_gallery", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function imageGalleryList($uid, $cat)
    {
        $this->db->select('*');
        $this->db->where(array('uniid'=> $uid, 'g_business_cat' => $cat));
        $result = $this->db->get('api_cartravel_business_gallery');
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