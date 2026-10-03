<?php
include('includes/dbconnection.php');
include('includes/sms_helper.php');
$id = $_GET['id'];

$q = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$id'");
$row = mysqli_fetch_array($q);
$aptnum = $row['AptNumber'];
$mob = $row['MobileNumber'];
$name = $row['Name'];

mysqli_query($con, "UPDATE tblcustomers SET Status='Accepted' WHERE AptNumber='$aptnum'");
mysqli_query($con, "UPDATE tblappointment SET Status='Accepted' WHERE AptNumber='$aptnum'");

$msg = "Hello $name, Your Appointment No. $aptnum is ACCEPTED. Thank You - Salon";
sendSalonSMS($mob, $msg);

header('location: accepted-appointment.php');
?>