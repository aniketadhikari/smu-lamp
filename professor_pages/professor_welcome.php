<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['professor_name'])){
   header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professor Dashboard</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <style>
      body {
            background: url('../images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
        }
   </style>
</head>

<body>
   <div class="container">
      <div class="content">
         <h3>hello, <span>professor</span></h3>
         <h1>welcome <span><?php echo $_SESSION['professor_name'] ?></span></h1>
         <a href="../logout.php" class="btn">Logout</a>
         <a href="groups.php" class="btn">Groups</a>
         <a href="schedule_eval.php" class="btn">Evaluations</a>
         <a href="import_students.php" class="btn">Import Students</a>
         <a href="import_courses.php" class="btn">Import Courses</a>
      </div>
   
   </div>

   

</body>
</html>