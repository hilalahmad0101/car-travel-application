<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect2.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:48%;
    height:300px;
}


</style>

<div class="col-md-9">
    <div class="thumbnail margintop30 panelmargin5 ">

      
      <?php echo form_open_multipart('','id="addToursAndTravelsForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin:0px;">

              <div class="col-md-12">
                <h3>Add Tour Packages</h3>
              </div>

              <div class="col-md-4">

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">
                <input type="hidden"  class="form-control" id="keywords" name="keywords" value="<?php echo $data['postInfo']->tour_keywords; ?>">
                <input type="hidden"  class="form-control" id="postID" name="postID" value="<?php echo $data['postInfo']->tpID; ?>">
                <input type="hidden"  class="form-control" id="dimg" name="dimg" value="<?php echo $data['postImage']; ?>">

                <img id="blah" src="<?php echo $data['postImage']; ?>" style="width:100%; height:200px;">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="tour_images" name="tour_images[]">
                  <?php echo form_error('tour_images','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputBusinessName">Package Name</label>
                  <input type="text"  class="form-control" id="tourPackateName" name="tourPackateName" placeholder="Tour Package Name" value="<?php echo $data['postInfo']->tour_package_name; ?>">
                  <?php echo form_error('tourPackateName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="forSingle">
                  <label for="InputforSingle">For Single</label>
                  <input type="number" class="form-control" id="forSingle" name="forSingle" placeholder="forSingle" value="<?php echo $data['postInfo']->tour_for_single; ?>">
                  <?php echo form_error('forSingle','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="forCouple">
                  <label for="InputforCouple">For Couple</label>
                  <input type="number" class="form-control" id="forCouple" name="forCouple" placeholder="forCouple" value="<?php echo $data['postInfo']->tour_for_couple; ?>">
                  <?php echo form_error('forCouple','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="forExtraChild">
                  <label for="InputforExtraChild">For Extra Child</label>
                  <input type="number" class="form-control" id="forExtraChild" name="forExtraChild" placeholder="forExtraChild" value="<?php echo $data['postInfo']->tour_for_extra_child; ?>">
                  <?php echo form_error('forExtraChild','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputtourStartLocation">Start City and Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="tourStartLocation" placeholder='Type your city' value="<?php echo $data['postInfo']->tour_start_location; ?>" required>

                  <?php echo form_error('tourStartLocation','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="tourPlanDays">
                  <label for="InputtourPlanDays">Tour plan for number of days</label>
                  <select class="form-control" id="tourPlanDays" name="tourPlanDays" style="width: 100%;">
                      <?php 
                        for ($i=1; $i <= 31; $i++) { 
                             echo ($i == $data['postInfo']->tour_plan_days)?"<option selected value='".$i."'> ".$i." </option>":"<option value=".$i.">".$i."</option>";
                        }
                      ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="InputAccommodation">Accommodation</label>
                  <span style="float: right;">
                    <label class="radio-inline">
                        <input type="radio" id="accommodationSts1" name="accommodationSts" value="1" <?php echo  set_radio('accommodationSts', '1', ($data["postInfo"]->tour_accommodation_sts == 1)?TRUE:''); ?> > Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="accommodationSts2" name="accommodationSts" value="0" <?php echo  set_radio('accommodationSts', '0', ($data["postInfo"]->tour_accommodation_sts == 0)?TRUE:''); ?> > No
                    </label>
                  </span>

                  <textarea type="text" class="form-control" id="accommodationDesc" name="accommodationDesc" placeholder="Accommodation Desc"><?php echo $data['postInfo']->tour_accommodation_desc; ?></textarea>
                  <?php echo form_error('accommodationDesc','<div class="error text-danger">', '</div>'); ?>

                </div>

                
              </div>


              <div class="col-md-4">

                <div class="form-group">
                  <label for="InputFoodDesc">Food</label>
                  <span style="float: right;">
                    <label class="radio-inline">
                        <input type="radio" id="foodSts1" name="foodSts" value="1" <?php echo  set_radio('foodSts', '1', ($data["postInfo"]->tour_food_sts == 1)?TRUE:''); ?>> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="foodSts2" name="foodSts" value="0" <?php echo  set_radio('foodSts', '0', ($data["postInfo"]->tour_food_sts == 0)?TRUE:''); ?>> No
                    </label>
                  </span>
                  <textarea type="text" class="form-control" id="foodDesc" name="foodDesc" placeholder="foodDesc"><?php echo $data['postInfo']->tour_food_desc; ?></textarea>
                  <?php echo form_error('foodDesc','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputTransportDesc">Transportation</label>

                  <span style="float: right;">
                    <label class="radio-inline">
                        <input type="radio" id="transportSts1" name="transportSts" value="1" <?php echo  set_radio('transportSts', '1', ($data["postInfo"]->tour_transport_sts == 1)?TRUE:''); ?> > Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="transportSts2" name="transportSts" value="0" <?php echo  set_radio('transportSts', '0', ($data["postInfo"]->tour_transport_sts == 0)?TRUE:''); ?> > No
                    </label>
                  </span>

                  <textarea type="text" class="form-control" id="transportDesc" name="transportDesc" placeholder="transportDesc"><?php echo $data['postInfo']->tour_transport_desc; ?></textarea>
                  <?php echo form_error('transportDesc','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputSightseeing">Sightseeing</label>

                  <span style="float: right;">
                    <label class="radio-inline">
                        <input type="radio" id="siteseeingSts1" name="siteseeingSts" value="1" <?php echo  set_radio('siteseeingSts', '1', ($data["postInfo"]->tour_siteseeing_sts == 1)?TRUE:''); ?> > Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="siteseeingSts2" name="siteseeingSts" value="0" <?php echo  set_radio('siteseeingSts', '0', ($data["postInfo"]->tour_siteseeing_sts == 0)?TRUE:''); ?> > No
                    </label>
                  </span>

                  <textarea type="text" class="form-control" id="siteseeingDesc" name="siteseeingDesc" placeholder="siteseeingDesc"><?php echo $data['postInfo']->tour_siteseeing_desc; ?></textarea>
                  <?php echo form_error('siteseeingDesc','<div class="error text-danger">', '</div>'); ?>
                </div>



                <div class="form-group">
                  <label for="InputComplimentory">Complimentory</label>

                  <span style="float: right;">
                    <label class="radio-inline">
                        <input type="radio" id="complimentrySts1" name="complimentrySts" value="1" <?php echo  set_radio('complimentrySts', '1', ($data["postInfo"]->tour_complimentry_sts == 1)?TRUE:''); ?>> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="complimentrySts2" name="complimentrySts" value="0" <?php echo  set_radio('complimentrySts', '0', ($data["postInfo"]->tour_complimentry_sts == 0)?TRUE:''); ?> > No
                    </label>
                  </span>

                  <textarea type="text" class="form-control" id="complimentryDesc" name="complimentryDesc" placeholder="complimentryDesc"><?php echo $data['postInfo']->tour_complimentry_desc; ?></textarea>
                  <?php echo form_error('complimentryDesc','<div class="error text-danger">', '</div>'); ?>
                </div>


                


                <div class="form-group">
                  <label for="InputTourWhatInc">What is included</label>
                  <input type="text" class="form-control" id="tourWhatInc" name="tourWhatInc" placeholder="tourWhatInc" value="<?php echo $data['postInfo']->tour_what_inc; ?>">
                  <?php echo form_error('tourWhatInc','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputTourWhatNotInc">What is not included</label>
                  <input type="text" class="form-control" id="tourWhatNotInc" name="tourWhatNotInc" placeholder="tourWhatNotInc" value="<?php echo $data['postInfo']->tour_what_not_inc; ?>">
                  <?php echo form_error('tourWhatNotInc','<div class="error text-danger">', '</div>'); ?>
                </div>



              </div>


              <div class="col-md-4">

                <div class="form-group">
                  <label for="InputTourDescription">Description</label>
                  <textarea type="text" class="form-control" id="tourDescription" name="tourDescription" placeholder="tourDescription"><?php echo $data['postInfo']->tour_description; ?></textarea>
                  <?php echo form_error('tourDescription','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputTourContactNumber">Contact Number</label>
                  <input type="text" class="form-control" id="tourContactNumber" name="tourContactNumber" placeholder="tourContactNumber" value="<?php echo $data['postInfo']->tour_contact_number; ?>">
                  <?php echo form_error('tourContactNumber','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputTourContactEmail">Contact Email</label>
                  <input type="text" class="form-control" id="tourContactEmail" name="tourContactEmail" placeholder="tourContactEmail" value="<?php echo $data['postInfo']->tour_contact_email; ?>">
                  <?php echo form_error('tourContactEmail','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>
                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="postingLocation" placeholder='Type your city' value="<?php echo $data['postInfo']->tour_post_location; ?>" required>
                  <?php echo form_error('postingLocation','<div class="error text-danger">', '</div>'); ?>
                </div>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row" style="margin:0px;">
              <div class="col-md-12">


              <div class="form-group">
                
                  <?php 

                  $string = explode("#", $data['postInfo']->tour_keywords);

                  $keySelect = '';
                  if($keywords)
                  {
                    echo '<label for="InputKeywords">Select Keywords</label>';
                    foreach ($keywords as $a => $value) {
                      $keySelect .= $value->keywordName."#";
                    }
                    $keySelect = explode("#", substr($keySelect, 0, -1));                    
                  
                    $rem = array_diff($keySelect, $string);

                    echo "<select id='KeywordsDemo' multiple='multiple' class='form-control'>";
                    foreach ($rem as $a)
                    {
                      echo '<option value="'.$a.'">'.$a.'</option>';
                    }
                    if(!empty($string))
                    {
                        foreach ($string as $sa) 
                        {
                          echo '<option value="'.$sa.'" selected>'.$sa.'</option>';
                        }
                    }
                    echo "</select>";
                  }
                  else
                  {
                    $keySelect = array();
                  }



                  ?>
              </div>


              </div>
            </div>

            <div class="row" style="margin:0px;">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="InputTourContactEmail">Click here to Add keywords</label>
                      <input type="button" class="form-control btn-danger" id="addKeywords" name="addKeywords"  value="Add Keywords" required>
                      <?php echo form_error('tourContactEmail','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="form-control btn btn-info" id="ToursAndTravelsButtons" name="ToursAndTravelsButtons" value="Save"> Save</button>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

          <?php echo form_close(); ?>


            </div>
        </div>


      </div>
  </div>
</section>



<script type="text/javascript">

jQuery(function () {
    jQuery("#KeywordsDemo").gs_multiselect();
});

$(document).ready(function(){

  tour_images.onchange = evt => {
    const [file] = tour_images.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }

    $('#addKeywords').on("click",function(){

        // alert("Hi");

        console.log($("#KeywordsDemo").html());
        var values = [];
        $('#KeywordsDemo option').each(function() { 
            values.push( $(this).attr('value') );
        });

        $("#keywords").val(values.join("# "));

        console.log(values.join("# "));
    });


    // $("#accommodationDesc").hide();
    // $("#accommodationSts1").click(function(){
    //         $("#accommodationDesc").show();
    // });
    // $("#accommodationSts2").click(function(){
    //         $("#accommodationDesc").hide();
    //         $("#accommodationDesc").val('');
    // });

    // $("#foodDesc").hide();
    // $("#foodSts1").click(function(){
    //         $("#foodDesc").show();
    // });
    // $("#foodSts2").click(function(){
    //         $("#foodDesc").hide();
    //         $("#foodDesc").val('');
    // });

    // $("#transportDesc").hide();
    // $("#transportSts1").click(function(){
    //         $("#transportDesc").show();
    // });
    // $("#transportSts2").click(function(){
    //         $("#transportDesc").hide();
    //         $("#transportDesc").val('');
    // });

    // $("#siteseeingDesc").hide();
    // $("#siteseeingSts1").click(function(){
    //         $("#siteseeingDesc").show();
    // });
    // $("#siteseeingSts2").click(function(){
    //         $("#siteseeingDesc").hide();
    //         $("#siteseeingDesc").val('');
    // });

    // $("#complimentryDesc").hide();
    // $("#complimentrySts1").click(function(){
    //         $("#complimentryDesc").show();
    // });
    // $("#complimentrySts2").click(function(){
    //         $("#complimentryDesc").hide();
    //         $("#complimentryDesc").val('');
    // });

    // if($('input[name=accommodationSts]:checked').val() == 1){$("#accommodationDesc").show();}
    // if($('input[name=foodSts]:checked').val() ==1){$("#foodDesc").show();}
    // if($('input[name=transportSts]:checked').val() ==1){$("#transportDesc").show();}
    // if($('input[name=siteseeingSts]:checked').val()==1){$("#siteseeingDesc").show();}
    // if($('input[name=complimentrySts]:checked').val()==1){$("#complimentryDesc").show();}
});

$('#addToursAndTravelsForm').on('submit', function(e){  
     e.preventDefault();  
     var form = $(this);
      console.log(form.serialize());
    
        $("#ToursAndTravelsButtons").prop('disabled', 'true');

        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/Postings/editTourPackages", 
             method:"POST",
             type:"POST",
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
                  $('#ToursAndTravelsButtons').removeAttr("disabled");
                  alert(sosMsg);
                  
                }
             },
             error:function(res)
             {
              console.log(res);
             }
        });  
});





</script>