<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remainders_model extends CI_Model
{
    public function saveInsurance($data)
    {
        $this->db->insert("api_insurance_remainders", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateInsurance($data, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_insurance_remainders', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function InsuranceDetails($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_insurance_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function InsuranceDetails_web($arr)
    {
        $this->db->select('*');
        $this->db->where($arr);
        $result = $this->db->get('api_insurance_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }


    public function deleteInsurance($uid, $insid)
    {
        $this->db->query("DELETE FROM `api_insurance_remainders` WHERE `uniid` = '$uid' AND `insID` = $insid");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function InsuranceVehicleDetails($uid)
    {
        $this->db->select('ins_reg_number, ins_model_name');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_insurance_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function InsuranceVehicleDetails_web($arr)
    {
        $this->db->select('*');
        $this->db->where($arr);
        $result = $this->db->get('api_insurance_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }










    public function saveBookingRemainder($data)
    {
        $this->db->insert("api_booking_remainders", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateBookingRemainder($data, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_booking_remainders', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bookingRemainderDetails($uid)
    {
        $this->db->select('*');
        $this->db->where('uniid', $uid);
        $result = $this->db->get('api_booking_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    public function bookingRemainderDetails_web($arr)
    {
        $this->db->select('*');
        $this->db->where($arr);
        $result = $this->db->get('api_booking_remainders');
        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }


    public function deleteBookingRemainder($uid, $bkrid)
    {
        $this->db->query("DELETE FROM `api_booking_remainders` WHERE `uniid` = '$uid' AND `bkrID` = $bkrid");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateDriverAllocation($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_booking_remainders', $data);
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