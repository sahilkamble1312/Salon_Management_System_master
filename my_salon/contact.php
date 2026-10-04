<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Men Salon Management System || Contact Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php');?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Contact us</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Contact us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget widget-contact">
                         <?php
                        $ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <h3 class="widget-title">Contact Info <i class="fa fa-address-book"></i></h3>
                        <address>
                            <strong><i class="fa fa-location-arrow"></i> Address: </strong>
                            <?php echo $row['PageDescription'];?><br><br>
                            <strong><i class="fa fa-phone-square"></i> Phone no:</strong> <a href="tel:<?php echo $row['MobileNumber']; ?>"><?php echo $row['MobileNumber']; ?></a>
                        </address>
                        <address>
                            <strong><i class="fa fa-envelope"></i> Email: </strong>
                            <a href="mailto:<?php echo $row['Email'];?>"><?php echo $row['Email'];?></a>
                        </address>
                         <address>
                            <strong><i class="fa fa-clock-o"></i> Timing: </strong>
                           <?php echo $row['Timing'];?>
                        </address><?php } ?>
                    </div>
                    <div class="widget widget-social">
                        <div class="social-circle">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well-block">
                        <?php
                        $ret=mysqli_query($con,"select * from tblpage where PageType='aboutus' ");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <h1><?php echo $row['PageTitle'];?></h1>
                        <h5 class="small-title ">best experience ever</h5>
                        <p><?php echo $row['PageDescription'];?></p><?php } ?>
                         </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- KAGAL - Deluxe Hair And Beauty Salon EXACT MAP -->
<div style="width:100%; height:500px;">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d346.6554238909983!2d74.31288454646918!3d16.578878892281388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc0fba9367d4535%3A0x5dfec1e0ac9ea82f!2sDeluxe%20Hair%20And%20Beauty%20Salon!5e1!3m2!1sen!2sin!4v1791039800495!5m2!1sen!2sin" 
width="100%" 
height="500" 
style="border:0;" 
allowfullscreen="" 
loading="lazy" 
referrerpolicy="no-referrer-when-downgrade">
</iframe>
</div>
<!-- google map end -->

   <?php include_once('includes/footer.php');?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>
</body>
</html>