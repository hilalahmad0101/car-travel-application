<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model
{
    public function saveData($tableName, $data)
    {
        $this->db->insert($tableName, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getData($tableName, $whereArr)
    {
        $this->db->select('*');
        $this->db->where($whereArr);
        $result = $this->db->get($tableName);
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }
public function getUserToken($uniid)
{       
        $this->db->select('user_DeviseTokenId');
        $this->db->where('uniid',$uniid);
        return $this->db->get('api_cartravel_users')->row('user_DeviseTokenId');
}

    public function updateData($tableName, $dataArr, $whereArr)
    {        
        $this->db->where($whereArr);
        $status = $this->db->update($tableName, $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeData($tableName, $whereArr)
    {
        $this->db->where($whereArr);
        $this->db->delete($tableName);

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    public function getCitiesData($tableName)
    {
        $this->db->select('DISTINCT(user_City), user_District, user_State');
        $this->db->order_by('user_State', 'ASC');
        $result = $this->db->get($tableName);
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }


    public function regUsersList($tableName, $whereArr)
    {
        $this->db->select('user_Mobile_No, user_uniid, user_Profile_Photo, user_Name, user_Surname, uesr_Business_Name, user_Owner_Name');
        $this->db->where_in('user_Mobile_No', $whereArr, false);
        $result = $this->db->get($tableName);
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