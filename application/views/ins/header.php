<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CarTravel.com APP</title>
<link rel="shortcut icon" href="<?php echo base_url().'assets/img/favicon.jpg'; ?>" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Cartravels" />
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

  <?php if($this->input->get('pid') != '' && $this->input->get('uid') != ''){ ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
    <title><?php echo @$postTitle; ?></title>
    <style>@media screen and (max-device-width:480px){body{-webkit-text-size-adjust:none}}</style>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:type" content="website" />


    <meta property="og:city" content="<?php echo @$this->session->userdata('export_type'); ?>" />
    <meta property="og:title" content="<?php echo @$postTitle; ?>" />
    <meta property="og:description" content="<?php echo @$postDesc; ?>" />
    <meta property="og:url" content="<?php echo @$url; ?>" />
    <meta property="og:image" content="<?php echo @$postImage; ?>" />

    
  <?php } ?>


<?php  
  if(@$this->session->has_userdata('export_type'))
  {
    $thisSelectedLocation = $this->session->userdata('export_type');
    $thisCityName = trim($thisSelectedLocation);

    if($thisCityName != '' && $thisCityName != 'india' && $thisCityName != 'India')
    {
      $thisCityState = explode(',', $thisCityName);
      $thisCity = trim($thisCityState[0]);
      $thisState = trim($thisCityState[1]);
    }
    else
    {
      $thisCity = "";
      $thisState = "";
    }
  }
  else
  {
    $thisCity = "";
    $thisState = "";
  }
?>
  
  <script type="text/javascript">
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

                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>web/images/car-travels-logo.png" alt="logo"/></a>

                    <a class="navbar-brand" id="storeIcon" href="https://www.apple.com/in/app-store/" target="_blank"><img src="<?php echo base_url(); ?>assets/img/appStore.png" alt="logo"/></a>
                    <a class="navbar-brand" id="storeIcon" href="https://play.google.com/store/apps/details?id=cartravels.co&hl=en" target="_blank"><img src="<?php echo base_url(); ?>assets/img/playStore.png" alt="logo"/></a>

                    <a class="navbar-brand input-group" id="storeIcon" href="javascript:void(0)">
                      <!-- <input type="text" id='cartravels-cities-dropdown' placeholder='Type your city'>
                      <span class="input-group-addon" id='headerCitySelectedGo'>Go</span>   -->

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

            <button type="submit" class="btn btn-default btn-block btnDanger">Submit</button>

            </form>

            <br><br>

            <div class="col-md-12">
              <h6 class="text-center text-gray">by Continuing, i agree to Cartravels.com T&C</h6>
              <h4>For Sign Up Download App from</h4>
            </div>
            <div class="col-md-6 col-xs-6">
              <a href="https://www.apple.com/in/app-store/" target="_blank" id="storeIconLogin"> <img src="<?php echo base_url(); ?>assets/img/appStore.png"></a>
            </div>
            <div class="col-md-6 col-xs-6">
              <a href="https://play.google.com/store/apps/details?id=cartravels.co&hl=en" target="_blank" id="storeIconLogin"> <img src="<?php echo base_url(); ?>assets/img/playStore.png"></a>
            </div>
          </div>
        </div>
      
      </div>

    </div>
  </div>
<?php } ?>

  <div class="modal  fade"  id="enauiryBookingModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" id="listDanger">
        <div class="modal-header">
          <button type="reset" class="close text-white" data-dismiss="modal" aria-hidden="true" style="float: left;"><i class="fa fa-long-arrow-left text-white"></i></button>
          <h4 class="modal-title text-center text-white" id="myModalLabel">BOOK YOURSELF A TREAT</h4>
        </div>


        <div class="modal-body">
          <?php echo form_open_multipart('','id="sendEnquiryForm"'); ?>

            <div class="row">

              <?php 
                // if($this->uri->segment(3) == 'CarTravelsOffices'){ 
              ?>

              <div id="enquiryInputs">
                <div id="enquiryInsidePanel">

                    <input type="text" class="form-control mb-15" id="yourName" name="yourName" placeholder="Your Name" value="" required>
                    <input type="text" class="form-control mb-15" id="yourNumber" name="yourNumber" placeholder="Your Mobile Number" value="" required>
                    <input type="text" class="form-control" id="yourEmail" name="yourEmail" placeholder="Your email ID" value="" required>

                </div>
              </div>
              <?php 
                  // } 
                 if($this->uri->segment(3) == 'CarTravelsOffices'){
              ?>


              <div id="enquiryInputs" style="margin-top: 45px;">
                <div id="enquiryInsidePanel">

                    <ul class="nav nav-pills nav-justified">
                      <li class="active"><a data-toggle="tab" href="#ONEWAY" onclick="bookingWay(this.innerHTML);">ONEWAY</a></li>
                      <li><a data-toggle="tab" href="#ROUNDTRIP" onclick="bookingWay(this.innerHTML);">ROUNDTRIP</a></li>
                      <li><a data-toggle="tab" href="#AIRPORT" onclick="bookingWay(this.innerHTML);">AIRPORT</a></li>
                    </ul>


                    <div class="tab-content">
                      <div id="ONEWAY" class="tab-pane fade in active">
                        <div class="row mt-10">
                          <div class="col-md-3">Pickup : </div>
                          <div class="col-md-9"><?php echo $thisCityName; ?></div>
                        </div>
                        <hr style="border-top: 1px dashed red;">
                        <div class="row">
                          
                          <div class="col-md-3">Drop : </div>
                          <div class="col-md-9">
                             <input type="text" class="form-control" id='cartravels-cities-dropdown' placeholder='Type your city' name="onewayDropCity" onchange="tripDropCity(this.value)" value="">
                          </div>
                        </div>
                      </div>

                      <div id="ROUNDTRIP" class="tab-pane fade">
                        <div class="row mt-10">
                          <div class="col-md-3">Pickup : </div>
                          <div class="col-md-9"><?php echo $thisCityName; ?></div>
                        </div>
                        <hr style="border-top: 1px dashed red;">
                        <div class="row">
                          
                          <div class="col-md-3">Drop : </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" id='cartravels-cities-dropdown' placeholder='Type your city' name="roundtropDropCity" onchange="tripDropCity(this.value)" value="">
                          </div>

                        </div>
                      </div>

                      <div id="AIRPORT" class="tab-pane fade">
                        <div class="row mt-10">
                          <div class="col-md-3">City : </div>
                          <div class="col-md-9"><?php echo $thisCityName; ?></div>
                        </div>
                        <hr style="border-top: 1px dashed red;">
                        <div class="row">
                          <div class="col-md-12 mb-10">Trip Type</div>
                          <div class="col-md-12 mb-10">
                            <select class="form-control" id="AirportTripType" onchange="bookingWayType(this.value)">
                              <!-- <option>Drivers</option> -->
                              <option>Cab from Airport</option>
                              <option>Cab to the Airport</option>
                            </select>
                          </div>
                          <div class="col-md-12 mb-10">
                            <input type="text" name="addr" id="addr" class="form-control cartravels-cities-dropdown" placeholder="Type your city">
                          </div>

                        </div>
                      </div>
                    </div>

                </div>

              </div>
              <?php } if($this->uri->segment(3) == 'OptingDrivers'){  ?>
              <div id="enquiryInputs" style="margin-top: 45px;">
                <div id="enquiryInsidePanel">

                    <ul class="nav nav-pills nav-justified">
                      <li class="active"><a data-toggle="tab" href="#ONEWAY" onclick="bookingWay(this.innerHTML);">Local</a></li>
                      <li><a data-toggle="tab" href="#ROUNDTRIP" onclick="bookingWay(this.innerHTML);">Out Station</a></li>
                    </ul>


                    <div class="tab-content">
                      <div id="ONEWAY" class="tab-pane fade in active">
                        <div class="row mt-10">
                          <div class="col-md-3">Pickup : </div>
                          <div class="col-md-9"><?php echo $thisCityName; ?></div>
                        </div>
                        <hr style="border-top: 1px dashed red;">
                        <div class="row">
                          
                          <div class="col-md-3">Drop : </div>
                          <div class="col-md-9">
                             <input type="text" class="form-control" id='cartravels-cities-dropdown' placeholder='Type your city' name="onewayDropCity" onchange="tripDropCity(this.value)" value="">
                          </div>
                        </div>
                      </div>

                      <div id="ROUNDTRIP" class="tab-pane fade">
                        <div class="row mt-10">
                          <div class="col-md-3">Pickup : </div>
                          <div class="col-md-9"><?php echo $thisCityName; ?></div>
                        </div>
                        <hr style="border-top: 1px dashed red;">
                        <div class="row">
                          
                          <div class="col-md-3">Drop : </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" id='cartravels-cities-dropdown' placeholder='Type your city' name="roundtropDropCity" onchange="tripDropCity(this.value)" value="">
                          </div>

                        </div>
                      </div>
                    </div>

                </div>

              </div>
              <?php }  if($this->uri->segment(3) == 'Mechanics'){  ?>
              <div id="enquiryInputs">
                <div id="enquiryInsidePanel">

                  <div class="tab-content">
                    <div id="ONEWAY" class="tab-pane fade in active">
                      <div class="row mt-10">
                        <div class="col-md-3">Location : </div>
                        <div class="col-md-9"><?php echo $thisCityName; ?></div>
                      </div>
                      <hr style="border-top: 1px dashed red;">
                    </div>
                  </div>
                    
                </div>
              </div>
              <?php } ?>

            </div>


            <div id="travelInfo">
              <p style="padding: 15px 0 0 15px; font-size: 18px;">Travel information</p>
              <div id="travelinfoPanel">
                <div class="col-md-6 text-center" id="onewayDepart">
                  <i class="fa fa-calendar" aria-hidden="true"></i> Depart on <br>
                  <input type="date"  min="<?php echo date('Y-m-d'); ?>" name="departDate" id="departDate" required value="<?php echo date('Y-m-d'); ?>"><br>
                  <input type="time" name="departTime" id="departTime" value='<?php echo date('H:i'); ?>' required>
                </div>
                
                <div class="col-md-6 text-center" id="roundDepart">
                  <i class="fa fa-calendar" aria-hidden="true"></i> Return on <br>
                  <input type="date" min="<?php echo date('Y-m-d'); ?>" name="returnDate" id="returnDate" value="<?php echo date('Y-m-d'); ?>"><br>
                  <input type="time" name="returnTime" id="returnTime" value='<?php echo date('H:i'); ?>'>
                </div>

              </div>

              <?php if($this->uri->segment(3) == 'SelfDrivingOffices'){ ?>

              <p style="padding: 15px 0 0 15px; font-size: 18px;">Hours</p>
              <div id="travelinfoPanel">

                <ul class="nav nav-tabs nav-justified" id="navJustified">
                  <li class="active"><a data-toggle="tab" href="#12Hours" onclick="bookinghours(this.innerHTML);">12 Hours</a></li>
                  <li><a data-toggle="tab" href="#24Hours" onclick="bookinghours(this.innerHTML);">24 Hours</a></li>
                </ul>

              </div>

              <?php } ?>


              <div id="travelinfoPanel">
                <p style="font-size: 18px; font-weight: 600;"><i class="fa fa-car" aria-hidden="true"></i> Preferred Vehicle Type</p>

                <h4>

                <select  name="preferredVehicle" id="preferredVehicle" required>
                  <option value="">-- select keyword --</option>
                  <?php  

                    $selectedKey = $this->input->get('key');
                    $listDanger = "listDanger";

                    if(is_array(@$allKeywordsList))
                    {

                      foreach ($allKeywordsList as $key) 
                      {

                        ?> <option value="<?php echo $key; ?>" <?php echo ($key === $selectedKey)?'selected':''; ?>><?php echo $key; ?></option> <?php 
                      }
                      
                    }
                  ?>
                  </select>

                </h4>
              </div>


              <input type="hidden" name="enquiryType" id="enquiryType" value="<?php echo $this->uri->segment('3'); ?>">
              <input type="hidden" name="listingCity" id="listingCity" value="<?php echo $thisCity; ?>">
              <input type="hidden" name="listingState" id="listingState" value="<?php echo $thisState; ?>">
              <input type="hidden" name="uniid" id="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

              <input type="hidden" name="pickupCity" id="pickupCity" value="<?php echo $thisCityName; ?>">
              <input type="hidden" name="dropCity" id="dropCity">              
              
              <input type="hidden" name="trip" id="trip">
              <input type="hidden" name="tripType" id="tripType">

              <div class="enquiryButton">
                <button type="submit" style="background-color: #AB1818; color:#fff;" class="form-control btn btnDanger" id="sendEnquiryButtons" name="sendEnquiryButtons" value="Book Now">Book Now</button>
                
              </div>

            </div>

          <?php echo form_close(); ?>

        </div>
      </div>
    
    </div>
  </div>






<script type="text/javascript">
  $(document).ready(function() {

    $('#trip').val('ONEWAY');
    $('#tripType').val('ONEWAY');
    $("input[name=onewayDropCity]").prop('required', true);
    $('#roundDepart').hide();

    if("<?php echo $this->uri->segment(3); ?>" == "SelfDrivingOffices")
    {
      $('#trip').val('');
      $('#tripType').val('12Hours');
      $('#roundDepart').show();
      $("#returnDate").prop('required', true);
      $("#returnTime").prop('required', true);
    }
    if("<?php echo $this->uri->segment(3); ?>" == "OptingDrivers")
    {
      $('#trip').val('Local');
      $('#tripType').val('Local');
      $('#roundDepart').show();
      $("#returnDate").prop('required', true);
      $("#returnTime").prop('required', true);
    }
    if("<?php echo $this->uri->segment(3); ?>" == "ToursAndTravels")
    {
      $('#trip').val('');
      $('#tripType').val('');
      $('#roundDepart').show();
      $("#returnDate").prop('required', true);
      $("#returnTime").prop('required', true);
    }
    if("<?php echo $this->uri->segment(3); ?>" == "Mechanics")
    {
      $('#trip').val('');
      $('#tripType').val('');
    }

    if("<?php echo $this->session->userdata('export_type'); ?>" == '' || "<?php echo $this->session->userdata('export_type'); ?>" == ' ')
    {
      if('<?php echo $this->uri->segment(1);?>' == 'postshare' || '<?php echo $this->uri->segment(1);?>' == 'Postshare')
      {
        return false;
      }
      else
      {
        $("#cityModel").modal({
            show: true,
            backdrop: 'static'
        });
      }
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

  function bookingWay(trip)
  {
    console.log(trip);
    if(trip == 'ONEWAY' || trip == 'ROUNDTRIP')
    {
      $('#trip').val(trip);
      $('#tripType').val(trip);
      $("input[name=onewayDropCity]").val('');
      $("input[name=roundtropDropCity]").val('');
      $('#dropCity').val('');
      if(trip == 'ONEWAY')
      {
        $("input[name=onewayDropCity]").prop('required', true);
        $('input[name=roundtropDropCity]').removeAttr("required");
        $('#roundDepart').hide();
      }
      else
      {
        $("input[name=roundtropDropCity]").prop('required', true);
        $('input[name=onewayDropCity]').removeAttr("required");
        $('#roundDepart').show();
      }
    }
    else if(trip == 'Local')
    {
      $('#trip').val(trip);
      $('#tripType').val(trip);
      $('#dropCity').val('');
      $("input[name=onewayDropCity]").val('');
      $("input[name=roundtropDropCity]").val('');
      $("input[name=onewayDropCity]").prop('required', true);
      $('input[name=roundtropDropCity]').removeAttr("required");
    }
    else if(trip == 'Out Station')
    {
      $('#trip').val(trip);
      $('#tripType').val(trip);
      $('#dropCity').val('');
      $("input[name=onewayDropCity]").val('');
      $("input[name=roundtropDropCity]").val('');
      $("input[name=roundtropDropCity]").prop('required', true);
      $('input[name=onewayDropCity]').removeAttr("required");
    }
    else
    {
      $('#trip').val(trip);
      $('#tripType').val('Drivers');
      $('#AirportTripType').val('Drivers');
      $('#dropCity').val('');
      $('#roundDepart').hide();
      $('input[name=onewayDropCity]').removeAttr("required");
      $('input[name=roundtropDropCity]').removeAttr("required");
    }
  }

  function bookinghours(trip)
  {
    console.log(trip);
    if(trip == '12 Hours')
    {
      $('#trip').val('');
      $('#tripType').val('12Hours');
    }
    else
    {
      $('#trip').val('');
      $('#tripType').val('24Hours');
    }
  }

  function bookingWayType(val)
  {
    console.log(val);
    $('#tripType').val(val);
  }

  function tripDropCity(val)
  {
    $('#dropCity').val(val);
  }



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
            
              window.open('<?php echo base_url(); ?>'+data.travelID, "_blank");
              location.reload();

            }
            else
            {
              $(".errorMessage").html(data.message);
            }
          }
        });
        
    });



    $('#sendEnquiryForm').on('submit', function(e){  
     e.preventDefault();  
    
        $("#sendEnquiryButtons").prop('disabled', true);
        $('#sendEnquiryButtons').html("Sending Please wait... <i class='fa fa-refresh fa-spin'></i> ");
        var form = $(this);
        console.log(form.serialize());

        $.ajax({  
             url:"https://cartravels.com/web_api/api/Enquiry/enquiryNow", 
             method:"POST",  
             type: "POST",
             data:new FormData(this),  
             contentType: false,  
             cache: false,  
             processData:false,  
             success:function(data)  
             {    
                var sosMsg = JSON.parse(data).message;
                var sosSt = JSON.parse(data).error;

                console.log(JSON.parse(data));

                if(sosSt == "false")
                {
                  console.log(JSON.parse(data));
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#sendEnquiryButtons').removeAttr("disabled");
                  $('#sendEnquiryButtons').html("Book Now");
                  alert(sosMsg);
                  
                }
             }  
        });  
    });

</script>
