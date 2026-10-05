<?php
// View Invoices - Admin
include('includes/dbconnection.php');
$ret = mysqli_query($con, "SELECT * FROM tblcustomers ORDER BY ID DESC");
?>
<table class="table table-bordered">
<tr><th>Name</th><th>Apt Number</th><th>Total</th><th>Date</th><th>Invoice</th></tr>
<?php while($row=mysqli_fetch_array($ret)){ ?>
<tr>
<td><?php echo $row['Name']; ?></td>
<td><?php echo $row['AptNumber']; ?></td>
<td>Rs.<?php echo $row['TotalCost']; ?></td>
<td><?php echo $row['app_date']; ?></td>
<td><a href="view-invoice.php?invid=<?php echo $row['AptNumber']; ?>" target="_blank" style="background:#000; color:#fff; padding:6px 12px; text-decoration:none;">View Bill</a></td>
</tr>
<?php } ?>
</table>