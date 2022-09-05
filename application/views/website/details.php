<?php  
$title = str_replace('%20', ' ', $this->uri->segment(3));
?>
	<section id="content">
		<div class="container">
		    <div class="row">
				<div class="col-md-12">
					<div class="aligncenter"><h2 class="aligncenter"><?php echo $title; ?></h2></div>

				</div>
			</div>
			<div class="row box-section">
				<?php  
				if(@$droppingCarsList)
				{

					foreach ($droppingCarsList as $dp) 
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->vehicle_images; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->pickupCity; ?> <br>  <span class="price pull-right">to <?php echo $dp->dropCity; ?></span></h6>
				                <hr>
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>

								<strong><?php echo $dp->vehicle_type; ?></strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$todayCarsList)
				{


					foreach ($todayCarsList as $dp)
					{
						if(!empty($dp->my_user_Owner_Name))
						{
							$user_Name = $dp->my_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->my_user_Name." ".$dp->my_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->tda_car_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->my_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->tda_car_type; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$vcCards)
				{
					foreach ($vcCards as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->vc_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->vc_desc; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$otherPostings)
				{
					foreach ($otherPostings as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->other_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->other_title; ?> </strong>  <br>
								<strong><?php echo $dp->other_desc; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$tourPackages)
				{
					foreach ($tourPackages as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->tourp_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->tour_package_name; ?> </strong>  <br>
								<strong><?php echo $dp->tour_description; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$sdVehicleList)
				{
					foreach ($sdVehicleList as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->sdv_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->sdv_name; ?> </strong>  <br>
								<strong><?php echo $dp->sdv_fuel_type; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo ($dp->user_Profile_Photo)?$dp->user_Profile_Photo:base_url().'assets/img/emptyface.png'; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$jobList)
				{
					foreach ($jobList as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->job_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->job_title; ?> </strong>  <br>
								<strong>Salary Base: <?php echo $dp->job_salary_based; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}

				elseif(@$TendersList)
				{
					foreach ($TendersList as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->tend_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->tend_title; ?> </strong>  <br>
								<strong>Salary Base: <?php echo $dp->tend_desc; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				elseif(@$AccBwList)
				{
					foreach ($AccBwList as $dp)
					{
						if(!empty($dp->requested_user_Owner_Name))
						{
							$user_Name = $dp->requested_user_Owner_Name;
							$user_Name = ucwords($user_Name);
						}
						else
						{
							$user_Name = $dp->requested_user_Name." ".$dp->requested_user_Surname;
							$user_Name = ucwords($user_Name);
						}
					?>
				
		            <div class="col-md-4">
						<div class="box-content">
							<a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$dp->postingID;?>&cid=<?=$dp->uniid;?>">
				               <img class="img-responsive" src="<?php echo $dp->accbw_image; ?>" alt="" style="width: 100%; height: 300px;">   
				                <h6><?php echo $dp->requested_mobile; ?> <span class="price pull-right"><?php echo $user_Name; ?></span></h6>
								<strong><?php echo $dp->accbw_title; ?> </strong>  <br>
								<strong>Salary Base: <?php echo $dp->accbw_dedication; ?> </strong>  

								<div class="price pull-right"> <img src="<?php echo $dp->user_Profile_Photo; ?>" class="img-rounded" alt="<?php echo $user_Name; ?>" style="width: 50px; height: 50px;"> </div>
				             </a>				
			            </div>
					</div>

					<?php
					}
				}
				else
				{
					echo '<div class="col-md-12"><center>No Postings Available</center></div>';
				}

				?>

	        </div>

		</div>
	</section>
	