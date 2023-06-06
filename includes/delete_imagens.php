<?php
    require_once 'dbh.inc.php';
 
    if($_REQUEST['file_id']){
        $file_id = $_REQUEST['file_id'];
        
        echo $file_id;
 
        $query=mysqli_query($conn, "SELECT * FROM files WHERE fileFullName='$file_id'") or die(mysqli_error());
        $fetch=mysqli_fetch_array($query);
        
        echo $fetch;
 
        $location="../uploads/imagens/".$fetch["fileFullName"];
 
 
        if(unlink($location)){
            mysqli_query($conn, "DELETE FROM files WHERE fileFullName='$file_id'") or die(mysqli_error());
 
            header('location: ../index.php');
        }
 
    }
 
?>
 