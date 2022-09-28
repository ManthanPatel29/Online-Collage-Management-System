<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];
    $password=md5($_POST['newpassword']);
    $query = $dbh->prepare("update tblstudents set Password='$password'  where  (Email='$email' AND MobileNumber = '$contactno') ");
       if($query->execute() === TRUE)
       {
            echo "<script>alert('Password successfully changed');</script>";
           echo "<script> window.location.href ='index.php'</script>";
            session_destroy();
       }
    else{
        echo "<script>alert('Please Enter Valid Details');</script>";
        echo "<script> window.location.href ='resetpassword.php'</script>";
    }
  }
  ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
   
    <title>Forgot Password</title>
  
    <link rel="apple-touch-icon" href="apple-icon.png">
  


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript">
    function checkpass()
    {
      if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
      {
          alert('New Password and Confirm Password field does not match');
          document.changepassword.confirmpassword.focus();
          return false;
      }
        return true;
    } 
</script>

</head>

<body class="bg-dark" style=" background-image: url('images/bg.jpg');">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                <h3 style="color: white">Forgot-Password </h3>
                    <hr  color="red"/>
                </div>
                <div class="login-form">
                    <form action="" method="post" name="changepassword" onsubmit="return checkpass();">
                        <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter Your Email" name="email" required="">
                        </div>
                        <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Your Mobile Number" name="contactno" required="">
                        </div>
                        <div class="form-group">
                                <label>New Password</label>
                                <input type="text" class="form-control" placeholder="New Password" name="newpassword" required="">
                        </div>
                            <div class="form-group">
                                <label>Confirm Your Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Your Password" name="confirmpassword" required="">
                        </div>
                        <div class="checkbox">
                                <label class="pull-left">
                                    <a href="index.php">Back Home!!</a>
                                </label>
                            </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="submit" >Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
