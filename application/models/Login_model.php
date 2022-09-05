<?php

class Login_model extends CI_Model
{

    public function saveData($data)
    {
        $this->db->insert("api_cartravel_users", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
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

    public function checkedemail($mobile)
    {
        $result = $this->db->query("SELECT `uniid`, `user_name`, `user_mobile`, `user_email`, `user_password`, `user_token`, `user_status`, `mobileVerification`, `emailVerification` FROM `api_cartravel_users` where `user_mobile` = '$mobile'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function checkMobile($mobile)
    {
        $result = $this->db->query("SELECT u.`user_name`, u.`user_mobile`, u.`uniid`, u.`user_email`, u.`user_password`, u.`user_token`, u.`user_status`, b.`cartravels_id` FROM `api_cartravel_users` u left join `api_cartravel_business_agencies` b ON b.`user_uniid` = u.`uniid` where u.`user_mobile` = '$mobile'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function updatePassCode($code, $uniid)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `code`='$code' where uniid = '$uniid' AND `user_status`='Active'");

        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePassword64($code, $uniid)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_passwordEnc`='$code' where uniid = '$uniid' AND `user_status`='Active'");

        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkedPassCode($code, $uniid)
    {
        // $result = $this->db->query("SELECT * FROM `api_cartravel_users` where `user_email` = '$mail'");
        $result = $this->db->query("SELECT `uniid` FROM `api_cartravel_users` where `code` = '$code' AND `uniid` = '$uniid'");
        if($result->num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function checkPassword($currentPwd, $uniid)
    {
        $result = $this->db->query("SELECT `user_password` FROM `api_cartravel_users` where `user_password` = '$currentPwd' AND `uniid` = '$uniid'");
        if($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }


    public function newPasswordUpdating($uniid, $code, $pwd)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_password`='$pwd' where uniid = '$uniid' AND code=$code");

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function chgPasswordUpdating($uniid, $pwd)
    {
        $this->db->query("UPDATE `api_cartravel_users` set `user_password`='$pwd' where uniid = '$uniid'");

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
    public function get_event_calls()
    {
        $result = $this->db->query("SELECT * FROM `api_event_cal`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function get_exp_categorys()
    {
        $result = $this->db->query("SELECT * FROM `api_exp_category`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function get_income_source()
    {
        $result = $this->db->query("SELECT * FROM `api_income_source`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }


    // type list

    public function get_exp_cat_list()
    {
        $result = $this->db->query("SELECT `expCat_name` FROM `api_expense_category_list`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }


    public function get_exp_type_list()
    {
        $result = $this->db->query("SELECT `expType_name` FROM `api_expense_type_list`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }


    public function get_inc_source_type_list()
    {
        $result = $this->db->query("SELECT `incSourceType_name` FROM `api_incsource_type_list`");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getDeviseToken($mobile)
    {
        $result = $this->db->query("SELECT `user_DeviseTokenId`, `uniid`, `user_mobile` FROM `api_cartravel_users` where `user_mobile` = '$mobile'");
        $data = $result->result();
        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function newDeviseTokenUpdating($uniid, $mobile, $dToken)
    {
        $this->db->where(array('uniid'=>$uniid, 'user_mobile'=>$mobile));
        $this->db->update('api_cartravel_users', array('user_DeviseTokenId'=>$dToken));

        if ($this->db->affected_rows() == 1) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function newUserLocationUpdating($uniid, $mobile, $uLocation)
    {
        $this->db->where(array('user_uniid'=>$uniid, 'user_Mobile_No'=>$mobile));
        $this->db->update('api_cartravel_business_agencies', array('user_location'=>$uLocation));

        if ($this->db->affected_rows() == 1) 
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