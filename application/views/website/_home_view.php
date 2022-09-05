
<style type="text/css">
	.box-content 
	{
		text-align: center;
		max-width: 100%;
		color: #000;
		font-size: 12px;
		display: grid;
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
	color: #000; 
	font-size: 12px; 
	padding-bottom: 5px; 
	padding-top: 18px; 
}

h2.aligncenter
{
	font-size: 20px;
}


/*.colsc:nth-child(3n+1) 
{ 
	background: #c69; 
}
.colsc:nth-child(3n+2) 
{ 
	background: #9c6; 
}
.colsc:nth-child(3n+3) 
{ 
	background: #69c; 
}
*/

	@media (max-width: 600px)
	{
		.container, .content
		{
/*			padding-left: 15px;
			padding-right: 15px;
			margin-right: 15px;
			margin-left: 15px;*/
		}

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
			margin-top: 0px;
			margin-bottom: 0px;
			padding-top: 0px;
			padding-bottom: 0px;
		}
	}

	@media (max-width: 260px)
	{
		.container, .content
		{
/*			padding-left: 15px;
			padding-right: 15px;
			margin-right: 15px;
			margin-left: 15px;*/
		}
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
			margin-top: 0px;
			margin-bottom: 0px;
			padding-top: 0px;
			padding-bottom: 0px;
		}
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
</style>


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<div class="container testimonial-group">
  <div class="row text-center">
    <div class="col-md-3 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/cto.png"><br>Today's Available Cars</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/dc.png"><br>Dropping Cars</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/sdv.png"><br>Self Driving Cars</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/tp.png"><br>Tour Packages</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/jobs.png"><br>Jobs</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/tender.png"><br>Tenders</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/pvc.png"><br>Promote Visiting Cards</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/others.png"><br>Others</div><!--
 --><div class="col-md-2 col-xs-3 colsc"><img src="<?php echo base_url(); ?>/assets/imgs/ads.png"><br>Ads</div>
  </div>
</div>






	<section id="content"  style="background-color: #d6d3d3">
		<div class="container">
		    <div class="row">
				<div class="col-md-12">
					<div class="aligncenter"><h2 class="aligncenter">Booking Categories</h2></div>
				</div>
			</div>

			<div class="row box-section">

	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/DroppingCars/Dropping Cars">
			              <img src="<?php echo base_url(); ?>/assets/imgs/cto.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Car Travels Offices</span>
		            </div>
				</div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/TodayAvailableCars/Available Cars">
			              <img   src="<?php echo base_url(); ?>/assets/imgs/sdv.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Self Driving Vehicles</span>
			 			
		            </div>
				</div>



	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/SelfDVehicles/Self Driving Cars">
			              <img   src="<?php echo base_url(); ?>/assets/imgs/od.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Opting Drivers</span>
			 			
		            </div>
				</div>

	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/TourPackages/Tour Packages">
			              <img   src="<?php echo base_url(); ?>/assets/imgs/tt.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Tours & Travels</span>
			 			
		            </div>
				</div>

	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/PromoteVCards/visiting cards">
			              <img   src="<?php echo base_url(); ?>/assets/imgs/mec.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Mechanics</span>
			 			
		            </div>
				</div>

	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="box-content">
						<a href="<?php echo base_url(); ?>Businesslistings/OtherPostings/others">
			              <img   src="<?php echo base_url(); ?>/assets/imgs/hr.png" alt=""> 
			 			</a>
			 			<span class="bctitle" id="bctitle">Hotels & Resorts</span>
			 			
		            </div>
				</div>

	        </div>

		</div>
	</section>
	