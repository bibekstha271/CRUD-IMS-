<?php
include 'db.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    $sql="delete from `client` where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        // echo "Deleted Succesfully";
        header('location:display(clients).php');
    }else{
        die(mysqli_error($conn));
    }
}

?>