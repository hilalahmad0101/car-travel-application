<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect2.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:50%;
    height:300px;
}

.fareSelected
{
  background-color: #AB1818;
  color: #fff;
}



.input-group-addon:first-child {
    border-right: 0;
    padding: 3px;
}

#fareDesign .fareSelected p {
    margin: 0 0 0px;
    padding: 10px;
}

.input-group-addon {
    padding: 3px 3px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    text-align: center;
    border-radius: 4px;
}

#vechicleTypeCheck .checked
{
  background-color: #AB1818;
  color:#fff;
}


</style>

<div class="col-md-9">
    <div class="thumbnail margintop30 panelmargin5 ">


                    

      <?php echo form_open_multipart('','id="droppingCarsForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-8">

                <h3>Self Driving Cars</h3>
                <h5>All fields are mandatory *</h5>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">
                <input type="hidden"  class="form-control" id="postID" name="postID" value="<?php echo $data['postInfo']->selfDriving; ?>">
                <input type="hidden"  class="form-control" id="dimg" name="dimg" value="<?php echo $data['postImage']; ?>">

                

                <div class="form-group input-group" id="vechicleTypeCheck">
                <span class="input-group-addon checked">
                  <label style="padding: 10px;">
                    <input type="radio" name="vehicleType" value="Car" <?php echo ($this->session->userdata('vType') == 'SelfDrivingOffices')?'checked':''; ?>> Car
                  </label>
                </span>
                <span class="input-group-addon">
                  <label style="padding: 10px;">
                    <input type="radio"  name="vehicleType" value="Bike/Scooter" <?php echo ($this->session->userdata('vType') == 'Bikes')?'checked':''; ?>> Bike/Scooter
                  </label>
                </span>
              </div>

                <img id="blah" src="<?php echo $data['postImage']; ?>" style="width:100%; height:200px;">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="sdv_images" name="sdv_images">
                  <?php echo form_error('sdv_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">

  

              <div class="form-group input-group">
                <span class="input-group-btn">
                  <label class="btn btn-danger" type="button">
                    <input type="radio" name="hours" value="1"> 1 Hour
                  </label>
                </span>
                <input type="text" name="HoursFare1" class="form-control" placeholder="1 Hours Fare" required value="<?php echo $data['postInfo']->sdv_HoursFare_1; ?>">
              </div>

              <div class="form-group input-group">
                <span class="input-group-btn">
                  <label class="btn btn-danger" type="button">
                  <input type="radio" name="hours" value="12"> 12 Hours
                </label>
                </span>
                <input type="text" name="HoursFare12" class="form-control" placeholder="12 Hours Fare" required value="<?php echo $data['postInfo']->sdv_HoursFare_12; ?>">
              </div>

              <div class="form-group input-group">
                <span class="input-group-btn">
                  <label class="btn btn-danger" type="button">
                    <input type="radio" name="hours" value="24" checked> 24 Hours
                  </label>
                </span>
                <input type="text" name="HoursFare24" class="form-control" placeholder="24 Hours Fare" required value="<?php echo $data['postInfo']->sdv_HoursFare_24; ?>">
              </div>


                <div class="form-group">
                  <label for="InputtourStartLocation">Vehicle Type : </label>

                  <!-- <div class="input-group"> -->
                  <select id="vehicleName" name="vehicleName" class="select2 form-control" style="width: 100%;" required>
                    <option value="">-- Select Vehicle --</option>
                    <?php  
                      foreach ($keywords as $k) {
                        ?>
                          <option <?php echo ($k->keywordName == $data['postInfo']->sdv_name)?"selected":""; ?> value="<?php echo $k->keywordName; ?>"><?php echo $k->keywordName; ?></option>
                        <?php
                      }
                    ?>
                  </select>

                  <?php echo form_error('vehicleName','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputtourStartLocation">Fuel Type : </label>

                <!-- <div class="input-group"> -->
                  <select id="fuelType" name="fuelType" class="select2 form-control" style="width: 100%;" required>
                    <option value="">-- Select Vehicle --</option>
                    <option <?php echo ("Petrol"== $data['postInfo']->sdv_fuel_type)?"selected":""; ?> value="Petrol">Petrol</option>
                    <option <?php echo ("Diesel" == $data['postInfo']->sdv_fuel_type)?"selected":""; ?> value="Diesel">Diesel</option>
                    <option <?php echo ("LPG" == $data['postInfo']->sdv_fuel_type)?"selected":""; ?> value="LPG">LPG</option>
                    <option <?php echo ("Battery" == $data['postInfo']->sdv_fuel_type)?"selected":""; ?> value="Battery">Battery</option>
                    <option <?php echo ("Electrical" == $data['postInfo']->sdv_fuel_type)?"selected":""; ?> value="Electrical">Electrical</option>
                  </select>

                  <?php echo form_error('fuelType','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label>Year of Model</label>
                  <input type="text" maxlength="4" minlength="4" class="form-control" name="vehicleYear" placeholder='Ex: 2005' value="<?php echo $data['postInfo']->sdv_vehicle_year; ?>" required>

                  <?php echo form_error('vehicleYear','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="location" placeholder='Type your city' value="<?php echo $data['postInfo']->sdv_location; ?>" required>

                  <?php echo form_error('location','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputPostingLocation">Description</label>

                  <textarea class="form-control" name="desc" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>
<?php echo $data['postInfo']->sdv_vehicle_desc; ?></textarea>

                  <?php echo form_error('desc','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputPostingLocation">Terms and Conditions</label>

                  <textarea rows="6" class="form-control"  name="termsAndConditions" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>
<?php echo $data['postInfo']->sdv_terms_cond; ?></textarea>

                  <?php echo form_error('termsAndConditions','<div class="error text-danger">', '</div>'); ?>
                </div>
                
              </div>



            </div>
            <!-- /.row -->


        </div>
        <!-- /.box-body -->
        <div class="box-footer" >
          <div class="card-footer">

            <div class="row"style=" margin: 0px;">
              <div class="col-md-8 col-xs-12">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" id="droppingCarsButtons" name="droppingCarsButtons" value="Save">Save</button>
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



$(document).ready(function(){

  sdv_images.onchange = evt => {
    const [file] = sdv_images.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }

  $('input[name=vehicleType]').on('click', function(){
      console.log(this.value);

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>user/set_ctype/",
          data: {cType: this.value},
          success: function(data) {
            location.reload();
          },  
          dataType: "json"
        });

  });

});

$('#droppingCarsForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#droppingCarsButtons").prop('disabled', 'true');
        $("#droppingCarsButtons").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');

        // return false;


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/SelfDriving/editSelfDrivingVehicle", 
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
                  $('#droppingCarsButtons').removeAttr("disabled");
                  $("#droppingCarsButtons").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});





</script>