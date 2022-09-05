

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="widget">
						<h5 class="widgetheading">Our Contact</h5>
						<address>
<!-- 						<strong>Bootstrap company Inc</strong><br>
						JC Main Road, Near Silnile tower<br>
						 Pin-21542 NewYork US.</address> -->
						<p>
							<a href="tel:+919063590635"><i class="fa fa-phone"></i> : (+91) 90635-90635</a> <br>
							<a href="mailto:cartravels2016@gmail.com"><i class="fa fa-envelope"></i> : cartravels2016@gmail.com</a>
						</p>
					</div>
				</div>

			</div>
		</div>
		<div id="sub-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="copyright">
							<p>
								<span>&copy; CarTravels.com. Developed By </span><a href="https://www.adwaithasmarterp.com/" target="_blank">Adwaitha SmartERP Solutions Pvt. Ltd.</a>
							</p>
						</div>
					</div>
					<div class="col-lg-6">
						<ul class="social-network">
							<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" data-placement="top" title="WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.js-example-basic-single').select2();

		$('.select2').select2({
		  placeholder: 'Select an option'
		});


		$("#citySelectedGo").on('click', function(){

			var cVal = $("#citySelectedValue").val();

			if(/^[a-zA-Z., ]*$/.test(cVal) == false) {
			    alert('Your search contains illegal characters.');
			    return false;
			}else if(/^[a-zA-Z., ]+\,[ a-zA-Z ]*$/.test(cVal) == false && cVal != 'india' && cVal != 'India')
			{
				alert('Type & Select city');
				return false;
			}

			if(cVal){
				$("#citySelectedGo").html('Please wait...');
			}

			// return false;
			if(cVal == '')
			{
				return false
			}
			else
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>Businesslistings/set_city/",
					data: {searchCity: cVal},
					success: function(data) {
						console.log(data);
					},	
					dataType: "json"
				});
			}

			
			setTimeout(function() {
		         // enter code here or a execute function.
		        location.reload();
		     }, 1000);
		});

		$("#headerCitySelectedGo").on('click', function(){

			var cVal = $("#cartravels-cities-dropdown").val();

  			// pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

			if(/^[a-zA-Z., ]*$/.test(cVal) == false) {
			    alert('Your search contains illegal characters.');
			    return false;
			}else if(/^[a-zA-Z., ]+\,[ a-zA-Z ]*$/.test(cVal) == false && cVal != 'india' && cVal != 'India')
			{
				alert('Type & Select city');
				return false;
			}

			$("#headerCitySelectedGo").html('Please wait...');

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>Businesslistings/set_city/",
					data: {searchCity: cVal},
					success: function(data) {
						console.log(data);
					},	
					dataType: "json"
				});
			
			setTimeout(function() {
		         // enter code here or a execute function.
		        location.reload();
		     }, 1000);
		});


	});
</script>












<style type="text/css">

  body
  {
    /*font-size: 1rem;*/
  }
  .input-group {
    position: relative;
    display: table;
    border-collapse: separate;
    /*font-size: 1rem;*/
}

  .card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
    font-size: 1rem;
}

.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-size: 1rem;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
     border: 1px solid rgba(0,0,0,.125); 
    border-radius: .25rem;
    font-size: 1rem;
}

  .card.hovercard .cardheader {
      background: url(<?php echo $bgImage; ?>);
      background-size: cover;
      height: 200px;
      font-size: 1rem;
  }



  #btn-share
  {
    width: auto;
    padding: 5px;
    font-size: 1rem;
  }

  #profileContainer
  {
      margin-bottom: 50px;
      font-size: 1rem;
  }

  .footer {
     position: fixed;
     left: 0;
     bottom: 0;
     width: 100%;
     background-color: #c1c1c1;
     color: white;
     text-align: center;
     padding: 5px;
     z-index: 2;
     font-size: 1rem;
  }

  .callbtn
  {
    background-color: #0099ff;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
    font-size: 1rem;
  }

  .postBtn{
    background-color: #FD3132;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
    font-size: 1rem;
  }

  .chatbtn
  {
    background-color: #33cc33;
    padding: 10px 5px;
    border:none;
    border-radius: 5px;
    font-family:sans-serif;
    color: #fff;
    font-size: 1rem;
  }

  footer a:hover
  {
    color: #fff;
    font-size: 1rem;
  }

  .btnMargin{
    margin: 0px;
    padding: 0 5px;
    font-size: 1rem;
  }

  .btnMargin p
  {
    padding-bottom: 0px;
    margin: 0px;
    font-weight: 700;
    font-size: 1rem;
  }

.card.hovercard .avatar {
    position: relative;
    top: -60px;
    margin-bottom: -50px;
    font-size: 1rem;
}

.card.hovercard .avatar img {
    width: 130px;
    height: 130px;
    max-width: 130px;
    max-height: 130px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
    font-size: 1rem;
}

.card.hovercard .info {
    padding: 4px 8px 10px;
    font-size: 1rem;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    /*font-size: 24px;*/
    font-size: 1rem;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    /*font-size: 12px;*/
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
    font-size: 1rem;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}

.text-danger {
    color: #AB1818;
    font-size: 1rem;
}

.postImage
{
  margin-left: -15px;
  margin-right: -15px;
}

.postImage img
{
  width: 50px;
}
.postImage p
{
  padding-top: 10px;
  margin-bottom: 20px;
  color: #428bca;
  margin-left: -15px;
  margin-right: -15px;
  font-size: 1rem;
}

/*.btn{ border-radius: 50%; width:32px; height:32px; line-height:18px;  }*/

</style>




<!-- Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:345px;margin-left: auto; margin-right: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center" id="myModalLabel">Add Post</h4>
      </div>
      <div class="modal-body">
        
        <div class="row postImage">
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTodayAvailableCars" class="" role="button"><img src="<?php echo base_url(); ?>assets/imgs/cto.png"> <p style="font-weight: 600">Todays Available</p></a>
          </div>
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addDroppingCars"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/dc.png"> <p style="font-weight: 600">Dropping Cars</p></a>
          </div>
          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addSelfDrivingCars"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/sdv.png"> <p style="font-weight: 600">Self Driving</p></a>
          </div>

          <br>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTourpackage"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/tp.png"> <p style="font-weight: 600">Tour Package</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addJobs"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/jobs.png"> <p style="font-weight: 600">Jobs</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addTender"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/tender.png"> <p style="font-weight: 600">Tenders</p></a>
          </div>

          <br>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addVisitingCard"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/pvc.png"> <p style="font-weight: 600">Promote Visiting</p></a>
          </div>

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addOthers"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/others.png"> <p style="font-weight: 600">Others</p></a>
          </div>

          <!-- <div class="col-xs-4 col-md-4 text-center">
            <a href="#"  role="button"><img src="<?php echo base_url(); ?>assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Ads</p></a>
          </div> -->

          <div class="col-xs-4 col-md-4 text-center">
            <a href="<?php echo base_url(); ?>user/addAccident"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/acc.png"> <p style="font-weight: 600">Accident / Breakdown</p></a>
          </div>






          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/1"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Banner Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/2"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Booking Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/3"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Home Page Ad</p></a>
          </div>
          <div class="col-xs-3 col-md-3 text-center">
            <a href="<?php echo base_url(); ?>user/addAds/4"  role="button"><img src="<?php echo base_url(); ?>/assets/imgs/postAnnounce.png"> <p style="font-weight: 600">Posting Ad</p></a>
          </div>
          
        </div>

      </div>

    </div>
  </div>
</div>


<?php 
  if($this->session->userdata('details'))
  {
    if($this->session->userdata('details')->cartravels_id != null)
    { ?>
	<!-- Footer -->
	<br>
	<br>
	<br>
	<footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url().$this->session->userdata('details')->cartravels_id; ?>">
              <i class="fa fa-home fa-lg text-black  fa-2x"> </i> <p class="text-danger">Home</p>
            </a>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url(); ?>user/logout">
              <i class="fa fa-sign-out fa-lg text-black  fa-2x"> </i> <p class="text-danger">Logout</p>
            </a>
          </div>
          <div class="col-xs-4 btnMargin">
            <div style="">
              <a class="text-danger text-center" data-toggle="modal" data-target="#addPostModal" href="#" style="background-color: red; color:#fff;display: inline-grid;padding: 14px 15px 5px 15px;border-radius: 15px; margin-bottom: -10px;margin-top: -17px;">
                <i class="fa fa-camera fa-lg black-text  fa-2x"> </i>
                <p style="padding-top: 0px;">Post</p>
              </a>
          </div>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-center" href="<?php echo base_url(); ?>user/myPosts">
              <i class="fa fa-list fa-lg text-black  fa-2x"> </i> <p class="text-danger">My Posts</p>
            </a>
          </div>
          <div class="col-xs-2 btnMargin">
            <a class="text-danger" href="<?php echo base_url(); ?>user">
              <i class="fa fa-user fa-lg text-black  fa-2x"> </i> <p class="text-danger">Profile</p>
            </a>
          </div>
        </div>
      </div>
	</footer>
	<!-- Footer -->
    <?php }} ?>























<!-- <script src="<?php echo base_url(); ?>assets/web/js/jquery.js"></script> -->
<script src="<?php echo base_url(); ?>assets/web/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/jquery.fancybox-media.js"></script>  
<script src="<?php echo base_url(); ?>assets/web/js/jquery.flexslider.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/animate.js"></script>
<!-- Vendor Scripts -->
<script src="<?php echo base_url(); ?>assets/web/js/modernizr.custom.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/animate.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/custom.js"></script> 

 <script src="<?php echo base_url(); ?>assets/web/contact/jqBootstrapValidation.js"></script>
 <!-- <script src="<?php echo base_url(); ?>assets/web/contact/contact_me.js"></script> -->
 
</body>
</html>


<script type="text/javascript">
// function loadMore()
// {
//    console.log("More loaded");
//     $("body").append("<div>");
//    $(window).bind('scroll', bindScroll);

//    // location.reload();
//  }

//  function bindScroll(){
//    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
//        $(window).unbind('scroll');
//        loadMore();
//    }
// }

// $(window).scroll(bindScroll);
</script>