<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyFavourites_model extends CI_Model
{
    public function saveFavourite($data)
    {
        $this->db->insert("api_cartravel_favourite", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeFavourite($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_favourite` WHERE `uniid` = '$uid' AND `pid` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveCatFavourite($data)
    {
        $this->db->insert("api_cartravel_cate_favourite", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeCatFavourite($uid, $cid)
    {
        $this->db->query("DELETE FROM `api_cartravel_cate_favourite` WHERE `uniid` = '$uid' AND `cid` = '$cid'");
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