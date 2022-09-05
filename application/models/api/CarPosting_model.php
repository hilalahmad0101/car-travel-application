<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarPosting_model extends CI_Model
{

    public function saveDroppingCars($data)
    {
        $this->db->insert("api_cartravel_dropping_cars", $data);

        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $location = $data['location'];
            $notifyImage = $data['vehicle_images'];
            $notifyBody = $data['vehicle_type'];
            $pickupCity = $data['pickupCity'];
            $dropCity = $data['dropCity'];
            $dpID = $insert_id;


            $tt_dp_journdy_datetime = $data['journey_date']." ".$data['journey_time'];

            $this->load->model('api/Notifications_model');
            $nfReqData = array("notify_location" => $location);
            $notifyUsers = $this->Notifications_model->cityState($nfReqData);

            $body = $pickupCity." to ".$dropCity." ".$notifyBody." is available.";
            $img = $notifyImage;
            $title = "Dropping Cars";

            $postData = array("uniid" => $uniid, "dpID" => $dpID, "post_location" => $location, "tt_dp_journdy_datetime" => $tt_dp_journdy_datetime);
            $this->db->insert("api_cartravel_postings", $postData);
            $pid = $this->db->insert_id();
            if ($notifyUsers) 
            {
                $tokens = array();
                $notifyData = array();
                foreach ($notifyUsers as $n) 
                {
                    array_push($tokens,$n->user_DeviseTokenId);
                    array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "dpID" => $dpID, "notify_location" => $location, "postingID" => $pid));
                }
                
                $this->db->insert_batch("api_cartravel_notifications", $notifyData);
                $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
            }
        }
        return $pid;
    }

    public function updateDroppingCars($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_dropping_cars', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeDroppingCars($uid, $pid)
    {

        $this->db->select('*');
        $this->db->from('api_cartravel_bookings');
            $wrArr = array('ownerUniid' => $uid, 'postLabel' => 'dpID', 'postID' => $pid);
        $this->db->where($wrArr);
        $bookHistory = $this->db->get();

        $bookCount = count(($bookHistory->result()));

        if($bookCount === 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_dropping_cars` WHERE `uniid` = '$uid' AND `dpID` = '$pid'");
            if($this->db->affected_rows() > 0)
            {
                $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `dpID` = '$pid'");
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

    public function listMyDroppingCars($whereArr)
    {
        $this->db->select('dc.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_dropping_cars dc');
        $this->db->join('api_cartravel_postings p', 'p.uniid = dc.uniid AND p.dpID = dc.dpID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = dc.uniid', 'left');
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

    public function listDroppingCars($whereArr)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_dropping_cars');
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







    // today available cars
    public function saveTodayAvailableCars($data)
    {
        $this->db->insert("api_cartravel_tdacars", $data);

        $insert_id = $this->db->insert_id();
       if(!empty($insert_id))
       {
           $uniid = $data['uniid'];
           $tda_location = $data['tda_location'];
           $tdaID = $insert_id;


           $notifyImage = $data['tda_car_image'];
           $notifyBody = $data['tda_car_type'];

           $this->load->model('api/Notifications_model');
           $nfReqData = array("notify_location" => $tda_location);
           $notifyUsers = $this->Notifications_model->cityState($nfReqData);

           $body = $notifyBody. " available for booking.";
           $img = $notifyImage;
           $title = "Today Available Cars";

           $postData = array("uniid" => $uniid, "tdaID" => $tdaID, "post_location" => $tda_location, "tt_tda_date" => $data['tda_date']);
           $this->db->insert("api_cartravel_postings", $postData);
           $pid = $this->db->insert_id();
           if ($notifyUsers) 
           {
               $tokens = array();
               $notifyData = array();
               foreach ($notifyUsers as $n) 
               {
                   array_push($tokens,$n->user_DeviseTokenId);
                   array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "tdaID" => $tdaID, "notify_location" => $tda_location, "postingID" => $pid));
               }
               
               $this->db->insert_batch("api_cartravel_notifications", $notifyData);
               $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
           }
        }
return $pid;
    }

    public function updateTodayAvailableCars($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_tdacars', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateGroupPost($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_postings', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeTodayAvailableCar($uid, $pid)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_bookings');
            $wrArr = array('ownerUniid' => $uid, 'postLabel' => 'tdaID', 'postID' => $pid);
        $this->db->where($wrArr);
        $bookHistory = $this->db->get();

        $bookCount = count(($bookHistory->result()));

        if($bookCount <= 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_tdacars` WHERE `uniid` = '$uid' AND `tdaID` = '$pid'");
            if($this->db->affected_rows() > 0)
            {
                $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `tdaID` = '$pid'");
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

    public function listMyTodayCars($whereArr)
    {
        $this->db->select('t.*, p.postingID, bc.user_Mobile_No as my_mobile, bc.user_Name as my_user_Name, bc.user_Surname as my_user_Surname, bc.user_Owner_Name as my_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_tdacars t');
        $this->db->join('api_cartravel_postings p', 'p.uniid = t.uniid AND p.tdaID = t.tdaID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = t.uniid', 'left');
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

    public function listTodayCars($whereArr)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_tdacars');
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