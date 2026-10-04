<?php
include('includes/dbconnection.php');
$id = $_GET['id'];
if(isset($_POST['update'])){
 $p_method = $_POST['p_method'];
 $p_status = $_POST['p_status'];
 $adv = $_POST['advance'];
 mysqli_query($con,"UPDATE tblcustomers SET PaymentMethod='$p_method', PaymentStatus='$p_status', AdvanceAmount='$adv' WHERE ID='$id'");
 echo "<script>alert('Payment Updated'); window.location='All-appointment.php';</script>";
}
$q = mysqli_query($con,"SELECT * FROM tblcustomers WHERE ID='$id'");
$row = mysqli_fetch_array($q);
?>
<html><body style="padding:30px; font-family:Arial;">
<h2>Update Payment - <?php echo $row['AptNumber'];?> (<?php echo $row['Name'];?>)</h2>
<p>Total Cost: Rs. <?php echo $row['TotalCost'];?></p>
<form method="post">
<label>Payment Method:</label><br>
<select name="p_method" style="padding:8px; width:200px;">
<option <?php if($row['PaymentMethod']=='Cash') echo 'selected';?>>Cash</option>
<option <?php if($row['PaymentMethod']=='Online') echo 'selected';?>>Online</option>
<option <?php if($row['PaymentMethod']=='Advance') echo 'selected';?>>Advance</option>
</select><br><br>
<label>Advance Amount Paid:</label><br>
<input type="number" name="advance" value="<?php echo $row['AdvanceAmount'];?>" style="padding:8px; width:200px;"><br><br>
<label>Payment Status:</label><br>
<select name="p_status" style="padding:8px; width:200px;">
<option <?php if($row['PaymentStatus']=='Pending') echo 'selected';?>>Pending</option>
<option <?php if($row['PaymentStatus']=='Partial') echo 'selected';?>>Partial</option>
<option <?php if($row['PaymentStatus']=='Paid') echo 'selected';?>>Paid</option>
</select><br><br>
<button type="submit" name="update" style="padding:10px 20px; background:green; color:white; border:none;">Update</button>
</form>
<br><a href="All-appointment.php">Back</a>
</body></html>