<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['student_name'])){
   header('location:index.php'); // if not logged in, redirect and go back to home page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">

</head>
<body>
   
<div class="container" style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/a/ac/SMU_Admin_Building.jpg);">
      <div class="content" style="background-color:rgba(25, 25, 25, 0.25);padding:10px;">
      <h3>Hi, <span>student</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['student_name'] ?></span></h1>
      <a href="logout.php" class="btn">Logout</a>
      <a href="courses.php" class="btn">Courses</a>
      <a href="complete_eval.php" class="btn">View and Complete Evaluations</a>
   </div>

</div>

</body>
</html>