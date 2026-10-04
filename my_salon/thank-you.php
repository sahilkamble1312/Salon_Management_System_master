<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Thank You - Appointment Confirmed</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include_once('includes/header.php'); ?>

<div class="container" style="margin-top:50px; margin-bottom:50px;">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div style="border:2px solid #28a745; padding:25px; border-radius:10px; background:#fff; text-align:center;">
<h2 style="color:#28a745;">Thank You!</h2>
<h4>Your Appointment is Confirmed</h4>
<hr>

<?php
$aptnum = $_SESSION['aptnumber'];
$q = mysqli_query($con,"SELECT * FROM tblcustomers WHERE AptNumber='$aptnum'");
$row = mysqli_fetch_array($q);
if($row){
?>
<table class="table table-bordered" style="text-align:left;">
<tr><th>Appointment Number</th><td><?php echo $row['AptNumber']; ?></td></tr>
<tr><th>Name</th><td><?php echo $row['Name']; ?></td></tr>
<tr><th>Total Cost</th><td>Rs. <?php echo $row['TotalCost']; ?></td></tr>
<tr><th>Payment Method</th><td><?php echo $row['PaymentMethod']; ?></td></tr>
<tr><th>Payment Status</th><td><span style="color:green; font-weight:bold;"><?php echo $row['PaymentStatus']; ?></span></td></tr>
<tr><th>Advance Paid</th><td>Rs. <?php echo $row['AdvanceAmount']; ?></td></tr>
<tr><th>Transaction ID</th><td><?php echo $row['TransactionId'] ? $row['TransactionId'] : 'N/A (Cash Payment)'; ?></td></tr>
<tr><th>UPI ID</th><td>kamblesahil1312@oksbi</td></tr>
</table>

<p style="margin-top:15px; font-size:13px; color:#555;">
Please visit Deluxe Salon Kagal on <?php echo $row['app_date']; ?> at <?php echo $row['app_time']; ?>
</p>

<?php } ?>

<a href="index.php" class="btn btn-success" style="margin-top:10px;">Go to Home</a>
<a href="appointment.php" class="btn btn-default" style="margin-top:10px;">Book Another</a>

</div>
</div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
</body>
</html>