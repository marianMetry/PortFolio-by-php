<?php
require_once('inc/db-connection.php');

if(isset($_POST['submit']) && isset($_GET['id']))
{
    $id=$_GET['id'];
   

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

   $query="select img from projects where id =$id";
   $run_query=mysqli_query($conn,$query);
   $img= mysqli_fetch_assoc($run_query);
   print_r($img);
   $oldNameImg=$img['img'];
   echo  $oldNameImg;

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

     if (!filter_var($url,FILTER_VALIDATE_URL))
     {
         $errors[]='website url must be valid';
     }
     if (!filter_var($repo,FILTER_VALIDATE_URL))
     {
         $errors[]='repositery must be valid';
     }

     if (empty($errors))
     {
      if(empty($fileName))
      {
                 $query="update projects set name='$name', description='$desc', img='$oldNameImg', url='$url' , repo='$repo' where id=$id";
                 $run_query=mysqli_query($conn,$query);
                 header('location:index.php');

      }else{

         $query="update projects set name='$name', description='$desc', img='$fileNewName', url='$url' , repo='$repo' where id=$id";
         $run_query=mysqli_query($conn,$query);
         move_uploaded_file($fileTempName,"imgs/$fileNewName");
         header('location:index.php');
        }
     }




}

?>