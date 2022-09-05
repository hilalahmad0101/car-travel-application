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
$title = str_replace('%20', ' ', $this->uri->segment(3));
$selectedKey = $this->input->get('key');
$listDanger = "listDanger";

?>
	<section id="content">
		<div class="container">
		    <div class="row">
				<div class="col-md-12">
					<img src="<?php echo base_url(); ?>assets/img/banner_1.jpg" style="width: 100%;">

<!-- 					<center>
						<div class="input-group mt-20" style="max-width: 400px;">
							<input type="text" class="form-control" readonly value="<?php echo $this->input->get('key'); ?>">
							<span class="input-group-addon" id="changeKeyword" style="cursor: pointer; background-color: #428bca; color:#fff;"><i class="fa fa-filter"></i> change</span>
						</div>
					</center> -->
					<div class="aligncenter"><h2 class="aligncenter">
						<?php
							if($title == "CarTravelsOffices"){ echo "CarTravels Offices"; } 
							if($title == "SelfDrivingOffices"){ echo "Self Driving Offices"; } 
							if($title == "OptingDrivers"){ echo "Opting Drivers"; } 
							if($title == "ToursAndTravels"){ echo "Tours And Travels"; } 
							if($title == "Mechanics"){ echo "Mechanics"; } 
							if($title == "HotelsAndResorts"){ echo "Hotels And Resorts"; }
						?></h2>
					</div>

				</div>
			</div>
			<div class="row box-section">
				<div class="col-md-3 mb-15">
					<div class="list-group" id="leftKeywordsList">
		          		<?php 

		          			if(is_array($allKeywordsList))
		          			{
		          				echo '<a href="javascript:vlid();" class="list-group-item active">Select Keyword</a>';
		          				foreach ($allKeywordsList as $key) 
		          				{
		          					?><a href="<?php echo current_url(); ?>/?key=<?php echo $key; ?>" class="list-group-item" id="<?php echo ($key === $selectedKey)?'listDanger':''; ?>"><?php echo $key; ?></a> <?php 
		          				}
		          				
		          			}
		          		?>
					</div>
				</div>
				<div class="col-md-9">
					<div class="list-group">
						<?php  
						if($businessCategoryList)
						{

							$actual_currentlink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

							foreach ($businessCategoryList as $bc) 
							{
								if(!empty($bc->user_Owner_Name))
								{
									$user_Name = $bc->user_Owner_Name;
									$user_Name = ucwords($user_Name);
								}
								else
								{
									$user_Name = $bc->user_Name." ".$bc->user_Surname;
									$user_Name = ucwords($user_Name);
								}

								if($bc->user_Cover_Photo != '' || $bc->user_Cover_Photo != null)
								{
									$user_Cover_Photo = $bc->user_Cover_Photo;
								}
								else
								{
									$user_Cover_Photo = base_url()."web/images/nophoto.jpg";
								}

								$address = $bc->user_Door_No.", ".$bc->user_Street.", ".$bc->user_Landmark.", ".$bc->user_City.", ".$bc->user_District.", ".$bc->user_State." - ".$bc->user_Pin_Code;


								$rate_times = $bc->ratingCount;
				                $rate_value = $bc->avgRating;
				                $rate_bg = $bc->avgRating*20;
							?>


							<div href="#" id="categoryList" class="row list-group-item mb-15" > 
								<div class="col-md-4 pop">
									<img class="img-responsive img-thumbnail img-rounded" src="<?php echo $user_Cover_Photo; ?>" alt="" style="width: 100%; height: 150px;"> 
								</div>
								<div class="col-md-6">

									<h4 class="text-black"><?php echo ($bc->uesr_Business_Name)?$bc->uesr_Business_Name:$user_Name.' ('.$bc->user_Business_Category.') '; ?></h4>

									 <div style="margin-bottom: 10px">
							            <div class="result-container">
							                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
							                <div class="rate-stars"></div>
							            </div>                    
							            <span class="reviewScore"><?php echo substr($rate_value,0,3); ?></span><span class="reviewCount">(<?php echo $rate_times; ?> reviews)</span>
							        </div>
									
									

									<p class="couponcode"><i class="fa fa-map-marker"></i> <a href="javascript:void(0)"  title=""><?php echo substr($address, 0, 40); ?>...more</a>

										<span class="coupontooltip"><?php echo $address; ?></span>

									</p>

									<!-- <p><i class="fa fa-volume-control-phone"></i> <a href="tel:<?php echo $bc->user_Mobile_No; ?>"><?php echo $bc->user_Mobile_No.'</a>'; echo (!empty($bc->user_Alter_Mobile_No))?', <a href="tel:'.$bc->user_Alter_Mobile_No.'</a>':''; ?></p> -->




									<p><i class="fa fa-volume-control-phone"></i> 
										<a href="tel:<?php echo $bc->user_Mobile_No; ?>"><?php echo $bc->user_Mobile_No; ?></a>
										<?php echo (!empty($bc->user_Alter_Mobile_No))?', <a href="tel:'.$bc->user_Alter_Mobile_No.'">'.$bc->user_Alter_Mobile_No.'</a>':''; ?>
									</p>

									<?php echo ($bc->user_Business_Website_Name)?'<p><i class="fa fa-globe"></i> <a href="http://'.$bc->user_Business_Website_Name.'" target="_blank"> '.$bc->user_Business_Website_Name.'</a></p>':''; ?>



									<p class="text-danger"><b><i class="fa fa-globe"></i> <a href="<?php echo base_url().$bc->cartravels_id; ?>" target='_blank' class='text-danger'><?php echo $this->CI->remove_http(base_url().$bc->cartravels_id); ?></a></b></p>
									<p><i class="fa fa-chevron-right"></i> <a href="<?php echo $actual_currentlink.'?&cid='.$bc->cid; ?>"> Open Now</a></p>
								</div>
								<div class="col-md-2">

										<input type="button" name="BOOK" class="form-control btn btn-success" value="Book"  id='enauiryBookingModal' data-toggle="modal" data-target="#enauiryBookingModal">

									<!-- <a href="#" name="BOOK" class="form-control btn btn-success" value="Book"  id='enauiryBookingModal' data-toggle="modal" data-target="#enauiryBookingModal">book</a> -->

								</div>

							</div>

							<?php
							}
						}
						
						else
						{
							echo '<div class="col-md-12"><center>No Data Found</center></div>';
						}

						?>
					</div>
				</div>
	        </div>

		</div>
	</section>
	



<!-- Modal -->
<div class="modal fade keyWordsList"  id="keyWordsList" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  bg-primary">
      	Select Keyword
      	<button type="button" class="close text-black" data-dismiss="modal">x</button>
      </div>

      <div class="modal-body">
        <div class="row">

          	<div class="list-group">
          		<?php 
          			if(is_array($allKeywordsList))
          			{
          				foreach ($allKeywordsList as $key) 
          				{
          					echo '<a href="'.current_url().'/?key='.$key.'" class="list-group-item">'.$key.'</a>';
          				}
          				
          			}
          			else
          			{
          				echo '<a href="#" class="list-group-item active">No Data Found</a>';
          			}
          		?>
			</div>

        </div>
      </div>
    
    </div>

  </div>
</div>


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
    if("<?php echo $this->input->get('key'); ?>" == '' && <?php echo (is_array($allKeywordsList))?1:0; ?> == 1)
    {
      $("#keyWordsList").modal({
          show: true,
          backdrop: 'static'
      });
    }

    $('#changeKeyword').click(function(){
        $("#keyWordsList").modal({
            show: true,
            backdrop: 'static'
        });
      });

    $(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
	});

	$("#enauiryBookingModal").modal({
        show: false,
        backdrop: 'static'
      });
      
  });



	// var tooltip = document.querySelectorAll('.coupontooltip');

	// console.log(tooltip);

	// document.addEventListener('mousemove', fn, false);

	// function fn(e) {
	//     for (var i=tooltip.length; i--;) {
	//         tooltip[i].style.left = e.screenX + 'px';
	//         tooltip[i].style.top = e.screenY + 'px';
	//     }
	// }

</script>