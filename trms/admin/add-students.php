<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmsaid'])) {
  $trmsaid=$_SESSION['trmsaid'];
    if(isset($_POST['submit']))
  { 
    $enrollment = $_POST['enrollment'];
    $sname=$_POST['sname'];
    $email=$_POST['email'];
    $sem=$_POST['semester'];
    $mobnum=$_POST['mobilenumber'];
    $mobnum=$_POST['parentsnumber'];
    $address=$_POST['address'];
    $Adate=$_POST['admissiondate'];
    $sql="insert into tblstudents (Name,Enrollment,Email, Semester, MobileNumber, ParentsNumber, Address, AdmissionDate) values (:sname,:enrollment , :email, :semester, :mobilenumber, :parentsnumber, :address, :admissionDate)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':sname',$sname,PDO::PARAM_STR);
    $query->bindParam(':enrollment',$enrollment,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':semester',$sem,PDO::PARAM_STR);
    $query->bindParam(':mobilenumber',$mobnum,PDO::PARAM_STR);
    $query->bindParam(':parentsnumber',$mobnum,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':admissionDate',$Adate,PDO::PARAM_STR);
           
    if ($query->execute() === TRUE) 
    {
        echo '<script>alert("Students Detail has been added.")</script>';
        echo "<script>window.location.href ='add-students.php'</script>";
    }
    else
    {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
        echo "<script>window.location.href ='add-students.php'</script>";
    }
}   
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Add Teachers</title>
  

    <link rel="apple-touch-icon" href="apple-icon.png">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <!-- Left Panel -->
    <?php include_once('includes/sidebar.php');?>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include_once('includes/header.php');?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Student Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Add Student Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                       <!-- .card -->
                    </div>
                    <!--/.col-->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Add Details </strong></div>
                                <form name="" method="post" action="" enctype="multipart/form-data">

                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Student's Enrollment</label>
                                        <input type="text" name="enrollment" class="form-control" id="enrollment" placeholder="Enter Enrollment" required="true" maxlength="12" pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Student Name</label>
                                        <input type="text" name="sname" class="form-control" id="sname" placeholder="Enter Name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="street" class=" form-control-label">Student Email ID</label>
                                        <input type="email" name="email" value="" id="email" class="form-control" placeholder="Enter Email ID" required="true">
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label"> Parent's Mobile Number</label>
                                                <input type="text" name="parentsnumber" id="parentsnumber" placeholder="Enter Parent's Mobile Number" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Student's Mobile Number</label>
                                                <input type="text" name="mobilenumber" id="mobilenumber" placeholder="Enter Mobile Number" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Student's Semester</label>
                                                <input type="number" name="semester" id="semester" placeholder="Enter Semester" class="form-control" required="true" max="8" min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Student's Address</label>
                                                <textarea type="text" name="address" id="address" placeholder="Enter Address" class="form-control" rows="2" cols="3" required="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Admission Date</label>
                                                <input type="date" name="admissiondate" id="admissiondate" value="" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>
                                     <p style="text-align: center;">
                                         <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i>  Add Details </button> 
                                    </p>                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->

<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>

<script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
<?php } else{
    header('location:logout.php'); }  ?>