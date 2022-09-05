<?php  
$title = str_replace('%20', ' ', $this->uri->segment(3));
?>

<!-- <style type="text/css">
	.row {
	    margin-left: 0px;
	    margin-right: 0px;
	    display: table;
	    width: 100%;
	}

	.col-md-4 {
	    width: 33.33333333333333%;
	    display: table-cell;
	}
</style> -->

<style type="text/css">
	h6{
		margin-bottom: 10px;
	}
	.pull-left h6{
		margin: 7px 0;
	}
</style>
	<section id="content">
		<div class="container">
		    <div class="row">
				<div class="col-md-12">
					<div class="aligncenter"><h2 class="aligncenter">Postings</h2></div>

				</div>
			</div>
			<div class="row box-section">
				<?php 

				if($allPostings)
				{


					foreach ($allPostings as $post) 
					{

						if($post->selfDriving)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->sdv_image; ?>" alt="" style="width: 100%; height: 300px;">   
						                <h6><?php echo $post->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
						                
						                <div class="pull-left">
											<strong><?php echo $post->sdv_name; ?> </strong>  <br>
											<strong><?php echo $post->sdv_fuel_type; ?> </strong>  
										</div>
										<div class="price pull-right"> <img src="<?php echo $post->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
						else if($post->todayAvailCars)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->tda_car_image; ?>" alt="" style="width: 100%; height: 300px;">   
						                <h6><?php echo $post->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>

						                <div class="pull-left">
											<strong><?php echo $post->tda_car_type; ?> </strong>
										</div>  

										<div class="price pull-right"> <img src="<?php echo ($post->user_Profile_Photo)?$post->user_Profile_Photo:'https://cartravels.com/assets/img/emptyface.png'; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
						else if($post->visitingCard)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->vc_image; ?>" alt="" style="width: 100%; height: 300px;">   
						                <h6><?php echo $post->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>

						                <div class="pull-left">
											<strong><?php echo $post->vc_desc; ?> </strong>  
										</div>

										<div class="price pull-right"> <img src="<?php echo $post->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
						else if($post->others)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->other_image; ?>" alt="" style="width: 100%; height: 300px;">   

						                <h6><?php echo $post->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>

						                <div class="pull-left">
											<strong><?php echo $post->other_title; ?> </strong>  <br>
											<strong><?php echo substr($post->other_desc, 0, 40); ?>... </strong>  
										</div>
										<div class="price pull-right"> <img src="<?php echo $post->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
						else if($post->tourPackage)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->tourp_image; ?>" alt="" style="width: 100%; height: 300px;">   
						                <h6><?php echo $post->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>

						                <div class="pull-left">
										<strong><?php echo $post->tour_package_name; ?> </strong>  <br>
										<strong><?php echo $post->tour_description; ?> </strong> 
										</div>

										<div class="price pull-right"> <img src="<?php echo $post->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
						else if($post->droppingCars)
						{
							if(!empty($post->requested_user_Owner_Name))
							{
								$user_Name = $post->requested_user_Owner_Name;
								$user_Name = ucwords($user_Name);
							}
							else
							{
								$user_Name = $post->requested_user_Name." ".$post->requested_user_Surname;
								$user_Name = ucwords($user_Name);
							}
							?>
							
				            <div class="col-md-4">
								<div class="box-content">
									<a href="<?php echo base_url(); ?>postshare/share/?pid=<?php echo $post->postingID; ?>&uid=<?php echo $post->myUniid; ?>" target="_blank">
						               <img class="img-responsive" src="<?php echo $post->vehicle_images; ?>" alt="" style="width: 100%; height: 300px;">   
						                <h6><?php echo substr($post->pickupCity, 0, 24); ?>...   <span class="price pull-right">to <?php echo substr($post->dropCity, 0, 24); ?>...</span></h6>
						                <!-- <hr> -->

						                <div class="pull-left">
						                	<h6><?php echo $post->requested_mobile; ?> 
						                	<!-- <span class="price pull-right"><?php echo $user_Name; ?></span> -->
						            		</h6>

											<strong><?php echo $post->vehicle_type; ?></strong>  
										</div>

										<div class="price pull-right"> <img src="<?php echo $post->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
						             </a>				
					            </div>
							</div>

							<?php
						}
					}
				}
				else
				{
					echo '<div class="col-md-12"><center>No Cars Available</center></div>';
				}


				?>

	        </div>

		</div>
	</section>
	