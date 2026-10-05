<?php
session_start(); error_reporting(0); include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) { header('location:logout.php'); } else {

// ========= SINGLE INVOICE VIEW - STANDALONE, NO HEADER =========
if(!empty($_REQUEST['invoiceid'])){
  $invid = trim($_REQUEST['invoiceid']); $e = mysqli_real_escape_string($con, $invid);
  $d = null;
  // 1. Admin
  $q = mysqli_query($con, "SELECT * FROM tblappointment WHERE TRIM(AptNumber)='$e' AND Name!='Admin' ORDER BY ID DESC LIMIT 1");
  if($q && mysqli_num_rows($q)>0) $d=mysqli_fetch_assoc($q);
  if(!$d){
    $q = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber LIKE '%$e%' AND Name!='Admin' ORDER BY ID DESC LIMIT 1");
    if($q && mysqli_num_rows($q)>0) $d=mysqli_fetch_assoc($q);
  }
  if(!$d){
    $q = mysqli_query($con, "SELECT AptNumber, Name, MobileNumber as PhoneNumber, app_date as AptDate, Details as Services, TotalCost FROM tblcustomers WHERE TRIM(AptNumber)='$e' LIMIT 1");
    if($q && mysqli_num_rows($q)>0) $d=mysqli_fetch_assoc($q);
  }
  //
  if(!$d || strtolower($d['Name'])=='admin'){
    $q = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber='$e' ORDER BY ID DESC LIMIT 1");
    if($q && mysqli_num_rows($q)>0) $tmp=mysqli_fetch_assoc($q);
    if($tmp && strtolower($tmp['Name'])!='admin') $d=$tmp;
    //
  }

  $name = $d['Name'] ?? 'Customer'; 
  $mobile = $d['PhoneNumber'] ?? $d['MobileNumber'] ?? ''; 
  $date = $d['AptDate'] ?? date('Y-m-d'); 
  $service = $d['Services'] ?? $d['Details'] ?? 'Service'; 
  $total = $d['TotalCost'] ?? 0;
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Invoice #<?php echo $invid; ?></title>
<link href="css/bootstrap.css" rel='stylesheet' />
<style>
body{background:#fff; font-family:Arial;}
.invoice-box{max-width:800px; margin:30px auto; background:#fff; padding:30px; border:1px solid #000;}
h2{font-weight:900; margin:0;}
@media print{
  body{margin:0; padding:0;}
  .no-print{display:none!important;}
  .invoice-box{border:none; margin:0; padding:15px; max-width:100%;}
  @page{margin:10mm;}
}
</style>
</head><body>
<div class="invoice-box" id="printArea">
<div style="text-align:center; border-bottom:3px double #000; padding-bottom:15px; margin-bottom:20px;">
<h2>DELUXE Mens Salon</h2>
<p style="margin:5px 0 0;">Kagal, Near ST Stand | Mob: 8805423266</p>
</div>
<h4>Invoice #<?php echo $invid; ?></h4>
<table class="table table-bordered">
<tr><th width="15%">Name</th><td width="35%"><?php echo $name; ?></td><th width="15%">Mobile</th><td width="35%"><?php echo $mobile; ?></td></tr>
<tr><th>Apt Number</th><td><?php echo $invid; ?></td><th>Date</th><td><?php echo $date; ?></td></tr>
<tr><th>Service</th><td colspan="3"><?php echo $service; ?></td></tr>
</table>
<table class="table table-bordered">
<tr><th width="70%">Service</th><th>Cost</th></tr>
<tr><td><?php echo $service; ?></td><td>Rs. <?php echo $total; ?></td></tr>
<tr style="background:#fcf8e3;"><th style="text-align:center; font-size:16px;">Grand Total</th><th style="font-size:16px;">Rs. <?php echo $total; ?></th></tr>
</table>
<p style="text-align:center; margin-top:25px; font-weight:600;">Thank you! Visit Again - DELUXE Mens Salon</p>
</div>
<div style="text-align:center; margin:20px;" class="no-print">
<button onclick="window.print()" style="padding:12px 30px; background:#000; color:#fff; border:none; font-size:16px; cursor:pointer;">🖨️ Print / Save PDF</button>

<?php 
$wmsg = "DELUXE Mens Salon - Kagal%0A%0A*Invoice #$invid*%0AName: $name%0AMobile: $mobile%0AApt No: $invid%0ADate: $date%0AService: $service%0ATotal: Rs. $total%0A%0AThank you! Visit Again";
$waLink = "https://wa.me/91".preg_replace('/[^0-9]/','',$mobile)."?text=".$wmsg;
$waShareAny = "https://api.whatsapp.com/send?text=".$wmsg;
?>
<a href="<?php echo $waLink; ?>" target="_blank" style="padding:12px 25px; background:#25D366; color:#fff; text-decoration:none; margin-left:10px; font-size:16px; border-radius:4px; display:inline-block;">💬 WhatsApp Customer</a>


<a href="invoices.php" style="padding:12px 25px; background:#007bff; color:#fff; text-decoration:none; margin-left:10px; font-size:16px; border-radius:4px; display:inline-block;">Back to List</a>
</div>
</body></html>
<?php exit; } ?>

<!DOCTYPE HTML><html><head><title>View Invoices</title><link href="css/bootstrap.css" rel='stylesheet' /><link href="css/style.css" rel='stylesheet' /><link href="css/font-awesome.css" rel="stylesheet"></head><body class="cbp-spmenu-push">
<div class="main-content"><?php include_once('includes/sidebar.php'); include_once('includes/header.php');?>
<div id="page-wrapper"><div class="main-page" style="padding-top:90px;">
<h3 class="title1">View Invoices</h3>
<div class="table-responsive">
<table class="table table-bordered"><thead><tr><th>S.No</th><th>Apt No</th><th>Customer</th><th>Action</th></tr></thead><tbody>
<?php $cnt=1; $ret=mysqli_query($con,"SELECT AptNumber, Name FROM tblappointment WHERE Name!='Admin' ORDER BY ID DESC");
while($r=mysqli_fetch_assoc($ret)){ if(empty($r['AptNumber'])) continue; ?>
<tr><td><?php echo $cnt++;?></td><td><?php echo $r['AptNumber'];?></td><td><?php echo $r['Name'];?></td><td><a href="invoices.php?invoiceid=<?php echo trim($r['AptNumber']);?>" target="_blank" class="btn btn-primary btn-sm">View Bill</a></td></tr><?php } ?>
</tbody></table>
</div></div></div></div></body></html>
<?php } ?>