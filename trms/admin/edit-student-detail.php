<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['trmsaid'])) 
{
    if(isset($_POST['submit']))
    {
        $eid=$_GET['editid'];
        $enroll=$_POST['enrollment'];
        $tname=$_POST['tname'];
        $email=$_POST['email'];
        $sem=$_POST['semester'];
        $mobnum=$_POST['mobilenumber'];
        $parnum=$_POST['parentsnumber'];
        $address=$_POST['address'];
        $Adate=$_POST['admissiondate'];

        $sql="update tblstudents set Enrollment=:enrollment, Name=:tname, Email=:email, Semester=:semester, MobileNumber=:mobilenumber, ParentsNumber=:parentsnumber, Address=:address, AdmissionDate=:admissiondate where Enrollment=:eid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':enrollment',$enroll,PDO::PARAM_STR);
        $query->bindParam(':tname',$tname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':semester',$sem,PDO::PARAM_STR);
        $query->bindParam(':mobilenumber',$mobnum,PDO::PARAM_STR);
        $query->bindParam(':parentsnumber',$parnum,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':admissiondate',$Adate,PDO::PARAM_STR);
        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
        
        if($query->execute() === TRUE){
            echo '<script>alert("Student detail has been updated successfully")</script>';
            echo "<script>window.location.href ='manage-students.php'</script>";
        }
        else
        {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
            echo "<script>window.location.href ='manage-students.php'</script>";
        }

  }
  
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Update Students's Details</title>
  
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
                        <h1>Update Student's Detail</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Update Details</li>
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
                            <div class="card-header"><strong>Student's Details</strong></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">
                            <?php
                                $eid=$_GET['editid'];
                                $sql=$dbh -> prepare("SELECT * from tblstudents where Enrollment = ? ");
                                $sql->bindparam(1,$eid);
                                $sql->execute();
                                $cnt=1;
                                    while($row=$sql->fetch())
                                    {               
                            ?>
                                <div class="form-group">
                                    <label for="company" class=" form-control-label">Student's Enrollment</label>
                                    <input type="text" name="enrollment" value="<?php  echo $row['Enrollment'];?>" class="form-control" id="enrollment" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="company" class=" form-control-label">Student's Name</label>
                                    <input type="text" name="tname" value="<?php  echo $row['Name'];?>" class="form-control" id="tname" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="street" class=" form-control-label">Student's Email ID</label>
                                    <input type="email" name="email" value="<?php  echo $row['Email'];?>" id="email" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="company" class=" form-control-label">Semester</label>
                                    <input type="number" name="semester" value = "<?php echo $row['Semester']; ?>" class="form-control" id="semester" min="1" max="8" required="true">
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Parent's Mobile</label>
                                            <input type="text" name="parentsnumber" id="parentsnumber" value="<?php  echo $row['ParentsNumber'] ; ?>" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Student's Mobile Number</label>
                                            <input type="text" name="mobilenumber" id="mobilenumber" value="<?php  echo $row['MobileNumber'] ;?>" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Student's Address</label>
                                            <textarea type="text" name="address" id="address" class="form-control" rows="2"  required="true"><?php echo $row['Address'];?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Student's Admission Date</label>
                                            <input type="date" name="admissiondate" id="admissiondate" value="<?php  echo $row['AdmissionDate']; ?>" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $cnt=$cnt+1; } ?>

                            <p style="text-align: center;">
                                <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update Details </button>
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
<?php } else{
     header('location:logout.php'); }  ?>