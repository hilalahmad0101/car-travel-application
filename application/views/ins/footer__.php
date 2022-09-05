

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
<!-- 				<div class="col-md-3 col-sm-3">
					<div class="widget">
						<h5 class="widgetheading">Quick Links</h5>
						<ul class="link-list">
							<li><a href="#">one</a></li>
							<li><a href="#">two</a></li>
							<li><a href="#">three</a></li>
							<li><a href="#">four</a></li>
							<li><a href="#">five</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget">
						<h5 class="widgetheading">Latest posts</h5>
						<ul class="link-list">
							<li><a href="#">post1</a></li>
							<li><a href="#">post2</a></li>
							<li><a href="#">post3</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget">
						<h5 class="widgetheading">Recent News</h5>
						<ul class="link-list">
							<li><a href="#">news1</a></li>
							<li><a href="#">news2</a></li>
							<li><a href="#">news3</a></li>
						</ul>
					</div>
				</div> -->
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
							<!-- <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li> -->
							<!-- <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li> -->
							<!-- <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li> -->
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



<script type="text/javascript">
	$(document).ready(function(){
		$('.js-example-basic-single').select2();

		$('.select2').select2({
		  placeholder: 'Select an option'
		});

		$("#searchCityData").click(function(e){
			// console.log(e.target.innerHTML);
			var cVal = e.target.innerHTML;
			// console.log(cVal);
			// $.cookie("CityName", "foo");
			// document.cookie = "CityName="+cVal;

			// $.get("<?php echo base_url(); ?>Businesslistings/set_session/" + cVal+"/"+cVal, function (result) {
			//     console.log(result);
			// });

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>Businesslistings/set_city/",
				data: {searchCity: cVal},
				success: function(data) {
					console.log(data);
				},
				dataType: "json"
			});

			// location.reload();
		});




	$("#searchCityData").hide();
	$(".CityName").keyup(function(){
		$("#searchCityData").show();
        var searchCity = $("#searchCity").val();
        console.log(searchCity);

        if(!searchCity){
        	$("#searchCityData").hide();
        }


        // $("#responseCity").html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
        if(searchCity.length >= 3) 
        {
          $.ajax({
             url: '<?php echo base_url(); ?>Businesslistings/getCityList',
             type: 'POST',
             data: {searchCity: searchCity},

             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
             	var data = JSON.parse(data);
             	if(data)
             	{
             		$("#searchCityData").html("");
             		$.each(data, function(key, value) {
			            $("#searchCityData").append("<option>" + value.city_name+", "+value.state_name+ "</option>");
			        });
             	}
             	else
             	{
             		$("#searchCityData").html("<option> -- No Data --</option>");
             	}
             	console.log(data);
             }
          });
      }
      else
      {
      	console.log(searchCity);
      	$("#searchCityData").html('<option> --- type city name --- </option>');
      }

    });






	});



</script>



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
 <script src="<?php echo base_url(); ?>assets/web/contact/contact_me.js"></script>
 
</body>
</html>


<script type="text/javascript">
function loadMore()
{
   console.log("More loaded");
    $("body").append("<div>");
   $(window).bind('scroll', bindScroll);

   // location.reload();
 }

 function bindScroll(){
   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
       $(window).unbind('scroll');
       loadMore();
   }
}

$(window).scroll(bindScroll);
</script>