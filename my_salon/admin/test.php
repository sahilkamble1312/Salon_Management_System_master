<?php
include('includes/dbconnection.php');
echo "<h2>tblcustomers data</h2>";
$q=mysqli_query($con,"SELECT AptNumber, Name FROM tblcustomers ORDER BY ID DESC LIMIT 5");
while($r=mysqli_fetch_assoc($q)){ echo $r['AptNumber']." - ".$r['Name']."<br>"; }

echo "<h2>tblappointment data</h2>";
$q=mysqli_query($con,"SELECT AptNumber, Name FROM tblappointment ORDER BY ID DESC LIMIT 5");
while($r=mysqli_fetch_assoc($q)){ echo $r['AptNumber']." - ".$r['Name']."<br>"; }

echo "<h2>Searching 928586023</h2>";
$inv='928586023';
$q=mysqli_query($con,"SELECT * FROM tblcustomers WHERE AptNumber LIKE '%92858%' LIMIT 1");
echo "Found: ".mysqli_num_rows($q);
if($r=mysqli_fetch_assoc($q)){ echo "<pre>"; print_r($r); echo "</pre>"; }
?>