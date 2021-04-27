<?php
require_once('inc/db-connection.php');
require_once('inc/header.php');
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    echo $id;
}elseif (!isset($_GET['id'])) {
    header('location:index.php');
}

$query ="select * from projects where id = $id";
$run_query = mysqli_query($conn , $query);
$project = mysqli_fetch_assoc($run_query);
// print_r($project);
?>







<div class="container">
<div class="row">
 <div class="col-md-6">
  <img class="img-fluid" src="imgs/<?php echo $project['img']?>">
 </div>
 
 <div class="col-md-6">
 <h1><?php echo $project['name']?></h1>
 <p><?php echo $project['description']?></p>
 </div>
 
</div>
 
</div>