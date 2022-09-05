
<section id="content">
    <div class="container">

      <!-- <h3 class="text-center">My Posts</h3> -->
        <div class="row">
          <div class="col-md-12">
            <div class="thumbnail margintop30 panelmargin5 ">
              
              <div class="box-body">
                <ul class="nav nav-tabs nav-justified">
                  <li class="active"><a data-toggle="tab" href="#myposts">My Posts</a></li>
                  <li><a data-toggle="tab" href="#myads">My ADS</a></li>
                  <li><a data-toggle="tab" href="#favourites">FAVOURITES</a></li>
                </ul>


                <div class="tab-content">
                  <div id="myposts" class="tab-pane fade in active">
                    <h3 class="text-center">My Posts</h3>
                    

<?php
      if($myPostings)
      {
          foreach ($myPostings as $post) 
          {
              if(!empty($post->selfDriving))
              {
                  // echo "selfDriving";
                  ?>

                        <!-- <div class="card" style="auto">
                          <div class="card-header"><h3>Self Driving Vehicle </h3></div>
                          <img class="card-img-top" src="<?php echo $post->sdv_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->sdv_name; ?> 
                            </h4>

                          </div>
                        </div> -->

                        <div href="#" id="categoryList" class="list-group-item mb-15" > 
                          <div class="row">
                            <div class="col-md-4 pop">
                              <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->sdv_image; ?>" alt="" style="width: 100%; height: 150px;"> 
                            </div>
                            <div class="col-md-4">

                              <h4 class="text-black"><?php echo $post->sdv_name; ?> </h4>

                              <p> <?php echo $post->sdv_hours; ?></p>
                              <p> <?php echo $post->sdv_location; ?></p>

                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$post->postingID?>&uid=<?=$post->myUniid?>" class="form-control btn btn-success">view</a>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>user/addSelfDrivingCars/<?=$post->postingID?>" class="form-control btn btn-success">Edit</a>
                            </div>
                          </div>
                        </div>


                  
                  <?php
              }

              else if(!empty($post->todayAvailCars))
              {
                  // echo "todayAvailCars";
                  ?>

                        <!-- <div class="card" style="auto">
                          <div class="card-header"><h3>Available Car </h3></div>
                          <img class="card-img-top" src="<?php echo $post->tda_car_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->tda_car_type; ?> 
                            </h4>
                          </div>
                        </div> -->

                        <div href="#" id="categoryList" class="list-group-item mb-15" > 
                          <div class="row">
                            <div class="col-md-4 pop">
                              <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->tda_car_image; ?>" alt="" style="width: 100%; height: 150px;"> 
                            </div>
                            <div class="col-md-4">

                              <h4 class="text-black"><?php echo $post->tda_car_type; ?> </h4>

                              <!-- <p> <?php echo $post->other_desc; ?></p> -->
                              <p> <?php echo $post->tda_location; ?></p>

                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$post->postingID?>&uid=<?=$post->myUniid?>" class="form-control btn btn-success">view</a>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>user/addTodayAvailableCars/<?=$post->postingID?>" class="form-control btn btn-success">Edit</a>
                            </div>
                          </div>
                        </div>

                  <?php
              }

              else if(!empty($post->others))
              {
                  // echo "others";
                  ?>
                  

                        <div href="#" id="categoryList" class="list-group-item mb-15" > 
                          <div class="row">
                            <div class="col-md-4 pop">
                              <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->other_image; ?>" alt="" style="width: 100%; height: 150px;"> 
                            </div>
                            <div class="col-md-4">

                              <h4 class="text-black"><?php echo $post->other_title; ?> </h4>

                              <p> <?php echo $post->other_desc; ?></p>
                              <p> <?php echo $post->other_location; ?></p>

                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$post->postingID?>&uid=<?=$post->myUniid?>" class="form-control btn btn-success">view</a>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>user/addOthers/<?=$post->postingID?>" class="form-control btn btn-success">Edit</a>
                            </div>
                          </div>
                        </div>




                     
                  <?php
              }
              else if(!empty($post->tourPackage))
              {
                  // echo "tourPackage";
                  ?>
                  

                        <!-- <div class="card" style="auto">
                          <div class="card-header"><h3>Tour Packages </h3></div>
                          <img class="card-img-top" src="<?php echo $post->tourp_image; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->tour_package_name; ?> <br> 
                              <?php echo $post->tour_description; ?> <br> 
                              <?php echo $post->tour_keywords; ?> 
                            </h4>
                          </div>
                        </div> -->

                        <div href="#" id="categoryList" class="list-group-item mb-15" > 
                          <div class="row">
                            <div class="col-md-4 pop">
                              <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->tourp_image; ?>" alt="" style="width: 100%; height: 150px;"> 
                            </div>
                            <div class="col-md-4">

                              <h4 class="text-black"><?php echo $post->tour_package_name; ?> </h4>

                              <p> <?php echo $post->tour_description; ?></p>
                              <p> <?php echo $post->tour_keywords; ?></p>
                              <p> <?php echo $post->tour_post_location; ?></p>

                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$post->postingID?>&uid=<?=$post->myUniid?>" class="form-control btn btn-success">view</a>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>user/addTourpackage/<?=$post->postingID?>" class="form-control btn btn-success">Edit</a>
                            </div>
                          </div>
                        </div>

                     
                  <?php
              }
              else if(!empty($post->droppingCars))
              {
                  // echo "droppingCars";
                  ?>
                 

                        <!-- <div class="card" style="auto">
                          <div class="card-header"><h3>Dropping Cars </h3></div>
                          <img class="card-img-top" src="<?php echo $post->vehicle_images; ?>" alt="Card image" style="width:100%; height: auto;">
                          <div class="card-body">
                            <h4 class="card-title">
                              <?php echo $post->vehicle_type; ?> <br> 
                              Driver Name : <?php echo $post->driver_name; ?> <br> 
                              Driver Mobile : <?php echo $post->driver_mobile; ?><br>
                            </h4>
                          </div>
                        </div> -->

                        <div href="#" id="categoryList" class="list-group-item mb-15" > 
                          <div class="row">
                            <div class="col-md-4 pop">
                              <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->vehicle_images; ?>" alt="" style="width: 100%; height: 150px;"> 
                            </div>
                            <div class="col-md-4">

                              <h4 class="text-black"><?php echo $post->vehicle_type; ?> </h4>

                              <p> Driver Name : <?php echo $post->driver_name; ?></p>
                              <p> Driver Mobile : <?php echo $post->driver_mobile; ?></p>
                              <p> <?php echo $post->tda_location; ?></p>

                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>postshare/share/?pid=<?=$post->postingID?>&uid=<?=$post->myUniid?>" class="form-control btn btn-success">view</a>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <a href="<?php echo base_url(); ?>user/addDroppingCars/<?=$post->postingID?>" class="form-control btn btn-success">Edit</a>
                            </div>
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
                  <div id="myads" class="tab-pane fade">
                    <h3 class="text-center">My Ads</h3>
                    
<?php
    // echo "<pre>";
    // print_r($adInfo);
    // echo "</pre>";
      if($adInfo)
      {
          foreach ($adInfo as $post) 
          {

          ?>

                <div href="#" id="categoryList" class="list-group-item mb-15" > 
                  <div class="row">
                    <div class="col-md-4 pop">
                      <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $post->ad_image; ?>" alt="" style="width: 100%; height: 150px;"> 
                    </div>
                    <div class="col-md-4">

                      <h4 class="text-black"><?php echo $post->ad_display_type; ?> </h4>

                      <p> <?php echo $post->ad_title; ?></p>
                      <p> <?php echo $post->ad_location; ?></p>

                    </div>
                    <div class="col-md-2">
                        <input data-toggle='modal' data-target='#viewAdInfoModal' class="form-control btn btn-success" onclick="viewadinfo(<?php echo $post->adID; ?>)" value="View">
                    </div>

                  </div>
                </div>
          
          <?php

          }
      }
      else
      {
          echo '<div class="row">
          <div class="col-lg-4 col-sm-3"></div>
          <div class="col-lg-4 col-sm-6 col-xs-12 text-center">
          <center>
              <h2><u>No Ads</u></h2>
              <hr>
          </center>
          </div>
          <div class="col-lg-4 col-sm-3"></div>
          </div>';

      }
?>


                  </div>
                  <div id="favourites" class="tab-pane fade">
                    <h3 class="text-center">My Favourates</h3>
                    <p class="text-center">No data found</p>
                  </div>
                </div>

              </div>

            </div>


        </div>
    </div>
</section>









<div class="modal fade"  id="viewAdInfoModal" role="dialog">
  <div class="modal-dialog" style="width:400px;">

    <!-- Modal content-->
    <div class="modal-content" >

      <div class="modal-header">
        <button type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title text-center" id="myModalLabel">Ad Information</h4>
      </div>

      <div class="modal-body">
        <!-- <div class="row"> -->

          <form action="#" id="editInsuranceRemainderForm" method="post" accept-charset="utf-8">

            <input type="hidden" class="form-control" name="webRem" placeholder='' value="<?=base64_encode(date('Y-m-d'));?>" required>
            <input type="hidden" class="form-control" name="uniid" placeholder='' value="<?=$this->session->userdata('details')->uniid;?>" required>
            <input type="hidden" class="form-control" name="travelID" placeholder='' value="<?=$this->session->userdata('details')->cartravels_id;?>" required>
            <input type="hidden" class="form-control" name="insID" id="editInsID" value="" required>

            <div class="row">
              <div class="col-md-12 form-group">
                <img id="blah" class="img-thumbnail" src="http://localhost:81/apis/web/images/nophoto.jpg" style="width:100%; height:200px;">
              </div>
            </div>

            <div class="form-group">
              <label for="InputBusinessName">Image upload</label>
              <input type="file"  class="form-control" id="ad_images" name="ad_images">
              <?php echo form_error('ad_images','<div class="error text-danger">', '</div>'); ?>
            </div>

            <div class="row form-group">
              <div class="col-md-4 col-xs-4">
                <label> Category</label>
              </div>
              
              <div class="col-md-8 col-xs-8">
                <input type="text" class="form-control" name="ad_business_cat" id="ad_business_cat" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-4 col-xs-4">
                <label> Url </label>
              </div>
              
              <div class="col-md-8 col-xs-8">
                <input type="text" class="form-control" name="ad_btn_action" id="ad_btn_action" required value="">
              </div>
            </div>



            <div class="row form-group">
              <div class="col-md-4 col-xs-4">
                <label> Post Location </label>
              </div>
              
              <div class="col-md-8 col-xs-8">
                <input type="text" class="form-control" name="ad_location" id="ad_location" required value="">
              </div>
            </div>



            <!-- <div class="row">
              <div class="col-md-12">
                  <button type="submit" class="btn btn-default btn-block btnDanger" id="editInsuranceRemainderBtn">Save</button>
              </div>
            </div> -->

          </form>

          

        <!-- </div> -->
      </div>
    
    </div>

  </div>
</div>









<script type="text/javascript">

$(document).ready(function(){
  ad_images.onchange = evt => {
    const [file] = ad_images.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
});

$('#todayAvailableCarForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#todayCarsButtons").prop('disabled', 'true');
        $("#todayCarsButtons").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');


        $.ajax({  
             url:"https://cartravels.com/web_api/api/CarPostings/todayAvailableCars", 
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
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#todayCarsButtons').removeAttr("disabled");
                  $("#todayCarsButtons").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});


function viewadinfo(id)
{
  $("#blah").attr('src', 'https://thrombosis.kuleuven-kulak.be/wp-content/plugins/gallery-by-supsystic/src/GridGallery/Galleries/assets/img/loading.gif');
  $.ajax({
      type  : 'POST',
      dataType: 'json',
      url   : '<?php echo base_url();?>web_api/api/AdPosts/getOneAdInfo',
      data: { 
          adID: id
        },
      success : function(data){
        var bkr = data.adInfo;
        console.log(bkr);



        $("#blah").attr('src', bkr.ad_image);
        $("#ad_business_cat").val(bkr.ad_business_cat);
        $("#ad_btn_action").val(bkr.ad_btn_action);
        $("#ad_location").val(bkr.ad_location);

        $("#ad_images").val('');

        // $("#insuredName").val(bkr.ins_insured_name);

        // $("#editInsID").val(bkr.insID);
      }
  });
}


</script>