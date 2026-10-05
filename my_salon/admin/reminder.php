<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
<title>30 Days Reminder</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script> new WOW().init(); </script>
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
<h3 class="title1">30 Days Reminder</h3>
<div class="table-responsive bs-example widget-shadow">
<h4>30 Days Reminder List:</h4>
<table class="table table-bordered">
<thead><tr><th>S.No</th><th>Customer Name</th><th>Last Visit</th><th>Days</th><th>WhatsApp</th></tr></thead>
<tbody>
<?php
$ret = mysqli_query($con, "SELECT tblcustomers.Name, tblcustomers.MobileNumber, MAX(tblinvoice.PostingDate) as lastdate, DATEDIFF(CURDATE(), MAX(tblinvoice.PostingDate)) as days FROM tblinvoice JOIN tblcustomers ON tblcustomers.ID=tblinvoice.Userid GROUP BY tblcustomers.ID ORDER BY days DESC");
$cnt=1;
while($row=mysqli_fetch_array($ret)){
// --- ENGLISH MESSAGE - NO MARATHI ---
$msg=urlencode("Hi ".$row['Name']."! Greetings from DELUX Mens Salon, Kagal. We hope to see you again soon - Sahil Kamble");
?>
<tr>
<th scope="row"><?php echo $cnt; ?></th>
<td><?php echo $row['Name']; ?></td>
<td><?php echo $row['lastdate']; ?></td>
<td style="color:red;"><?php echo $row['days']; ?> <?php echo ($row['days']==1) ? "day" : "days"; ?></td>
<td>
<?php if(strlen($row['MobileNumber'])==10){ ?>
<a href="https://wa.me/91<?php echo $row['MobileNumber']; ?>?text=<?php echo $msg; ?>" target="_blank" class="btn btn-success btn-sm">Send WhatsApp</a>
<?php } else { echo "Invalid No."; } ?>
</td>
</tr>
<?php $cnt++; } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('includes/footer.php');?>
</div>
<script src="js/classie.js"></script>
<script>var menuLeft=document.getElementById('cbp-spmenu-s1'),showLeftPush=document.getElementById('showLeftPush'),body=document.body;showLeftPush.onclick=function(){classie.toggle(this,'active');classie.toggle(body,'cbp-spmenu-push-toright');classie.toggle(menuLeft,'cbp-spmenu-open');disableOther('showLeftPush');};function disableOther(button){if(button!=='showLeftPush'){classie.toggle(showLeftPush,'disabled');}}</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>