<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('security');
		
        $this->load->model('api/Members_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function addMember()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));
            $inviteCode = xss_clean($this->input->post('inviteCode'));
            $groupName = xss_clean($this->input->post('groupName'));

            $dataArr = array(
                "sender_uniid" => $uniid,
                "sender_cid" => $cid,
                "sender_cartravels_id" => $cartravelID,
                "sender_invite_code" => $inviteCode,
                "group_name" => $groupName,
                "added_date" =>  date('Y-m-d H:i:s')
            );

            $status = $this->Members_model->put_addMember($dataArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Member Added";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Process, Try again.";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function getAddMembers()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));

            $whereArr = array(
                "sender_uniid" => $uniid,
                "sender_cid" => $cid,
                "sender_cartravels_id" => $cartravelID,
                "code_status" => 1,
                "service_status" => "Yes"
            );

            $data = $this->Members_model->get_addMembers($whereArr);

            if($data)
            {
                $json['error'] = "false";
                $json['addMembers'] = $data;
            }
            else
            {
                $json['error'] = "true";
                $json['addMembers'] = "No Data";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function updateAddMemberLatLong()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));

            $lat = xss_clean($this->input->post('lat'));
            $long = xss_clean($this->input->post('long'));

            $update = array(
                "Latitude" => $lat,
                "Longitude" => $long
            );

            $whereArr = array(
                "user_uniid" => $uniid,
                "user_cid" => $cid,
                "user_cartravels_id" => $cartravelID,
                "code_status" => 1,
                "service_status" => "Yes"
            );

            $status = $this->Members_model->updateLatLongAddMember($update, $whereArr);

            if($status == true)
            {
                $json['error'] = "false";
                $json['message'] = "Updated Lat Long";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Unable to Process, Try again.";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function updateAddMemberInviteCode()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));

            $inviteCode = xss_clean($this->input->post('inviteCode'));

            $update = array(
                "user_uniid" => $uniid,
                "user_cid" => $cid,
                "user_cartravels_id" => $cartravelID,
                "code_status" => 1,
                "service_status" => "Yes"
            );

            $whereArr = array(
                "sender_invite_code" => $inviteCode
            );

            $chkWhereArr = array(
                "sender_uniid" => $uniid,
                "sender_invite_code" => $inviteCode
            );

            $chkUserData = array(
                "user_uniid" => $uniid,
                "sender_invite_code" => $inviteCode
            );

            $chkCodeData = array(
                "sender_invite_code" => $inviteCode,
                "code_status" => 1,
                "service_status" => "Yes"
            );


            $chkData = $this->Members_model->get_ChkMembers($chkWhereArr);

            $chkUData = $this->Members_model->get_ChkMembers($chkUserData);

            $chkCData = $this->Members_model->get_ChkMembers($chkCodeData);

            if($chkData)
            {
                $json['error'] = "true";
                $json['message'] = "Sorry! Same Member can`t update.";
            }
            else
            {
                if($chkUData)
                {
                    $json['error'] = "true";
                    $json['message'] = "This InviteCode already Updated.";
                }
                else if($chkCData)
                {
                    $json['error'] = "true";
                    $json['message'] = "This InviteCode already Used.";
                }
                else
                {
                    $status = $this->Members_model->updateLatLongAddMember($update, $whereArr);

                    if($status == true)
                    {
                        $json['error'] = "false";
                        $json['message'] = "Updated InviteCode Successfully";
                    }
                    else
                    {
                        $json['error'] = "true";
                        $json['message'] = "Sorry! Unable to Process, Try again.";
                    }
                }
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function addMemberServices()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $uniid = xss_clean($this->input->post('uniid'));
            $cid = xss_clean($this->input->post('cid'));
            $cartravelID = xss_clean($this->input->post('cartravelID'));

            $whereArr = array(
                "m.user_uniid" => $uniid,
                "m.user_cid" => $cid,
                "m.user_cartravels_id" => $cartravelID,
                "m.code_status" => 1
            );

            $data = $this->Members_model->get_addServiceMembers($whereArr);

            if($data)
            {
                $json['error'] = "false";
                $json['addedTo'] = $data;
                $json['service'] = "Yes";
            }
            else
            {
                $json['error'] = "true";
                $json['addedTo'] = "No Data";
                $json['service'] = "No";
            }
        }
        else
        {
             $json['error'] = 'true';
             $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }


    public function deleteAddMember()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $senderUniid = $this->input->post("senderUniid");
            $memberID = $this->input->post("memberID");

            $data = $this->Members_model->removeAddMember($senderUniid, $memberID);

            if($data)
            {
                $json['error'] = "false";
                $json['message'] = "Add Member Deleted";
            }
            else
            {
                $json['error'] = "true";
                $json['message'] = "Sorry unable to Deleted";
            }
        }
        else
        {
            $json['error'] = "true";
            $json['message'] = "Unknown Method";
        }
        echo json_encode($json);
    }

    public function deleteTimeOutCodes()
    {
        $chkDate = date('Y-m-d H:i:s', strtotime('-2 days'));
        $status = $this->Members_model->delete_timeout_addMember($dataArr);
    }

}