<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar.min.css" />

<script src="<?php echo base_url(); ?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar.min.js"></script>

<style type="text/css">
  
</style>


<script>

    $(document).ready(function () {

      eventsList('<?php echo date("d-m-Y"); ?>');
      insuranceList('<?php echo date("d-m-Y"); ?>');

      function flagEvent(event, element) 
      {
        element.addClass('event-on-' + event.start.format('YYYY-MM-DD')).css('display', 'none');
      }

      var calendar = $('#calendar').fullCalendar({
          editable: true,
          events: "<?php echo base_url()."web_api/api/Remainders/getBookingRemainder_web/".$this->session->userdata("ctuid"); ?>",
          displayEventTime: false,
          eventRender: function (event, element, view) {

            flagEvent(event, element);

            if (event.end && event.start.format('YYYY-MM-DD') !== event.end.format('YYYY-MM-DD')) {
                while (event.end > event.start) {
                  event.start.add(1, 'day');
                  // console.log('flag', event.start.format('YYYY-MM-DD'))
                  flagEvent(event, element);
                }
            }

            // console.log(event);
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
          },
          selectable: true,
          selectHelper: true,
          eventAfterAllRender: function() 
          {
            $('#calendar .fc-day.fc-widget-content').each(function(i) {
              var date = $(this).data('date');
              var count = $('#calendar a.fc-event.event-on-' + date).length;

              var myVar = insuranceListCount(moment(date, 'YYYY-MM-DD').format('DD-MM-Y'));
              // $(this).append(myVar.insCount);

              // console.log(myVar);

              // var rs = function insfun(r) {return r;}
              // console.log(rs);

              // insuranceListCount(moment(date, 'YYYY-MM-DD').format('DD-MM-Y')).done(function(response){
              //     console.log(response);
              //     if(response.insCount)
              //     {
              //       $('.fc-day.fc-widget-content.fc-sat.fc-other-month.fc-future').append('<div class="fc-event-count2" id="countNum">' + response.insCount + '</div>');

              //     }
                  
              // });

              // $('.fc-body .fc-widget-content .fc-row .fc-day fc-past').append("hello");


              // console.log($(this));
              
              // <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2021-08-07"></td>

              // var myVar = '';

              // $.ajax({
              //     type  : 'post',
                  
              //     url   : '<?php echo base_url()."web_api/api/Remainders/getInsurance_web"; ?>',
              //     data: { 
              //         uniid: '<?php echo $this->session->userdata("ctuid"); ?>',
              //         remDate: date
              //       },
              //       dataType: "JSON",
              //     success : function(data){
              //       var myVar = data;
              //       return myVar;
              //       return data.readyState;
              //       console.log(" Inside - "+data.readyState);
                    
              //     },
              //     error:function(){
              //       return '';
              //     } 
              // });

              // console.log(x.readyState);
              // console.log(x.status);
              // console.log(myVar);
              // $(this).append('<div class="fc-event-count2" id="countNum">2'++'</div>');


              if (count > 0) {
                $(this).append('<div class="fc-event-count" id="countNum">' + count + '</div>');
              }
              if(myVar.insCount > 0)
              {
                $(this).append('<div class="fc-event-count2" id="countNum">'+myVar.insCount+'</div>');
              }

            });
          },
          select: function (start, end, allDay) {
              // var title = prompt('Event Title:');

              var selectedDate = $.fullCalendar.formatDate(start, "DD-MM-Y");
              // console.log(selectedDate);
              // console.log(insuranceListCount(selectedDate));

              eventsList(selectedDate);
              insuranceList(selectedDate);
          },
          
          editable: true,
          eventDrop: function (event, delta) {
                      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                      $.ajax({
                          url: 'edit-event.php',
                          data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                          type: "POST",
                          success: function (response) {
                              displayMessage("Updated Successfully");
                          }
                      });
                  },
          eventClick: function (event) {
              var deleteMsg = confirm("Do you really want to delete?");

          }
      });



function eventsList(selectedDate)
{
  $("#booking-remainders").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
  $.ajax({
      type  : 'post',
      dataType: 'json',
      url   : '<?php echo base_url()."web_api/api/Remainders/getBookingRemainder_web"; ?>',
      data: { 
          uniid: '<?php echo $this->session->userdata("ctuid"); ?>',
          remDate: selectedDate
        },
      success : function(data){
        // console.log(data.bookRemainders);

         $('#booking-remainders').html(data.html);

      }
  });
}



function insuranceList(selectedDate)
{
  $("#insurance-remainders").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
  $.ajax({
      type  : 'post',
      dataType: 'json',
      url   : '<?php echo base_url()."web_api/api/Remainders/getInsurance_web"; ?>',
      data: { 
          uniid: '<?php echo $this->session->userdata("ctuid"); ?>',
          remDate: selectedDate
        },
      success : function(data){
        // console.log(data);

         $("#insurance-remainders").html(data.html);
      },
      fail:function(response){
        // console.log(response);
      } 
  });
}


function insuranceListCount(selectedDate)
{
  var ress;
  $.ajax({
        type: 'POST',
        url   : '<?php echo base_url()."web_api/api/Remainders/getInsurance_web"; ?>',
        async: false,
        data: ({ 
          uniid: '<?php echo $this->session->userdata("ctuid"); ?>',
          remDate: selectedDate
        }),
        dataType: 'JSON',
        //async: true,  //NOT NEEDED
        success: function(response) {

        },
    }).done(function(data){ress = data;})
  return ress;
}








$('#AddBookingRemainderForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      // console.log(form.serialize());
      // return false;
    
        $("#AddBookingRemainderBtn").prop('disabled', 'true');
        $("#AddBookingRemainderBtn").html('<i class="fa fa-cog fa-spin"></i> Please wait adding...', 'true');


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/Remainders/addBookingRemainders", 
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

                // console.log(JSON.parse(data));

                if(sosSt == "false")
                {
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#AddBookingRemainderBtn').removeAttr("disabled");
                  $("#AddBookingRemainderBtn").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});

$('#editBookingRemainderForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      // console.log(form.serialize());
      // return false;
    
        $("#editBookingRemainderBtn").prop('disabled', 'true');
        $("#editBookingRemainderBtn").html('<i class="fa fa-cog fa-spin"></i> Please wait adding...', 'true');


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/Remainders/editBookingRemainders", 
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

                // console.log(JSON.parse(data));

                if(sosSt == "false")
                {
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#editBookingRemainderBtn').removeAttr("disabled");
                  $("#editBookingRemainderBtn").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});

$('#AddInsuranceRemainderForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      // console.log(form.serialize());
      // return false;
    
        $("#AddInsuranceRemainderBtn").prop('disabled', 'true');
        $("#AddInsuranceRemainderBtn").html('<i class="fa fa-cog fa-spin"></i> Please wait adding...', 'true');


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/Remainders/addInsurance", 
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

                // console.log(JSON.parse(data));

                if(sosSt == "false")
                {
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#AddInsuranceRemainderBtn').removeAttr("disabled");
                  $("#AddInsuranceRemainderBtn").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
});



    $('#editInsuranceRemainderForm').on('submit', function(e){  
      e.preventDefault();  
      var form = $(this);
      // console.log(form.serialize());
      // return false;
    
        $("#editInsuranceRemainderBtn").prop('disabled', 'true');
        $("#editInsuranceRemainderBtn").html('<i class="fa fa-cog fa-spin"></i> Please wait adding...', 'true');


        $.ajax({  
             url:"<?php echo base_url(); ?>web_api/api/Remainders/editInsurance", 
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

                // console.log(JSON.parse(data));

                if(sosSt == "false")
                {
                  alert(sosMsg);
                  location.reload();
                }
                else
                {
                  // console.log(data);
                  $('#editInsuranceRemainderBtn').removeAttr("disabled");
                  $("#editInsuranceRemainderBtn").html('<i class="fa fa-paper-plane-o"></i>', 'true');
                  alert(sosMsg);
                  
                }
             }  
        });  
    });




    });

    function displayMessage(message) {
          $(".response").html("<div class='success'>"+message+"</div>");
        setInterval(function() { $(".success").fadeOut(); }, 1000);
    }
</script>
<style>
  .calbody {
      margin-top: 50px;
      text-align: center;
      font-size: 12px;
      font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
  }

  #calendar {
      width: 100%;
      margin: 0 auto;
  }

  .response {
      height: auto;
  }

  .success {
      background: #cdf3cd;
      padding: 10px 60px;
      border: #c3e6c3 1px solid;
      display: inline-block;
  }

  .fc-day, .fc-event-container, td
  {
      cursor: pointer;
  }

  .fc-event-count {
        color: #fff;
        font-size: large;
        padding: 5px;
        margin-bottom: 0;
        font-weight: 700;
        background-color: #000;
        width: 25px;
        border-radius: 10px;
      }

  .fc-event-count2 {
        color: #fff;
        font-size: large;
        padding: 5px;
        margin-bottom: 0;
        font-weight: 700;
        background-color: #f60000;
        width: 25px;
        border-radius: 10px;
      }


  .fc-buttons
  {
    margin: 10px 0;
  }

  #booking-remainders
  {
    margin: 10px 0;
  }

  .remainderTable
  {
    font-size: 15px;
  }

  .remainderTable .fa
  {
    font-size: 20px;
  }

  .remainderTable .fa-comments, .fa-pencil, .fa-trash
  {
    color: red;
    font-size: 20px;
  }
</style>


<div class="calbody">
    <h2>Remainders</h2>

    <div class="response"></div>
    <div class="text-right fc-buttons">
      <button class="btn btn-info" data-toggle="modal" data-target="#AddBookingRemainder"> <i class="fa fa-plus"></i> &nbsp;Add Booking</button>
      <button class="btn btn-info" data-toggle="modal" data-target="#AddInsuranceRemainder"> <i class="fa fa-plus"></i> &nbsp;Add Insurance</button>
    </div>
    <div id='calendar'></div>
    <div id='EventList'></div>

    <div id="booking-remainders" class="text-left"></div>
    <div id="insurance-remainders" class="text-left"></div>

    <div class="text-left">
      <?php  
        // echo "<pre>";
        // print_r($this->session->userdata());
        // echo "</pre>";
      ?>
    </div>
</div>






<div class="modal fade"  id="AddBookingRemainder" role="dialog">
  <div class="modal-dialog" style="width:400px;">

    <!-- Modal content-->
    <div class="modal-content" >

      <div class="modal-header">
        <button type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title text-center" id="myModalLabel">Add Booking Remainder </h4>
      </div>

      <div class="modal-body">
        <div class="row">

          <form action="#" class="form-group" id="AddBookingRemainderForm" method="post" accept-charset="utf-8">

            <input type="hidden" class="form-control" name="webRem" placeholder='' value="<?=base64_encode(date('Y-m-d'));?>" required>
            <input type="hidden" class="form-control" name="uniid" placeholder='' value="<?=$this->session->userdata('details')->uniid;?>" required>
            <input type="hidden" class="form-control" name="travelID" placeholder='' value="<?=$this->session->userdata('details')->cartravels_id;?>" required>


            <div class="col-md-12">

                <label style="padding: 0; font-size: 13px;">Booking Date and Time</label>
                <div class="form-group">
                  <div class="col-md-6">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> From Date </label><br>
                    <input type="date" class="form-control"  min="<?php echo date('Y-m-d'); ?>" name="bkrFromDate" required value="<?php echo date('Y-m-d'); ?>">
                    <input type="time" class="form-control" name="bkrFromTime" required value="<?php echo date('H:i'); ?>">
                  </div>
                  
                  <div class="col-md-6">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> To Date </label><br>
                    <input type="date" class="form-control"  min="<?php echo date('Y-m-d'); ?>" name="bkrToDate" required value="<?php echo date('Y-m-d'); ?>">
                    <input type="time" class="form-control"  name="bkrToTime" required value="<?php echo date('H:i'); ?>">
                  </div>

                </div>

                <div class="form-group">
                  <label>Customer Name </label>
                  <input type="text" class="form-control" name="bkrCustomerName" placeholder='' value="" required>
                  <?php echo form_error('bkrCustomerName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Customer Mobile </label>
                  <input type="text" class="form-control" name="bkrCustomerMobile" placeholder='' value="" required>
                  <?php echo form_error('bkrCustomerMobile','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Pickup Place </label>
                  <input type="text" class="form-control" id="cartravels-cities-dropdown" name="bkrPickupPlace" placeholder='' value="" required>
                  <?php echo form_error('bkrPickupPlace','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>About </label>
                  <select id="bkrKeyword" name="bkrKeyword" class="form-control" style="width: 100%;" required>
                    <option value="">-- Select Vehicle --</option>
                    <?php  
                      foreach ($keywords as $k) {
                        ?>
                          <option value="<?php echo $k->keywordName; ?>"><?php echo $k->keywordName; ?></option>
                        <?php
                      }
                    ?>
                  </select>

                  <?php echo form_error('bkrKeyword','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" name="bkrDesc" placeholder='' value="" required></textarea>
                  <?php echo form_error('bkrDesc','<div class="error text-danger">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-default btn-block btnDanger" id="AddBookingRemainderBtn">Submit</button>
            </div>
          </form>

          

        </div>
      </div>
    
    </div>

  </div>
</div>


<div class="modal fade"  id="editBookingRemainder" role="dialog">
  <div class="modal-dialog" style="width:400px;">

    <!-- Modal content-->
    <div class="modal-content" >

      <div class="modal-header">
        <button type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title text-center" id="myModalLabel">Edit Booking Remainder </h4>
      </div>

      <div class="modal-body">
        <div class="row">

          <form action="#" class="form-group" id="editBookingRemainderForm" method="post" accept-charset="utf-8">

            <input type="hidden" class="form-control" name="webRem" placeholder='' value="<?=base64_encode(date('Y-m-d'));?>" required>
            <input type="hidden" class="form-control" name="uniid" placeholder='' value="<?=$this->session->userdata('details')->uniid;?>" required>
            <input type="hidden" class="form-control" name="travelID" placeholder='' value="<?=$this->session->userdata('details')->cartravels_id;?>" required>
            <input type="hidden" class="form-control" id="editBkrID" name="bkrID" value="" required>


            <div class="col-md-12">

                <label style="padding: 0; font-size: 13px;">Booking Date and Time</label>
                <div class="form-group">
                  <div class="col-md-6">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> From Date </label><br>
                    <input type="date" class="form-control" id="bkrFromDate" name="bkrFromDate" required value="">
                    <input type="time" class="form-control" id="bkrFromTime" name="bkrFromTime" required value="">
                  </div>
                  
                  <div class="col-md-6">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> To Date </label><br>
                    <input type="date" class="form-control" id="bkrToDate" name="bkrToDate" required value="">
                    <input type="time" class="form-control" id="bkrToTime" name="bkrToTime" required value="">
                  </div>

                </div>

                <div class="form-group">
                  <label>Customer Name </label>
                  <input type="text" class="form-control" id="bkrCustomerName" name="bkrCustomerName" placeholder='' value="" required>
                  <?php echo form_error('bkrCustomerName','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Customer Mobile </label>
                  <input type="text" class="form-control" id="bkrCustomerMobile" name="bkrCustomerMobile" placeholder='' value="" required>
                  <?php echo form_error('bkrCustomerMobile','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Pickup Place </label>
                  <input type="text" class="form-control" id="cartravels-cities-dropdown" name="bkrPickupPlace" placeholder='' value="" required>
                  <?php echo form_error('bkrPickupPlace','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>About </label>
                  <select id="bkrKeyword" name="bkrKeyword" class="form-control" style="width: 100%;" required>
                    <option value="">-- Select Vehicle --</option>
                    <?php  
                      foreach ($keywords as $k) {
                        ?>
                          <option value="<?php echo $k->keywordName; ?>"><?php echo $k->keywordName; ?></option>
                        <?php
                      }
                    ?>
                  </select>

                  <?php echo form_error('bkrKeyword','<div class="error text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                  <label>Description </label>
                  <textarea  class="form-control" id="bkrDesc" name="bkrDesc" placeholder='' value="" required></textarea>
                  <?php echo form_error('bkrDesc','<div class="error text-danger">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-default btn-block btnDanger" id="editBookingRemainderBtn">Update</button>
            </div>
          </form>

          

        </div>
      </div>
    
    </div>

  </div>
</div>

<div class="modal fade"  id="AddInsuranceRemainder" role="dialog">
  <div class="modal-dialog" style="width:400px;">

    <!-- Modal content-->
    <div class="modal-content" >

      <div class="modal-header">
        <button type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title text-center" id="myModalLabel">Add Insurance Remainder </h4>
      </div>

      <div class="modal-body">
        <!-- <div class="row"> -->

          <form action="#" id="AddInsuranceRemainderForm" method="post" accept-charset="utf-8">

            <input type="hidden" class="form-control" name="webRem" placeholder='' value="<?=base64_encode(date('Y-m-d'));?>" required>
            <input type="hidden" class="form-control" name="uniid" placeholder='' value="<?=$this->session->userdata('details')->uniid;?>" required>
            <input type="hidden" class="form-control" name="travelID" placeholder='' value="<?=$this->session->userdata('details')->cartravels_id;?>" required>

            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Vehicle Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Registration Number </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="regNumber" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Model Name </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="modelName" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Year </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="number" class="form-control" name="year" required value="<?php echo date('Y'); ?>">
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Insurance Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Insurance Company </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="insuranceCompany" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Policy Number </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="policyNumber" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Insured's Name </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="insuredName" required value="">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6">
                <label>Period of Insurance From </label><br>
                <input type="date" class="form-control" name="insFromDate" required value="<?php echo date('Y-m-d'); ?>">
              </div>
              
              <div class="col-md-6">
                <label>Period of Insurance To </label><br>
                <input type="date" class="form-control"  min="<?php echo date('Y-m-d'); ?>" name="insToDate" required value="<?php echo date('Y-m-d'); ?>">
              </div>

            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Pollution Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Valid upto </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="date" class="form-control" name="pollutionValidDate" required value="">
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Fitness Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Valid upto </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="date" class="form-control" name="fitnessValidDate" required value="">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                  <button type="submit" class="btn btn-default btn-block btnDanger" id="AddInsuranceRemainderBtn">Submit</button>
              </div>
            </div>

          </form>

          

        <!-- </div> -->
      </div>
    
    </div>

  </div>
</div>


<div class="modal fade"  id="editInsuranceRemainder" role="dialog">
  <div class="modal-dialog" style="width:400px;">

    <!-- Modal content-->
    <div class="modal-content" >

      <div class="modal-header">
        <button type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
        <h4 class="modal-title text-center" id="myModalLabel">Edit Insurance Remainder </h4>
      </div>

      <div class="modal-body">
        <!-- <div class="row"> -->

          <form action="#" id="editInsuranceRemainderForm" method="post" accept-charset="utf-8">

            <input type="hidden" class="form-control" name="webRem" placeholder='' value="<?=base64_encode(date('Y-m-d'));?>" required>
            <input type="hidden" class="form-control" name="uniid" placeholder='' value="<?=$this->session->userdata('details')->uniid;?>" required>
            <input type="hidden" class="form-control" name="travelID" placeholder='' value="<?=$this->session->userdata('details')->cartravels_id;?>" required>
            <input type="hidden" class="form-control" name="insID" id="editInsID" value="" required>

            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Vehicle Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Registration Number </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="regNumber" id="regNumber" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Model Name </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="modelName" id="modelName" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Year </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="number" class="form-control" name="year" id="year" required value="">
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Insurance Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Insurance Company </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="insuranceCompany" id="insuranceCompany" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Policy Number </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="policyNumber" id="policyNumber" required value="">
              </div>
            </div>


            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Insured's Name </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="text" class="form-control" name="insuredName" id="insuredName" required value="">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6">
                <label>Period of Insurance From </label><br>
                <input type="date" class="form-control" name="insFromDate" id="insFromDate" required value="">
              </div>
              
              <div class="col-md-6">
                <label>Period of Insurance To </label><br>
                <input type="date" class="form-control"  min="<?php echo date('Y-m-d'); ?>" name="insToDate" id="insToDate" required value="">
              </div>

            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Pollution Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Valid upto </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="date" class="form-control" name="pollutionValidDate" id="pollutionValidDate" required value="">
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <p style="background-color: #3102b0; text-align: center;color: #fff; padding: 2px;">Fitness Details</p>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6">
                <label> Valid upto </label>
              </div>
              
              <div class="col-md-6 col-xs-6">
                <input type="date" class="form-control" name="fitnessValidDate" id="fitnessValidDate" required value="">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                  <button type="submit" class="btn btn-default btn-block btnDanger" id="editInsuranceRemainderBtn">Save</button>
              </div>
            </div>

          </form>

          

        <!-- </div> -->
      </div>
    
    </div>

  </div>
</div>


<script type="text/javascript">

  function editBooking(id)
  {

    $.ajax({
        type  : 'POST',
        dataType: 'json',
        url   : '<?php echo base_url();?>web_api/api/Remainders/getOneBookingRemainder',
        data: { 
            bkrID: id
          },
        success : function(data){
          var bkr = data.bookRemainders[0];
          // console.log(bkr);

          $("#bkrFromDate").val(moment(bkr.bkr_from_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));
          $("#bkrFromTime").val(moment(bkr.bkr_from_date, 'DD-MM-Y h:m A').format('HH:mm'));
          $("#bkrToDate").val(moment(bkr.bkr_to_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));
          $("#bkrToTime").val(moment(bkr.bkr_to_date, 'DD-MM-Y h:m A').format('HH:mm'));
          $("#bkrCustomerName").val(bkr.bkr_customer_name);
          $("#bkrCustomerMobile").val(bkr.bkr_customer_mobile);
          $("input[name = bkrPickupPlace]").val(bkr.bkr_pickup_place);

          $('select[name^="bkrKeyword"] option[value="'+bkr.bkr_keyword+'"]').attr("selected","selected");

          $("#bkrDesc").val(bkr.bkr_desc);
          $("#editBkrID").val(bkr.bkrID);
        }
    });
  }

  function editInsurance(id)
  {

    $.ajax({
        type  : 'POST',
        dataType: 'json',
        url   : '<?php echo base_url();?>web_api/api/Remainders/getOneInsuranceRemainder',
        data: { 
            insID: id
          },
        success : function(data){
          var bkr = data.insRemainders[0];
          console.log(bkr);

          $("#insFromDate").val(moment(bkr.ins_from_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));
          // $("#bkrFromTime").val(moment(bkr.bkr_from_date, 'DD-MM-Y h:m A').format('HH:mm'));
          $("#insToDate").val(moment(bkr.ins_to_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));
          // $("#bkrToTime").val(moment(bkr.bkr_to_date, 'DD-MM-Y h:m A').format('HH:mm'));

          $("#pollutionValidDate").val(moment(bkr.ins_pollution_valid_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));
          $("#fitnessValidDate").val(moment(bkr.ins_fitness_valid_date, 'DD-MM-Y h:m A').format('YYYY-MM-DD'));


          $("#regNumber").val(bkr.ins_reg_number);
          $("#modelName").val(bkr.ins_model_name);
          $("#year").val(bkr.ins_year);

          $("#insuranceCompany").val(bkr.ins_insurance_company);
          $("#policyNumber").val(bkr.ins_policy_number);
          $("#insuredName").val(bkr.ins_insured_name);

          $("#editInsID").val(bkr.insID);
        }
    });
  }

</script>