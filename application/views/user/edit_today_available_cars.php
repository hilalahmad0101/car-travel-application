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
                <input type="hidden"  class="form-control" id="postID" name="postID" value="<?php echo $data['postInfo']->tdaID; ?>">
                <input type="hidden"  class="form-control" id="dimg" name="dimg" value="<?php echo $data['postImage']; ?>">

                <img id="blah" src="<?php echo $data['postImage']; ?>" style="width:100%; height:200px;">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="vehicle_images" name="vehicle_images">
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
                          <option <?php echo ($k->keywordName == $data['postInfo']->tda_car_type)?"selected":""; ?> value="<?php echo $k->keywordName; ?>"><?php echo $k->keywordName; ?></option>
                        <?php
                      }
                    ?>
                  </select>

                  <?php echo form_error('vehicle_type','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="location" placeholder='Type your city' value="<?php echo $data['postInfo']->tda_location; ?>" required>

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
                  <button type="submit" class="form-control btn btn-info" id="todayCarsButtons" name="todayCarsButtons" value="Save">Save</button>
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

  vehicle_images.onchange = evt => {
    const [file] = vehicle_images.files
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
             url:"<?php echo base_url(); ?>web_api/api/CarPostings/editTodayAvailableCars", 
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