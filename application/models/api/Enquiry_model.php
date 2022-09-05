<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model
{
    public function getEnqSendingData($whereArr, $uid, $cKey, $min)
    {
        $this->db->select('ba.user_uniid, ba.user_Business_Category, ba.user_Mobile_No, ba.user_State, ba.user_City, ba.user_Keywords, ba.user_Membership_Type, ba.user_Positions, ba.uesr_Business_Name,ba.user_Name, ba.user_Surname,ba.user_Email, ba.user_Membership_Date, ur.user_DeviseTokenId');
        $this->db->from('api_cartravel_business_agencies ba');

        $this->db->join("api_cartravel_users ur", "ur.user_mobile = ba.user_Mobile_No", 'left');


        if(array_key_exists('user_Business_Category', $whereArr))
        {
            if($whereArr['user_Business_Category'] == 'CarTravelsOffices')
            {
                $names = array('CarTravelsOffices', 'OwnerCumDrivers');
                $this->db->where_in('user_Business_Category', $names);

                if(!empty($whereArr['user_City']) && !empty($whereArr['user_State']))
                {
                    $wr = array(
                        "user_City" => $whereArr['user_City'], 
                        "user_State" => $whereArr['user_State'],  
                        "user_Keywords like " => "%$cKey%"
                    );
                    $this->db->where($wr);
                }
                else if(!empty($whereArr['user_State']))
                {
                    $wr = array(
                        "user_State" => $whereArr['user_State'],  
                        "user_Keywords like " => "%$cKey%"
                    );
                    $this->db->where($wr);
                }
            }
            else
            {
                $this->db->where($whereArr);
            }
        }
        else
        {
            $this->db->where($whereArr);
        }
        
        $this->db->order_by('user_Business_Category ASC, user_Membership_Type ASC, user_Positions ASC, user_Membership_Date ASC, cid ASC');

        if($min == 'WebEnquiryLimit')
        {
            $this->db->limit(10);            
        }
        // else
        // {
        //     $min = 0;
        //     $this->db->limit(10, $min);
        // }

        $this->db->group_by('cid');
        $result = $this->db->get();

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

    public function sendEnquiry($data)
    {
        $this->db->insert("api_cartravel_enquiry", $data);
        $booking_id = $this->db->insert_id();

        if ($this->db->affected_rows() > 0)
        {
            return $booking_id;
        }
        else
        {
            return false;
        }
    }

    public function listEnquiries($wrArr)
    {
        $this->db->select('`enq`.*, 
            er.user_Mobile_No as enqOwner_ownerMobile, 
            er.user_Name as enqOwner_userName, 
            er.user_Surname as enqOwner_userSurname, 
            er.user_Owner_Name as enqOwner_ownerName, 
            er.user_Profile_Photo as enqOwner_profilePhoto,
            er.user_Email as enqOwner_email,

            es.user_Mobile_No as enqUser_ownerMobile, 
            es.user_Name as enqUser_userName, 
            es.user_Surname as enqUser_userSurname, 
            es.user_Owner_Name as enqUser_ownerName, 
            es.user_Profile_Photo as enqUser_profilePhoto,
            es.user_Email as enqUser_email
        ');

        $this->db->from('api_cartravel_enquiry enq');
        
        $this->db->join('api_cartravel_business_agencies er', 'er.user_uniid = enq.ownerUniid', 'left');
        $this->db->join('api_cartravel_business_agencies es', 'es.user_uniid = enq.uniid', 'left');
        $this->db->where($wrArr);
        $this->db->order_by('enq.enquiryID', 'DESC');
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

    public function listResEnquiries($wrArr)
    {
        $this->db->select('

            enq.enquiryType,
            enq.enq_tour_couple,
            enq.enq_user_key,
            enq.uniid,
            enq.enq_preferred_vehicle,
            enq.enq_pickup_city,
            enq.enq_drop_city,
            
            enq.enq_depart_date,
            enq.enq_depart_time,
            enq.enq_return_date,
            enq.enq_return_time,
            enq.enq_trip,
            enq.enq_trip_type,
            
            enq.enq_date,

            es.user_Mobile_No as enqUser_ownerMobile, 
            es.user_Name as enqUser_userName, 
            es.user_Surname as enqUser_userSurname, 
            es.user_Owner_Name as enqUser_ownerName, 
            es.user_Profile_Photo as enqUser_profilePhoto,
            es.user_Email as enqUser_email
        ');

        $this->db->from('api_cartravel_enquiry enq');
        
        $this->db->join('api_cartravel_business_agencies es', 'es.user_uniid = enq.uniid', 'left');
        $this->db->where($wrArr);
        $this->db->order_by('enq.enquiryID', 'DESC');
        $this->db->group_by('enq_user_key');
        // $this->db->limit(1);
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

    public function respondedEnquiries($wrArr)
    {
        $this->db->select('
            enq.enquiryID,

            enq.enquiryType,
            enq.enq_user_key, 
            enq.uniid, 
            enq.ownerUniid,
            enq.enq_self_driving_info,
            enq.enq_tour_package_info,
            enq.enq_min_km, 
            enq.enq_per_km, 
            enq.enq_ext_km, 
            enq.enq_tour_couple,

            enq.enq_tour_single_nos,
            enq.enq_tour_child_nos,
            enq.enq_tour_couple_nos,

            enq.enq_driver_batha, 
            enq.enq_toll_tax, 
            enq.enq_parking_fee, 
            enq.enq_night_halt, 
            enq.enq_total_amount,
            enq.enq_fare_comments, 
            enq.enq_date, 
            enq.enq_owner_acceptance_status, 
            enq.enq_owner_acceptance_datetime, 
            enq.enq_owner_close_sts, 
            enq.enq_user_read_status, 
            enq.enq_user_read_datetime, 
            enq.enq_sender_close_sts,

            er.user_Mobile_No as enqOwner_ownerMobile, 
            er.user_Name as enqOwner_userName, 
            er.user_Surname as enqOwner_userSurname, 
            er.user_Owner_Name as enqOwner_ownerName, 
            er.user_Profile_Photo as enqOwner_profilePhoto,
            er.user_Email as enqOwner_email
            ');
        $this->db->from('api_cartravel_enquiry enq');
        $this->db->join('api_cartravel_business_agencies er', 'er.user_uniid = enq.ownerUniid', 'left');

        $this->db->where($wrArr);
        $this->db->order_by('enq.enq_owner_acceptance_datetime', 'ASC');
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

    public function updateOwnerEnquiryAcceptance($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_enquiry', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateEnquiryAlertClose($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_enquiry', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function respondedEnquiriesCount($wrArr)
    {
        $this->db->where($wrArr);
        $enqResponces = $this->db->count_all_results('api_cartravel_enquiry');

        if($enqResponces > 0)
        {
            return $enqResponces;
        }
        else
        {
            return false;
        }
    }




    public function sendSMS($smsNumber, $smsText)
    {
        if(!empty($smsNumber) && is_numeric($smsNumber))
        {
            $user = "jnana325";
            $pass = "31025325";
            $sender = "JKATTA";
            $phone  = $smsNumber;
            $text  = $smsText;
            $priority  = "ndnd";
            $stype  = "normal";

            $postData = array(
                'user' => $user,
                'pass' => $pass,
                'sender' => $sender,
                'phone' => $phone,
                'text' => $text,
                'priority' => $priority,
                'stype' => $stype
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,'http://bhashsms.com/api/sendmsg.php?');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec($ch);

            if($response)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function sendEmail($emailAddr, $emailName, $emailSubject, $emailMessage)
    {
        if($emailAddr != '')
        {
            $this->load->library('PHPMailer_Lib');
        
            // PHPMailer object
            $mail = $this->phpmailer_lib->load();

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host     = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'info@geolandmarks.com';
            $mail->Password = 'CFNv9YnrKYZahKrE';
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = 465;

            $mail->setFrom('info@geolandmarks.com', $emailName);
            $mail->addReplyTo('cartravels2016@gmail.com', $emailName);

            // Add a recipient
            $mail->addAddress($emailAddr);

            // Email subject
            $mail->Subject = $emailSubject;

            // Set email format to HTML
            $mail->isHTML(true);


            $mail->Body = $emailMessage;

            // Send email
            if ($mail->send()) 
            {   
                return true;
            }
            else 
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

?>