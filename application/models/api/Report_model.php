<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function save_sendReport($data)
    {
        $this->db->insert("api_cartravel_report_post", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function reportDetails($uid)
    {
        $this->db->select('*');
        $this->db->where('reporter_uniid', $uid);
        $result = $this->db->get('api_cartravel_report_post');
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