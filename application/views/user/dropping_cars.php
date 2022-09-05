<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect2.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:50%;
    height:300px;
}


</style>

<div class="col-md-9">
    <div class="thumbnail margintop30 panelmargin5 ">                    

      <?php echo form_open_multipart('','id="droppingCarsForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <h3>Dropping Cars</h3>
                <h5>All fields are mandatory *</h5>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="vehicle_images" name="vehicle_images" required>
                  <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">



                <div class="form-group row" style="background-color: #f1f1f1;">
                  <div class=" col-md-3 col-xs-3">
                    <label>Stopovers </label>
                  </div>
                  <div class="col-md-9 col-xs-9">
                    <span id="viaCitiesList"></span>
                    <input type="hidden" class="form-control" name="via_cities_list" id="via_cities_list" value="" >

        


                    <div class="input-group">
                      <input type="text" class="form-control ui-autocomplete-input" id="cartravels-cities-dropdown" name="addViaCity" autocomplete="off" placeholder='Type your city'>
                      <span class="input-group-addon" id="addViaCityBtn">Add</span>
                    </div>

                  </div>
                </div>




                <div class="form-group row">
                  <div class=" col-md-3 col-xs-3">
                    <label>Pickup City </label>
                    <input type="hidden" name="pickupLat" value="0">
                    <input type="hidden" name="pickupLong" value="0">
                    <input type="hidden" name="dropLat" value="0">
                    <input type="hidden" name="dropLong" value="0">
                  </div>
                  <div class="col-md-9 col-xs-9">

                    <input type="text" class="form-control" id='cartravels-cities-dropdown' name="pickupCity" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>
                    <?php echo form_error('pickupCity','<div class="error text-danger">', '</div>'); ?>

                  </div>
                </div>

                <div class="form-group row">
                  <div class=" col-md-3 col-xs-3">
                    <label>Drop City </label>
                  </div>
                  <div class="col-md-9 col-xs-9">

                    <input type="text" class="form-control" id='cartravels-cities-dropdown' name="dropCity" placeholder='Type your city' value="" required>
                    <?php echo form_error('dropCity','<div class="error text-danger">', '</div>'); ?>

                  </div>
                </div>
                
                <hr style="border-top: 1px dashed red;">

                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>


                <div class="row">
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Journey Date</label>
                    <input type="date" maxlength="10" class="form-control" name="journey_date"  value="<?php echo date('Y-m-d'); ?>" required>
                    <?php echo form_error('journey_date','<div class="error text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Time</label>
                    <input type="time" maxlength="10" class="form-control" name="journey_time" value="<?php echo date('H:i'); ?>" required>
                    <?php echo form_error('journey_time','<div class="error text-danger">', '</div>'); ?>
                  </div>
                </div>


                <div class="row">
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Available Seats</label>
                    <input type="number" maxlength="10" class="form-control" name="available_seats" placeholder='Ex:5' value="" required>
                    <?php echo form_error('available_seats','<div class="error text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Ticket Fare / Seat</label>
                    <input type="number" maxlength="10" class="form-control" name="ticket_fair" placeholder='Ex:500' value="" required>
                    <?php echo form_error('ticket_fair','<div class="error text-danger">', '</div>'); ?>
                  </div>
                </div>

                <hr style="border-top: 1px dashed red;">

                <div class="form-group">
                  <label for="InputtourStartLocation">Vehicle Type : </label>

                <!-- <div class="input-group"> -->
                  <select id="vehicle_type" name="vehicle_type" class="select2 form-control" style="width: 100%;" required>
                    <option value="">-- Select Vehicle --</option>
                    <?php  
                      foreach ($keywords as $k) {
                        ?>
                          <option value="<?php echo $k->keywordName; ?>"><?php echo $k->keywordName; ?></option>
                        <?php
                      }
                    ?>
                  </select>

                  <?php echo form_error('vehicle_type','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Driver Name</label>
                  <input type="text" maxlength="10" class="form-control" name="driver_name" placeholder='Driver Name' value="" required>
                  <?php echo form_error('driver_name','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Driver Mobile Number</label>
                  <input type="text" maxlength="10" class="form-control" name="driver_mobile" placeholder='987XXXXXXX' value="" required>
                  <?php echo form_error('driver_mobile','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="location" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>

                  <?php echo form_error('location','<div class="error text-danger">', '</div>'); ?>
                </div>
                
              </div>



            </div>
            <!-- /.row -->


        </div>
        <!-- /.box-body -->
        <div class="box-footer" >
          <div class="card-footer">

            <div class="row"style=" margin: 0px;">
              <div class="col-md-6 col-xs-12">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" id="droppingCarsButtons" name="droppingCarsButtons" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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

  $("#addViaCityBtn").on('click', function(){
    var vcity = $('input[name=addViaCity]').val();
    if($('#viaCitiesList').html() == '')
    {
      $('#viaCitiesList').html(vcity);
      $('input[name=addViaCity]').val('');
      $('#via_cities_list').val(vcity);
    }
    else
    {
      $('#viaCitiesList').append('#'+vcity);
      $('input[name=addViaCity]').val('');
      $("#via_cities_list").val(function() {
        return this.value + '#' + vcity;
      });
    }

    console.log(vcity);
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
             url:"https://cartravels.com/web_api/api/CarPostings/addDroppingCars", 
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