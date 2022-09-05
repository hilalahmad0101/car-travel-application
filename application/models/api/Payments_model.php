<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments_model extends CI_Model
{
    public function saveNewPayments($data)
    {
        $this->db->insert("api_cartravel_subscription_amounts", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function adsPaymentsList($payCat)
    {
        $this->db->select('*');
        $this->db->where('subscription_type', $payCat);
        $result = $this->db->get('api_cartravel_subscription_amounts');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }

    public function updatePaymentDetails($whereArr, $updateData)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_subscription_amounts', $updateData);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function payerDetails($uid)
    {
        $this->db->select('user_uniid, user_Name, user_Surname, user_Owner_Name, user_Email, user_Mobile_No');
        $this->db->where('user_uniid', $uid);
        $result = $this->db->get('api_cartravel_business_agencies');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }


    public function paymentDetails($rzoid)
    {
        $this->db->select('*');
        $this->db->where('razorpay_order_id', $rzoid);
        $result = $this->db->get('api_cartravel_payments');
        if($result->num_rows() > 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }


    public function saveTransactions($options)
    {
        $this->db->insert("api_cartravel_payments", $options);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function updatePaymentStatusMembership($cid, $pCode)
    {
        $this->db->where(array("cid" => $cid));
        $status = $this->db->update('api_cartravel_business_agencies', array("user_Membership_Type" => 2, "user_Membership_Date" => date('Y-m-d'), "user_payment_sts" => "Captured", "user_payment_code" => $pCode));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePaymentStatusMembershipFail($cid)
    {
        $this->db->where(array("cid" => $cid));
        $status = $this->db->update('api_cartravel_business_agencies', array("user_Membership_Date" => date('Y-m-d'), "user_payment_sts" => ""));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePaymentStatusAds($adID, $adDate, $adCode)
    {
        $this->db->where(array("adID" => $adID));
        $status = $this->db->update('api_cartravel_ads', array("ad_status" => "Live", "payment_sts" => "Captured", "ad_payment_date" => $adDate, "payment_code" => $adCode));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePaymentStatusAdsFail($adID)
    {
        $this->db->where(array("adID" => $adID));
        $status = $this->db->update('api_cartravel_ads', array("ad_status" => "Pending", "payment_sts" => null));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updatePaymentID($rzoid, $rzpsts, $rzpid)
    {
        $this->db->where(array("razorpay_order_id" => $rzoid));
        $status = $this->db->update('api_cartravel_payments', array("payment_id" => $rzpid, "payment_status" => $rzpsts));
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