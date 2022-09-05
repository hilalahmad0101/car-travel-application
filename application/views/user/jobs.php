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

      

      <?php echo form_open_multipart('','id="jobsForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">



              <div class="col-md-6">

                <h3>Jobs</h3>
                <h5>All fields are mandatory *</h5>
                    
                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="job_images" name="job_images" required>
                  <?php echo form_error('job_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">

                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>



                <div class="form-group">
                  <label>Job Type </label>
                  <select id="jobType" name="jobType" class="form-control" style="width: 100%;" required>
                    <option value="Wanted">Wanted</option>
                    <option value="Apply">Apply</option>
                  </select>
                  <?php echo form_error('jobType','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label>Title </label>
                  <input type="text" class="form-control" name="jobTitle" placeholder='' value="" required>
                  <?php echo form_error('jobTitle','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="row">
                  <div class="form-group col-md-6 col-xs-7">
                    <label>Salary Range From</label>
                    <input type="number"  placeholder="From" class="form-control" name="salaryFrom"  value="" required>
                    <?php echo form_error('salaryFrom','<div class="error text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group col-md-6 col-xs-5">
                    <label>To</label>
                    <input type="number"  placeholder="To" class="form-control" name="salaryTo" value="" required>
                    <?php echo form_error('salaryTo','<div class="error text-danger">', '</div>'); ?>
                  </div>
                </div>


                <div class="form-group">
                  <label>Salary Period </label>
                  <select id="salaryBased" name="salaryBased" class="form-control" style="width: 100%;" required>
                    <option value="Hourly">Hourly</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                  </select>
                  <?php echo form_error('salaryBased','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" name="jobDescription" placeholder='' value="" required></textarea>
                  <?php echo form_error('jobDescription','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="jobLocation" placeholder='Type your city' value="<?php echo @$this->session->userdata('export_type'); ?>" required>

                  <?php echo form_error('jobLocation','<div class="error text-danger">', '</div>'); ?>
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
                  <button type="submit" class="form-control btn btn-info" id="jobButtons" name="jobButtons" value="Save"><i class="fa fa-paper-plane-o"></i> Post</button>
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

$('#jobsForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      console.log(form.serialize());
      // return false;
    
        $("#jobButtons").prop('disabled', 'true');
        $("#jobButtons").html('<i class="fa fa-cog fa-spin"></i> Please wait posting...', 'true');

        // return false;


        $.ajax({  
             url:"https://cartravels.com/web_api/api/JobPostings/postJob", 
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
                  $('#jobButtons').removeAttr("disabled");
                  $("#jobButtons").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});





</script>