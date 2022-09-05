            <div class="col-md-9">
                <div class="thumbnail margintop30 panelmargin5 ">



<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.js"></script>
<link href="<?php echo base_url(); ?>assets/keywords/jquery.multiselect.css" rel="stylesheet">
<style>

#KeywordsDemo {
    width:50%;
    height:300px;
}

input[type="file"] {
  /*position: absolute;*/
  z-index: -1;
  top: 6px;
  left: 0;
  font-size: 15px;
  color: rgb(153,153,153);
  width: 200px;
  height: 100px;
  background-color: #adcde985;
}

</style>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        Edit Profile
      </h3>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default" id="deleteCategoryUserInfo">
        <div class="box-header with-border">
          <h4 class="box-title"><?php echo $user->user_Business_Category; ?>
            <span id="editRegStatus"></span>
          </h4>
        </div>

        <?php echo form_open('Registrations/editBusinessCat','id="editRegistrationForm"'); ?>

        <div class="box-body">

            <div class="row" style="margin:0px;">

              <div class="col-md-4">

                <input type="hidden" id="userID" name="userID" value="<?php echo $user->user_uniid; ?>">

                <div class="form-group">
                  <label>Business Category</label>
                  <select class="form-control" name="businessCategory" id="businessCategory"  style="width: 100%;">
                    <option value="">-- Change Category --</option>

                    <option <?php echo ("CarTravelsOffices" == $user->user_Business_Category)?'selected':''; ?> value="CarTravelsOffices">Car Travels Offices</option>
                    <option <?php echo ("OwnerCumDrivers" == $user->user_Business_Category)?'selected':''; ?> value="OwnerCumDrivers">Owner Cum Drivers</option>
                    <option <?php echo ("Drivers" == $user->user_Business_Category)?'selected':''; ?> value="Drivers">Drivers</option>
                    <option <?php echo ("SelfDrivingOffices" == $user->user_Business_Category)?'selected':''; ?> value="SelfDrivingOffices">Self Driving Offices</option>
                    <option <?php echo ("OptingDrivers" == $user->user_Business_Category)?'selected':''; ?> value="OptingDrivers">Opting Drivers</option>
                    <option <?php echo ("Tenders" == $user->user_Business_Category)?'selected':''; ?> value="Tenders">Tenders</option>
                    <option <?php echo ("ToursAndTravels" == $user->user_Business_Category)?'selected':''; ?> value="ToursAndTravels">Tours And Travels</option>
                    <option <?php echo ("Mechanics" == $user->user_Business_Category)?'selected':''; ?> value="Mechanics">Mechanics</option>
                    <option <?php echo ("HotelsAndResorts" == $user->user_Business_Category)?'selected':''; ?> value="HotelsAndResorts">Hotels And Resorts</option>
                    <option <?php echo ("Ads" == $user->user_Business_Category)?'selected':''; ?> value="Ads">Ads</option>
                    <option <?php echo ("NormalUser" == $user->user_Business_Category)?'selected':''; ?> value="NormalUser">Normal User</option>

                  </select>
                  <?php echo form_error('state','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="businessNameDiv">
                  <label for="InputBusinessName">Business Name</label>
                  <input type="text"  class="form-control" id="businessName" name="businessName" placeholder="Business Name" value="<?php echo $user->uesr_Business_Name; ?><?php echo set_value('businessName'); ?>">
                  <?php echo form_error('businessName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="ownerNameDiv">
                  <label for="InputOwnerName">Owner Name</label>
                  <input type="text" class="form-control" id="ownerName" name="ownerName" placeholder="Owner Name" value="<?php echo $user->user_Owner_Name; ?><?php echo set_value('ownerName'); ?>">
                  <?php echo form_error('ownerName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="userNameDiv">
                  <label for="InputUserName">User Name</label>
                  <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" value="<?php echo $user->user_Name; ?><?php echo set_value('userName'); ?>">
                  <?php echo form_error('userName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="surNameDiv">
                  <label for="InputSurName">Surname</label>
                  <input type="text" class="form-control" id="surName" name="surName" placeholder="Surname" value="<?php echo $user->user_Surname; ?><?php echo set_value('surName'); ?>">
                  <?php echo form_error('surName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" id="professionDiv">
                  <label>Profession </label>
                  <select class="form-control" name="profession" id="profession" style="width: 100%;">
                    <option value="">--- Select Profession ---</option>
                    <?php 

                    foreach ($profession as $p)
                    {
                    ?>
                    <option title="<?php echo $p->profession_name; ?>" <?php echo ($p->profession_name == $user->user_Proffession)?'selected':''; ?>><?php echo $p->profession_name; ?></option>
                    <?php
                    }

                    ?>

                  </select>
                  <?php echo form_error('profession','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputEmail">E-Mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?php echo $user->user_Email; ?><?php echo set_value('email'); ?>">
                  <?php echo form_error('email','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputMobileNumber">Mobile Number</label>
                  <input type="number" class="form-control" id="mobile" name="mobile" placeholder="99XXXXXX99" value="<?php echo $user->user_Mobile_No; ?><?php echo set_value('mobile'); ?>">
                  <?php echo form_error('mobile','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputAlterMobileNumber">Alternate Mobile Number</label>
                  <input type="number" class="form-control" id="alterMobile" name="alterMobile" placeholder="999XXXX999" value="<?php echo $user->user_Alter_Mobile_No; ?><?php echo set_value('alterMobile'); ?>">
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
                  <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?php echo $user->user_Street; ?><?php echo set_value('street'); ?>">
                  <?php echo form_error('street','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputStreet">Land Mark</label>
                  <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Land Mark" value="<?php echo $user->user_Landmark; ?><?php echo set_value('landmark'); ?>">
                  <?php echo form_error('landmark','<div class="error text-danger">', '</div>'); ?>
                </div>



              </div>


              <div class="col-md-4">

                <div class="form-group">
                  <label for="InputDoorNumber">Door Number</label>
                  <input type="text" class="form-control" id="doorNumber" name="doorNumber" placeholder="Door Number" value="<?php echo $user->user_Door_No; ?><?php echo set_value('doorNumber'); ?>">
                  <?php echo form_error('doorNumber','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputPincode">Pin Code / Zip Code</label>
                  <input type="text" class="form-control" id="pincode" name="pincode" placeholder="pincode" value="<?php echo $user->user_Pin_Code; ?><?php echo set_value('pincode'); ?>">
                  <?php echo form_error('pincode','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputLatitude">Latitude</label>
                  <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php echo $user->user_Latitude; ?><?php echo set_value('latitude'); ?>">
                  <?php echo form_error('latitude','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label for="InputLongitude">Longitude</label>
                  <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php echo $user->user_Longitude; ?><?php echo set_value('longitude'); ?>">
                  <?php echo form_error('longitude','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group" data-toggle="modal" data-target="#modal-mapLatLong">
                  <a class="btn btn-app bg-primary" >
                    <!-- onclick="getLocation()" -->
                    <i class="fa fa-thumbtack"></i> Click here to get Latitude, Longitude
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
                  <input type="text" class="form-control" id="businessWebsiteName" name="businessWebsiteName" placeholder="www.abc.com" value="<?php echo $user->user_Business_Website_Name; ?><?php echo set_value('businessWebsiteName'); ?>">
                  <?php echo form_error('businessWebsiteName','<div class="error text-danger">', '</div>'); ?>
                </div>


             <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon bg-aqua">
                    <i class="fa fa-globe"></i>&nbsp; https://www.cartravels.com/
                  </div>
                    <input readonly type="text" class="form-control" id="websiteUrl" name="websiteUrl" placeholder="Website Url" value="<?php echo $user->user_Website_Url; ?><?php echo set_value('websiteUrl'); ?>">
                </div>
                  <?php echo form_error('websiteUrl','<div class="error text-danger">', '</div>'); ?>
                  <span id="websiteUrlinfo"></span>

                <!-- /.input group -->
              </div>


              <!-- <div class="form-group">
                <iframe src="https://www.cartravels.com/<?php echo $user->user_Website_Url; ?>" height="400" width="100%" title="<?php echo $user->user_Website_Url; ?>"></iframe>
              </div> -->


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
                    <input type="text" class="form-control" id="facebookID" name="facebookID" placeholder="facebook ID" value="<?php echo set_value('facebookID'); ?><?php echo $user->user_Facebook_ID; ?>">
                    <div class="input-group-addon bg-green">
                      <a href="https://www.facebook.com/<?php echo $user->user_Facebook_ID; ?>" target="_blank" style="color:#fff;"><i class="fa fa-facebook"></i>&nbsp; Check Link</a>
                    </div>
                </div>
                  <?php echo form_error('facebookID','<div class="error text-danger">', '</div>'); ?>

                <!-- /.input group -->
              </div>


              <div class="form-group">
                


                  <?php 


                  $string = explode("#", substr($user->user_Keywords, 0, -1));

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
              <div class="col-md-12">

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" name="Create Travel Office" value="Edit Registration"><i class="fa fa-save"></i> Save</button>
                </div>
              </div>


            </div>

            
          </div>
          <?php echo form_close(); ?>




            <div class="row">

              <div class="col-md-4">

                 <div class="form-group">
                    <div class="input-group">
                      <label for="pp">Update Profile Photo</label>
                      <form method="post" id="upload_form" align="center" enctype="multipart/form-data">
                        <input type="hidden" name="uniid" value="<?php echo $user->user_uniid; ?>">
                        <input type="file" class="form-control" id="profilePic" name="profilePic">
                        
                        <!-- <div class="input-group-addon bg-aqua btn-block"> -->
                          <input type="submit" name="uploadProfile" id="uploadProfile" value="Upload Profile Image" class="btn btn-info btn-block" /> 
                        <!-- </div> -->

                      </form>
                    </div>

                  </div>
              </div>

              <div class="col-md-4">
                 <div class="form-group">
                  <label for="pcp">Update Cover Photo</label>
                    <div class="input-group">
                      <form method="post" id="uploadCoverPhoto_form" align="center" enctype="multipart/form-data">
                        <input type="hidden" name="uniid" value="<?php echo $user->user_uniid; ?>">
                        <input type="file" class="form-control" id="coverPhoto" name="coverPhoto">
                        
                        <!-- <div class="input-group-addon bg-aqua btn-block"> -->
                          <input type="submit" name="upload" id="upload" value="Upload Cover Photo Image" class="btn btn-info btn-block" /> 
                        <!-- </div> -->

                      </form>
                    </div>

                  </div>
              </div>


            </div>

            <div class="row">

              <div class="col-md-6">
                <div class="box" style="border: 1px rgb(153,153,153);    background: #f9e3e3;">
                  <div class="box-header">
                    <h3 class="box-title text-bold">SOS Contacts List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                      <div id="sosMembers">
                      </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <div class="col-md-6" id="SOSform">

              <?php echo form_open('user/editBusinessCat','id="addSOSForm"'); ?>

                <input type="hidden" id="uniid" name="uniid" value='<?php echo $user->user_uniid; ?>'>
                <input type="hidden" id="type" name="type" value="Family">

                <div class="form-group">
                  <label>SOS Contact Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" style="width: 100%;">
                  <?php echo form_error('name','<div class="error text-danger">', '</div>'); ?>
                </div>


                <div class="form-group">
                  <label for="InputMobileNumber">SOS Contact Number</label>
                  <input type="number" class="form-control" id="number" name="number" placeholder="99XXXXXX99" value="<?php echo set_value('number'); ?>">
                  <?php echo form_error('number','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-info" name="Add SOS Numbers" value="Add SOS"><i class="fa fa-plus-circle"></i> Add SOS</button>
                </div>

                <?php echo form_close(); ?>

              </div>



              
            </div>


        </div>
      </div>
      <!-- /.box -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->









<body class="hold-transition sidebar-mini">



      <div class="modal fade" id="modal-mapLatLong" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Get Latitude & Longitude</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              

              <style>          
          #map { 
            height: 500px;    
            width: auto;            
          }          
        </style> 

        <div style="padding:10px">
            <div id="map"></div>
        </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="btnOk" class="btn btn-primary">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
              






<?php  

$selected = "selected";
$non = "";

?>



<script type="text/javascript">

jQuery(function () {
    jQuery("#KeywordsDemo").gs_multiselect();
});

    sosList();
    function sosList()
    {
      var uid = '<?php echo $user->user_uniid; ?>';
      $('#sosMembers').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
      $.ajax({
          type  : 'post',
          method:"POST",
          url   : '<?php echo base_url()."User/getSOS"; ?>',
          data: { 
              uniid: uid
            },
          success : function(data){
            $('#sosMembers').html(data);
          }
      });
    }

    $('#addSOSForm').on('submit', function(e){  
         e.preventDefault();  
         if($('#sosName').val() == '' && $('#sosNumber').val() == '')  
         {  
              alert("Please Enter SOS Name and Number");  
         }  
         else  
         {  
            $.ajax({  
                 url:"https://cartravels.com/web_api/api/SOSContacts/addSOS", 
                 method:"POST", 
                 type  : 'post',  
                 data:new FormData(this),  
                 contentType: false,  
                 cache: false,  
                 processData:false,  
                 success:function(data)  
                 {    
                    var sosMsg = JSON.parse(data).message;
                    var sosSt = JSON.parse(data).error;

                    // console.log(JSON.parse(data));

                    if(sosSt == "false")
                    {
                      console.log(JSON.parse(data));
                      alert(sosMsg);
                      location.reload();
                    }
                    else
                    {
                      alert(sosMsg);
                    }
                 }  
            });  
         }  
    });

    function deleteSOSContact(e)
    {


      var uniid = "<?php echo $user->user_uniid; ?>";
      var sosid = $(e).attr("value");
      var sosNum = $(e).attr("number");

      if (confirm("Are you sure? \nYou want delete "+sosNum)) {
          // $("#editRegistrationForm").remove();
          
          $.ajax({
              type  : 'POST',
              url   : 'https://cartravels.com/web_api/api/SOSContacts/deleteSOS',
              data: {
                  sosid : sosid,
                  uniid : uniid
                },
              success : function(data){
                var d = JSON.parse(data);
                // console.log(d);
                if(d.error == 'false')
                {
                  sosList();
                  alert(d.message);
                }
                else
                {
                  alert("Sorry, Unable to delete.");
                }

              }
          });
      }
      else
      {
          // alert(e.id);
      }
    }



$( "select[name='state']" ).click(function() 
{
    var selectBox = document.getElementById("state");
    var selectedValue = selectBox.options[selectBox.selectedIndex].title;
    // console.log(selectedValue);


    var state = $(this).val();

    if(state) {
        $.ajax({
            url: "<?php echo base_url(); ?>User/addDistrictsRec",
            dataType: 'Json',
            data: {'stateCode':selectedValue},
            success: function(data) {

                $('select[name="district"]').empty();
                $('select[name="district"]').append('<option value="">--- Select District ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="district"]').append('<option title="'+ value.district_code +'">'+ value.district_name +'</option>');
                });
            }
        });
    }
    else{
        $('select[name="district"]').empty();
    }
});


$( "select[name='district']" ).click(function () 
{
    var district = $(this).val();
    var selectDBox = document.getElementById("district");
    var selectedDValue = selectDBox.options[selectDBox.selectedIndex].title;

    var selectBox = document.getElementById("state");
    var selectedValue = selectBox.options[selectBox.selectedIndex].title;

    if(district) {
        $.ajax({
            type  : 'get',
            url: "<?php echo base_url(); ?>User/listDCities",
            dataType: 'Json',
            data: {
              stateCode: selectedValue,
            districtCode:selectedDValue
          },
            success: function(data) {

                $('select[name="city"]').empty();
                $('select[name="city"]').append('<option value="">--- Select City ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option title="'+ value.city_code +'">'+ value.city_name +'</option>');
                });
            }
        });
    }
    else{
        $('select[name="city"]').empty();
    }
});


$( "select[name='city']" ).click(function () 
{
    var city = $(this).val();
    console.log(city);
    var selectCBox = document.getElementById("city");
    var selectedCValue = selectCBox.options[selectCBox.selectedIndex].title;
    // console.log(selectedCValue);

    var selectDBox = document.getElementById("district");
    var selectedDValue = selectDBox.options[selectDBox.selectedIndex].title;

    var selectBox = document.getElementById("state");
    var selectedValue = selectBox.options[selectBox.selectedIndex].title;

    if(district) {
        $.ajax({
            type  : 'get',
            url: "<?php echo base_url(); ?>User/listDCPlaces",
            dataType: 'Json',
            data: {
              cityCode: selectedCValue
          },
            success: function(data) {
              // console.log(data);
              if(data)
              {
                $('select[name="place"]').prop("disabled", false);
                $('select[name="place"]').empty();
                $('select[name="place"]').append('<option value="">--- Select Place ---</option>');
                $.each(data, function(key, value) {
                    $('select[name="place"]').append('<option title="'+ value.place_code +'">'+ value.place_name +'</option>');
                });
              }
              else
              {
                $('select[name="place"]').prop("disabled", true);
              }

            }
        });
    }
    else{
        $('select[name="city"]').empty();
    }
});



      $(document).ready(function(){  

            $('#upload_form').on('submit', function(e){  
                 e.preventDefault(); 
                 if($('#profilePic').val() == '')  
                 {  
                      alert("Please Select the File");  
                 }  
                 else  
                 {  
                      $.ajax({  
                           url:'<?php echo base_url()."user/uploadRegisteredProfileImage"; ?>',   
                           //base_url() = http://localhost/tutorial/codeigniter  
                           method:"POST",
                           type  : 'post',
                           data:new FormData(this),  
                           contentType: false,  
                           cache: false,  
                           processData:false,  
                           success:function(data)  
                           {
                              alert("Uploaded");
                              location.reload();
                              // console.log(data);
                           }  
                      });  
                 }  
            });



            $('#uploadCoverPhoto_form').on('submit', function(e){  
                 e.preventDefault();  
                 if($('#coverPhoto').val() == '')  
                 {  
                      alert("Please Select the Cover Photo");  
                 }  
                 else  
                 {  
                      $.ajax({  
                           url:'<?php echo base_url()."user/uploadRegisteredCoverImage"; ?>',   
                           //base_url() = http://localhost/tutorial/codeigniter  
                           method:"POST", 
                           type  : 'post', 
                           data:new FormData(this),  
                           contentType: false,  
                           cache: false,  
                           processData:false,  
                           success:function(data)  
                           {
                              alert("Uploaded");
                              location.reload();
                              // console.log(data);
                           }  
                      });  
                 }  
            });
      });



    $(document).ready(function(){


      $("#websiteUrl").keyup(function(){

        var weburl = $("#websiteUrl").val();
        weburl = weburl.replace(/[` ~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi,'');

        $("#websiteUrl").val(weburl);

        $("#websiteUrlinfo").html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
        if(weburl.length > 3) 
        {
          $.ajax({
             url: '<?php echo base_url(); ?>user/searchCartravelsId',
             type: 'POST',
             data: {websiteUrl: weburl},

             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
              data = JSON.parse(data);
              if(data.error == "false")
              {
                $("#websiteUrlinfo").html('<span class="text-danger"><b>'+data.message+'</b></span>');
              }
              else
              {
                $("#websiteUrlinfo").html('<span class="text-success"><b>'+data.message+'</b></span>');
              }
             }
          });
        }
        else
        {
          $("#websiteUrlinfo").html('<span class="text-danger"><b>minimum 4 letters</b></span>');
        }

      });






      function businessChange(busCat)
      {
        if(busCat == "CarTravelsOffices" || busCat == "SelfDrivingOffices" || busCat == "ToursAndTravels" || busCat == "Mechanics" || busCat == "HotelsAndResorts" || busCat == "Ads")
        {
          $("#businessNameDiv").show();
          $("#ownerNameDiv").show();
          $("#userNameDiv").hide();
          $("#surNameDiv").hide();
          $("#professionDiv").hide();
        }
        else if(busCat == "OwnerCumDrivers" || busCat == "Drivers" || busCat == "OptingDrivers" || busCat == "Tenders")
        {
          $("#businessNameDiv").hide();
          $("#ownerNameDiv").hide();
          $("#userNameDiv").show();
          $("#surNameDiv").show();
          $("#professionDiv").hide();
        }
        else if(busCat == "NormalUser")
        {
          $("#businessNameDiv").hide();
          $("#ownerNameDiv").hide();
          $("#userNameDiv").show();
          $("#surNameDiv").show();
          $("#professionDiv").show();
        }
        else{
          $("#businessNameDiv").hide();
          $("#ownerNameDiv").hide();
          $("#userNameDiv").hide();
          $("#surNameDiv").hide();
          $("#professionDiv").hide();
        }
      }

      var busCat = "<?php echo $user->user_Business_Category; ?>";

      businessChange(busCat);

      $("#businessCategory").on("change", function(){
      // var busCat = $('select[name="district"]').val();
        $("#userName").val("");
        $("#surName").val("");
        $("#businessName").val("");
        $("#ownerName").val("");
        
        busCat = $("#businessCategory").val();
        businessChange(busCat); 
      });


      // districts list
      if("<?php echo $user->user_State; ?>") {
          var state = '<?php echo $user->stateCode; ?>';
          $.ajax({
             url: '<?php echo base_url(); ?>web_api/api/Registration/listDistricts',
             type: 'POST',
             data: {stateCode: state},

             error: function(data) {
                // console.log(data.responseText);
             },
             success: function(data) {
                // console.log(JSON.parse(data));
                data = JSON.parse(data);


                  $('select[name="district"]').empty();
                  if(data.districts != "No Districts Found")
                  {

                    $('select[name="district"]').append('<option value="">--- Select District ---</option>');
                    $.each(data.districts, function(key, value) {
                        $('select[name="district"]').append('<option title="'+ value.district_code +'" '+((value.district_name == "<?php echo $user->user_District;?>")?"<?php echo $selected; ?>":"<?php echo $non; ?>")+'>'+ value.district_name +'</option>');
                    });
                  }
                  else
                  {
                    $('select[name="district"]').append('<option value="">--- Select City ---</option>');
                  }


             }
          });
      }
      else
      {
          $('select[name="district"]').empty();
      }


      // cities list
      if("<?php echo $user->user_District; ?>") {
          var state = '<?php echo $user->stateCode; ?>';
          var districtCode = '<?php echo $user->district_code; ?>';
          $.ajax({
             url: '<?php echo base_url(); ?>web_api/api/Registration/listCities',
             type: 'POST',
             data: {stateCode: state, districtCode: districtCode},

             error: function(data) {
                // console.log(data.responseText);
             },
             success: function(data) {
                // console.log(JSON.parse(data));
                data = JSON.parse(data);

                  $('select[name="city"]').empty();
                  if(data.cities != "No Districts Found")
                  {

                    $('select[name="city"]').append('<option value="">--- Select District ---</option>');
                    $.each(data.cities, function(key, value) {
                        $('select[name="city"]').append('<option title="'+ value.city_code +'" '+((value.city_name == "<?php echo $user->user_City;?>")?"<?php echo $selected; ?>":"<?php echo $non; ?>")+'>'+ value.city_name +'</option>');
                    });
                  }
                  else
                  {
                    $('select[name="city"]').append('<option value="">--- Select City ---</option>');
                  }


             }
          });
      }
      else
      {
          $('select[name="district"]').empty();
      }


      // Places list
      if("<?php echo $user->metropolitan; ?>" == 1) {

          var cityCode = '<?php echo $user->city_code; ?>';

          $.ajax({
             url: '<?php echo base_url(); ?>Registrations/listPlaces',
             type: 'POST',
             data: {cityCode: cityCode},

             error: function(data) {
                // console.log(data.responseText);
             },
             success: function(data) {
                // console.log(JSON.parse(data));
                data = JSON.parse(data);


                  $('select[name="place"]').empty();
                  if(data.places != "No places Found")
                  {

                    $('select[name="place"]').append('<option value="">--- Select Place ---</option>');
                    $.each(data.places, function(key, value) {
                        $('select[name="place"]').append('<option value="'+ value.place_name +'" '+((value.place_name == "<?php echo $user->user_Place;?>")?"<?php echo $selected; ?>":"<?php echo $non; ?>")+'>'+ value.place_name +'</option>');
                    });
                  }
                  else
                  {
                    $('select[name="place"]').append('<option value="">--- Select Place ---</option>');
                  }
             }
          });
      }
      else
      {
          // $('#PlaceDiv').hide();
      }
    });


    /* Attach a submit handler to the form */
    $("#editRegistrationForm").submit(function(event) {
        var ajaxRequest;
        /* Stop form from submitting normally */
        event.preventDefault();
        /* Clear result div*/
        $("#placesList").html('');
        /* Get from elements values */
        var values = $(this).serialize();

           ajaxRequest= $.ajax({
                url: "<?php echo base_url().'user/editCategoryProfile'; ?>",
                type: "post",
                data: values
            });
        /*  Request can be aborted by ajaxRequest.abort() */
        ajaxRequest.done(function (response, textStatus, jqXHR){
             // Show successfully for submit message
             var d = JSON.parse(response);
             // $("#editRegStatus").html(response);

             if(d.error == "false")
             {
              $("#editRegStatus").html('<span class="text-success">'+d.message+'</span>');
                alert(d.message);
                location.reload();
             }
             else
             {
              $("#editRegStatus").html('<span class="text-danger">'+d.message+'</span>');
                alert(d.message);
             }
             
        });
        /* On failure of request this function will be called  */
        ajaxRequest.fail(function (res){
            // Show error
            // console.log(res);
            // console.log(res.responseText);
            $("#editRegStatus").html('There is error while submit');
        });
    });
  </script>










<?php 

define('API', 'AIzaSyB-y_HMrWo7r1DkWYmiJCNyiuQDBKqf1js');


?>

<script type="text/javascript">
        var map;
        
        function initMap() {

          var navPoint = navigator.geolocation.getCurrentPosition(function showPosition(position) {

            // var latitude = position.coords.latitude; // YOUR LATITUDE VALUE
            // var longitude = position.coords.longitude; // YOUR LONGITUDE VALUE
            var latitude = <?php echo ($user->user_Latitude)?$user->user_Latitude:0; ?>; // YOUR LATITUDE VALUE
            var longitude = <?php echo ($user->user_Longitude)?$user->user_Longitude:0; ?>; // YOUR LONGITUDE VALUE



            if(latitude == 0 && longitude == 0)
            {
              latitude = position.coords.latitude; // YOUR LATITUDE VALUE
              longitude = position.coords.longitude; // YOUR LONGITUDE VALUE
            }
            
            // console.log(latitude);
            // console.log(longitude);

            var myLatLng = {lat: latitude, lng: longitude};
            
            map = new google.maps.Map(document.getElementById('map'), {
              center: myLatLng,
              zoom: 18,
              disableDoubleClickZoom: true, // disable the default map zoom on double click
            });
            
            // Update lat/long value of div when anywhere in the map is clicked    
            google.maps.event.addListener(map,'click',function(event) {                
                // document.getElementById('latclicked').innerHTML = event.latLng.lat();
                // document.getElementById('longclicked').innerHTML =  event.latLng.lng();

                  document.getElementById("latitude").value = event.latLng.lat();
                  document.getElementById("longitude").value = event.latLng.lng();
            });
            
            // Update lat/long value of div when you move the mouse over the map
            google.maps.event.addListener(map,'mousemove',function(event) {
                // document.getElementById('latmoved').innerHTML = event.latLng.lat();
                // document.getElementById('longmoved').innerHTML = event.latLng.lng();
            });

            function handleEvent(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            }
                    
            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              draggable:true,
              //title: 'Hello World'
              
              // setting latitude & longitude as title of the marker
              // title is shown when you hover over the marker
              title: latitude + ', ' + longitude 
            });    

            marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent); 
            
            } );
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo API; ?>&callback=initMap" async defer></script>

<script>
  $("#btnOk").click(function () {
      $("#modal-mapLatLong").modal("hide");
  });
</script>




























                </div>
            </div>


        </div>
    </div>
</section>


