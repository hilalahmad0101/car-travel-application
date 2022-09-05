
<style type="text/css">
	a{
		color:red;
		text-decoration: none;
	}
	.box-content 
	{
		/*text-align: center;*/
		max-width: 100%;
		color: #000;
		font-size: 12px;
		display: grid;
	}
	#businessListings 
	{
		text-align: center;
		max-width: 100%;
		color: #000;
		font-size: 12px;
		/*display: grid;*/
	}
	.box-content a img
	{
		width: 100px;
		height: 100px;
	}

	.row {
	     margin-left: 0px; 
	     margin-right: 0px; 
	}

	/* The heart of the matter */
	.testimonial-group > .row {
	  overflow-x: auto;
	  white-space: nowrap;
	}
	.testimonial-group > .row > .colsc {
	  display: inline-block;
	  float: none;
	}

	/* Decorations */
	.colsc
	{ 
		color: red; 
		font-size: 12px; 
		padding-bottom: 5px; 
		padding-top: 18px; 
	}

	h2.aligncenter
	{
		font-size: 20px;
		padding-top: 10px;
		padding-bottom: 10px;
		margin-bottom: 10px;
		margin-top: 10px;
	}

	span#bctitle
	{
		margin-top: 5px;
	}
	span.bctitle
	{
		color:red;
		background-color: #fff;
		border-radius: 5px;
		padding: 2px 4px;
		margin-top: 5px;
	}

	@media (max-width: 600px)
	{
		.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4{
		    position: relative;
		    min-height: 1px;
		    padding-left: 0px;
		    padding-right: 0px;
		}

		.box-content a img
		{
			width: 50px;
			height: 50px;
		}



		/*icons*/
		.colsc, .box-content
		{
			font-size: 8px; 
		}

		.colsc img
		{ 
			color: #000; 
			padding-bottom: 5px; 
			padding-top: 18px;
			width: 50px;
		}

		h2.aligncenter
		{
			font-size: 20px;
			margin-top: 10px;
			margin-bottom: 10px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
	}

	@media (max-width: 260px)
	{
		.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4{
		    position: relative;
		    min-height: 1px;
		    padding-left: 0px;
		    padding-right: 0px;
		}

		.box-content a img
		{
			width: 30px;
			height: 30px;
		}

		h2.aligncenter
		{
			font-size: 20px;
			margin-top: 10px;
			margin-bottom: 10px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
	}

	.left .fa
	{
		position: absolute;
	    top: 50%;
	    z-index: 5;
	    display: inline-block;
	    left: 25%;
	}

	.right .fa
	{
		position: absolute;
	    top: 50%;
	    z-index: 5;
	    display: inline-block;
	    right: 25%;
	}

	.item .container .carousel-caption {
	    left: 20%;
	    right: 20%;
	    padding-bottom: 0px;
	    bottom: 5px;
	}

	.containerSec {
	  position: relative;
	  font-family: Arial;
	}

	.text-block {
	  position: absolute;
	  bottom: 5px;
	  right: 5px;
	  background-color: #fff;
	  color: #ab1818;
	  padding-left: 5px;
	  padding-right: 5px;
	  font-weight: 700;
	}

</style>

<div class="container testimonial-group">


	 <div class="row text-center">
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/TodayAvailableCars/Available Cars">
				<img src="<?php echo base_url(); ?>assets/imgs/cto.png"><br>Today's Available Cars
			</a>
		</div>

		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/DroppingCars/Dropping Cars">
				<img src="<?php echo base_url(); ?>assets/imgs/dc.png"><br>Dropping Cars
			</a>
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/SelfDVehicles/Self Driving Cars">
				<img src="<?php echo base_url(); ?>assets/imgs/sdv.png"><br>Self Driving Cars
			</a>
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/TourPackages/Tour Packages">
				<img src="<?php echo base_url(); ?>assets/imgs/tp.png"><br>Tour Packages
			</a>
		</div>
		<!-- need to design -->
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/jobs/Jobs">
				<img src="<?php echo base_url(); ?>assets/imgs/jobs.png"><br>Jobs
			</a>
		</div>
		<!-- need to design -->
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/tenders/Tenders">
				<img src="<?php echo base_url(); ?>assets/imgs/tender.png"><br>Tenders
			</a>
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/PromoteVCards/visiting cards">
				<img src="<?php echo base_url(); ?>assets/imgs/pvc.png"><br>Promote Visiting Cards
			</a>
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/OtherPostings/others">
				<img src="<?php echo base_url(); ?>assets/imgs/others.png"><br>Others
			</a>
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<img src="<?php echo base_url(); ?>assets/imgs/postAnnounce.png"><br>Ads
		</div>
		<div class="col-md-2 col-xs-3 colsc">
			<a href="<?php echo base_url(); ?>Businesslistings/AccidentBreakdown/Accident or Breakdown">
				<img src="<?php echo base_url(); ?>/assets/imgs/acc.png"><br>Accident/Breakdown
			</a>
		</div>
	 </div>


	<!-- Carousel ================================================== -->
    <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo base_url(); ?>assets/img/banner_1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url(); ?>assets/img/banner_2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url(); ?>assets/img/banner_1.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
    </div> -->


		<?php 

			if($adInfo)
			{ ?>
				<div class="containerSec">
				  <a href="<?=$adInfo->ad_btn_action; ?>" target="_blank" class="img-thumbnail">
				  	<img src="<?=$adInfo->ad_image; ?>" alt="Banner Ad" style="width:100%;">
				  
					  <div class="text-block">
					    Ad
					  </div>
				  </a>
				</div> <?php
			}else{ ?>
				<div class="containerSec">
				  <a href="https://cartravels.com/app?ref=app" target="_blank" class="img-thumbnail">
				  	<img src="https://cartravels.com/assets/img/banner_1.jpg" alt="Banner Ad" style="width:100%;">
				  
					  <div class="text-block">
					    Ad
					  </div>
				  </a>
				</div><?php
			}

		?>    

    


</div>



<section id="content"  style="background-color: #d6d3d3">
	<div class="container" >
	    <div class="row">
			<div class="col-md-12">
				<div class="aligncenter"><h2 class="aligncenter">Booking Categories</h2></div>
			</div>
		</div>

		<div class="row box-section" id="businessListings">

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/CarTravelsOffices">
		              <img src="<?php echo base_url(); ?>/assets/imgs/cto.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Car Travels Offices</span>
	            </div>
			</div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/SelfDrivingOffices">
		              <img src="<?php echo base_url(); ?>/assets/imgs/sdv.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Self Driving Vehicles</span>
		 			
	            </div>
			</div>



            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/OptingDrivers">
		              <img src="<?php echo base_url(); ?>/assets/imgs/od.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Opting Drivers</span>
		 			
	            </div>
			</div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/ToursAndTravels">
		              <img src="<?php echo base_url(); ?>/assets/imgs/tt.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Tours & Travels</span>
		 			
	            </div>
			</div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/Mechanics">
		              <img src="<?php echo base_url(); ?>/assets/imgs/mec.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Mechanics</span>
		 			
	            </div>
			</div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box-content">
					<a href="<?php echo base_url(); ?>Businesslistings/category/HotelsAndResorts">
		              <img src="<?php echo base_url(); ?>/assets/imgs/hr.png" alt=""> 
		 			</a>
		 			<span class="bctitle" id="bctitle">Hotels & Resorts</span>
		 			
	            </div>
			</div>

        </div>

	</div>
</section>
	