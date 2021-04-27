<?php
session_start();
session_destroy();
require_once('inc/header.php');
require_once('inc/db-connection.php');
$query ='select * from projects';
$run_query=mysqli_query($conn,$query);
$projects = mysqli_fetch_all($run_query,MYSQLI_ASSOC);

?>

<div class="container mt-5">

<?php if(!isset($_SESSION['email'])){?>
<a  class="btn btn-primary m-3" href="login.php">login</a>
<?php }?>


<?php if(isset($_SESSION['email'])){?>
<a  class="btn btn-primary m-3" href="addprojectform.php">Add project</a>
<?php }?>

<?php if(isset($_SESSION['email'])){?>
<a  class="btn btn-danger m-3" href="logout.php">logout</a>
<?php }?>

 <div class="row py-5 mx-3">
 <?php foreach($projects as $project){?>
   <div class="col-md-4">
    <img class="img-fluid" src="imgs/<?php echo $project['img']?>">
    <h1><?php echo$project['name']?></h1>
    <a  class="btn btn-primary" href="showProject.php?id=<?php echo$project['id']?>">View-Detalis</a>

    <?php if(isset($_SESSION['email'])){ ?>
    <a  class="btn btn-danger" href="delet.php?id=<?php echo$project['id']?>">delete</a>
    <a  class="btn btn-success" href="edit.php?id=<?php echo$project['id']?>">edit</a>
    <?php }?>
   </div>
   <?php }?>
 </div>
</div>
