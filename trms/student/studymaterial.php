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
   
    <title>Study Material</title>
  
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
                        <h1>Study Material</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Study Material</li>
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
                            <div class="card-header"><strong>Study Material</strong></div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <?php
                                            $sql=$dbh -> prepare("select tblmaterial.ID,tblmaterial.filename,tblsubjects.SubjectName from  tblmaterial,tblstudents,tblsubjects where (tblstudents.Enrollment = '$studentid' AND tblmaterial.subID = tblsubjects.subID AND tblstudents.Semester = tblsubjects.Semester )");
                                            $sql->execute();
                                            $sublist=$sql->rowCount();
                                            $cnt=1;
                                            
                                        ?>
                                        <table class="table">
                                            <tr style="text-align:center;">
                                                <th>Sr.NO</th>
                                                <th>Name</th>       
                                                <th>Subject</th>       
                                                <th>View</th>
                                            </tr>
                                            <?php
                                                while($row = $sql->fetch()){
                                            ?>
                                            <tr style="text-align:center;">
                                              <td><?php echo $cnt;?></td>
                                              <td><?php  echo $row['filename'];?></td>
                                              <td><?php  echo $row['SubjectName'];?></td>
                                              <td> <a target="_blank" href="viewmaterial.php?fid=<?php echo $row['ID']; ?>"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">&nbsp; &nbsp; View &nbsp; &nbsp;</button></a></td>
                                            </tr>
                                            <?php
                                                        $cnt=$cnt+1;
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
<?php } 
else{
    header('location:logout.php');
}
?>