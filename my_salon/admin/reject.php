<?php
include('includes/dbconnection.php');
include('includes/sms_helper.php');
$id = $_GET['id'];

$q = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$id'");
$row = mysqli_fetch_array($q);
$aptnum = $row['AptNumber'];
$mob = $row['MobileNumber'];
$name = $row['Name'];
$adate = $row['app_date'];
$atime = $row['app_time'];
$service = $row['Details'];

mysqli_query($con, "UPDATE tblcustomers SET Status='Rejected' WHERE AptNumber='$aptnum'");
mysqli_query($con, "UPDATE tblappointment SET Status='Rejected' WHERE AptNumber='$aptnum'");

// SMS - tujha juna code tasach rahil
$msg = "Hello $name, Your Appointment No. $aptnum is REJECTED. Please contact salon.";
sendSalonSMS($mob, $msg);

// WhatsApp sathi
$text = "Hello $name, Sorry your appointment at Deluxe Salon Kagal on $adate at $atime for $service could not be confirmed as we are fully booked. Please book for another time. Sorry for inconvenience. Deluxe Salon Kagal";
$wamsg = urlencode($text);
$clean_mob = preg_replace('/[^0-9]/', '', $mob);
if(strlen($clean_mob) == 10){ $clean_mob = "91".$clean_mob; }
$link = "https://wa.me/".$clean_mob."?text=".$wamsg;
?>
<html>
<body style="text-align:center; padding-top:60px; font-family:Arial;">
<h2 style="color:red;">Rejected <?php echo $aptnum; ?> - <?php echo $name; ?></h2>
<p>SMS sent successfully</p>
<br>
<a href="<?php echo $link; ?>" target="_blank" style="background:#ff3b30; color:white; padding:20px 35px; text-decoration:none; border-radius:12px; font-size:22px; font-weight:bold; display:inline-block;">
Send Reject on WhatsApp
</a>
<br><br><br>
<a href="rejected-appointment.php" style="font-size:18px;">Go to Rejected List (Skip WhatsApp)</a>
<br><br>
<a href="All-appointment.php">Back to All Appointments</a>
</body>
</html>