<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />

    <!-- TITLE -->
    <title><?php echo @$_GET['t']; ?> <?php echo @$_GET['m']; ?></title>

    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">

    <!-- IMAGE URL -->
    <meta property="og:image" itemprop="image" content=""/>

    
    <meta property="og:type" content="website" />

    <!-- NAMES -->
    <meta property="og:description" content="" />


</head>
<body>
    

<br><br>
<!--<a href="intent://www.myct.me/#Intent;scheme=https;package=cartravels.co;end">CarTravels</a>-->


<!--<a href="intent:#Intent;scheme=https://open?url_param=hi santhosh;package=cartravels.co;end">click here</a>-->



 <a href='intent://cartravels.com/app.php?driver=<?php echo @$_GET["driver"]; ?>#Intent;scheme=https;package=cartravels.co;category=android.intent.category.BROWSABLE;component=cartravels.co;action=android.intent.action.VIEW;end' id="post">CarTravels</a>


 <a href='intent://cartravels.com/app.php?sos=<?php echo @$_GET["sos"]; ?>#Intent;scheme=https;package=cartravels.co;category=android.intent.category.BROWSABLE;component=cartravels.co;action=android.intent.action.VIEW;end' id="sos">CarTravels</a>

 
</body>
</html>

<script type="text/javascript">
    document.getElementById("post").click();
    document.getElementById("sos").click();
</script>
