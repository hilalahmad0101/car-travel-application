<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($profile->user_Owner_Name)?ucwords($profile->user_Owner_Name):ucwords($profile->user_Name.' '.$profile->user_Surname); ?> +91 9966890867</title>

    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">
    <meta property="og:image" itemprop="image" content="<?php echo ($profile->user_Profile_Photo)?$profile->user_Profile_Photo:base_url().'assets/img/CarTravels.com.jpg'; ?>"/>

    
    <meta property="og:type" content="website" />

    <meta property="og:description" content="<?php echo ($profile->uesr_Business_Name)?$profile->uesr_Business_Name .'('.$profile->user_City.' - '.$profile->user_State.')':ucwords($profile->user_Proffession); ?>" />

    
    <link rel="shortcut icon" href="<?php echo $profile->user_Profile_Photo; ?>" type="image/x-icon">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">



<meta name="fb:app_id" content="113869198637480" />
<meta name="og:site_name" content="Facebook for Developers" />
<meta name="og:title" content="Getting Started - Sharing - Documentation - Facebook for Developers" />

<meta name="og:url" content="https://developers.facebook.com/docs/sharing/webmasters/getting-started/" />
<meta name="og:image" content="https://static.xx.fbcdn.net/rsrc.php/v3/yb/r/-Hn0KbzDJps.png" />
<meta name="og:locale" content="en_US" />
<meta name="og:description" content="" />
<meta name="twitter:site:id" content="63359297" />





<style>
#mySidenav a {
  position: absolute;
  right: 0px;
  transition: 0.3s;
  padding: 7px;
  /*width: 180px;*/
  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 5px 0 0 5px;
  z-index:1000;
  position: fixed;
}

#mySidenav a:hover {
  right: 0;
}

#about {
  top: 330px;
  background-color: #4CAF50;
}
.top-icons li
{
    font-size: 20px;
}

</style>


<div id="mySidenav" class="sidenav">
 <a style="top: 150px;right:-55px;margin:0;padding:5px 3px;transform: rotate(90deg);" href="<?php echo base_url(); ?>registration">
    <img src="<?php echo base_url(); ?>assets/img/ct_logo.png" width="150px;">
 </a>
</div>


<style>
#wrap {
   min-height: 100%;
   height: auto !important;
   height: 100%;
   margin: 0 auto -60px;
   bottom: 0px;
}
</style>

