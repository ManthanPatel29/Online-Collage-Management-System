<?php
    include('includes/dbconnection.php');
    if(isset($_GET['fid']))
    { 
        $tid = $_GET['fid'] ;  
        $stmt= $dbh -> prepare("SELECT * from tblmaterial where ID=?");
        $stmt->bindParam(1,$tid);
        $stmt->execute();
        $rows = $stmt->fetch(); 
        header('Content-Type:' . $rows['type']);
        header('Content-Disposition: inline; filename="' .$rows['filename']. '"'); 
        echo $rows['data'];
    } 
?>