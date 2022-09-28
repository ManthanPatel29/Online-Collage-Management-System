<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmsaid'])) 
{
    $teacherid=$_SESSION['trmsaid'];
    if(isset($_POST['submit']))
    {
        $name = $_FILES['myfile']['name'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $type = $_FILES['myfile']['type']; 
        $semester = $_POST['semester'];
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        if(!in_array($extension,['pdf', 'doc', 'docx']))
        {
            echo '<script>alert("'.$extension.' file extension not allowed only .doc, .pdf or .docx allowed")</script>';
            echo "<script> window.location.href ='add-attsheet.php'</script>";
        } 
        elseif($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo '<script>alert("File is Too large!")</script>';
            echo "<script> window.location.href ='add-attsheet.php'</script>";
        }
        else {
            $stmt = $dbh->prepare("insert into tbltimetable values('',?,?,?,?)");
            $stmt->bindParam(1,$name);
            $stmt->bindParam(2,$data);
            $stmt->bindParam(3,$type);
            $stmt->bindParam(4,$semester);

            if($stmt->execute() === TRUE){
                echo '<script>alert("Time Table has been uploaded successfully")</script>';
                echo "<script> window.location.href ='add-timetable.php'</script>";
            }
            else{
                echo '<script>alert("Please Try Again")</script>';
                echo "<script> window.location.href ='add-timetable.php'</script>";
            }
        }      
    } 
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Add Time Table</title>
    <meta charset="utf-8"/>
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
                        <h1>Add Time Table</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Add Time Table</li>
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
                            <div class="card-header"><strong>Add Time Table</strong></div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class="form-control-label"><b>Add Time Table</b></label>
                                        <input style="padding:2.5px;" type="file" name="myfile" class="form-control" required>
                                    </div>                                  
                                    <div class="form-group">
                                        <label for="company" class="form-control-label"><b>Select Semester</b></label><br/>
                                        <input type="number" name="semester" placeholder = "Select Semester" class="form-control" id="semester" min="1" max="8" required="true">
                                    </div>
                                </div>
                                <p style="text-align: center;">
                                     <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Upload Time Table</button> 
                                </p>
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
<?php } 
else{
    header('location:logout.php');
}
?>