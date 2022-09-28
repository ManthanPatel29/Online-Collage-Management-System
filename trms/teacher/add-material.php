<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmstid'])) 
{
    $teacherid=$_SESSION['trmstid'];
    if(isset($_POST['submit']))
    {
        $maid = $_POST['subject'];
        $mname = $_FILES['myfile']['name'];
        $mtype = $_FILES['myfile']['type'];
        $mdata = file_get_contents($_FILES['myfile']['tmp_name']);
        $extension = pathinfo($mname, PATHINFO_EXTENSION);
        if(!in_array($extension,['pdf', 'doc', 'docx']))
        {
            echo '<script>alert("'.$extension.' file extension is not allowed only .doc, .pdf or .docx allowed")</script>';
            echo "<script> window.location.href ='add-material.php'</script>";
        } 
        elseif($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
            echo '<script>alert("File is Too large!")</script>';
            echo "<script> window.location.href ='add-material.php'</script>";
        }
        else {
            $sql = $dbh->prepare("insert into tblmaterial values('',?,?,?,?)");
            $sql->bindParam(1,$mname,PDO::PARAM_STR);
            $sql->bindParam(2,$mdata,PDO::PARAM_STR);
            $sql->bindParam(3,$mtype,PDO::PARAM_STR);
            $sql->bindParam(4,$maid,PDO::PARAM_STR);
            if($sql->execute() === TRUE){
                echo '<script>alert("sheet has been uploaded successfully")</script>';
                echo "<script> window.location.href ='add-material.php'</script>";
            }
            else{
                echo '<script>alert("Please Try Again")</script>';
                echo "<script> window.location.href ='add-material.php'</script>";
            }
        }          
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Add Materials</title>
  
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
                        <h1>Add Materials</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Add Material</li>
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
                            <div class="card-header"><strong>Add Subject Materials</strong></div>
                            <form action="add-material.php" method="post" enctype="multipart/form-data">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class="form-control-label"><b>Add Material</b></label>
                                        <input style="padding:2.5px;" type="file" name="myfile" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" class="form-control-label"><b>Select Subject</b></label><br/>
                                        <select class="form-control" id="subject" name="subject" required="true">
                                        <option value = '' disabled selected>Select Subjects </option>
                                        <?php
                                            $sql="SELECT SubjectName,subID from  tblsubjects where TeacherID = '$teacherid' ";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            while($row = $query->fetch())
                                            {
                                        ?>
                                            
                                        <option value="<?php echo $row['subID'];?>"><?php  echo $row['SubjectName'];?></option>
                                        <?php   }   ?>
                                        
                                        </select>
                                    </div>
                                </div>
                                <p style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Upload Material</button> 
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