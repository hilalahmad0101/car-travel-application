<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postings_model extends CI_Model
{

    // Visiting Card Promotions
    public function saveVC($data)
    {
        $this->db->insert("api_cartravel_vc", $data);
        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $vc_location = $data['vc_location'];
            $vc = $insert_id;

            $postData = array("uniid" => $uniid, "vcID" => $vc, "post_location" => $vc_location);

            $this->db->insert("api_cartravel_postings", $postData);
        }

        return  $this->db->insert_id();
    }


    public function updateVC($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_vc', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function removeVC($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_vc` WHERE `uniid` = '$uid' AND `vcID` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `vcID` = '$pid'");
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listMyVCs($whereArr)
    {
        $this->db->select('vc.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_vc vc');
        $this->db->join('api_cartravel_postings p', 'p.uniid = vc.uniid AND p.vcID = vc.vcID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = vc.uniid', 'left');
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




    // Posting Others
    public function saveOthers($data)
    {
        $this->db->insert("api_cartravel_others", $data);
        
        $insert_id = $this->db->insert_id();
        
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $other_location = $data['other_location'];
            $otherID = $insert_id;

            $postData = array("uniid" => $uniid, "otherID" => $otherID, "post_location" => $other_location);
            $this->db->insert("api_cartravel_postings", $postData);
            $pid = $this->db->insert_id();


            $notifyImage = $data['other_image'];
            $notifyBody = $data['other_title'];
            $notifyDesc = $data['other_desc'];

            $this->load->model('api/Notifications_model');
            $nfReqData = array("notify_location" => $other_location);
            $notifyUsers = $this->Notifications_model->cityState($nfReqData);

            $img = $notifyImage;
            $body = $notifyBody." - ".$notifyDesc;
            $title = $notifyBody;
            if ($notifyUsers) 
            {
                $tokens = array();
                $notifyData = array();
                foreach ($notifyUsers as $n) 
                {
                    array_push($tokens,$n->user_DeviseTokenId);
                    array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "otherID" => $otherID, "notify_location" => $other_location, "postingID" => $pid));
                }
                $this->db->insert_batch("api_cartravel_notifications", $notifyData);
                $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
            }
           
        }
return $pid;
    }

    public function updateOthers($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_others', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeOthers($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_others` WHERE `uniid` = '$uid' AND `otherID` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `otherID` = '$pid'");
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listMyOthers($whereArr)
    {
        $this->db->select('o.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_others o');
        $this->db->join('api_cartravel_postings p', 'p.uniid = o.uniid AND p.otherID = o.otherID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = o.uniid', 'left');
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






    // Posting Accident / breakdown
    public function saveAccBw($data)
    {
        $this->db->insert("api_cartravel_accbw", $data);


        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $accbw_location = $data['accbw_location'];
            $accID = $insert_id;

            $postData = array("uniid" => $uniid, "accID" => $accID, "post_location" => $accbw_location);
            $this->db->insert("api_cartravel_postings", $postData);
            $pid = $this->db->insert_id();

            $notifyImage = $data['accbw_image'];
            $notifyBody = $data['accbw_title'].' - '.$data['accbw_dedication'];

            $this->load->model('api/Notifications_model');
            $nfReqData = array("notify_location" => $accbw_location);
            $notifyUsers = $this->Notifications_model->cityState($nfReqData);

            $body = $notifyBody;
            $img = $notifyImage;
            $title = "Need Help";
            if ($notifyUsers) 
            {
                $tokens = array();
                $notifyData = array();
                foreach ($notifyUsers as $n) 
                {
                    array_push($tokens,$n->user_DeviseTokenId);
                    array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "accID" => $accID, "notify_location" => $accbw_location, "postingID" => $pid));
                }
                $this->db->insert_batch("api_cartravel_notifications", $notifyData);
                $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
            }
          
        }
return $pid;
    }

    public function updateAccBw($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_accbw', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeAccBw($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_accbw` WHERE `uniid` = '$uid' AND `accID` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `accID` = '$pid'");
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listMyAccBw($whereArr)
    {
        $this->db->select('acb.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_accbw acb');
        $this->db->join('api_cartravel_postings p', 'p.uniid = acb.uniid AND p.accID = acb.accID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = acb.uniid', 'left');
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



    // Posting Tour packages
    public function saveTourTravels($data)
    {
        $this->db->insert("api_cartravel_tours_travels", $data);

        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $tour_post_location = $data['tour_post_location'];
            $tourPacID = $insert_id;

            $postData = array("uniid" => $uniid, "tpID" => $tourPacID, "post_location" => $tour_post_location);
            $this->db->insert("api_cartravel_postings", $postData);
            $pid = $this->db->insert_id();

            $notifyImage = $data['tourp_image'];
            $notifyBody = $data['tour_package_name']." ".$data['tour_description']." - Tour Package available.";

            $this->load->model('api/Notifications_model');
            $nfReqData = array("notify_location" => $tour_post_location);
            $notifyUsers = $this->Notifications_model->cityState($nfReqData);

            $img = $notifyImage;
            $body = $notifyBody;
            $title = "Tour Packages";
            if ($notifyUsers) 
            {
                $tokens = array();
                $notifyData = array();
                foreach ($notifyUsers as $n) 
                {
                    array_push($tokens,$n->user_DeviseTokenId);
                    array_push($notifyData,array("sender_uniid" => $uniid, "receiver_uniid" => $n->user_uniid, "tpID" => $tourPacID, "notify_location" => $tour_post_location, "postingID" => $pid));
                }
                $this->db->insert_batch("api_cartravel_notifications", $notifyData);
                $this->Notifications_model->cityNotifications($tokens, $body, $img, $title, $uniid, $pid);
            }
        }
      return $pid;
    }

    public function updateTourTravels($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_tours_travels', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeTourTravels($uid, $pid)
    {
        $this->db->select('*');
        $this->db->from('api_cartravel_bookings');
            $wrArr = array('ownerUniid' => $uid, 'postLabel' => 'tpID', 'postID' => $pid);
        $this->db->where($wrArr);
        $bookHistory = $this->db->get();

        $bookCount = count(($bookHistory->result()));

        if($bookCount === 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_tours_travels` WHERE `uniid` = '$uid' AND `tpID` = '$pid'");
            if($this->db->affected_rows() > 0)
            {
                $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `tpID` = '$pid'");
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

    public function listMyTourPackages($whereArr)
    {
        $this->db->select('tour.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_tours_travels tour');
        $this->db->join('api_cartravel_postings p', 'p.uniid = tour.uniid AND p.tpID = tour.tpID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = tour.uniid', 'left');
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

    public function listMyAllGroupPostings($whereArr, $myUniid, $min = null)
    {
        $toDate = date("Y-m-d");
        // $toDate = date("Y-m-d");

        $this->db->select('`p`.gpost_status, `p`.postingID, `p`.posting_booking_sts, `p`.uniid as myUniid, p.sdvID as selfDriving, p.tdaID as todayAvailCars, p.vcID as visitingCard,p.otherID as others,p.tpID as tourPackage,p.dpID as droppingCars, `sdv`.*, `tda`.*, `vc`.*, `otr`.*, `tt`.*, `dp`.*, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo, p.post_location, p.favourite, fav.favourite as Fav');
        $this->db->from('api_cartravel_postings p');
        
        $this->db->join('api_cartravel_sdv sdv', 'sdv.uniid = p.uniid AND sdv.sdvID = p.sdvID', 'left');
        $this->db->join('api_cartravel_tdacars tda', 'tda.uniid = p.uniid AND tda.tdaID = p.tdaID AND tda.tda_date = "'.$toDate.'"', 'left');
        // $this->db->join('api_cartravel_tdacars tda', "tda.uniid = p.uniid AND tda.tdaID = p.tdaID AND tda.tda_date = '2020-12-12", 'left');
        $this->db->join('api_cartravel_vc vc', 'vc.uniid = p.uniid AND vc.vcID = p.vcID', 'left');
        $this->db->join('api_cartravel_others otr', 'otr.uniid = p.uniid AND otr.otherID = p.otherID', 'left');
        $this->db->join('api_cartravel_tours_travels tt', 'tt.uniid = p.uniid AND tt.tpID = p.tpID', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', 'dp.uniid = p.uniid AND dp.dpID = p.dpID AND dp.journey_date >= "'.$toDate.'"', 'left');
        // $this->db->join('api_cartravel_dropping_cars dp', "dp.uniid = p.uniid AND dp.dpID = p.dpID", 'left');
        
        if(!empty($myUniid))
        {
            $this->db->join('api_cartravel_favourite fav', "fav.pid = p.postingID AND fav.uniid = '$myUniid'", 'left');
        }

        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = p.uniid', 'left');
        $this->db->where($whereArr);
        $this->db->order_by('postingID', 'DESC');

        if($min != '')
        {
            $this->db->limit(25, $min);            
        }
        else
        {
            $min = 0;
            $this->db->limit(25, $min);
        }
        
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




    public function listMyGroupPostings($whereArr)
    {
        $this->db->select('`p`.gpost_status, `p`.postingID, `p`.uniid as myUniid, p.sdvID as selfDriving, p.tdaID as todayAvailCars, p.vcID as visitingCard,p.otherID as others,p.tpID as tourPackage,p.dpID as droppingCars,p.accID as Accident, p.jobID as Jobs, p.tendID as Tenders, `sdv`.*, `tda`.*, `vc`.*, `otr`.*, `tt`.*, `dp`.*, `acc`.*, `job`.*, `tend`.*, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo, p.post_location, p.favourite');
        $this->db->from('api_cartravel_postings p');
        
        $this->db->join('api_cartravel_sdv sdv', 'sdv.uniid = p.uniid AND sdv.sdvID = p.sdvID', 'left');
        $this->db->join('api_cartravel_tdacars tda', 'tda.uniid = p.uniid AND tda.tdaID = p.tdaID', 'left');
        $this->db->join('api_cartravel_vc vc', 'vc.uniid = p.uniid AND vc.vcID = p.vcID', 'left');
        $this->db->join('api_cartravel_others otr', 'otr.uniid = p.uniid AND otr.otherID = p.otherID', 'left');
        $this->db->join('api_cartravel_tours_travels tt', 'tt.uniid = p.uniid AND tt.tpID = p.tpID', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', 'dp.uniid = p.uniid AND dp.dpID = p.dpID', 'left');

        $this->db->join('api_cartravel_accbw acc', 'acc.uniid = p.uniid AND acc.accID = p.accID', 'left');
        $this->db->join('api_cartravel_jobs job', 'job.uniid = p.uniid AND job.jobID = p.jobID', 'left');
        $this->db->join('api_cartravel_tenders tend', 'tend.uniid = p.uniid AND tend.tendID = p.tendID', 'left');

        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = p.uniid', 'left');
        $this->db->where($whereArr);
        $this->db->order_by('postingID', 'DESC');
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