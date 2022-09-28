<?php
    include('includes/dbconnection.php');
    if(isset($_GET['fid']))
    { 
        $tid = $_GET['fid'] ;  
        $stmt= $dbh -> prepare("SELECT * from tblsubmission where ID=?");
        $stmt->bindParam(1,$tid);
        $stmt->execute();
        $rows = $stmt->fetch(); 
        header('Content-Type:' .$rows['type']);
        echo $rows['data'];
    } 
?>