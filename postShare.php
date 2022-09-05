<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
    <title><?php echo @$_GET['t']; ?></title>
    <style>@media screen and (max-device-width:480px){body{-webkit-text-size-adjust:none}}</style>
 
    <!-- implement javascript on web page that first first tries to open the deep link
        1. if user has app installed, then they would be redirected to open the app to specified screen
        2. if user doesn't have app installed, then their browser wouldn't recognize the URL scheme
        and app wouldn't open since it's not installed. In 1 second (1000 milliseconds) user is redirected
        to download app from app store.
     -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">
    <meta property="og:type" content="website" />


<?php 

$servername = "localhost";
$username = "cartrrjz_ctuser";
$password = "KZvh87SuYWnx";
$dbname = "cartrrjz_travels";

$conn = new mysqli($servername, $username, $password, $dbname);



$uniid = $_GET['uid'];
$pid = $_GET['pid'];

$myquery = "SELECT `p`.`gpost_status`, `p`.`postingID`, `p`.`posting_booking_sts`, `p`.`uniid` as `myUniid`, `p`.`sdvID` as `selfDriving`, `p`.`tdaID` as `todayAvailCars`, `p`.`vcID` as `visitingCard`, `p`.`otherID` as `others`, `p`.`tpID` as `tourPackage`, `p`.`dpID` as `droppingCars`, `sdv`.*, `tda`.*, `vc`.*, `otr`.*, `tt`.*, `dp`.*, `bc`.`user_Mobile_No` as `requested_mobile`, `bc`.`user_Name` as `requested_user_Name`, `bc`.`user_Surname` as `requested_user_Surname`, `bc`.`user_Owner_Name` as `requested_user_Owner_Name`, `bc`.`user_Profile_Photo`, `p`.`post_location`, `p`.`favourite`, `fav`.`favourite` as `Fav` FROM `api_cartravel_postings` `p` LEFT JOIN `api_cartravel_sdv` `sdv` ON `sdv`.`uniid` = `p`.`uniid` AND `sdv`.`sdvID` = `p`.`sdvID` LEFT JOIN `api_cartravel_tdacars` `tda` ON `tda`.`uniid` = `p`.`uniid` AND `tda`.`tdaID` = `p`.`tdaID` LEFT JOIN `api_cartravel_vc` `vc` ON `vc`.`uniid` = `p`.`uniid` AND `vc`.`vcID` = `p`.`vcID` LEFT JOIN `api_cartravel_others` `otr` ON `otr`.`uniid` = `p`.`uniid` AND `otr`.`otherID` = `p`.`otherID` LEFT JOIN `api_cartravel_tours_travels` `tt` ON `tt`.`uniid` = `p`.`uniid` AND `tt`.`tpID` = `p`.`tpID` LEFT JOIN `api_cartravel_dropping_cars` `dp` ON `dp`.`uniid` = `p`.`uniid` AND `dp`.`dpID` = `p`.`dpID` LEFT JOIN `api_cartravel_favourite` `fav` ON `fav`.`pid` = `p`.`postingID` AND `fav`.`uniid` = '$uniid' LEFT JOIN `api_cartravel_business_agencies` `bc` ON `bc`.`user_uniid` = `p`.`uniid` WHERE `p`.`postingID` = '$pid' ORDER BY `postingID` DESC";
$result = $conn->query($myquery);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";

    $sdv_image = $row['sdv_image'];
    $sdv_type = $row['sdv_type']; // car
    $sdv_name = $row['sdv_name']; // car Name
    $sdv_hours = $row['sdv_hours']; // Hours


    $tda_car_image = $row['tda_car_image'];
    $tda_car_type = $row['tda_car_type'];


    $vc_image = $row['vc_image'];
    $vc_desc = $row['vc_desc'];


    $other_image = $row['other_image'];
    $other_title = $row['other_title'];
    $other_desc = $row['other_desc'];


    $tourp_image = $row['tourp_image'];
    $tour_package_name = $row['tour_package_name'];
    $tour_description = $row['tour_description'];
    $tour_plan_days = $row['tour_plan_days'];
    $tour_keywords = $row['tour_keywords'];


    $vehicle_images = $row['vehicle_images'];
    $pickupCity = $row['pickupCity'];
    $dropCity = $row['dropCity'];
    $available_seats = $row['available_seats'];
    $ticket_fair = $row['ticket_fair'];
    $journey_date = $row['journey_date'];

    if(!empty($sdv_image))
    {
        $postImage = $sdv_image;
        $cat = "Self Driving Vehicle";
        $postTitle = $cat.' - '.$sdv_type.' - '.$sdv_name;
        $postDesc = $postTitle.' ('.$sdv_hours.' Hours)';
    }
    elseif(!empty($tda_car_image))
    {
        $postImage = $tda_car_image;
        $cat = "Today Available Cars";
        $postTitle = $cat.' - '.$tda_car_type;
        $postDesc = $postTitle;
    }
    elseif(!empty($vc_image))
    {
        $postImage = $vc_image;
        $cat = "Visiting Cards";
        $postTitle = $cat.' - '.$vc_desc;
        $postDesc = $postTitle;
    }
    elseif(!empty($other_image))
    {
        $postImage = $other_image;
        $cat = "Others";
        $postTitle = $cat.' - '.$other_title;
        $postDesc = $postTitle.' - '.$other_desc;
    }
    elseif(!empty($tourp_image))
    {
        $postImage = $tourp_image;
        $cat = "Tour Packages";
        $postTitle = $cat.' - '.$tour_package_name;
        $postDesc = $postTitle.' - '.$tour_description.', Days: '.$tour_plan_days.', Places: '.$tour_keywords;
    }
    elseif(!empty($vehicle_images))
    {
        $postImage = $vehicle_images;
        $cat = "Dropping Cars";
        $postTitle = $cat.' - '.$pickupCity.' to '.$dropCity;
        $postDesc = $postTitle.', Available Seats '.$available_seats.', Ticket Cost: '.$ticket_fair.', Date: '.$journey_date;
    }






    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    // echo $url;    

    ?>




    <title><?php echo $postTitle; ?></title>
    <meta property="og:title" content="<?php echo $postTitle; ?>" />

    <meta property="og:description" content="<?php echo $postDesc; ?>" />

    
    <meta property="og:url" content="<?php echo $url; ?>" />
    <meta property="og:image" content="<?php echo $postImage; ?>" />






    <?php
  }
} else {
  echo "0 results";
}

// print_r($result);



$conn->close();

?>







</head>
<body>

<br><br> 

<!--<a href="intent://www.myct.me/#Intent;scheme=https;package=cartravels.co;end">CarTravels</a>-->


<!--<a href="intent:#Intent;scheme=https://open?url_param=hi santhosh;package=cartravels.co;end">click here</a>-->


<!-- <a href="intent://www.myct.me/postShare.php?share=clptravels123#Intent;scheme=https;package=cartravels.co;category=android.intent.category.BROWSABLE;component=cartravels.co;action=android.intent.action.VIEW;end">CarTravels</a>
 -->
 
 
 <a href='intent://cartravels.com/postShare.php?pid=<?php echo @$_GET["pid"]; ?>&uid=<?php echo @$_GET["uid"]; ?>#Intent;scheme=https;package=cartravels.co;category=android.intent.category.BROWSABLE;component=cartravels.co;action=android.intent.action.VIEW;end' id="post">POST</a>


<script type="text/javascript">
    document.getElementById("post").click();
    document.getElementById("driver").click();
</script>

</body>
</html>