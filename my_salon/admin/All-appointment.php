<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/sms_helper.php'); 
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
} else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SALON|| All Appointments</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script><script> new WOW().init(); </script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
<?php include_once('includes/sidebar.php');?>
<?php include_once('includes/header.php');?>
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<div class="search-box">
<input type="text" id="search" placeholder="Search by name...">
<button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
</div>
<style>.search-box{ margin-left: 696px; margin-bottom: -35px; }</style>
<script>
$(document).ready(function(){
$("#search").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("table tbody tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>

<h3 class="title1">All Appointments</h3>
<div class="table-responsive bs-example widget-shadow">
<h4>All Appointments:</h4>
<table class="table table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Name</th>
<th>Apt_Number</th>
<th>Mobile</th>
<th>App Date/Time</th>
<th>Service</th>
<th>Total</th>
<th>Advance</th>
<th>Balance</th>
<th>Payment</th>
<th>Transaction ID</th>
<th>Status</th>
<th>Action</th>
<th>View</th>
</tr>
</thead>
<tbody>
<?php
$ret=mysqli_query($con,"select * from tblcustomers ORDER BY ID DESC");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$total = isset($row['TotalCost']) ? $row['TotalCost'] : 0;
$adv = isset($row['AdvanceAmount']) ? $row['AdvanceAmount'] : 0;
$bal = $total - $adv;
?>
<tr>
<th scope="row"><?php echo $cnt;?></th>
<td><?php echo $row['Name'];?></td>
<td><?php echo $row['AptNumber'];?></td>
<td><?php echo $row['MobileNumber'];?></td>
<td><?php echo $row['app_date'];?> <?php echo $row['app_time'];?></td>
<td><?php echo $row['Details'];?></td>
<td>Rs. <?php echo $total;?></td>
<td style="color:green; font-weight:bold;">Rs. <?php echo $adv;?></td>
<td style="color:red; font-weight:bold;">Rs. <?php echo $bal;?></td>
<td>
<?php echo isset($row['PaymentMethod']) ? $row['PaymentMethod'] : 'Cash'; ?><br>
<small style="color:<?php echo (isset($row['PaymentStatus']) && $row['PaymentStatus']=='Paid') ? 'green' : 'orange'; ?>; font-weight:bold;">
<?php echo isset($row['PaymentStatus']) ? $row['PaymentStatus'] : 'Pending'; ?>
</small>
<br>
<a href="update-payment.php?id=<?php echo $row['ID'];?>" style="color:blue; font-size:12px;"><u>Update Payment</u></a>
</td>
<td style="font-size:12px;">
<?php 
if(!empty($row['TransactionId'])){
echo $row['TransactionId']."<br><small>kamblesahil1312@oksbi</small>";
} else {
echo "N/A (Cash)";
}
?>
</td>
<td>
<?php if($row['Status']==""){ ?>
<span style="color:orange;">Pending</span>
<?php } else { ?>
<span style="color:green;font-weight:bold;"><?php echo $row['Status'];?></span>
<?php } ?>
</td>
<td>
<?php if($row['Status']!="Accepted" && $row['Status']!="Rejected"){ ?>
<a href="accept.php?id=<?php echo $row['ID'];?>" style="color:green; font-weight:bold;">Accept</a> | 
<a href="reject.php?id=<?php echo $row['ID'];?>" style="color:red; font-weight:bold;">Reject</a>
<?php } else { echo "Done"; } ?>
</td>
<td><a href="view-customer-details.php?viewid=<?php echo $row['ID'];?>">View</a></td>
</tr>
<?php $cnt=$cnt+1; }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<script src="js/classie.js"></script>
<script>
var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
showLeftPush = document.getElementById( 'showLeftPush' ),
body = document.body;
showLeftPush.onclick = function() {
classie.toggle( this, 'active' );
classie.toggle( body, 'cbp-spmenu-push-toright' );
classie.toggle( menuLeft, 'cbp-spmenu-open' );
disableOther( 'showLeftPush' );
};
function disableOther( button ) {
if( button !== 'showLeftPush' ) {
classie.toggle( showLeftPush, 'disabled' );
}
}
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>