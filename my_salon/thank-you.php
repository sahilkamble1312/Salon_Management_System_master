<?php
session_start();
include('includes/dbconnection.php');
$aptno = $_GET['aptnumber'] ?? $_SESSION['aptno'] ?? '';
if($aptno==''){
  $q=mysqli_query($con,"SELECT AptNumber FROM tblappointment ORDER BY ID DESC LIMIT 1");
  $r=mysqli_fetch_array($q); $aptno=$r['AptNumber'];
}
$query=mysqli_query($con,"SELECT * FROM tblappointment WHERE AptNumber='$aptno' LIMIT 1");
$row=mysqli_fetch_array($query);
if(!$row){ die("No booking found"); }
?>
<!DOCTYPE html>
<html><head><title>Your Bill - DELUXE</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>@media print{.no-print{display:none}}</style>
</head>
<body style="background:#f2f2f2;">
<div style="max-width:750px; margin:30px auto; background:#fff; padding:25px; border:1px solid #000;">
<center><h2><b>DELUXE Mens salon</b></h2><p>Near ST Stand, Kagal</p><hr></center>
<h4 style="background:#000; color:#fff; padding:10px;">Invoice #<?php echo $row['AptNumber']; ?></h4>
<table class="table table-bordered">
<tr><td>Name</td><td><?php echo $row['Name']; ?></td><td>Phone</td><td><?php echo $row['PhoneNumber']; ?></td></tr>
<tr><td>Service</td><td><?php echo $row['Services']; ?></td><td>Date</td><td><?php echo $row['AptDate']; ?> <?php echo $row['AptTime']; ?></td></tr>
<tr><td>Total</td><td colspan="3"><b>Rs. <?php echo $row['TotalCost']; ?></b></td></tr>
</table>
<center><p>Thank you! Visit Again</p></center>
</div>
<div class="no-print" style="text-align:center;">
<button onclick="window.print()" style="padding:12px 30px; background:#000; color:#fff; border:none; font-size:16px; border-radius:5px;">📄 Download PDF / Print Bill</button>
<br><br><a href="index.php">Go to Home</a>
</div>
</body></html>