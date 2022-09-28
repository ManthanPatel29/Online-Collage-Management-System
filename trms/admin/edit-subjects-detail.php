<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmsaid'])) {
    if(isset($_POST['submit']))
    {
        $eid=$_GET['editid'];
        $subjects=$_POST['subjects'];
        $semester=$_POST['semester'];
        $teacherid=$_POST['teacherid'];

        $sql="update tblsubjects set SubjectName=:subjects, Semester=:semester, TeacherID=:teacherid where subID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjects',$subjects);
        $query->bindParam(':semester',$semester);
        $query->bindParam(':teacherid',$teacherid);
        $query->bindParam(':eid',$eid);
        if($query->execute() === TRUE){
            echo '<script>alert("Subject has been updated successfully")</script>';
            echo "<script>window.location.href ='manage-subjects.php'</script>";
        }
        else
        {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
            echo "<script>window.location.href ='manage-subjects.php'</script>";
        }
  }
  
    
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Update Subjects</title>
  
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
                        <h1>Update Subjects</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Update Subject</li>
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
                            <div class="card-header"><strong>Subject Details</strong></div>
                            <form name="" method="post" action="">  
                                <div class="card-body card-block">
                                     <?php
                                        $eid=$_GET['editid'];
                                        $sql=$dbh -> prepare("SELECT tblsubjects.SubjectName,tblsubjects.Semester,tblteacher.Name from  tblsubjects,tblteacher where (tblsubjects.subID = $eid AND tblsubjects.TeacherID = tblteacher.ID)");
                                        $sql->execute();
                                        $cnt=1;
                                        while($row = $sql->fetch())
                                            {               
                                    ?>
                                                <div class="form-group">
                                                    <label for="company" class=" form-control-label">Subject Name</label>
                                                    <input type="text" name="subjects" value="<?php  echo $row['SubjectName'];?>" class="form-control" id="subjects" required="true">
                                                </div>
                                                <div class="form-group">
                                                    <label for="company" class=" form-control-label">Semester</label>
                                                    <input type="number" name="semester" placeholder = "<?php echo $row['Semester']; ?>" class="form-control" id="semester" min="1" max="8" required="true">
                                                </div>
                                                <div class="form-group">
                                                    <label for="company" class=" form-control-label">Teacher's Name</label>
                                                    <select class="form-control" id="teachername" name="teacherid">
                                                        <option value = '' disabled selected><?php  echo $row['Name'];?></option>
                                                        <?php 
                                                            $query=$dbh -> prepare("SELECT Name,ID from  tblteacher");
                                                            $query->execute();
                                                            while($rows = $query->fetch())
                                                            {   
                                                        ?>
                                                        <option value="<?php echo $rows['ID'];?>"><?php  echo $rows['Name'];?></option><?php  }         ?>

                                                    </select>
                                                </div>
                                </div>
                                                <?php $cnt=$cnt+1;  }    ?> 
                                 <div class="card-footer">
                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update Details</button>
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
    header('location:logout.php');  }  ?>