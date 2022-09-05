<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:50%;
    height:300px;
}

input[type="file"] {
  position: absolute;
  z-index: -1;
  top: 6px;
  left: 0;
  font-size: 15px;
  color: rgb(153,153,153);
  width: 200px;
  height: 100px;
}

</style>

<div class="col-md-9">
    <div class="thumbnail margintop30 panelmargin5 ">

      <h3>Add Tour Packages</h3>

      <?php  
        // echo "<pre>";
        // print_r($this->session->userdata('details'));

      ?>

                    
      <?php echo form_open('Registrations/editBusinessCat','id="editRegistrationForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row">

              <div class="col-md-4">

                <input type="hidden" id="userID" name="userID" value="">

                <div class="form-group">
                  <label>Business Category</label>
                  <select class="form-control" name="businessCategory" id="businessCategory"  style="width: 100%;">
                    <option value="">-- Change Category --</option>

                  </select>
                  <?php echo form_error('state','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="businessNameDiv">
                  <label for="InputBusinessName">Business Name</label>
                  <input type="text"  class="form-control" id="businessName" name="businessName" placeholder="Business Name" value="<?php echo @$user->uesr_Business_Name; ?><?php echo set_value('businessName'); ?>">
                  <?php echo form_error('businessName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="ownerNameDiv">
                  <label for="InputOwnerName">Owner Name</label>
                  <input type="text" class="form-control" id="ownerName" name="ownerName" placeholder="Owner Name" value="<?php echo @$user->user_Owner_Name; ?><?php echo set_value('ownerName'); ?>">
                  <?php echo form_error('ownerName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="userNameDiv">
                  <label for="InputUserName">User Name</label>
                  <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" value="<?php echo @$user->user_Name; ?><?php echo set_value('userName'); ?>">
                  <?php echo form_error('userName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="surNameDiv">
                  <label for="InputSurName">Surname</label>
                  <input type="text" class="form-control" id="surName" name="surName" placeholder="Surname" value="<?php echo @$user->user_Surname; ?><?php echo set_value('surName'); ?>">
                  <?php echo form_error('surName','<div class="error text-danger">', '</div>'); ?>
                </div>



                <div class="form-group">
                  <label for="InputEmail">E-Mail</label>
                  <input readonly type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?php echo @$user->user_Email; ?><?php echo set_value('email'); ?>">
                  <?php echo form_error('email','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputMobileNumber">Mobile Number</label>
                  <input readonly type="number" class="form-control" id="mobile" name="mobile" placeholder="99XXXXXX99" value="<?php echo @$user->user_Mobile_No; ?><?php echo set_value('mobile'); ?>">
                  <?php echo form_error('mobile','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputAlterMobileNumber">Alternate Mobile Number</label>
                  <input type="number" class="form-control" id="alterMobile" name="alterMobile" placeholder="999XXXX999" value="<?php echo @$user->user_Alter_Mobile_No; ?><?php echo set_value('alterMobile'); ?>">
                  <?php echo form_error('alterMobile','<div class="error text-danger">', '</div>'); ?>
                </div>
              </div>


              <div class="col-md-4">

                <div class="form-group">
                  <label>State</label>
                  <select class="form-control" name="state" id="state" style="width: 100%;">
                    <option value="">-- Select State --</option>

                    <?php 

                    foreach ($states as $s) 
                    {
                    ?>
                    <option title="<?php echo $s->state_code; ?>" sid="<?php echo $s->state_code; ?>" <?php echo ($s->state_name == $user->user_State)?'selected':''; ?>><?php echo $s->state_name; ?></option>
                    <?php
                    }

                    ?>

                  </select>
                  <?php echo form_error('state','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputDistrict">District</label>
                  <select class="form-control" name="district" id="district" style="width: 100%;"></select>
                  <?php echo form_error('district','<div class="error text-danger">', '</div>'); ?>
                </div>



                <div class="form-group">
                  <label for="InputCity">City</label>
                  <select class="form-control" id="city" name="city" style="width: 100%;"></select>
                  <?php echo form_error('city','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group" id="PlaceDiv">
                  <label for="InputPlace">Place</label>
                  <select class="form-control" id="place" name="place" style="width: 100%;"></select>
                  <?php echo form_error('place','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputStreet">Street</label>
                  <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?php echo @$user->user_Street; ?><?php echo set_value('street'); ?>">
                  <?php echo form_error('street','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputStreet">Land Mark</label>
                  <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Land Mark" value="<?php echo @$user->user_Landmark; ?><?php echo set_value('landmark'); ?>">
                  <?php echo form_error('landmark','<div class="error text-danger">', '</div>'); ?>
                </div>



              </div>


              <div class="col-md-4">

                <div class="form-group">
                  <label for="InputDoorNumber">Door Number</label>
                  <input type="text" class="form-control" id="doorNumber" name="doorNumber" placeholder="Door Number" value="<?php echo @$user->user_Door_No; ?><?php echo set_value('doorNumber'); ?>">
                  <?php echo form_error('doorNumber','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputPincode">Pin Code / Zip Code</label>
                  <input type="text" class="form-control" id="pincode" name="pincode" placeholder="pincode" value="<?php echo @$user->user_Pin_Code; ?><?php echo set_value('pincode'); ?>">
                  <?php echo form_error('pincode','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputLatitude">Latitude</label>
                  <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php echo @$user->user_Latitude; ?><?php echo set_value('latitude'); ?>">
                  <?php echo form_error('latitude','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputLongitude">Longitude</label>
                  <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php echo @$user->user_Longitude; ?><?php echo set_value('longitude'); ?>">
                  <?php echo form_error('longitude','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" data-toggle="modal" data-target="#modal-mapLatLong">
                  <a class="btn btn-app bg-primary" onclick="getLocation()">
                    <i class="fa fa-thumbtack"></i> Click here to get Lat, Long
                  </a>
                </div>

                <div id="sample"></div>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label for="InputWebsite">Website</label>
                  <input type="text" class="form-control" id="businessWebsiteName" name="businessWebsiteName" placeholder="www.abc.com" value="<?php echo @$user->user_Business_Website_Name; ?><?php echo set_value('businessWebsiteName'); ?>">
                  <?php echo form_error('businessWebsiteName','<div class="error text-danger">', '</div>'); ?>
                </div>


             <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon bg-aqua">
                    <i class="fa fa-globe"></i>&nbsp; http://www.cartravels.com/
                  </div>
                    <input type="text" class="form-control" id="websiteUrl" name="websiteUrl" placeholder="Website Url" value="<?php echo @$user->user_Website_Url; ?><?php echo set_value('websiteUrl'); ?>">
                </div>
                  <?php echo form_error('websiteUrl','<div class="error text-danger">', '</div>'); ?>
                  <span id="websiteUrlinfo"></span>

                <!-- /.input group -->
              </div>


              <div class="form-group">
                <iframe src="http://localhost:81/apis/<?php echo @$user->user_Website_Url; ?>" height="400" width="100%" title="<?php echo $user->user_Website_Url; ?>"></iframe>
              </div>


              <!-- <form method="post" id="upload_form" align="center" enctype="multipart/form-data">  
                  <input type="file" name="image_file" id="image_file" />  
                  <br />  
                  <br />  
                  <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
              </form>  -->



               <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon bg-red">
                    <i class="fa fa-facebook"></i>&nbsp; https://www.facebook.com/
                  </div>
                    <input type="text" class="form-control" id="facebookID" name="facebookID" placeholder="facebook ID" value="<?php echo set_value('facebookID'); ?><?php echo @$user->user_Facebook_ID; ?>">
                    <div class="input-group-addon bg-green">
                      <a href="https://www.facebook.com/<?php echo @$user->user_Facebook_ID; ?>" target="_blank" style="color:#fff;"><i class="fa fa-facebook"></i>&nbsp; Check Link</a>
                    </div>
                </div>
                  <?php echo form_error('facebookID','<div class="error text-danger">', '</div>'); ?>

                <!-- /.input group -->
              </div>


              <div class="form-group">
                


                  <?php 


                  $string = explode("#", substr(@$user->user_Keywords, 0, -1));

                  $keySelect = '';
                  if($keywords)
                  {
                    echo '<label for="InputKeywords">Keywords</label>';
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
                    foreach ($string as $sa) 
                    {
                      echo '<option value="'.$sa.'" selected>'.$sa.'</option>';
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

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="card-footer">

            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" name="Create Travel Office" value="Edit Registration"><i class="fa fa-save"></i> Save</button>
                </div>
              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <a href="javascript:void(0)" onclick="deleteBusinessCat();" class="form-control btn btn-danger" name="DelReg" value="Delete Registration"><i class="fa fa-save"></i> Delete</a>
                </div>
              </div>
            </div>

            
          </div>
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

</script>