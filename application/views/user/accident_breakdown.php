<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect2.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:50%;
    height:300px;
}
</style>

<script type="text/javascript">
function initGeolocation()
{
  if( navigator.geolocation )
  {
    // Call getCurrentPosition with success and failure callbacks
    navigator.geolocation.getCurrentPosition( success, fail );
  }
  else
  {
    alert("Sorry, your browser does not support geolocation services.");
  }
}
function success(position)
{
  document.getElementById('longitude').value = position.coords.longitude;
  document.getElementById('latitude').value = position.coords.latitude
}
function fail()
{
// Could not obtain location
}
initGeolocation();   
</script>

<div class="col-md-9">
    <div class="thumbnail margintop30 panelmargin5 ">


      
                    

      <?php echo form_open_multipart('','id="othersForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <h3>Accident / Breakdown</h3>
                <h5>All fields are mandatory *</h5>
                <h5>Know your location click  Allow</h5>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="accbw_images" name="accbw_images" required>
                  <?php echo form_error('accbw_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">

                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>

                <div class="form-group">
                  <label>Accident / Breakdown Title </label>
                  <input type="text" class="form-control" name="accBreakTitle" placeholder='' value="Need Help" required>
                  <?php echo form_error('accBreakTitle','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="row">
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Latitude</label>
                    <input type="text" readonly class="form-control" name="latitude" id="latitude" value="" required>
                    <?php echo form_error('latitude','<div class="error text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Longitude</label>
                    <input type="text" readonly class="form-control" name="longitude" id="longitude" value="" required>
                    <?php echo form_error('longitude','<div class="error text-danger">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" name="dedication" placeholder='' value="" required></textarea>
                  <?php echo form_error('dedication','<div class="error text-danger">', '</div>'); ?>
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
                  <button type="submit" class="form-control btn btn-info" id="otherButtons" name="otherButtons" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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



});

$('#othersForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#otherButtons").prop('disabled', 'true');
        $("#otherButtons").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');

        // return false;


        $.ajax({  
             url:"https://cartravels.com/web_api/api/Postings/postAccidentBreakdown", 
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
                  $('#otherButtons').removeAttr("disabled");
                  $("#otherButtons").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});





</script>