<?php
if (isset($_POST["submit"]))
{ 
        $extension = pathinfo($filename);
//        if (!in_array($extension, ['.zip', '.pdf', '.docx'])) 
//        {
//            echo "Your file extension must be .zip, .pdf or .docx";
//        } 
        if ($_FILES['file']['size'] > 1000000) 
        { 
            echo "File too large!";
        } 
        else 
        {
            if (move_uploaded_file($file, $destination)) 
            {
                $sql = "INSERT INTO materials (file_name, subID) VALUES ('$filename', $adid)";
                $query = $dbh->prepare($sql);
//                $query->bindParam(':subjects',$subjects,PDO::PARAM_STR);
//                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                $query->execute();

            }
            else 
            {
                echo "Failed to upload file.";
                echo $extension;
            }
        }
    } 
?>