<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmssid'])) {
        $studentid=$_SESSION['trmssid'];
?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button> 
                <a class="navbar-brand" href="dashboard.php"> 
                    <?php
                                    $sql="SELECT Name from  tblstudents where Enrollment = '$studentid' ";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $row)
                                        { 
                                            echo $row->Name;
                                        }
                                    }
                    ?>
                </a>
                
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-item-has">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li class="menu-item-has">
                        <a href="studymaterial.php"> <i class="menu-icon fa fa-tasks"></i>Study Material</a>
                    </li>
                    
                    <li class="menu-item-has">
                        <a href="attsheet.php"> <i class="menu-icon fa fa-tasks"></i>Attandance sheet</a>
                    </li>
                        
                    <li class="menu-item-has">
                        <a href="timetable.php"> <i class="menu-icon fa fa-tasks"></i>Time Table</a>
                    </li>
                    
                    <li class="menu-item-has">
                        <a href="add-submission.php"> <i class="menu-icon fa fa-tasks"></i>Submission</a>
                    </li>
                    
                    <li class="menu-item-has">
                        <a href="search.php"> <i class="menu-icon fa fa-search"></i>Search</a>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
<?php }
else{
    header('location:logout.php');
}
?>