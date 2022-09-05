<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings_model extends CI_Model
{
    public function droppingCarsSeatsUpdate($pTable, $whereArr, $availSeats)
    {
        $this->db->where($whereArr);
        $status = $this->db->update("$pTable", array("available_seats" => $availSeats));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bookingStatusUpdates($updateWr)
    {
        $this->db->where($updateWr);
        $status = $this->db->update('api_cartravel_postings', array("posting_booking_sts" => 1));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bookingStatusReject($rejectWr)
    {
        $this->db->where($rejectWr);
        $status = $this->db->update('api_cartravel_postings', array("posting_booking_sts" => 0));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rejectPostUpdate($rejWrr)
    {
        $this->db->where($rejWrr);
        $status = $this->db->update("api_cartravel_tdacars", array("tda_availability" => 1, "tda_booked_status" => 0));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function postBookingStatusUpdates($pTable, $whereArr)
    {

        // today available calrs - done
        // dropping cars - done
        // self driving vehicles
        // Tour Packages - working

        switch ($pTable) 
        {
            case "api_cartravel_sdv":
                $availability = "sdv_availability";
                $booked_status = "sdv_booked_status";
                break;
            case "api_cartravel_tdacars":
                $availability = "tda_availability";
                $booked_status = "tda_booked_status";
                break;
            case "api_cartravel_vc":
                $availability = "vc_availability";
                $booked_status = "vc_booked_status";
                break;
            case "api_cartravel_others":
                $availability = "other_availability";
                $booked_status = "other_booked_status";
                break;
            case "api_cartravel_tours_travels":
                $availability = "tp_availability";
                $booked_status = "tp_booked_status";
                break;
            case "api_cartravel_dropping_cars":
                $availability = "dp_availability";
                $booked_status = "dp_booked_status";
                break;
            default:
                $tableName = "UnknownTable";
        }

        $this->db->where($whereArr);
        $status = $this->db->update("$pTable", array("$availability" => 0, "$booked_status" => 1));
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveBooking($data, $updateWr, $whereArr, $pTable)
    {

        if($pTable == "api_cartravel_dropping_cars")
        {
            $this->db->select('available_seats');
            $this->db->from('api_cartravel_dropping_cars');
            $this->db->where($whereArr);
            $seats = $this->db->get();
            $seats = $seats->row()->available_seats;


            if($seats >= $data['booking_seats'] && $data['booking_seats'] > 0)
            {
                $booking_seats = $data['booking_seats'];
                $availableSeats = $seats - $data['booking_seats'];

                $this->db->insert("api_cartravel_bookings", $data);
                $booking_id = $this->db->insert_id();

                if ($this->db->affected_rows() > 0) 
                {
                    if($availableSeats == 0)
                    {
                        $this->bookingStatusUpdates($updateWr);
                        $this->postBookingStatusUpdates($pTable, $whereArr);
                    }
                    $this->droppingCarsSeatsUpdate($pTable, $whereArr, $availableSeats);
                    return $booking_id;
                }
            }
            else if($data['booking_seats'] <= 0)
            {
                return false;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->db->insert("api_cartravel_bookings", $data);
            $booking_id = $this->db->insert_id();

            if ($this->db->affected_rows() > 0)
            {
                $this->bookingStatusUpdates($updateWr);
                $this->postBookingStatusUpdates($pTable, $whereArr);
                return $booking_id;
            }
            else
            {
                return false;
            }
        }
    }

    public function listBookings($wrArr)
    {
        $this->db->select('`b`.*, 
            bc.user_Mobile_No as pid_ownerMobile, 
            bc.user_Name as pid_userName, 
            bc.user_Surname as pid_userSurname, 
            bc.user_Owner_Name as pid_ownerName, 
            bc.user_Profile_Photo as pid_profilePhoto,
            bc.user_Email as pid_email,

            us.user_Mobile_No as bookie_ownerMobile, 
            us.user_Name as bookie_userName, 
            us.user_Surname as bookie_userSurname, 
            us.user_Owner_Name as bookie_ownerName, 
            us.user_Profile_Photo as bookie_profilePhoto,
            us.user_Email as bookie_email,

            tda.tda_car_image,
            tda.tda_car_type,

            dp.pickupCity as dp_pickupCity,
            dp.dropCity as dp_dropCity,
            dp.journey_date as dp_journey_date,
            dp.journey_time as dp_journey_time,
            dp.vehicle_type as dp_vehicle_type,
            dp.vehicle_images as dp_vehicle_images,
            dp.driver_name as dp_driver_name,
            dp.driver_mobile as dp_driver_mobile,

            sdv.sdv_type,
            sdv.sdv_name,
            sdv.sdv_fuel_type,
            sdv.sdv_vehicle_year,
            sdv.sdv_vehicle_desc,
            sdv.sdv_terms_cond,
            sdv.sdv_image,

            tp.tourp_image,
            tp.tour_package_name,
            tp.tourp_image,
            tp.tour_description,
            tp.tour_for_single,
            tp.tour_for_couple,
            tp.tour_for_extra_child,
            tp.tour_start_location,
            tp.tour_accommodation_sts,
            tp.tour_accommodation_desc,
            tp.tour_food_sts,
            tp.tour_food_desc,
            tp.tour_siteseeing_sts,
            tp.tour_siteseeing_desc,
            tp.tour_transport_sts,
            tp.tour_transport_desc,
            tp.tour_complimentry_sts,
            tp.tour_complimentry_desc,
            tp.tour_plan_days,
            tp.tour_what_inc,
            tp.tour_what_not_inc,
            tp.tour_contact_number,
            tp.tour_contact_email,
            tp.tour_keywords,

        ');
        $this->db->from('api_cartravel_bookings b');

        $this->db->join('api_cartravel_tours_travels tp', 'tp.tpID = b.postID AND tp.lid = "tpID"', 'left');
        $this->db->join('api_cartravel_sdv sdv', 'sdv.sdvID = b.postID AND sdv.lid = b.postLabel', 'left');
        $this->db->join('api_cartravel_dropping_cars dp', 'dp.dpID = b.postID AND dp.lid = b.postLabel', 'left');
        $this->db->join('api_cartravel_tdacars tda', 'tda.tdaID = b.postID AND tda.lid = b.postLabel', 'left');
        
        $this->db->join('api_cartravel_business_agencies bc', 'bc.user_uniid = b.ownerUniid', 'left');
        $this->db->join('api_cartravel_business_agencies us', 'us.user_uniid = b.uniid', 'left');
        $this->db->where($wrArr);
        $this->db->order_by('b.bookingID', 'DESC');
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

    public function updateOwnerBookingAcceptance($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_bookings', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateBookieReject($dataArr, $whereArr, $rejectWr, $rejWrr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_bookings', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            $this->bookingStatusReject($rejectWr);
            $this->rejectPostUpdate($rejWrr);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateAlertClose($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_bookings', $data);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }




    public function saveHotelBooking($data)
    {
        $this->db->insert("api_cartravel_hotel_bookings", $data);
        $booking_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $booking_id;
        }
        else
        {
            return false;
        }
    }

    public function listHotelBookings($wrArr)
    {
        $this->db->select('`b`.*, 
            ui.user_Mobile_No as ui_userMobile, 
            ui.user_Name as ui_userName, 
            ui.user_Surname as ui_userSurname, 
            ui.user_Owner_Name as ui_ownerName, 
            ui.user_Profile_Photo as ui_profilePhoto,

            oi.user_Mobile_No as oi_ownerMobile, 
            oi.user_Name as oi_userName, 
            oi.user_Surname as oi_userSurname, 
            oi.user_Owner_Name as oi_ownerName, 
            oi.user_Profile_Photo as oi_profilePhoto,
        ');
        $this->db->from('api_cartravel_hotel_bookings b');

        $this->db->join('api_cartravel_business_agencies ui', 'ui.user_uniid = b.hotel_user_uniid', 'left');
        $this->db->join('api_cartravel_business_agencies oi', 'oi.user_uniid = b.hotel_owner_uniid', 'left');

        $this->db->where($wrArr);
        $this->db->order_by('hotelBookID', 'DESC');
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


    public function updateHotelBookingAcceptance($dataArr, $whereArr)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_hotel_bookings', $dataArr);
        if($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateHotelAlertClose($whereArr, $data)
    {
        $this->db->where($whereArr);
        $status = $this->db->update('api_cartravel_hotel_bookings', $data);
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