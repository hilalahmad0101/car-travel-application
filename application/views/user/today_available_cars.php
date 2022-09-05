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
                    

      <?php echo form_open_multipart('','id="todayAvailableCarForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <h3>Today Available Cars</h3>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="vehicle_images" name="vehicle_images" required>
                  <?php echo form_error('vehicle_images','<div class="error text-danger">', '</div>'); ?>
                </div>


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


                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>

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
        <div class="box-footer">
          <div class="card-footer">

            <div class="row" style="margin:0px;">
              <div class="col-md-6">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" id="todayCarsButtons" name="todayCarsButtons" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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





</script>