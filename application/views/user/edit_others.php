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

      
                    

      <?php echo form_open_multipart('','id="othersForm"'); ?>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row" style="margin: 0px;">

              <div class="col-md-6">

                <h3>Others</h3>
                <h5>All fields are mandatory *</h5>

                <input type="hidden"  class="form-control" id="uniid" name="uniid" value="<?php echo $this->session->userdata('ctuid'); ?>">
                <input type="hidden"  class="form-control" id="postID" name="postID" value="<?php echo $data['postInfo']->otherID; ?>">
                <input type="hidden"  class="form-control" id="dimg" name="dimg" value="<?php echo $data['postImage']; ?>">

                <img id="blah" src="<?php echo $data['postImage']; ?>" style="width:100%; height:200px;">

                <div class="form-group">
                  <label for="InputBusinessName">Image upload</label>
                  <input type="file"  class="form-control" id="other_images" name="other_images">
                  <?php echo form_error('other_images','<div class="error text-danger">', '</div>'); ?>
                </div>

                <hr style="border-top: 1px dashed red;">

                <?php  
                  $cityJaonData = json_decode(file_get_contents(base_url().'assets/citieslist.json'));
                ?>

                <div class="form-group">
                  <label>Title </label>
                  <input type="text" class="form-control" name="title" placeholder='' value="<?php echo $data['postInfo']->other_title; ?>" required>
                  <?php echo form_error('title','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" name="desc" placeholder='' required><?php echo $data['postInfo']->other_desc; ?></textarea>
                  <?php echo form_error('desc','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputPostingLocation">Post Location</label>

                  <input type="text" class="form-control" id='cartravels-cities-dropdown' name="location" placeholder='Type your city' value="<?php echo $data['postInfo']->other_location; ?>" required>

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

  other_images.onchange = evt => {
    const [file] = other_images.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }

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
             url:"<?php echo base_url(); ?>web_api/api/Postings/editOthers", 
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