<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']) == 0) {
	header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SALON | Invoice</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script><script>new WOW().init();</script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
<?php include_once('includes/sidebar.php'); ?>
<?php include_once('includes/header.php'); ?>
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<h3 class="title1">Invoice List</h3>
<div class="table-responsive bs-example widget-shadow">
<h4>Invoice List:</h4>
<table class="table table-bordered">
<thead>
<tr><th>S.No</th><th>Invoice Id</th><th>Customer Name</th><th>Invoice Date</th><th>View</th><th>Delete</th></tr>
</thead>
<tbody>
<?php
$ret = mysqli_query($con, "select tblcustomers.Name,tblinvoice.BillingId,tblinvoice.PostingDate from tblcustomers join tblinvoice on tblcustomers.ID=tblinvoice.Userid group by tblinvoice.BillingId order by tblinvoice.BillingId desc");
if(mysqli_num_rows($ret) == 0){
echo "<tr><td colspan='6' style='color:red; text-align:center;'>No Invoice Found - Please create invoice first</td></tr>";
}
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
<tr>
<th scope="row"><?php echo $cnt; ?></th>
<td><?php echo $row['BillingId']; ?></td>
<td><?php echo $row['Name']; ?></td>
<td><?php echo $row['PostingDate']; ?></td>
<td><a href="view-invoice.php?invoiceid=<?php echo $row['BillingId']; ?>">View</a></td>
<td><a href="delete-invoice.php?invoiceid=<?php echo $row['BillingId']; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
</tr>
<?php $cnt++; } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('includes/footer.php'); ?>
</div>
<script src="js/classie.js"></script>
<script>var menuLeft=document.getElementById('cbp-spmenu-s1'),showLeftPush=document.getElementById('showLeftPush'),body=document.body;showLeftPush.onclick=function(){classie.toggle(this,'active');classie.toggle(body,'cbp-spmenu-push-toright');classie.toggle(menuLeft,'cbp-spmenu-open');disableOther('showLeftPush');};function disableOther(button){if(button!=='showLeftPush'){classie.toggle(showLeftPush,'disabled');}}</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>