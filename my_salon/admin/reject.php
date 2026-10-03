<?php
include('includes/dbconnection.php');
include('includes/sms_helper.php');
$id = $_GET['id'];

$q = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$id'");
$row = mysqli_fetch_array($q);
$aptnum = $row['AptNumber'];
$mob = $row['MobileNumber'];
$name = $row['Name'];

mysqli_query($con, "UPDATE tblcustomers SET Status='Rejected' WHERE AptNumber='$aptnum'");
mysqli_query($con, "UPDATE tblappointment SET Status='Rejected' WHERE AptNumber='$aptnum'");

$msg = "Hello $name, Your Appointment No. $aptnum is REJECTED. Please contact salon.";
sendSalonSMS($mob, $msg);

header('location: rejected-appointment.php');
?>