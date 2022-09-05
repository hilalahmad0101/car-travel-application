<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postshare_model extends CI_Model
{
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


        print_r($this->db->last_query());
        exit;

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