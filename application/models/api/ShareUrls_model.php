<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareUrls_model extends CI_Model
{
    public function saveShareUrl($data)
    {
        $this->db->insert("api_driver_share", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveSOSShareUrl($data)
    {
        $this->db->insert("api_sos_share", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeShareCode($toDay)
    {
        $this->db->query("DELETE FROM `api_driver_share` WHERE `share_date` < '$toDay' ");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function stopShareCode($cid, $code)
    {
        $this->db->query("DELETE FROM `api_driver_share` WHERE `share_code` = '$code' AND `driver_cid` = $cid");
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