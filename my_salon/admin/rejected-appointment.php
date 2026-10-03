<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SALON|| Rejected</title>
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

<h3 class="title1">Rejected List</h3>
<div class="table-responsive bs-example widget-shadow">
<h4>Rejected Appointments:</h4>
<table class="table table-bordered">
<thead>
<tr>
<th>S.No</th><th>Name</th><th>Apt_Number</th><th>Mobile</th><th>Creation Date</th><th>Status</th><th>View</th>
</tr>
</thead>
<tbody>
<?php
$ret=mysqli_query($con,"select * from tblcustomers WHERE Status='Rejected' ORDER BY ID DESC");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
<tr>
<th scope="row"><?php echo $cnt;?></th>
<td><?php echo $row['Name'];?></td>
<td><?php echo $row['AptNumber'];?></td>
<td><?php echo $row['MobileNumber'];?></td>
<td><?php echo $row['CreationDate'];?></td>
<td><span style="color:red;font-weight:bold;"><?php echo $row['Status'];?></span></td>
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