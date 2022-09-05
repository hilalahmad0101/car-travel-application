<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CarTravel.com APP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://CarTravels.com" />
<!-- css -->
<link href="<?php echo base_url(); ?>assets/web/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/web/css/fancybox/jquery.fancybox.css" rel="stylesheet"> 
<link href="<?php echo base_url(); ?>assets/web/css/flexslider.css" rel="stylesheet" /> 
<link href="<?php echo base_url(); ?>assets/web/css/style.css" rel="stylesheet" />

<!-- Vendor Styles -->
<link href="<?php echo base_url(); ?>assets/web/css/magnific-popup.css" rel="stylesheet"> 
<!-- Block Styles -->

<link href="<?php echo base_url(); ?>assets/web/css/gallery-1.css" rel="stylesheet">
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<style type="text/css">
    .pull-center
    {
        display: inline;
        text-align: center;
    }

    .CityName
    {
        font-size: 15px;
        width: 350px;
    }

    #mySidenav a {
      position: absolute;
      right: 0px;
      transition: 0.3s;
      padding: 7px;
      /*width: 180px;*/
      text-decoration: none;
      font-size: 20px;
      color: white;
      border-radius: 5px 0 0 5px;
      z-index:1000;
      position: fixed;
      z-index: 100000;
    }

    #mySidenav a:hover {
      right: 0;
    }

</style>

</head>
<body>
<!-- <div id="wrapper" class="home-page"> -->





<!-- <div id="mySidenav" class="sidenav">
 <a style="top: 150px;right:-55px;margin:0;padding:5px 3px;transform: rotate(90deg);" href="https://play.google.com/store/apps/details?id=cartravels.co&hl=en" target="_blank">
    <img src="<?php echo base_url(); ?>assets/img/ct_logo.png" width="150px;">
 </a>
</div> -->



<?php  
    // $this->load->model('Businesslistings_model');
    // $cityData = $this->Businesslistings_model->listOfCities($whereArr = 0);
    // echo "<pre>";
    // print_r($cityData);
    // echo "</pre>";
?>

<div id="wrapper">
<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 	  
        <p class="pull-left hidden-xs"> <a href="https://play.google.com/store/apps/details?id=cartravels.co&hl=en" target="_blank" style="font-size: 15px;"> <i class="fa fa-download"></i><span> Download App 
            <?php  
                // if(isset($_COOKIE["CityName"])) 
                // {
                //   echo @$_COOKIE["CityName"];
                // }
            ?>

        </span> </a></p>
        <span class="pull-right"> 


<!--             <div class="form-group" id="CityName">
              <div class="input-group">
                <span class="input-group-addon">Andhra Pradesh</span>

                <input type="text" class="form-control" name="searchCity" id="searchCity" placeholder="Search Citys" autocomplete="off">


                <span class="input-group-addon"><i class="fa fa-search"></i></span>
              </div>
            </div> -->

            <select name="searchCity" id="searchCity" class="form-control select2 CityName">
                <option value="-- select city --">-- select city --</option>
                <?php 

                    if(@$this->session->has_userdata('export_type'))
                    {
                        $this->selectedLocation = $this->session->userdata('export_type');
                        // $this->selectedLocation = str_replace('-', ', ', $this->selectedLocation);
                        $this->locationID = $this->session->userdata('city_code');
                    }
                    else
                    {
                        $this->selectedLocation = '';
                    }

                    foreach ($cityData as $c) 
                    {
                        ?>
                        <option id="<?php echo $c->city_code; ?>" value="<?php echo $c->city_name.','.$c->state_name; ?>" <?php echo ($c->city_name.', '.$c->state_name == @$this->selectedLocation)?"selected":""; ?>>
                            <?php echo $c->city_name.', '.$c->state_name; ?>
                        </option>
                        <?php
                    }
                ?>
            </select>
        </span>

            <!-- <select class="js-example-basic-single" name="state">
              <option value="AL">Alabama</option>
              <option value="WY">Wyoming</option>
            </select> -->

        <!-- <p class="pull-right"><a href="tel:+919063590635"><i class="fa fa-phone"></i>Tel No. (+91) 90635 90635</p> -->

      </div>
    </div>
  </div>
</div>
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top" style="border-bottom: 1px solid #c1c1c1;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="https://www.cartravels.com/web/images/car-travels-logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li> 
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->