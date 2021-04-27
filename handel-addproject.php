<?php
session_start();
require_once('inc/db-connection.php');
if(isset($_POST['submit']))
{
    $name =htmlspecialchars(trim($_POST['name']) );
    $desc =htmlspecialchars(trim($_POST['desc']) );
    $url =htmlspecialchars(trim($_POST['url']) );
    $file=$_FILES['file'];
    $repo =htmlspecialchars(trim($_POST['repo']) );

    $fileName = $file['name'];
    $fileTempName = $file['tmp_name'] ;
    $fileError = $file['error'] ;
     
    $ext=pathinfo($fileName,PATHINFO_EXTENSION);
    $fileNewName=uniqid()."." .$ext;

    $errors=[];
    if (empty($name))
    {
        $errors[]='name is required';
    }elseif (strlen($name)<5 || strlen($name)>255) 
    {
        $errors[]='name length must between [5-255]';
    }elseif (!is_string($name) || is_numeric($name)) {
        $errors[]='name  must  be string';
    }


    if (empty($desc))
    {
        $errors[]='description is required';
    }elseif (strlen($desc)<5 || strlen($desc)>1000) 
    {
        $errors[]='description length must between [5-1000]';
    }
    if(  $fileError>0)
    {
        $errors[]='there is an error ocured when uploded file';
    }
     if (!filter_var($url,FILTER_VALIDATE_URL))
     {
         $errors[]='website url must be valid';
     }
     if (!filter_var($repo,FILTER_VALIDATE_URL))
     {
         $errors[]='repositery must be valid';
     }
     
     if(empty($errors))
     {
         $query="INSERT INTO PROJECTS (name,description,img ,url,repo) values('$name','$desc','$fileNewName','$url','$repo')";
        $run_query= mysqli_query($conn,$query);
        //put the img inside the img folder by this function 
        move_uploaded_file($fileTempName,'imgs/$fileNewName');
        header('location:index.php');
     }else
     {
       $_SESSION['errors']=$errors;
       header('location:addprojectform.php');
     }


   
}






?>