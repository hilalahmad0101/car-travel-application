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

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/web/js/jquery.js"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />


  <script>
    $(function() {   
      var availableTags1 = <?php $this->load->view('website/cities_list'); ?>;
      $( ".cartravels-cities-dropdown, #cartravels-cities-dropdown, #citySelectedValue" ).autocomplete({
         source: function (request, response) {
        response($.map(availableTags1, function (obj, key) {
        
        var name = obj.city_name.toUpperCase();
        
        if (name.indexOf(request.term.toUpperCase()) != -1) {       
          return {
            label: obj.city_name + ", " + obj.state_name, // Label for Display
            value: obj.city_name + ", " + obj.state_name// Value
          }
        } else {
          return null;
        }
      }));      
    },  
    focus: function(event, ui) {
    },
        select: function( event, ui ) {
          $( "#cartravels-cities-dropdown" ).val( ui.item.city_name );
          $( "#cartravels-cities-dropdown" ).attr( 'hiddenid',ui.item.state_name );        
        },
        minLength:3 
      }); 
    });
  </script>

</head>
<body>
<!-- <div id="wrapper" class="home-page"> -->



<!-- 

<div id="mySidenav" class="sidenav">
 <a style="top: 150px;right:-55px;margin:0;padding:5px 3px;transform: rotate(90deg);" href="https://play.google.com/store/apps/details?id=cartravels.co&hl=en" target="_blank">
    <img src="<?php echo base_url(); ?>assets/img/ct_logo.png" width="150px;">
 </a>
</div>



 -->

<div id="wrapper">
  <div class="topbar">
    <div class="container">
      <div class="row">
        <?php 
          // echo "<pre>"; 
          // print_r($this->session->userdata('details')->cartravels_id);
          // echo "</pre>"; 
        ?>
      </div>
    </div>
  </div>
  	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top" style="border-bottom: 1px solid #c1c1c1;">
            <div class="container">
                <div class="navbar-header">
                  <?php  if($this->session->userdata('isCTUserLoggedIn')) {  ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  <?php } else { ?>
                    <a href="#" class="navbar-toggle btn btnDanger" id='loginButton'  data-toggle="modal" data-target="#loginModal"> <i class="fa fa-chevron-circle-down "></i> Login </a>
                  <?php } ?>

                    <a class="navbar-brand " href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>web/images/car-travels-logo.png" alt="logo"/></a>


                    <a class="navbar-brand input-group" style="margin-left: 20px;" id="storeIcon" href="javascript:void(0)">

                      <div class="input-group">
                        <input type="text" class="form-control" id='cartravels-cities-dropdown' placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>">
                        <span class="input-group-btn">
                          <button class="btn btn-default btnDanger" type="button" id='headerCitySelectedGo'>Go!</button>
                        </span>
                      </div><!-- /input-group -->
                    </a>
                    
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                      <?php 

                        $this->isUserLoggedIn = $this->session->userdata('isCTUserLoggedIn');
                        if($this->isUserLoggedIn)
                        { 
                            ?>
                            <li class="active"><a href="<?php echo base_url().$this->session->userdata('details')->cartravels_id; ?>">home</a></li>
                            <li class="active"><a href="<?php echo base_url(); ?>user">My Account</a></li>
                            <li class="active"><a href="<?php echo base_url(); ?>user/logout">Logout</a></li> 
                            <?php

                        }
                        else
                        {
                          ?><li>
                              <a class="navbar-toggle btn btnDanger" id='loginButton' href="#" data-toggle="modal" data-target="#loginModal"> <i class="fa fa-chevron-circle-down " ></i> Login </a>

                            </li>

                            <?php
                        }


                       ?>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->


  <div class="modal fade" id="cityModel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-footer" style="margin-top: 0px;">
          <div class="input-group cartravels-city-search">

            <?php if($this->session->has_userdata('export_type')) { ?>

            <span class='input-group-addon btn' style="background-color: #F6D702; color:#000; font-weight: 600; padding: 0 10px;"><?php echo $this->session->userdata('export_type'); ?></span>
            <input  class="form-control" id='citySelectedValue' placeholder='Type your city'>
            <?php }else{?> 
            <span class='input-group-addon btn' style="background-color: #F6D702; color:#000; font-weight: 600; padding: 0 10px;">India</span>
            <input  class="form-control" id='citySelectedValue' placeholder='Type your city'>
            <?php } ?>

            <span class="btn input-group-addon btnDanger" type="button" id='citySelectedGo' style="padding: 0 10px;">Go</span>         
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


</div><!-- /.wrapper -->


<?php  if(!$this->session->userdata('isCTUserLoggedIn')) {  ?>


<!-- Modal -->
<div class="modal right fade"  id="loginModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body">
        <div class="row">

          <button type="button" class="close text-black" data-dismiss="modal">x</button>

          <div class="text-center">
            <h3 class="text-black">Be a part of the largest <br>Indian Travel Community</h3>
          </div>
          <br>

          <div class="col-md-12 text-center">
            <img src="<?php echo base_url(); ?>web/images/car-travels-logo.png" style="width: 200px;">
          </div>
          <div class="col-md-12 text-center">
            <h5 class="text-center text-gray">Login / Signup Using</h5>

            <div class="errorMessage" style="color:red;"></div>
          </div>



          <form action="#" class="form-signin form-group" id="userLoginForm" method="post" accept-charset="utf-8">

          <div class="form-group">
            <input type="number" class="form-control" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-default btn-block">Submit</button>

          </form>

          <br><br>

          <div class="col-md-12">
            <h6 class="text-center text-gray">by Continuing, i agree to Cartravels.com T&C</h6>
            <h4>For Sign Up Download App from</h4>
          </div>
          <div class="col-md-6 col-xs-6">
            <a href="#" id="storeIconLogin"> <img src="<?php echo base_url(); ?>assets/img/appStore.png"></a>
          </div>
          <div class="col-md-6 col-xs-6">
            <a href="#" id="storeIconLogin"> <img src="<?php echo base_url(); ?>assets/img/playStore.png"></a>
          </div>
        </div>
      </div>
    
    </div>

  </div>
</div>


<?php } ?>





<script type="text/javascript">
  $(document).ready(function() {
    if("<?php echo $this->session->userdata('export_type'); ?>" == '' || "<?php echo $this->session->userdata('export_type'); ?>" == ' ')
    {
      $("#cityModel").modal({
          show: true,
          backdrop: 'static'
      });
    }
      

      $('#searchCity').click(function(){
        $("#cityModel").modal({
            show: true,
            backdrop: 'static'
        });
      });

      $("#loginModal").modal({
        show: false,
        backdrop: 'static'
      });
  });



    $("#userLoginForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Login/signin",
          data: form.serialize(),
          success: function(data)
          {
            data = JSON.parse(data);
            console.log(data);
            if(data.message == 'userLoggedIn')
            {
              window.location = '<?php echo base_url(); ?>'+data.travelID;
            }
            else
            {
              $(".errorMessage").html(data.message);
            }
          }
        });
        
    });

</script>
