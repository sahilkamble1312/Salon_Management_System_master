<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['loggedin'] == false)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobilenum = $_POST['mobilenum'];
		$gender = $_POST['gender'];
		$details = isset($_POST['details']) ? implode(", ", $_POST['details']) : "";
		
		// Total calculate in PHP (secure)
		$totalcost = 0;
		if(isset($_POST['details'])){
		  foreach($_POST['details'] as $sname){
		    $cq = mysqli_query($con,"SELECT Cost FROM tblservices WHERE ServiceName='$sname'");
		    $cr = mysqli_fetch_array($cq);
		    $totalcost += $cr['Cost'];
		  }
		}
		$date = $_POST['date'];
		$time = $_POST['time'];
		$aptnumber = mt_rand(100000000, 999999999);
		$_SESSION['aptnumber'] = $aptnumber;

		// Payment Logic Start
		$p_method = $_POST['paymentmethod'];
		$trans_id = $_POST['transaction_id'];
		if($p_method == 'Advance'){ 
			$adv = 200; 
			$p_status='Partial'; 
		} else if($p_method == 'Online'){ 
			$adv = $totalcost; 
			$p_status='Paid'; 
		} else { 
			$adv = 0; 
			$p_status='Pending'; 
		}
		// Payment Logic End

		// Customers table insert with payment
       $query= mysqli_query($con, "INSERT INTO tblcustomers(AptNumber,Name,Email,MobileNumber,Gender,Details,app_date,app_time,TotalCost,PaymentMethod,PaymentStatus,AdvanceAmount,TransactionId) VALUES('$aptnumber','$name','$email','$mobilenum','$gender','$details','$date','$time','$totalcost','$p_method','$p_status','$adv','$trans_id')");
	   
	    $query2 = mysqli_query($con, "insert into tblappointment(AptNumber,Name,Email,PhoneNumber,AptDate,AptTime,Services,TotalCost) value('$aptnumber','$name','$email','$mobilenum','$date','$time','$details','$totalcost')");
		if ($query && $query2) {
			echo "<script>alert('Appointment Confirmed Successfully');</script>";
			echo "<script>window.location.href = 'thank-you.php'</script>";
		} else {
			echo "<script>alert('Something Went Wrong. Please try again.');</script>";
		}
	}
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Men Salon Management System || Home Page</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<?php include_once('includes/header.php'); ?>

		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="page-caption">
							<h2 class="page-title">Book Appointment</h2>
							<div class="page-breadcrumb">
								<ol class="breadcrumb">
									<li><a href="index.php">Home</a></li>
									<li class="active">Book Appointment</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h1 class="apt">Appointment Form</h1>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
						<div class="form-body">
							<form method="post">
								<div class="form-group name-input">
									<label for="exampleInputEmail1">Name</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="" required="true">
								</div>
								<div class="form-group email-input">
									<label for="exampleInputPassword1">Email</label>
									<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required="true">
								</div>
								<div class="form-group mobile-input">
									<label for="exampleInputEmail1">Mobile Number</label>
									<input type="text" class="form-control" id="mobilenum" name="mobilenum" placeholder="Mobile Number" value="" required="true" maxlength="10" pattern="[0-9]+">
								</div>
								<div class="form-group gender-input">
									<label for="gender">Gender</label>
									<div class="radio">
										<label><input type="radio" name="gender" id="gender" value="Male"> Male</label>
										<label><input type="radio" name="gender" id="gender" value="Female"> Female</label>
										<label><input type="radio" name="gender" id="gender" value="Transgender"> Transgender</label>
									</div>
								</div>
								
								<div class="form-group service-input">
									<label for="details">Appointment Date</label>
									<input type="date" class="form-control" name="date" placeholder="Date" id="adate" required="true" min="<?php echo date('Y-m-d'); ?>">
								</div>

								<div class="form-group service-input">
									<label for="details">Appointment Time</label>
									<input type="time" class="form-control" name="time" placeholder="Time" id='atime' required="true">
								</div>

								<div class="form-group service-input">
								  <label>Service <small>(Select Multiple Services)</small></label>
								  <div style="border:1px solid #ccc; padding:12px; border-radius:8px; display:flex; flex-wrap:wrap; gap:12px; background:#fff;">
								  <?php
								  $q = mysqli_query($con,"SELECT * FROM tblservices");
								  while($r = mysqli_fetch_array($q)){
								  ?>
								    <label style="width:46%; cursor:pointer; font-weight:normal;">
								      <input type="checkbox" class="svc" name="details[]" value="<?php echo $r['ServiceName'];?>" data-cost="<?php echo $r['Cost'];?>" onchange="calcTotal()"> 
								      <?php echo $r['ServiceName'];?> - Rs.<?php echo $r['Cost'];?>
								    </label>
								  <?php } ?>
								  </div>
								  <p style="margin-top:8px; font-weight:bold;">Total: Rs. <span id="tot">0</span></p>
								</div>

								<!-- PAYMENT SECTION START -->
								<div class="form-group" style="border:2px solid #28a745; padding:15px; border-radius:10px; background:#f9fff9;">
									<label style="font-weight:bold; color:#28a745;">Select Payment Method</label><br>
									<select name="paymentmethod" id="p_method" onchange="checkPayment()" required style="padding:10px; width:100%; border-radius:5px;">
										<option value="Cash">Cash at Salon (Pay Later)</option>
										<option value="Advance">Advance Pay - Rs. 200 (Book Confirm)</option>
										<option value="Online">Online Full Payment</option>
									</select>

									<div id="payment_area" style="display:none; margin-top:15px;">
										<div id="upi_box" style="text-align:center; border:1px dashed #000; padding:15px; background:white;">
											<p style="margin:0;">Pay on UPI ID: <b>deluxesalon@upi</b></p>
											<img id="upi_qr" src="" style="width:180px; margin:10px 0;">
											<p id="qr_amount_text" style="font-weight:bold;"></p>
											<p style="font-size:12px;">Scan with GPay / PhonePe / Paytm</p>
										</div>

										<div style="text-align:center; margin:15px 0;">
											<p>OR</p>
											<button type="button" onclick="payWithRazorpay()" style="background:#0b72e7; color:white; padding:10px 20px; border:none; border-radius:5px; width:100%;"><i class="fa fa-credit-card"></i> Pay with Card / GPay / Razorpay</button>
										</div>

										<label>Transaction ID (After Payment)</label>
										<input type="text" name="transaction_id" id="trans_id" class="form-control" placeholder="Enter Transaction ID / UTR">
										<small style="color:red;">If you have made the payment, please enter Transaction ID, otherwise leave it blank</small>
									</div>
								</div>
								<!-- PAYMENT SECTION END -->
						
								<button type="submit" id="submit" name="submit" class="btn btn-defaultt">Book <i class="fa fa-bookmark-o"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

<script>
function calcTotal(){
 let t=0;
 document.querySelectorAll('.svc:checked').forEach(c=>{ t+=parseInt(c.dataset.cost) });
 document.getElementById('tot').innerText=t;
 checkPayment(); // update QR also
}

function checkPayment(){
 var m = document.getElementById('p_method').value;
 var area = document.getElementById('payment_area');
 var total = parseInt(document.getElementById('tot').innerText) || 0;
 var payAmt = (m=='Advance') ? 200 : total;

 if(m=='Cash'){
  area.style.display='none';
 } else {
  area.style.display='block';
  var upi_id = "kamblesahil1312@oksbi";
  var upi_link = "upi://pay?pa="+upi_id+"&pn=Deluxe Salon Kagal&am="+payAmt+"&cu=INR";
  var qr_api = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data="+encodeURIComponent(upi_link);
  document.getElementById('upi_qr').src = qr_api;
  document.getElementById('qr_amount_text').innerText = "Amount to Pay: Rs. "+payAmt;
 }
}

function payWithRazorpay(){
 let total = parseInt(document.getElementById('tot').innerText) || 0;
 let method = document.getElementById('p_method').value;
 let amt = (method=='Advance') ? 200 : total;
 if(amt==0){ alert("Please select service first"); return; }
 var options = {
    "key": "rzp_test_BIl1a1QAUoik6n",
    "amount": (amt*100).toString(),
    "currency": "INR",
    "name": "Deluxe Salon Kagal",
    "description": method+" Payment",
    "handler": function (response){
        alert("Payment Success! ID: "+response.razorpay_payment_id);
        document.getElementById('trans_id').value = response.razorpay_payment_id;
    },
    "theme": { "color": "#28a745" }
 };
 var rzp = new Razorpay(options);
 rzp.open();
}
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
		<script src="js/classie.js"></script>
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<script src="js/bootstrap.js"> </script>
	</body>
</html>
<?php } ?>
<?php include_once('includes/footer.php'); ?>