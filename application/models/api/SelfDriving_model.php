<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelfDriving_model extends CI_Model
{

    // today available cars
    public function saveSelfDrivingvv($data)
    {
        $this->db->insert("api_cartravel_sdv", $data);

        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $sdv_location = $data['sdv_location'];
            $sdvID = $insert_id;

            $postData = array("uniid" => $uniid, "sdvID" => $sdvID, "post_location" => $sdv_location);
            $this->db->insert("api_cartravel_postings", $postData);
            $pid = $this->db->insert_id();


            $notifyImage = $data['sdv_image'];
            $notifyBody = $data['sdv_name'];

            $this->load->model('api/Notifications_model');
            $nfReqData = array("notify_location" => $sdv_location);
            $notifyUsers = $this->Notifications_model->cityState($nfReqData);

            $img = $notifyImage;
            $body = $notifyBody." available for Self Driving";
            $title = "Self Driving Vehicles";
            if ($notifyUsers) 
            {
                $tokens = array();
                $notifyData = array();
                foreach ($notifyUsers as $n) 
                {
                    array_push($tokens,$n->user_DeviseTokenId);
                    array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "sdvID" => $sdvID, "notify_location" => $sdv_location, "postingID" => $pid));
                }
               
                $this->db->insert_batch("api_cartravel_notifications", $notifyData);
                $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
            }
         
        }
return $pid;
    }



    public function updateSelfDrivingvv($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_sdv', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeSelfDrivingvv($uid, $pid)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_bookings');
            $wrArr = array('ownerUniid' => $uid, 'postLabel' => 'sdvID', 'postID' => $pid);
        $this->db->where($wrArr);
        $bookHistory = $this->db->get();

        $bookCount = count(($bookHistory->result()));

        if($bookCount === 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_sdv` WHERE `uniid` = '$uid' AND `sdvID` = '$pid'");
            if($this->db->affected_rows() > 0)
            {
                $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `sdvID` = '$pid'");
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return 'history';
        }
    }


    

    public function listMySelfDrivingvv($whereArr)
    {
        $this->db->select('v.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_sdv v');
        $this->db->join('api_cartravel_postings p', 'p.uniid = v.uniid AND p.sdvID = v.sdvID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = v.uniid', 'left');
        $this->db->where($whereArr);
        $result = $this->db->get();
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