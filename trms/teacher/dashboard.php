<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmstid'])) {
        $teacherid=$_SESSION['trmstid'];
     ?>
  
<!doctype html>
<html class="no-js" lang="en">
<head>
    
    <title>Teacher Dashboard</title>
   

    <link rel="apple-touch-icon" href="apple-icon.png">
   

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">

        <?php include_once('includes/header.php');?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            


         <a class="hover-focus" href="manage-subjects.php">
             <div class="col-sm-6 col-lg-6">
                <div class="card text-white bg-flat-color-4">
                    
                    <div class="card-body pb-0">
                        
                        <?php 
                            $sql ="SELECT subID from tblsubjects where TeacherID = '$teacherid'";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $sublist=$query->rowCount();
                        ?>
                        <h4 class="mb-0">
                            <span class="count"><?php echo htmlentities($sublist);?></span>
                        </h4>
                        <p class="text-light">Total Subjects</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </a>
            <!--/.col-->
            <a class="hover-focus" href="manage-studymat.php">
            <div class="col-sm-6 col-lg-6">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <?php 
                            $sql1 =$dbh -> prepare("SELECT ID from tblmaterial,tblsubjects where tblsubjects.subID = tblmaterial.subID AND tblsubjects.TeacherID = '$teacherid'");
                            $sql1->execute();
                            $totstudymat=$sql1->rowCount();
                        ?>
                        <h4 class="mb-0">
                            <span class="count"><?php echo htmlentities($totstudymat);?></span>
                        </h4>
                        <p class="text-light">Total Study Materials</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            </a>
  <!--/.col-->
                <a class="hover-focus" href="manage-attsheet.php">
            <div class="col-sm-6 col-lg-6">
                <div class="card text-white bg-flat-color-5">
                    <div class="card-body pb-0">
                        <?php 
                            $sql2 =$dbh -> prepare("select * from  tblattendance,tblsubjects where (tblattendance.subID = tblsubjects.subID  AND tblsubjects.TeacherID = '$teacherid' )");
                            $sql2->execute();
                            $totasheet=$sql2->rowCount();
                        ?>
                        <h4 class="mb-0">
                            <span class="count"><?php echo htmlentities($totasheet);?></span>
                        </h4>
                        <p class="text-light">Total Attendance Sheet</p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            </a>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>
<?php }
else
{
    header('location:logout.php');
}
?>
