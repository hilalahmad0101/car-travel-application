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

      
      <?php echo form_open_multipart('','id="vcForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <h3>Promote Visiting Card</h3>
                <h5>All fields are mandatory *</h5>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="vc_images" name="vc_images" required>
                  <?php echo form_error('vc_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">

                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>


                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" name="desc" placeholder='' value="" required></textarea>
                  <?php echo form_error('desc','<div class="error text-danger">', '</div>'); ?>
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
                  <button type="submit" class="form-control btn btn-info" id="vcButtons" name="vcButtons" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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

$('#vcForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#vcButtons").prop('disabled', 'true');
        $("#vcButtons").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');

        // return false;


        $.ajax({  
             url:"https://cartravels.com/web_api/api/Postings/promoteVCards", 
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
                  $('#vcButtons').removeAttr("disabled");
                  $("#vcButtons").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});





</script>