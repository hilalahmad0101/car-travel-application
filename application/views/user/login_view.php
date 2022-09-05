

<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">


			

			  <!-- <form name="loginForm" method="POST" action="<?php echo current_url(); ?>" class="form-signin" > -->
			  	<?php echo form_open('', 'class="form-signin"'); ?>
			    <h3 class="form-signin-heading text-center">Login</h3>


			<?php
			if(!empty($this->session->has_userdata('error')))
			{
				echo '<center><span style="color:red">'.$this->session->userdata('error').'</span></center>';
			}
			else
			{
				echo "";
			}
			echo '<center><span style="color:red">'.validation_errors().'</span></center>'; 

			?>

			    <input type="number" name="mobileNumber" id="mobileNumber" maxlength="10" class="form-control" placeholder="Mobile Number" required autofocus value="<?php echo set_value('mobileNumber'); ?>"><br>
			    <input type="password" name="userPassword" id="userPassword" class="form-control" placeholder="Password" required>
			    <label class="checkbox">
			      <input type="checkbox" value="remember-me"> Remember me
			    </label>
			    <input type="submit" class="btn btn-lg btn-primary btn-block" name="Login" value="Login">
			  </form>

			</div>
		</div>
	</div>
</section>
