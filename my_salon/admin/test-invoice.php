<?php
session_start();
include('includes/dbconnection.php');
$aptno = $_GET['invid'] ?? '';
$result = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber='$aptno'");
$row = mysqli_fetch_array($result);
if(!$row){ die("Not found $aptno"); }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Invoice <?php echo $row['AptNumber']; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body style="background:#eee;">

<div id="printArea" style="max-width:800px; margin:20px auto; background:#fff; padding:20px; border:1px solid #000;">
<center>
<h2><b>DELUXE Mens salon</b></h2>
<p>Near ST Stand, Kagal | 8805423266</p>
<hr>
</center>
<h4 style="background:#000; color:#fff; padding:10px;">Invoice #<?php echo $row['AptNumber']; ?></h4>
<table class="table table-bordered">
<tr><td>Name</td><td><?php echo $row['Name']; ?></td><td>Phone</td><td><?php echo $row['PhoneNumber']; ?></td></tr>
<tr><td>Email</td><td><?php echo $row['Email']; ?></td><td>Date</td><td><?php echo $row['AptDate']; ?> <?php echo $row['AptTime']; ?></td></tr>
<tr><td>Service</td><td><?php echo $row['Services']; ?></td><td>Apt Number</td><td><?php echo $row['AptNumber']; ?></td></tr>
<tr><td>Total</td><td colspan="3"><b>Rs. <?php echo $row['TotalCost']; ?></b></td></tr>
</table>
<center><p>Thank you!</p></center>
</div>

<div style="text-align:center; margin-bottom:40px;">
<button onclick="window.print()" style="padding:12px 25px; background:#000; color:#fff; border:none; border-radius:5px;">PDF Download / Print</button>
<button onclick="sendWA()" style="padding:12px 25px; background:#25D366; color:#fff; border:none; border-radius:5px; margin-left:10px;">Send on WhatsApp</button>
</div>

<script>
function sendWA(){
  var mob = "<?php echo $row['PhoneNumber']; ?>";
  var text = "DELUXE Mens salon Invoice%0AName: <?php echo $row['Name']; ?>%0AApt: <?php echo $row['AptNumber']; ?>%0AService: <?php echo $row['Services']; ?>%0ATotal: Rs.<?php echo $row['TotalCost']; ?>";
  window.open("https://wa.me/91"+mob+"?text="+text,"_blank");
}
</script>

</body>
</html>