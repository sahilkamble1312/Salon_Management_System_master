<?php
include('includes/dbconnection.php');
$id = $_GET['id'];

$q = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$id'");
$row = mysqli_fetch_array($q);
if(!$row){
    $q2 = mysqli_query($con, "SELECT * FROM tblappointment WHERE ID='$id'");
    $r2 = mysqli_fetch_array($q2);
    $aptnum_temp = $r2['AptNumber'];
    $q = mysqli_query($con, "SELECT * FROM tblcustomers WHERE AptNumber='$aptnum_temp'");
    $row = mysqli_fetch_array($q);
}
$aptnum = $row['AptNumber'];
$mob = $row['MobileNumber'];
$name = $row['Name'];
$adate = $row['app_date'];
$atime = $row['app_time'];
$service = $row['Details'];

mysqli_query($con, "UPDATE tblcustomers SET Status='Accepted' WHERE AptNumber='$aptnum'");
mysqli_query($con, "UPDATE tblappointment SET Status='Accepted' WHERE AptNumber='$aptnum'");


$plain_msg = "Hello $name,

Your appointment at Deluxe Salon Kagal is CONFIRMED!

Appointment No: $aptnum
Service: $service
Date: $adate
Time: $atime

Please arrive on time.
Thank you!

- Deluxe Salon, Kagal";

$msg = urlencode($plain_msg);
$clean_mob = preg_replace('/[^0-9]/', '', $mob);
if(strlen($clean_mob) == 10){ $clean_mob = "91".$clean_mob; }
?>
<html><body style="text-align:center; padding-top:60px; font-family:Arial;">
<h2 style="color:green;">Appointment <?php echo $aptnum; ?> Accepted!</h2>
<p><?php echo "$name - $mob | $service | $adate $atime"; ?></p><br>
<a href="https://api.whatsapp.com/send?phone=<?php echo $clean_mob; ?>&text=<?php echo $msg; ?>" target="_blank" style="background:#25D366; color:white; padding:20px 35px; text-decoration:none; border-radius:12px; font-size:22px; font-weight:bold; display:inline-block;">Send WhatsApp</a>
<br><br><br><a href="all-appointment.php">Back to All Appointments</a>
</body></html>