<?php
require_once('inc/db-connection.php');

if($_GET['id'])
{
    $id=$_GET['id'];
    echo $id;
    $query="delete from projects where id =$id";
    $run_query= mysqli_query($conn,$query);
    // $result=mysqli_fetch_assoc($run_query);

    header('location:index.php');
}



?>