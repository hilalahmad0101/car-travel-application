<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0" nonce="k5jlnhdX"></script>
<?php $bgImage = ($profile->user_Cover_Photo)?$profile->user_Cover_Photo:base_url().'assets/img/default_bg.jpg'; ?>


<style type="text/css">

  body
  {
    font-size: 1rem;
  }
  .input-group {
      position: relative;
      display: table;
      border-collapse: separate;
  }

  label
  {
    font-size: 13px;
  }

  .form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.428571429;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

  .card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
     border: 1px solid rgba(0,0,0,.125); 
    border-radius: .25rem;
}

  .card.hovercard .cardheader {
      background: url(<?php echo $bgImage; ?>);
      background-size: cover;
      height: 200px;
  }

  .btn {
      height: 36px;
      padding: 3px 18px;
      font-size: 14px;
      line-height: 1.2em;
      font-weight: 500;
      box-shadow: none !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: .2s all;
      text-decoration: none !important;
      border-radius: 10px;
      /*border-width: 2px;*/
      /*margin: 3px;*/
      color: #fff;
      font-family:sans-serif;
  }

  #btn-share
  {
    width: auto;
    padding: 5px;
  }

  #profileContainer
  {
      margin-bottom: 50px;
  }

  .footer {
     position: fixed;
     left: 0;
     bottom: 0;
     width: 100%;
     background-color: #c1c1c1;
     color: white;
     text-align: center;
     padding: 5px;
     z-index: 2;
  }

  .callbtn
  {
    background-color: #0099ff;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
  }

  .postBtn{
    background-color: #FD3132;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
  }

  .chatbtn
  {
    background-color: #33cc33;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
  }

  footer a:hover
  {
    color: #fff;
  }

  .btnMargin{
    margin: 0px;
    padding: 5px;
  }

  .btnMargin p
  {
    padding-bottom: 0px;
    margin: 0px;
    font-weight: 700;
  }

.card.hovercard .avatar {
    position: relative;
    top: -60px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 130px;
    height: 130px;
    max-width: 130px;
    max-height: 130px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}

.text-danger {
    color: #AB1818;
}

.postImage img
{
  width: 50px;
}
.postImage p
{
  padding-top: 10px;
  margin-bottom: 20px;
}

/*.btn{ border-radius: 50%; width:32px; height:32px; line-height:18px;  }*/

</style>

<div class="container-fluid" id="profileContainer">
	<div class="row">
		<div class="col-lg-4 col-sm-3 col-xs-12">

      <?php 
        if($this->session->userdata('details'))
        {
          if($this->session->userdata('details')->cartravels_id == $this->uri->segment(1))
          { 
            $this->load->view('calender_view');
          }
        }
      ?>  
    </div>
		<div class="col-lg-4 col-sm-6 col-xs-12 text-center">
			<!-- <br><br><img src='images/logo.png' width='300'><br><br> -->

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <!-- <img alt="" src="<?php echo $profile->user_Profile_Photo; ?>"> -->
                    <img alt="" src="<?php echo ($profile->user_Profile_Photo)?$profile->user_Profile_Photo:base_url()."images/emptyface.png"; ?>">
                </div>
                <div class="info">
                    <div class="title">
                        <a href="<?php echo ($profile->user_Business_Website_Name)?'http://'.$profile->user_Business_Website_Name:'javascript:0;'; ?>">
                        	<?php echo ($profile->uesr_Business_Name)?$profile->uesr_Business_Name:ucwords($profile->user_Name.' '.$profile->user_Surname); ?>
                        </a>
                    </div>
                    <div class="desc"><?php echo ($profile->user_Owner_Name)?ucwords($profile->user_Owner_Name):ucwords($profile->user_Name.' '.$profile->user_Surname); ?></div>

                    <div class="desc"><?php echo ucwords($profile->user_City).' - '.ucwords($profile->user_State); ?></div>


                </div>


                <div class="bottom">
                    <a class="btn btn-info btn-twitter btn-sm" href="tel:+91<?php echo $profile->user_Mobile_No; ?>">
                        <i class="fa fa-phone"></i>
                    </a>
                    <a class="btn btn-success btn-sm" rel="publisher" href="https://wa.me/+91<?php echo $profile->user_Mobile_No; ?>?text=Hi, *Got reference from your Business Card, want to know more about your services*.">
                        <i class="fa fa-whatsapp"></i>
                    </a>

                    
					           <a class="btn btn-warning btn-sm" rel="publisher" href="mailto:<?php echo $profile->user_Email; ?>">
                        <i class="fa fa-envelope-o"></i>
                    </a>

                    <a class="btn btn-success btn-sm" rel="publisher" type="button" href="" id="btn-share" data-toggle="modal" data-target="#bottom_modal">
                        <i class="fa fa-share-square-o"> Share </i>  
                    </a>

                </div>

                <div class="bottom">
                    <a class="btn btn-info callbtnTop btn-sm" href="https://www.facebook.com/<?php echo ($profile->user_Facebook_ID)?$profile->user_Facebook_ID:'javascript:void(0);'; ?>&t=TEst" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a class="btn btn-danger btn-sm" rel="publisher" href="https://www.google.co.in/maps/place/<?php echo $profile->user_Latitude; ?>, <?php echo $profile->user_Longitude; ?>" target="_blank">
                        <i class="fa fa-map-marker"></i>
                    </a>

                    <a class="btn btn-info btn-sm" rel="publisher" href="http://<?php echo ($profile->user_Business_Website_Name)?$profile->user_Business_Website_Name:'javascript:void(0);'; ?>" target="_blank">
                        <i class="fa fa-globe"></i>
                    </a>


                    <!--   <a class="btn btn-success btn-sm" rel="publisher" href="https://www.facebook.com/sharer.php?u=<?php echo base_url().$this->uri->segment(1); ?>&t=CarTravels-Visiting Card" id="btn-share" target="_blank">
                        <i class="fa fa-facebook-square"> </i> <small> Share </small>
                    </a> -->

                    
                    
                </div>
            </div>




            <center>
               <a href="https://play.app.goo.gl/?link=https://play.google.com/store/apps/details?id=cartravels.co&ddl=1&pcampaignid=web_ddl_1"> <img src="<?php echo base_url(); ?>assets/img/ct_logo.png" width="200px;"></a>
            </center>



<?php
      if($myPostings)
      {
          foreach ($myPostings as $post) 
          {
              if(!empty($post->selfDriving))
              {
                  // echo "selfDriving";
                  ?>

                        <div class="card" style="auto">
                          <div class="card-header"><h3>Self Driving Vehicle </h3></div>
                          <img class="card-img-top" src="<?php echo $post->sdv_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->sdv_name; ?> 
                            </h4>

                          </div>
                        </div>


                  
                  <?php
              }

              else if(!empty($post->todayAvailCars))
              {
                  // echo "todayAvailCars";
                  ?>

                        <div class="card" style="auto">
                          <div class="card-header"><h3>Available Car </h3></div>
                          <img class="card-img-top" src="<?php echo $post->tda_car_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->tda_car_type; ?> 
                            </h4>
                          </div>
                        </div>

                  <?php
              }

              else if(!empty($post->others))
              {
                  // echo "others";
                  ?>
                  
                        <div class="card" style="auto">
                          <div class="card-header"><h3><?php echo $post->other_title; ?> </h3></div>
                          <img class="card-img-top" src="<?php echo $post->other_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->other_desc; ?>
                            </h4>
                          </div>
                        </div>

                     
                  <?php
              }
              else if(!empty($post->tourPackage))
              {
                  // echo "tourPackage";
                  ?>
                  

                        <div class="card" style="auto">
                          <div class="card-header"><h3>Tour Packages </h3></div>
                          <img class="card-img-top" src="<?php echo $post->tourp_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->tour_package_name; ?> <br> 
                              <?php echo $post->tour_description; ?> <br> 
                              <?php echo $post->tour_keywords; ?> 
                            </h4>
                          </div>
                        </div>

                     
                  <?php
              }
              else if(!empty($post->droppingCars))
              {
                  // echo "droppingCars";
                  ?>
                 

                        <div class="card" style="auto">
                          <div class="card-header"><h3>Dropping Cars </h3></div>
                          <img class="card-img-top" src="<?php echo $post->vehicle_images; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->vehicle_type; ?> <br> 
                              Driver Name : <?php echo $post->driver_name; ?> <br> 
                              Driver Mobile : <?php echo $post->driver_mobile; ?><br>
                            </h4>
                          </div>
                        </div>

                     
                  <?php
              }
          }
      }
      else
      {
          echo '<div class="row">
          <div class="col-lg-4 col-sm-3"></div>
          <div class="col-lg-4 col-sm-6 col-xs-12 text-center">
          <center>
              <h2><u>No Postings</u></h2>
              <hr>
          </center>
          </div>
          <div class="col-lg-4 col-sm-3"></div>
          </div>';

      }
  ?>













    </div>
    <div class="col-lg-4 col-sm-3 col-xs-12">


      <?php 
        if($this->session->userdata('details'))
        {
          if($this->session->userdata('details')->cartravels_id == $this->uri->segment(1))
          { 
            $this->load->view('chat_view');
          }
        }
      ?>

    </div>
  </div>

  <!-- <div class="row">
    <div class="col-lg-4 col-sm-3">
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12 text-center">
      <center>
         <a href="https://play.google.com/store/apps/details?id=cartravels.co"> <img src="<?php echo base_url(); ?>assets/img/ct_logo.png" width="200px;"></a>
      </center>
    </div>
    <div class="col-lg-4 col-sm-3"></div>
  </div> -->

  
</div>

<style type="text/css">
  .codeWidth
  {
    /*width: 15%;*/
    padding-right: 10px;
    font-size: 1.4rem;
    font-weight: 800;
  }
  .numberWidth input
  {
    /*width: 70%;*/
    font-size: 1.4rem;
    padding: 5px;
  }
  .iconWidth
  {
    /*width: 15%;*/
    padding-left: 10px;
  }

  .modal-header {
      display: -ms-flexbox;
      /*display: block;*/
      -ms-flex-align: start;
      align-items: flex-start;
      -ms-flex-pack: justify;
      justify-content: space-between;
      padding: 1rem 1rem;
      border-bottom: 1px solid #dee2e6;
      border-top-left-radius: calc(.3rem - 1px);
      border-top-right-radius: calc(.3rem - 1px);
  }

  .input-group-addon {
    padding: 0px 12px;
  }
</style>




<div class="modal full bottom" id="bottom_modal" tabindex="-1" role="dialog" aria-labelledby="bottom_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <center>
        <div class="modal-header text-center">

        <div class="input-group">
          <span class="input-group-addon">+91</span>
          <input type="text" class="form-control" name="sharePhoneNumber" id="sharePhoneNumber"  maxlength="10">
          <span class="input-group-addon"><a id="shareWp" href="https://wa.me/+91<?php echo $profile->user_Mobile_No; ?>?text=<?php echo current_url(); ?>" style="font-size: 30px; color:rgb(0,255,0); padding:0px 12px;" target="_blank"> <i class="fa fa-whatsapp"></i></a>  </span>
        </div>

          <!--           <div class="form-inline text-center">
            <div class="codeWidth">
              +91
            </div>
            <div class="mx-sm-3 numberWidth">
              <input type="text" class="form-control" name="sharePhoneNumber" id="sharePhoneNumber"  maxlength="10">
            </div>
            <div class="mx-sm-3 iconWidth">
              <a id="shareWp" href="https://wa.me/+91<?php echo $profile->user_Mobile_No; ?>?text=<?php echo current_url(); ?>" style="font-size: 34px; color:rgb(0,255,0); padding:0px 12px;"> <i class="fa fa-whatsapp"></i></a>  
            </div>
            
          </div> -->
        

        </div>
      </center>
      <div class="modal-body">

        <div class="bottom text-center">

            <h2>Share</h2>

            <a class="btn btn-success btn-sm" id="shareSms" rel="publisher" href="sms:+91<?php echo $profile->user_Mobile_No; ?>?body=<?php echo current_url(); ?>">
                <i class="fa fa-envelope"></i>
            </a>

            <a class=" btn-sm" href="tg://msg?text=<?php echo current_url(); ?>">
                <!-- <i class="fa fa-telegram"></i> -->
                <img src="https://telegram.org/img/t_logo.svg" width="40px;">
            </a>

            <a class="btn btn-info callbtnTop btn-sm" href="fb://sharer?u=<?php echo current_url(); ?>%2F&amp;src=sdkpreparse" target="_blank">
                <i class="fa fa-facebook"></i>
            </a>

            <a class="btn-sm" rel="publisher" href="https://wa.me/?text=<?php echo current_url(); ?>">
              <img src="<?php echo base_url(); ?>images/bw.png" width="45px;">
            </a>

            <a class="btn btn-success btn-sm" rel="publisher" href="https://wa.me/?text=<?php echo current_url(); ?>">
                <i class="fa fa-whatsapp"></i>
            </a>


            <div class="fb-share-button btn-sm" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small"><a class="btn btn-success btn-sm" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore" style="color: #fff;"><i class="fa fa-facebook text-white"></i></a></div>
          
        </div>
        <br>

      </div>

    </div>
  </div>
</div>


<!-- Footer -->
<footer class="footer">

<?php 
  if($this->session->userdata('details'))
  {
    if($this->session->userdata('details')->cartravels_id == $this->uri->segment(1))
    { ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url().$this->session->userdata('details')->cartravels_id; ?>">
              <i class="fa fa-home fa-lg text-black  fa-2x"> </i> <p class="text-danger">Home</p>
            </a>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url(); ?>user/logout">
              <i class="fa fa-sign-out fa-lg text-black  fa-2x"> </i> <p class="text-danger">Logout</p>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <div style="">
              <a class="text-danger text-center" data-toggle="modal" data-target="#addPostModal" href="#" style="background-color: red; color:#fff;display: inline-grid;padding: 14px 15px 5px 15px;border-radius: 15px; margin-bottom: -10px;margin-top: -17px;">
                <i class="fa fa-camera fa-lg black-text  fa-2x"> </i>
                <p style="padding-top: 3px;">Post</p>
              </a>
          </div>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-center" href="<?php echo base_url(); ?>user/myPosts">
              <i class="fa fa-list fa-lg text-black  fa-2x"> </i> <p class="text-danger">My Posts</p>
            </a>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url(); ?>user">
              <i class="fa fa-user fa-lg text-black  fa-2x"> </i> <p class="text-danger">Profile</p>
            </a>
          </div>
        </div>
      </div>

    <?php } else { 
      // redirect(base_url().$this->session->userdata('details')->cartravels_id, 'refresh'); 
      ?>


      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-4 btnMargin">
            <a class="btn-block callbtn" href="tel:+91<?php echo $profile->user_Mobile_No; ?>" target="_blank">
              <i class="fa fa-phone fa-lg white-text  fa-2x">  Call 1</i>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <a class="btn-block callbtn btn-danger" href="tel:+91<?php echo $profile->user_Alter_Mobile_No; ?>" target="_blank">
              <i class="fa fa-phone fa-lg white-text  fa-2x">  Call 2</i>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <a class="btn-block chatbtn" href="https://wa.me/+91<?php echo $profile->user_Mobile_No; ?>?text=Hi, *Got reference from your Business Card, want to know more about your services*." target="_blank">
              <i class="fa fa-wechat fa-lg white-text  fa-2x"> Chat</i>
            </a>
          </div>
        </div>
      </div>

    <?php }  
  }  else { ?>


      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-4 btnMargin">
            <a class="btn-block callbtn" href="tel:+91<?php echo $profile->user_Mobile_No; ?>" target="_blank">
              <i class="fa fa-phone fa-lg white-text  fa-2x">  Call 1</i>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <a class="btn-block callbtn btn-danger" href="tel:+91<?php echo $profile->user_Alter_Mobile_No; ?>" target="_blank">
              <i class="fa fa-phone fa-lg white-text  fa-2x">  Call 2</i>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <a class="btn-block chatbtn" href="https://wa.me/+91<?php echo $profile->user_Mobile_No; ?>?text=Hi, *Got reference from your Business Card, want to know more about your services*." target="_blank">
              <i class="fa fa-wechat fa-lg white-text  fa-2x"> Chat</i>
            </a>
          </div>
        </div>
      </div>


  <?php  } ?>

</footer>
<!-- Footer -->



<script type="text/javascript">

$( document ).ready(function() {
   $("#sharePhoneNumber").on("keyup", function(){
    var ph = $("#sharePhoneNumber").val();
    $("a#shareWp").attr("href", 'https://wa.me/+91'+ph+'?text=<?php echo current_url(); ?>');
    $("a#shareSms").attr("href", 'sms:+91'+ph+'?body=<?php echo current_url(); ?>');
    console.log(ph);
  });
});

</script>





<!-- Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:345px;margin-left: auto; margin-right: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center" id="myModalLabel">Add Post</h4>
      </div>
      <div class="modal-body">
        
        <div class="row postImage">
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTodayAvailableCars" class="" role="button"><img src="<?php echo base_url(); ?>assets/imgs/cto.png"> <p style="font-weight: 600">Todays Available</p></a>
          </div>
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addDroppingCars"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/dc.png"> <p style="font-weight: 600">Dropping Cars</p></a>
          </div>
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addSelfDrivingCars"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/sdv.png"> <p style="font-weight: 600">Self Driving</p></a>
          </div>

          <br>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTourpackage"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/tp.png"> <p style="font-weight: 600">Tour Package</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addJobs"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/jobs.png"> <p style="font-weight: 600">Jobs</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTender"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/tender.png"> <p style="font-weight: 600">Tenders</p></a>
          </div>

          <br>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addVisitingCard"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/pvc.png"> <p style="font-weight: 600">Promote Visiting</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addOthers"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/others.png"> <p style="font-weight: 600">Others</p></a>
          </div>

          <!-- <div class="col-xs-4 col-md-4 text-center">
            <a href="#"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Ads</p></a>
          </div> -->

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addAccident"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/acc.png"> <p style="font-weight: 600">Accident / Breakdown</p></a>
          </div>

          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/1"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Banner Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/2"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Booking Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/3"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Home Page Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/4"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Posting Ad</p></a>
          </div>
          
        </div>

      </div>

    </div>
  </div>
</div>