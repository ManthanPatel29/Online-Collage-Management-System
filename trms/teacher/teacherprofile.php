<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmstid']))
{
    $teacherid=$_SESSION['trmstid'];
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>Profile Page</title>
   

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
    <?php include('includes/sidebar.php'); ?>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profile Page</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Profile</li>
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
                            <div class="card-header"><strong>Teacher's</strong><small> Profile</small></div>
                            <form name="profile" method="post" action="">
                                
                            <div class="card-body card-block">
                             <?php

                                $sql="SELECT * from  tblteacher where ID = '$teacherid' ";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $row)
                                        {                   
                             ?>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Name</label>
                                            <input type="text" name="username" value="<?php  echo $row->Name;?>" class="form-control" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Contact Number</label>
                                            <input type="number" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' readonly='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Email ID</label>
                                            <input type="email" name="email" value="<?php  echo $row->ID;?>" class="form-control" readonly='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="postal-code" class=" form-control-label">Joining Date</label>
                                            <input type="text" name="" value="<?php  echo $row->JoiningDate;?>" readonly="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Address </label>
                                            <textarea class="form-control" readonly='true' ><?php  echo $row->Address; ?></textarea>
                                        </div>
                                        <?php $cnt=$cnt+1; } } ?>
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
    header('location:logout.php'); } ?>