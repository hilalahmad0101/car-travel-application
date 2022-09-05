<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyRatings_model extends CI_Model
{
    public function saveRating($data)
    {
        $this->db->insert("api_cartravel_cat_ratings", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateRatings($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_cat_ratings', $data);
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