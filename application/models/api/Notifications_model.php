<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model
{

    // today available cars
    public function cityNotifications($to, $body, $img, $title, $uid, $pid)
    {
        $this->cityNotificationsFlutter($to, $body, $img, $title, $uid, $pid);
        $this->cityNotificationsIosFlutter($to, $body, $img, $title, $uid, $pid);
    }
  
public function cityNotificationsIosFlutter($to, $body, $img, $title, $uid, $pid)
    {
        $curlHandler = curl_init();
        $headers = array('Content-Type: application/json', 
            'Authorization:key=AAAA0CV4BVA:APA91bFZDhA8uZEbNDaDSkO87Jz2uZAA_EhaKw9oI9_8t4irZ5BE6jAtgl9muJLVETzVjpZ9VyGmhMsA3dQJx_Idn2yUXPNCtSptim6jUcgvRiJIzCYLShlMIhRwWL05L2nnU-LY55g6');
            if(is_array($to))
            {
                $json['registration_ids'] = $to;
            }
            else{
                $json['to'] = $to;
            }
        $json['data']["body"] = $body;
        $json['notification']["body"] = $body;
        $json['data']["click_action"] = "FLUTTER_NOTIFICATION_CLICK";
        $json['data']["Title"] = $title;
        $json['notification']["title"] = $title;
        $json['data']["id1"] = $uid;
        $json['data']["id2"] = $pid;
        $json['data']["id3"] = "idThree";
        $json['data']["image"] = $img;
        $json['notification']["image"] = $img;
        $rawJson = json_encode($json);
        curl_setopt_array($curlHandler, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send?conte',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $rawJson
        ]);

        $response = curl_exec($curlHandler);

        curl_close($curlHandler);
    }

    public function cityNotificationsFlutter($to, $body, $img, $title, $uid, $pid)
    {
        $curlHandler = curl_init();
        $headers = array('Content-Type: application/json', 
            'Authorization:key=AAAAzUFOswI:APA91bHVhjx9VLg3ywZ8oPExQJzRmAEDHNHlB8E-x_Q9piYoxh04bsMYXb2h93MlVh3RiNJS6G9BUDGdaii-o_MD-l2KY8N_iVBNTY2_4Y3uzTDDzT1291VIXg0_Unccr8XNI-l0Wa68');

            if(is_array($to))
            {
                $json['registration_ids'] = $to;
            }
            else{
                $json['to'] = $to;
            }
        $json['data']["body"] = $body;
        $json['notification']["body"] = $body;
        $json['data']["click_action"] = "FLUTTER_NOTIFICATION_CLICK";
        $json['data']["Title"] = $title;
        $json['notification']["title"] = $title;
        $json['data']["id1"] = $uid;
        $json['data']["id2"] = $pid;
        $json['data']["id3"] = "idThree";
        $json['data']["image"] = $img;
        $json['notification']["image"] = $img;
        $rawJson = json_encode($json);
        curl_setopt_array($curlHandler, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send?conte',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $rawJson
        ]);

        $response = curl_exec($curlHandler);
        
        curl_close($curlHandler);
    }


    public function cityState($data)
    {
        $whereArr = array('ba.user_location' => $data['notify_location']);

        $this->db->select('ba.user_location, ba.user_Mobile_No, ba.user_uniid, u.user_DeviseTokenId');
        $this->db->from("api_cartravel_business_agencies ba");
        $this->db->join('api_cartravel_users u', 'u.uniid = ba.user_uniid', 'left');
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


    public function grabSendingNotifications($whereArr)
    {
        $this->db->select('ba.user_location, ba.user_Mobile_No, ba.user_uniid, u.user_DeviseTokenId');
        $this->db->from("api_cartravel_business_agencies ba");
        $this->db->join('api_cartravel_users u', 'u.uniid = ba.user_uniid', 'left');
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

    public function listMyNotifications($uniid)
    {
        $this->db->select('nt.notifyID, nt.postingID, nt.receiver_uniid as myUniid, 
            nt.sender_uniid as postUniid, 
            nt.sdvID as selfDriving, sdv.*,
            nt.tdaID as todayAvailCars, tda.*,
            nt.otherID as Others, other.*,
            nt.tpID as tourPackage, tp.*,
            nt.dpID as droppingCars, dp.*,
            nt.accID as accBreakdown, acc.*,
            nt.pro_id as promotion_id, pro.*,

            bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo,
            nt.read_status as readStatus');
        $this->db->from('api_cartravel_notifications nt');
        
        $this->db->join('api_cartravel_sdv sdv', 'sdv.sdvID = nt.sdvID', 'left');
        $this->db->join('api_cartravel_tdacars tda', 'tda.tdaID = nt.tdaID', 'left');
        $this->db->join('api_cartravel_others other', 'other.otherID = nt.otherID', 'left');
        $this->db->join('api_cartravel_tours_travels tp', 'tp.tpID = nt.tpID', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', 'dp.dpID = nt.dpID', 'left');
        $this->db->join('api_cartravel_accbw acc', 'acc.accID = nt.accID', 'left');
        $this->db->join('api_cartravel_promotions pro', 'pro.pro_id = nt.pro_id', 'left');

        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = nt.sender_uniid', 'left');

        $this->db->where('nt.receiver_uniid', $uniid);
        $this->db->order_by('notifyID', 'DESC');
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


    public function updateNotificationStatus($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_notifications', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    public function clearMyNotifications($uid)
    {
        $this->db->query("DELETE FROM `api_cartravel_notifications` WHERE `receiver_uniid` = '$uid'");

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
