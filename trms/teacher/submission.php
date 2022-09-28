<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmstid'])) 
{
    $teacherid=$_SESSION['trmstid'];
    if(isset($_GET['stype']))
    {
        $stype = $_GET['stype'];
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>View Submission</title>
  
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
                        <h1 style="text-transform: capitalize;">view <?php echo $stype ?>s</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Files</li>
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
                            <div class="card-header"><strong>Files</strong></div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <?php
                                            $sql=$dbh -> prepare("select * from  tblsubmission,tblsubjects where (tblsubmission.SubmissionType = '$stype' AND tblsubjects.subID = tblsubmission.subID AND tblsubjects.TeacherID = '$teacherid')");
                                            $sql->execute();
                                            $sublist=$sql->rowCount();
                                            $cnt=1;
                                            if($sublist >= 1){
                                        ?>
                                        <table class="table">
                                            <tr style="text-align:center;">
                                                <th>Sr.No</th>
                                                <th>Enrollment No</th>
                                                <th>File Name</th>
                                                <th>Subject Name</th>
                                                <th>Date Of Submission</th>             
                                                <th>View</th>
                                            </tr>
                                            <?php
                                                while($row = $sql->fetch()){
                                            ?>
                                            <tr style="text-align:center;">
                                              <td><?php echo $cnt;?></td>
                                              <td><?php  echo $row['StudentID'];?></td>
                                              <td><?php  echo $row['filename'];?></td>
                                              <td><?php  echo $row['SubjectName'];?></td>
                                              <td><?php  echo date("d-m-Y", strtotime($row['SubmissionDate']) );?></td>
                                              <td> <a target="_blank" href="viewsubmission.php?fid=<?php echo $row['ID']; ?>"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">&nbsp;&nbsp; View &nbsp;&nbsp; </button></a></td>
                                            </tr>
                                            <?php
                                                        $cnt=$cnt+1;
                                                }
                                                }
                                                else{
                                                    echo "<p style='text-align:center; font-size: 20px; color:black; margin:3px'><b>Sorry No Data Available!</b></p>";
                                                }
                                        
                                            ?>
                                        </table>
                                    </div>
                                </div>
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
<?php }//end of get perameter if
} 
else{
    header('location:logout.php');
}
?>