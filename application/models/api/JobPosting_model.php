<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobPosting_model extends CI_Model
{

    // today available cars
    public function saveJobPosting($data)
    {
        $this->db->insert("api_cartravel_jobs", $data);


        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
            $uniid = $data['uniid'];
            $job_location = $data['job_location'];
            $jobID = $insert_id;

            $postData = array("uniid" => $uniid, "jobID" => $jobID, "post_location" => $job_location);
            $this->db->insert("api_cartravel_postings", $postData);
        }
return $this->db->insert_id();
    }

    public function listMyPostingJobs($whereArr)
    {
        $this->db->select('j.*, p.postingID, bc.user_Mobile_No as requested_mobile, bc.user_Name as requested_user_Name, bc.user_Surname as requested_user_Surname, bc.user_Owner_Name as requested_user_Owner_Name, bc.user_Profile_Photo');
        $this->db->from('api_cartravel_jobs j');
        $this->db->join('api_cartravel_postings p', 'p.uniid = j.uniid AND p.jobID = j.jobID', 'left');
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = j.uniid', 'left');
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


    public function updateJobPosting($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_jobs', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function removeJobPosting($uid, $pid)
    {
        $this->db->query("DELETE FROM `api_cartravel_jobs` WHERE `uniid` = '$uid' AND `jobID` = '$pid'");
        if($this->db->affected_rows() > 0)
        {
            $this->db->query("DELETE FROM `api_cartravel_postings` WHERE `uniid` = '$uid' AND `jobID` = '$pid'");

            return true;
        }
        else
        {
            return false;
        }
    }

}

?>