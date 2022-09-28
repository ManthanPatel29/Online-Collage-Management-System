<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmssid'])) 
{  
    $studentid=$_SESSION['trmssid'];
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>Student Profile</title>
   

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
                        <h1>Student Profile</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Student Profile</li>
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
                            <div class="card-header"><strong>Student</strong><small> Profile</small></div>
                            <form name="profile" method="post" action="">
                                
                            <div class="card-body card-block">
                                <?php
                                    $sql="SELECT * from  tblstudents where Enrollment = '$studentid' ";
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
                                    <label for="company" class=" form-control-label">Enrollment No:</label>
                                    <label name="adminname" class="form-control"><?php echo $row->Enrollment; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="vat" class=" form-control-label">Student Name</label>
                                    <label name="adminname" class="form-control"><?php echo $row->Name; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Semester</label>
                                    <label name="adminname" class="form-control"><?php echo $row->Semester; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Mobile Number</label>
                                    <label name="adminname" class="form-control"><?php echo $row->MobileNumber; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Parent's Mobile No</label>
                                    <label name="adminname" class="form-control"><?php echo $row->ParentsNumber; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Address</label>
                                    <label name="adminname" class="form-control"><?php echo $row->Address; ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Admission Date</label>
                                    <label name="adminname" class="form-control"><?php echo $row->AdmissionDate; ?></label>
                                </div>
                                    <?php $cnt=$cnt+1;
                                                }
                                            } 
                                    ?>  
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
<?php  } else{
    header('location:logout.php');}  ?>