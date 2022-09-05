<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('security');
        $this->load->model('api/Hotels_model');
    }
    
    public function index()
    {
        echo "Unknown Method & access denied";
    }

    public function saveHotelInfo()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));


            $hotelType = xss_clean($this->input->post('hotelType'));
            $hotelRoomInfo = xss_clean($this->input->post('hotelRoomInfo'));
            $hotelWtInc = xss_clean($this->input->post('hotelWtInc'));
            $hotelWtNotInc = xss_clean($this->input->post('hotelWtNotInc'));
            $hotelDesc = xss_clean($this->input->post('hotelDesc'));
            $hotelOffers = xss_clean($this->input->post('hotelOffers'));
            $hotelWifi = xss_clean($this->input->post('hotelWifi'));
            $hotelRestaurant = xss_clean($this->input->post('hotelRestaurant'));
            $hotelSwimPool = xss_clean($this->input->post('hotelSwimPool'));
            $hotelGym = xss_clean($this->input->post('hotelGym'));
            $hotelLaundry = xss_clean($this->input->post('hotelLaundry'));
            $hotelRoomService = xss_clean($this->input->post('hotelRoomService'));
            $hotelBarRestaurant = xss_clean($this->input->post('hotelBarRestaurant'));
            $hotelBanquets = xss_clean($this->input->post('hotelBanquets'));
            $hotelBoardroom = xss_clean($this->input->post('hotelBoardroom'));
            $hotelTransportation = xss_clean($this->input->post('hotelTransportation'));

            if(!empty($_FILES['hotel_image']['name']))
	        {
                $config['upload_path'] = 'assets/hotels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['hotel_image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('hotel_image'))
                {
                    $uploadData = $this->upload->data();
                    $hPicture = $uploadData['file_name'];
                    $hPicture = base_url().'assets/hotels/'.$hPicture;
                }
                else { $hPicture = ''; }
            }
            else { $hPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/hotels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $hAudio = $uploadData['file_name'];
                    $hAudio = base_url().'assets/hotels/'.$hAudio;
                }
                else { $hAudio = ''; }
            }
            else { $hAudio = ''; }

            $data = array(
				"uniid" => $uniid,
				"hotel_images" => $hPicture,
				"hotel_voice_msg" => $hAudio,
				"hotel_type" => $hotelType,
				"hotel_rooms_info" => $hotelRoomInfo,
				"hotel_wt_inc" => $hotelWtInc,
				"hotel_wt_not_inc" => $hotelWtNotInc,
				"hotel_desc" => $hotelDesc,
				"hotel_offers" => $hotelOffers,
				"hotel_wifi" => $hotelWifi,
				"hotel_restaurant" => $hotelRestaurant,
				"hotel_swim_pool" => $hotelSwimPool,
				"hotel_gym" => $hotelGym,
				"hotel_laundry" => $hotelLaundry,
				"hotel_room_service" => $hotelRoomService,
				"hotel_bar_restaurant" => $hotelBarRestaurant,
				"hotel_banquets" => $hotelBanquets,
				"hotel_boardroom" => $hotelBoardroom,
				"hotel_transportation" => $hotelTransportation,

				"updated_on" => date('Y-m-d H:i:s')
			);

			$status = $this->Hotels_model->saveHotel($data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Hotel Information Added Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function editHotelInfo()
	{
		if($this->input->method(TRUE) == 'POST')
		{
            $uniid = xss_clean($this->input->post('uniid'));
            $HotelInfoID = xss_clean($this->input->post('HotelInfoID'));

            $hotelImages = xss_clean($this->input->post('hotelImages'));
            $hotelVoiceMsg = xss_clean($this->input->post('hotelVoiceMsg'));
            $hotelType = xss_clean($this->input->post('hotelType'));
            $hotelRoomInfo = xss_clean($this->input->post('hotelRoomInfo'));
            $hotelWtInc = xss_clean($this->input->post('hotelWtInc'));
            $hotelWtNotInc = xss_clean($this->input->post('hotelWtNotInc'));
            $hotelDesc = xss_clean($this->input->post('hotelDesc'));
            $hotelOffers = xss_clean($this->input->post('hotelOffers'));
            $hotelWifi = xss_clean($this->input->post('hotelWifi'));
            $hotelRestaurant = xss_clean($this->input->post('hotelRestaurant'));
            $hotelSwimPool = xss_clean($this->input->post('hotelSwimPool'));
            $hotelGym = xss_clean($this->input->post('hotelGym'));
            $hotelLaundry = xss_clean($this->input->post('hotelLaundry'));
            $hotelRoomService = xss_clean($this->input->post('hotelRoomService'));
            $hotelBarRestaurant = xss_clean($this->input->post('hotelBarRestaurant'));
            $hotelBanquets = xss_clean($this->input->post('hotelBanquets'));
            $hotelBoardroom = xss_clean($this->input->post('hotelBoardroom'));
            $hotelTransportation = xss_clean($this->input->post('hotelTransportation'));

            if(!empty($_FILES['hotel_image']['name']))
	        {
                $config['upload_path'] = 'assets/hotels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['hotel_image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('hotel_image'))
                {
                    $uploadData = $this->upload->data();
                    $hPicture = $uploadData['file_name'];
                    $hPicture = base_url().'assets/hotels/'.$hPicture;
                }
                else { $hPicture = ''; }
            }
            else { $hPicture = ''; }

	        if(!empty($_FILES['audio_file_path']['name']))
	        {
                $config['upload_path'] = 'assets/hotels/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['audio_file_path']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('audio_file_path'))
                {
                    $uploadData = $this->upload->data();
                    $hAudio = $uploadData['file_name'];
                    $hAudio = base_url().'assets/hotels/'.$hAudio;
                }
                else { $hAudio = ''; }
            }
            else { $hAudio = ''; }

            $data = array(
				"hotel_images" => $hPicture,
				"hotel_voice_msg" => $hAudio,
				"hotel_type" => $hotelType,
				"hotel_rooms_info" => $hotelRoomInfo,
				"hotel_wt_inc" => $hotelWtInc,
				"hotel_wt_not_inc" => $hotelWtNotInc,
				"hotel_desc" => $hotelDesc,
				"hotel_offers" => $hotelOffers,
				"hotel_wifi" => $hotelWifi,
				"hotel_restaurant" => $hotelRestaurant,
				"hotel_swim_pool" => $hotelSwimPool,
				"hotel_gym" => $hotelGym,
				"hotel_laundry" => $hotelLaundry,
				"hotel_room_service" => $hotelRoomService,
				"hotel_bar_restaurant" => $hotelBarRestaurant,
				"hotel_banquets" => $hotelBanquets,
				"hotel_boardroom" => $hotelBoardroom,
				"hotel_transportation" => $hotelTransportation,

				"updated_on" => date('Y-m-d H:i:s')
			);

            $whereArr = array('uniid' => $uniid, 'hotelID' => $HotelInfoID);

            $status = $this->Hotels_model->updateHotelInfo($whereArr, $data);

			if($status == true)
			{
				$json['error'] = "false";
				$json['message'] = "Hotel Information Edited Successfully";
			}
			else
			{
				$json['error'] = "true";
				$json['message'] = "Sorry! Unable to Process, Try again.";
			}
		}
		else
		{
			$json['error'] = "true";
			$json['message'] = "Unknown Method";
		}
		echo json_encode($json);
	}

	public function getHotelInfo()
	{
		if($this->input->post())
		{
			$uniid = xss_clean($this->input->post('uniid'));
			
			$hotelInfo = $this->Hotels_model->hotelInfoList($uniid);
			
			if($hotelInfo)
			{
				$json['error'] = "false";
				$json['hotelInfo'] = $hotelInfo;
			}
			else
			{
				 $json['error'] = 'true';
				 $json['hotelInfo'] = 0;
			}
			echo json_encode($json);
		}
	}
}

?>