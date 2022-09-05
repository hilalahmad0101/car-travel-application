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
                    

      <?php echo form_open_multipart('','id="adsForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <?php  

                  if($this->uri->segment(3) == 1)
                  {
                    $adDisplayType = 'BannerAd';
                    echo '<h3>Ads - '.$adDisplayType.'</h3>';
                    ?>
                    <div class="form-group">
                      <label for="AdPostImage">Image upload</label>
                      <input type="file" accept="image/*" class="form-control" id="adpost_image" name="adImage" required>
                      <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Category</label>
                      <select id="businessCategory" name="businessCategory" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Category --</option>
                        <option value="CarTravelsOffices">Car Travels Offices</option>
                        <option value="HotelsAndResorts">Hotels And Resorts</option>
                        <option value="Mechanics">Mechanics</option>
                        <option value="OptingDrivers">Opting Drivers</option>
                        <option value="OwnerCumDriver">Owner Cum Driver</option>
                        <option value="SelfDrivingOffices">Self Driving Offices</option>
                        <option value="ToursAndTravels">Tours And Travels</option>
                      </select>
                      <?php echo form_error('businessCategory','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">URL</label>
                      <input type="text" class="form-control" name="btnAction" value="" required>
                      <?php echo form_error('btnAction','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <input type="hidden"  class="form-control" name="btnName" value="Use App">
                    <?php
                  }
                  elseif($this->uri->segment(3) == 2)
                  {
                    $adDisplayType = 'BookingAd';
                    echo '<h3>Ads - '.$adDisplayType.'</h3>';
                    ?>
                    <div class="form-group">
                      <label for="AdPostImage">Image upload</label>
                      <input type="file" accept="image/*" class="form-control" id="adpost_image" name="adImage" required>
                      <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Title</label>
                      <input type="text" class="form-control" name="adTitle" value="" required>
                      <?php echo form_error('adTitle','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Description</label>
                      <input type="text" class="form-control" name="adDesc" value="" required>
                      <?php echo form_error('adDesc','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Bottom Line Description</label>
                      <input type="text" class="form-control" name="btnLineText" value="" required>
                      <?php echo form_error('btnLineText','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Category</label>
                      <select id="businessCategory" name="businessCategory" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Category --</option>
                        <option value="CarTravelsOffices">Car Travels Offices</option>
                        <option value="HotelsAndResorts">Hotels And Resorts</option>
                        <option value="Mechanics">Mechanics</option>
                        <option value="OptingDrivers">Opting Drivers</option>
                        <option value="OwnerCumDriver">Owner Cum Driver</option>
                        <option value="SelfDrivingOffices">Self Driving Offices</option>
                        <option value="ToursAndTravels">Tours And Travels</option>
                      </select>
                      <?php echo form_error('businessCategory','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Choose a button</label>
                      <select name="btnName" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Button --</option>
                          <option value="Use App">Use App</option>
                          <option value="Download">Download</option>
                          <option value="Install">Install</option>
                          <option value="Book Now">Book Now</option>
                          <option value="Get Quote">Get Quote</option>
                          <option value="Shop Now">Shop Now</option>
                          <option value="View Gift Card">View Gift Card</option>
                          <option value="Order Food">Order Food</option>
                          <option value="Call Now">Call Now</option>
                          <option value="Contact Us">Contact Us</option>
                          <option value="Send Message">Send Message</option>
                          <option value="Whatsapp">Whatsapp</option>
                          <option value="Play Game">Play Game</option>
                          <option value="Sign Up">Sign Up</option>
                          <option value="Watch Video">Watch Video</option>
                          <option value="Learn More">Learn More</option>
                          <option value="Follow">Follow</option>
                      </select>
                      <?php echo form_error('btnName','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">URL / Number</label>
                      <input type="text" class="form-control" name="btnAction" value="" required>
                      <?php echo form_error('btnAction','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <?php
                  }
                  else if($this->uri->segment(3) == 3)
                  {
                    $adDisplayType = 'HomePageAd';
                    echo '<h3>Ads - '.$adDisplayType.'</h3>';
                    ?>
                    <div class="form-group">
                      <label for="AdPostImage">Image upload</label>
                      <input type="file" accept="image/*" class="form-control" id="adpost_image" name="adImage" required>
                      <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Title</label>
                      <input type="text" class="form-control" name="adTitle" value="" required>
                      <?php echo form_error('adTitle','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Description</label>
                      <input type="text" class="form-control" name="adDesc" value="" required>
                      <?php echo form_error('adDesc','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Bottom Line Description</label>
                      <input type="text" class="form-control" name="btnLineText" value="" required>
                      <?php echo form_error('btnLineText','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Choose a button</label>
                      <select name="btnName" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Button --</option>
                          <option value="Use App">Use App</option>
                          <option value="Download">Download</option>
                          <option value="Install">Install</option>
                          <option value="Book Now">Book Now</option>
                          <option value="Get Quote">Get Quote</option>
                          <option value="Shop Now">Shop Now</option>
                          <option value="View Gift Card">View Gift Card</option>
                          <option value="Order Food">Order Food</option>
                          <option value="Call Now">Call Now</option>
                          <option value="Contact Us">Contact Us</option>
                          <option value="Send Message">Send Message</option>
                          <option value="Whatsapp">Whatsapp</option>
                          <option value="Play Game">Play Game</option>
                          <option value="Sign Up">Sign Up</option>
                          <option value="Watch Video">Watch Video</option>
                          <option value="Learn More">Learn More</option>
                          <option value="Follow">Follow</option>
                      </select>
                      <?php echo form_error('btnName','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">URL / Number</label>
                      <input type="text" class="form-control" name="btnAction" value="" required>
                      <?php echo form_error('btnAction','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <?php
                  }
                  else if($this->uri->segment(3) == 4)
                  {
                    $adDisplayType = 'PostingAd';
                    echo '<h3>Ads - '.$adDisplayType.'</h3>';
                    ?>
                    <div class="form-group">
                      <label for="AdPostImage">Image upload</label>
                      <input type="file" accept="image/*" class="form-control" id="adpost_image" name="adImage" required>
                      <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Title</label>
                      <input type="text" class="form-control" name="adTitle" value="" required>
                      <?php echo form_error('adTitle','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Description</label>
                      <input type="text" class="form-control" name="adDesc" value="" required>
                      <?php echo form_error('adDesc','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">Bottom Line Description</label>
                      <input type="text" class="form-control" name="btnLineText" value="" required>
                      <?php echo form_error('btnLineText','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Choose a button</label>
                      <select name="btnName" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Button --</option>
                          <option value="Use App">Use App</option>
                          <option value="Download">Download</option>
                          <option value="Install">Install</option>
                          <option value="Book Now">Book Now</option>
                          <option value="Get Quote">Get Quote</option>
                          <option value="Shop Now">Shop Now</option>
                          <option value="View Gift Card">View Gift Card</option>
                          <option value="Order Food">Order Food</option>
                          <option value="Call Now">Call Now</option>
                          <option value="Contact Us">Contact Us</option>
                          <option value="Send Message">Send Message</option>
                          <option value="Whatsapp">Whatsapp</option>
                          <option value="Play Game">Play Game</option>
                          <option value="Sign Up">Sign Up</option>
                          <option value="Watch Video">Watch Video</option>
                          <option value="Learn More">Learn More</option>
                          <option value="Follow">Follow</option>
                      </select>
                      <?php echo form_error('btnName','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">URL / Number</label>
                      <input type="text" class="form-control" name="btnAction" value="" required>
                      <?php echo form_error('btnAction','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <?php
                  }
                  else
                  {
                    $adDisplayType = 'BannerAd';
                    echo '<h3>Ads - '.$adDisplayType.'</h3>';
                    ?>
                    <div class="form-group">
                      <label for="AdPostImage">Image upload</label>
                      <input type="file" accept="image/*" class="form-control" id="adpost_image" name="adImage" required>
                      <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputtourStartLocation">Category</label>
                      <select id="businessCategory" name="businessCategory" class="form-control" style="width: 100%;" required>
                        <option value="">-- Select Category --</option>
                        <option value="CarTravelsOffices">Car Travels Offices</option>
                        <option value="HotelsAndResorts">Hotels And Resorts</option>
                        <option value="Mechanics">Mechanics</option>
                        <option value="OptingDrivers">Opting Drivers</option>
                        <option value="OwnerCumDriver">Owner Cum Driver</option>
                        <option value="SelfDrivingOffices">Self Driving Offices</option>
                        <option value="ToursAndTravels">Tours And Travels</option>
                      </select>
                      <?php echo form_error('businessCategory','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label for="InputPostingLocation">URL</label>
                      <input type="text" class="form-control" name="btnAction" value="" required>
                      <?php echo form_error('btnAction','<div class="error text-danger">', '</div>'); ?>
                    </div>

                    <input type="hidden"  class="form-control" name="btnName" value="Use App">
                    
                    <?php
                  }

                  // print_r($this->session->userdata('details')->cartravels_id);

                ?>

                

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">
                <input type="hidden"  class="form-control" name="cartravelID" value="<?php echo $this->session->userdata('details')->cartravels_id; ?>">
                <input type="hidden"  class="form-control" name="adDisplayType" value="<?php echo $adDisplayType; ?>">
                


                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="adLocation" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>

                  <?php echo form_error('adLocation','<div class="error text-danger">', '</div>'); ?>
                </div>
                
              </div>

              <div class="col-md-6">
                <img id="blah" src="<?php echo base_url().'images/noimage.jpg'; ?>" style="width:200px; height:200px;" />
              </div>

            </div>
            <!-- /.row -->


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="card-footer">

            <div class="row" style="margin:0px;">
              <div class="col-md-6">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" id="adpostButton" name="adpostButton" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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

  adpost_image.onchange = evt => {
    const [file] = adpost_image.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }

});

$('#adsForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#adpostButton").prop('disabled', 'true');
        $("#adpostButton").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/AdPosts/addAdPost", 
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
                  $('#adpostButton').removeAttr("disabled");
                  $("#adpostButton").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});





</script>