<style type="text/css">
	/*.btn{
			text-align: center;
			color: #fff;
			padding: 0px 0px; 
			border-radius: 0;
			background: #AB1818; 
			border-color: #AB1818; 

		}*/

	/*******************************
* MODAL AS RIGHT SIDEBAR CSS
*******************************/
  .modal.keyWordsList .modal-dialog {


    width: 350px;

  }

  .modal.keyWordsList .modal-content {
    max-height: 600px;
  }

  #keyWordsList .modal-body{
  	height: 530px;
  	overflow: auto;
  	margin-bottom: 10px;
  }

  #categoryList {
	    position: relative;
	    display: block;
	    padding: 15px 0px;
	    margin-bottom: -1px;
	    background-color: #fff;
	    border: 1px solid #ddd;
	    margin: 0 0 10px 0; 
	}
#categoryList p {
	    margin: 0 0 3px 0; 
	}

	#categoryList h4 {
	    margin: 10px 0 10px 0; 
	}


	.couponcode:hover .coupontooltip {
	    display: block;
	    /*position: relative;*/
	}


	.coupontooltip {
	    display: none;
	    background: #000;
	    margin-left: 65%;
	    margin-top: 0px;
	    padding: 10px;
	    position: absolute;
	    z-index: 1000;
	    width:200px;
	    height:auto;
	    color: #fff;
	    float: right;
	}

	.couponcode {
	    /*margin:100px;*/
	}

</style>


<?php  
$title = $this->uri->segment(1);
$selectedKey = $this->input->get('pid');
$listDanger = "listDanger";

?>
	<section id="content">
		<div class="container">
		    <div class="row">
				<div class="col-md-12">

					<div class="aligncenter"><h2 class="aligncenter">
						<?php
							echo $cat;
							// if($title == "postshare"){ echo "CarTravels Offices"; } 
							// if($title == "SelfDrivingOffices"){ echo "Self Driving Offices"; } 
							// if($title == "OptingDrivers"){ echo "Opting Drivers"; } 
							// if($title == "ToursAndTravels"){ echo "Tours And Travels"; } 
							// if($title == "Mechanics"){ echo "Mechanics"; } 
							// if($title == "HotelsAndResorts"){ echo "Hotels And Resorts"; }
						?></h2>
					</div>

				</div>
			</div>
			<div class="row box-section">
				<div class="col-md-3 mb-15">
					<div class="list-group" id="leftKeywordsList">
						<!-- - -->
					</div>
				</div>
				<div class="col-md-6">
					<div class="list-group">
						<?php  
						if($postInfo)
						{
							$bc = $postInfo;
								if(!empty($bc->requested_user_Owner_Name))
								{
									$user_Name = $bc->requested_user_Owner_Name;
									$user_Name = ucwords($user_Name);
								}
								else
								{
									$user_Name = $bc->requested_user_Name." ".$bc->requested_user_Surname;
									$user_Name = ucwords($user_Name);
								}

								if($postImage != '')
								{
									$user_Cover_Photo = $postImage;
								}
								else
								{
									$user_Cover_Photo = base_url()."web/images/nophoto.jpg";
								}

							?>


							<style type="text/css">
							 hr {
							     margin-top: 5px; 
							     margin-bottom: 5px; 
							    border: 0;
							    border-top: 1px solid #ccc;
							}
							</style>


							<div href="#" id="categoryList" class="row list-group-item mb-15" > 
								<div class="col-md-12 pop">
									<img class="img-responsive img-thumbnail img-rounded" src="<?php echo $user_Cover_Photo; ?>" alt="" style="width: 100%; height: 250px;"> 
									<hr>

									<?php if($postInfo->droppingCars != 0) { ?>
							
										<h4 class="text-center"> <i class="fa fa-car"></i> <?php echo $postInfo->vehicle_type; ?></h4>
										<hr>

										<div class="row">
											<div class="col-md-5">
												<p class="text-black"><?php echo $postInfo->pickupCity ?></p>
											</div>
											<div class="col-md-2">>></div>
											<div class="col-md-5">
												<p class="text-black"><?php echo $postInfo->dropCity ?></p>
											</div>
										</div>
										<hr>

										<div class="row">
											<div class="col-md-5">
												<p class="text-black">Availablee Seats</p>
												<h5><?php echo $postInfo->available_seats ?></h5>
											</div>
											<div class="col-md-2">-</div>
											<div class="col-md-5">
												<p class="text-black">Total  Price for 1 passenger</p>
												<h5> <i class="fa fa-inr"></i> <?php echo $postInfo->ticket_fair ?></h5>
											</div>
										</div>
										<hr>

										<div class="row">
											<div class="col-md-5">
												<p class="text-black">Journey Date</p>
												<h5><?php echo date("d-m-Y", strtotime($postInfo->journey_date)); ?></h5>

											</div>
											<div class="col-md-2">-</div>
											<div class="col-md-5">
												<p class="text-black">Journey Time</p>
												<h5><?php echo date("g:i A", strtotime($postInfo->journey_time)); ?></h5>
											</div>
										</div>
										<hr>

										<div class="row">
											<div class="col-md-5">
												<p class="text-black">Driver Name</p>
												<h5><?php echo $postInfo->driver_name ?></h5>
											</div>
											<div class="col-md-2">-</div>
											<div class="col-md-5">
												<p class="text-black">Driver mobile</p>
												<h5><?php echo $postInfo->driver_mobile ?></h5>
											</div>
										</div>
										<hr>								
										

										<p class="couponcode">
											<i class="fa fa-map-marker"></i> 
											<a href="javascript:void(0)"  title=""><?php echo $postInfo->location; ?></a>
										</p>

										<br>

									<?php }elseif($postInfo->todayAvailCars != 0) { ?>

										<h4>  
											<span class="text-left"><i class="fa fa-car"></i><?php echo $postInfo->tda_car_type; ?></span>        
											<span class="text-right" style="float:right;"><?php echo $postInfo->tda_date; ?></span>
										</h4>
										<hr>

										

										<p class="couponcode">
											<i class="fa fa-map-marker"></i> 
											<a href="javascript:void(0)"  title=""><?php echo $postInfo->tda_location; ?></a>
										</p>

										<br>


									<?php }elseif($postInfo->selfDriving != 0) { ?>

										<h4 class="text-center"> <i class="fa fa-car"></i> <?php echo $postInfo->sdv_type; ?></h4>
										<hr>

										<table class="table table-striped">
											<tr>
												<th class="text-center" style="background-color: #c0c0c0;">1Hr.</th>
												<th class="text-center" style="background-color: #c0c0c0;">12Hr.</th>
												<th class="text-center" style="background-color: #c0c0c0;">24Hr.</th>
											</tr>

											<tr>
												<td class="text-center"> <i class="fa fa-rupee"></i> <?php echo $postInfo->sdv_HoursFare_1; ?></td>
												<td class="text-center"> <i class="fa fa-rupee"></i> <?php echo $postInfo->sdv_HoursFare_12; ?></td>
												<td class="text-center"> <i class="fa fa-rupee"></i> <?php echo $postInfo->sdv_HoursFare_24; ?></td>
											</tr>
										</table>

										<div class="row">
											<div class="col-md-5 col-xs-5">
												<p class="text-black">Fuel Type</p>
												<h5><?php echo $postInfo->sdv_fuel_type; ?></h5>
											</div>
											<div class="col-md-2 col-xs-2">-</div>
											<div class="col-md-5 col-xs-5">
												<p class="text-black">Year of model</p>
												<h5> <?php echo $postInfo->sdv_vehicle_year; ?></h5>
											</div>
										</div>
										<hr>

										<p class="couponcode">
											<i class="fa fa-map-marker"></i> 
											<a href="javascript:void(0)"  title=""><?php echo $postInfo->sdv_location; ?></a>
										</p>

										<hr>
										<h6>Description</h6>
											<?php echo nl2br(trim($postInfo->sdv_vehicle_desc)); ?>
										<h6>Terms and Conditions</h6>
											<?php echo nl2br(trim($postInfo->sdv_terms_cond)); ?>

										





									<?php }elseif($postInfo->tourPackage != 0) { ?>

										<h4 class="text-center">  <?php echo $postInfo->tour_package_name; ?></h4>
										<hr>

										<table class="table table-striped">
											<tr>
												<td>For Single</td>
												<td> <i class="fa fa-rupee"></i> <?php echo $postInfo->tour_for_single; ?></td>
											</tr>

											<tr>
												<td>For Couple</td>
												<td> <i class="fa fa-rupee"></i> <?php echo $postInfo->tour_for_couple; ?></td>
											</tr>

											<tr>
												<td>For Extra Child</td>
												<td> <i class="fa fa-rupee"></i> <?php echo $postInfo->tour_for_extra_child; ?></td>
											</tr>

											<tr>
												<td>Start Location</td>
												<td><?php echo $postInfo->tour_start_location; ?></td>
											</tr>

											<tr>
												<td>Accommodation </td>
												<td><?php echo $postInfo->tour_accommodation_desc; ?></td>
											</tr>
											<tr>
												<td>Food</td>
												<td><?php echo $postInfo->tour_food_desc; ?></td>
											</tr>
											<tr>
												<td>Siteseeing</td>
												<td><?php echo $postInfo->tour_siteseeing_desc; ?></td>
											</tr>
											<tr>
												<td>Transport</td>
												<td><?php echo $postInfo->tour_transport_desc; ?></td>
											</tr>
											<tr>
												<td>Complimentary</td>
												<td><?php echo $postInfo->tour_complimentry_desc; ?></td>
											</tr>
											<tr>
												<td>Number of days</td>
												<td><?php echo $postInfo->tour_plan_days; ?></td>
											</tr>
											<tr>
												<td>Whats is included</td>
												<td><?php echo $postInfo->tour_what_inc; ?></td>
											</tr>

											<tr>
												<td>Whats is not included</td>
												<td><?php echo $postInfo->tour_what_not_inc; ?></td>
											</tr>

											<tr>
												<td>Contact No</td>
												<td><?php echo $postInfo->tour_contact_number; ?></td>
											</tr>

											<tr>
												<td>Contact Email</td>
												<td><?php echo $postInfo->tour_contact_email; ?></td>
											</tr>

										</table>

										<hr>
										<h6>Description</h6>
											<?php echo nl2br(trim($postInfo->tour_description)); ?>

											<hr>

											<p class="couponcode">
												<i class="fa fa-map-marker"></i> 
												<a href="javascript:void(0)"  title=""><?php echo $postInfo->tour_post_location; ?></a>
											</p>

											<hr>

											<h6>Tour Places</h6>
											<?php 
												$tourKeys = explode("#", trim($postInfo->tour_keywords)); 
												if(!empty($tourKeys))
												{
													foreach ($tourKeys as $key) {
														echo ' <span class="label label-info">'.trim($key).'</span> ';
													}
													echo "<br/>";
													echo "<br/>";

												}
											?>



									<?php }elseif($postInfo->visitingCard != 0) { ?>

										<h4><?php echo $postInfo->vc_desc; ?></h4>
										<hr>

										<p class="couponcode">
											<i class="fa fa-map-marker"></i> 
											<a href="javascript:void(0)"  title=""><?php echo $postInfo->vc_location; ?></a>
										</p>

										

									<?php }elseif($postInfo->others != 0) { ?> 

										<h6><?php echo trim($postInfo->other_title); ?></h6>
											
										<h6 class="text-black"><?php echo trim($postInfo->other_desc); ?></h6>
											

										<p class="couponcode">
										<i class="fa fa-map-marker"></i> 
										<a href="javascript:void(0)"  title=""><?php echo $postInfo->other_location; ?></a>
										</p>

									<?php }elseif($postInfo->tenderID != 0) { ?> 

										<h6><?php echo trim($postInfo->tend_title); ?></h6>
											
										<h6 class="text-black"><?php echo trim($postInfo->tend_desc); ?></h6>
											

										<p class="couponcode">
										<i class="fa fa-map-marker"></i> 
										<a href="javascript:void(0)"  title=""><?php echo $postInfo->tend_location; ?></a>
										</p>

									<?php }elseif($postInfo->jobPostPID != 0) { ?> 

										<h4>  
											<span class="text-left"><?php echo $postInfo->job_title.' ('.$postInfo->job_type.')'; ?></span>        
											<span class="text-right" style="float:right;"><?php echo $postInfo->job_date; ?></span>
										</h4>
										<hr>
											
										<h6 class="text-black"> <i class="fa fa-inr"></i> <?php echo $postInfo->job_salary_from.' -  <i class="fa fa-inr"></i> '.$postInfo->job_salary_to.' | '.trim($postInfo->job_salary_based); ?></h6>
											
										<h6 class="text-black"><?php echo trim($postInfo->job_description); ?></h6>

										<p class="couponcode">
										<i class="fa fa-map-marker"></i> 
										<a href="javascript:void(0)"  title=""><?php echo $postInfo->job_location; ?></a>
										</p>

									<?php }elseif($postInfo->accidentCars != 0) { ?> 

										<h4> <?php echo $postTitle; ?></h4>
										<hr>
											
											
										<h6 class="text-black"><?php echo trim($postInfo->accbw_dedication); ?></h6>

										<p class="couponcode">
										<i class="fa fa-map-marker"></i> 
										<a href="javascript:void(0)"  title=""><?php echo $postInfo->accbw_location; ?></a>
										</p>

									<?php } ?>


								<hr>

								<div class="row">
									<div class="col-md-3 col-xs-3 text-right">
										<img src="<?php echo $postInfo->user_Profile_Photo; ?>" style="height: 70px;width: 70px; border-radius: 50%; border: 1px solid #000;">
									</div>
									<div class="col-md-9  col-xs-9">
										<h5 style="margin-bottom:10px;"><?php echo $user_Name ?></h5>
										<a href="<?php echo base_url().$postInfo->cartravels_id; ?>" target="_blank" class="text-black"> <i class="fa fa-hand-o-right"></i> <?php echo $postInfo->cartravels_id; ?></a>
									</div>
								</div>
								<hr>

								<h5 class="text-black">Post ID: <?php echo $postInfo->postingID ?></h5>

								<hr>	


								<div class="row">
									<div class="col-md-6 col-xs-6">
										<?php if($this->session->has_userdata('details')){ ?>
											<a href="<?php echo base_url().'user/'.$editPostUrl.'/'.$this->input->get('pid'); ?>" target="_blank" class="form-control btn btn-info"> Edit</a>
										<?php }else{ ?>
											<a href="tel:<?php echo $postInfo->requested_mobile; ?>" target="_blank" class="form-control btn btn-info"> <i class="fa fa-phone"></i> Call</a>
										<?php } ?>
									</div>

									<div class="col-md-6 col-xs-6">
										<?php if($this->session->has_userdata('details')){ ?>
											<a href="https://wa.me/+91<?php echo $postInfo->requested_mobile; ?>?text=Hi," target="_blank" class="form-control btn btn-success"> Delete</a>
										<?php }else{ ?>
											<a href="https://wa.me/+91<?php echo $postInfo->requested_mobile; ?>?text=Hi," target="_blank" class="form-control btn btn-success"> <i class="fa fa-wechat"></i> Chat</a>
										<?php } ?>
									</div>
								</div>

							</div>


						<?php
						}
						
						else
						{
							echo '<div class="col-md-12"><center>wrong data</center></div>';
						}

						?>
					</div>
				</div>
	        </div>

		</div>
	</section>
	






<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {


    $('#changeKeyword').click(function(){
        $("#keyWordsList").modal({
            show: true,
            backdrop: 'static'
        });
      });
      
  });
</script>