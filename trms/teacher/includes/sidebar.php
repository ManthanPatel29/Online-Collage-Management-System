<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmstid'])) {
        $teacherid=$_SESSION['trmstid'];
?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button> 
                <a class="navbar-brand" href="dashboard.php"> 
                    <?php
                                    $sql="SELECT Name from  tblteacher where ID = '$teacherid' ";
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
                        <a href="add-material.php"> <i class="menu-icon fa fa-tasks"></i>Add Material</a>
                    </li>
                    
                    <li class="menu-item-has">
                        <a href="add-attsheet.php"> <i class="menu-icon fa fa-tasks"></i>Add Attandance sheet</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Submission</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-file-o"></i><a href="submission.php?stype=assignment">Assignments</a></li>
                            <li><i class="menu-icon fa fa-file-o"></i><a href="submission.php?stype=practical">Practicals</a></li>
                        </ul>
                    </li>
                        
                    <li class="menu-item-has">
                        <a href="timetable.php"> <i class="menu-icon fa fa-tasks"></i>Time Table</a>
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