<?php
include 'db.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    $sql="delete from `inventory2` where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        // echo "Deleted Succesfully";
        header('location:display2.php');
    }else{
        die(mysqli_error($conn));
    }
}

?>