<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
  if (isset($_GET['viewid'])) {
    $viewid = $_GET['viewid'];
    // die($viewid);
    $query = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$viewid'");
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_array($query);
      $namett = $row['Name'];
      $email = $row['Email'];
      $mobileNumber = $row['MobileNumber'];
      $gender = $row['Gender'];
      $details = $row['Details'];
      $date = $row['app_date'];
      $time = $row['app_time'];
      $creationDate = $row['CreationDate'];
      $status = $row['Status'];
            


    } else {
      header('location:manage-customers.php');
      exit();
    }
  } else {
    header('location:manage-customers.php');
    exit();
  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>SALON|| Customer Details</title>
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <!-- Custom CSS -->
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <!-- font-awesome icons -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- //font-awesome icons -->
  <!-- font CSS -->
  <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
    rel='stylesheet' type='text/css'>
  <!-- //font CSS -->
  <!-- jQuery -->
  <script src="js/jquery-1.10.2.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
</head>

<body class="cbp-spmenu-push">
  <div class="main-content">
    <?php include_once('includes/sidebar.php'); ?>
    <?php include_once('includes/header.php'); ?>
    <div id="page-wrapper">
      <div class="main-page">
        <div class="widget-shadow">
          <div class="form-group">
            <table class="table">
              <tr>
                <th>Name</th>
                <td>
                  <?php echo $namett; ?>
                </td>
              </tr>
              <tr>
                <th>Email</th>
                <td>
                  <?php echo $email; ?>
                </td>
              </tr>
              <tr>
                <th>Mobile Number</th>
                <td>
                  <?php echo $mobileNumber; ?>
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>
                  <?php echo $gender; ?>
                </td>
              </tr>
              <tr>
                <th>Service</th>
                <td>
                  <?php echo $details; ?>
                </td>
              </tr>
              <tr>
                <th>Date</th>
                <td>
                  <?php echo $date; ?>
                </td>
              </tr>              <tr>
                <th>Time</th>
                <td>
                  <?php echo $time; ?>
                </td>
              </tr>
              <tr>
                <th>Creation Date</th>
                <td>
                  <?php echo $creationDate; ?>
                </td>
              </tr>
            </table>
            <div style="margin:20px; text-align:center;">
             <?php if($status=='' || $status=='Pending'){ ?>
     <a href="accept.php?id=<?php echo $_GET['viewid']; ?>" style="background:green; color:white; padding:10px 25px; border-radius:5px; text-decoration:none; margin-right:15px;">Accept</a>
     <a href="reject.php?id=<?php echo $_GET['viewid']; ?>" style="background:red; color:white; padding:10px 25px; border-radius:5px; text-decoration:none;">Reject</a>
              <?php } else { echo "<b>Status: $status</b>"; } ?>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  .form-group {
    margin-left: 18px;
    margin-top: 78px;
  }
</style>