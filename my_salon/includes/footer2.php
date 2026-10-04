<?php
include('includes/dbconnection.php');
error_reporting(0);

if (isset($_POST['sub'])) {

    $email = $_POST['email'];

    $query = mysqli_query($con, "insert into tblsubscriber(Email) value('$email')");
    if ($query) {
        $to = "kamblesahil1312@gmail.com";
        $subject = "New subscriber to your newsletter";
        $message = "You have a new subscriber to your newsletter:\n\nEmail address: $email";
        $headers = "From:kamblesahil1312@gmail.com \r\n";
        $headers .= "Reply-To: kamblesahil1312@gmail.com\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);
        echo "<script>alert('Your subscribe successfully!.');</script>";
        echo "<script>window.location.href ='index.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}
?>

<div class="footer">
    <!-- footer-->
    <div class="container">
        <div class="footer-block">
            <!-- footer block -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-widget">
                        <h2 class="widget-title">Salon Address</h2>
                        <ul class="listnone contact">
                        <?php

$ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {

    ?>
    <li><i class="fa fa-map-marker"></i>
        <?php echo $row['PageDescription']; ?>
    </li>
    <li><i class="fa fa-phone"></i>
    <a href="tel:8805423266"><?php echo $row['MobileNumber']; ?></a>
    </li>

    <li><i class="fa fa-envelope-o"></i>
    <a href="mailto:kamblesahil1312@gmail.com"><?php  echo $row['Email'];?></a>
    </li>
<?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-widget footer-social">
                        <!-- social block -->
                        <h2 class="widget-title">Social Feed</h2>
                        <ul class="listnone">
                            <li>
                            
                            </li>
                            <li><a href="https://www.linkedin.com/in/sahil-kamble-b6b68a2b0"><i
                                        class="fa fa-linkedin"></i> Linked In</a></li>
                           

                        </ul>
                    </div>
                    <!-- /.social block -->
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="footer-widget widget-newsletter">
                        <!-- newsletter block -->
                        <h2 class="widget-title">Newsletters</h2>
                        <p>Enter your email address to receive new discount and other useful information
                            right to your inbox.</p>
                        <form method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter your email address"
                                    name="email">
                                <span class="input-group-btn">
                            


                                <a href="login.php" class="btn btn-default">Subscribe<i class="fa fa-gratipay"></i></a>



                                </span>
                            </div>
                        </form>
                        <!-- /input-group -->
                    </div>
                    <!-- newsletter block -->
                </div>
            </div>
            <div class="tiny-footer">
                <!-- tiny footer block -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright-content">
                            <p><i class="fa fa-copyright"></i> Men Salon Management System 2023 || Created by
                                <span>Sahil kamble</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tiny footer block -->
        </div>
        <!-- /.footer block -->
    </div>
</div>