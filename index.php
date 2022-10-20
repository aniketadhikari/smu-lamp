<?php

@include 'config.php';

session_start();
// if logged in, redirect and go immediately to professor welcome page
if(isset($_SESSION['professor_name'])){
   header('location:professor_welcome.php'); 
}

// if logged in, redirect and go immediately to student welcome page
if(isset($_SESSION['student_name'])){
   header('location:student_welcome.php'); 
}

if(isset($_POST['submit'])){

   // $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   // $cpass = md5($_POST['cpassword']);
   // $user_type = $_POST['user_type'];

   $select = " SELECT * FROM Users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'professor'){

         $_SESSION['professor_name'] = $row['name'];
         header('location:professor_welcome.php');

      }elseif($row['user_type'] == 'student'){

         $_SESSION['student_name'] = $row['name'];
         header('location:student_welcome.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      
         <h3>login now</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
         <input type="email" name="email" required placeholder="enter your email">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>Don't have an account? <a href="register.php">register now</a></p>
      
   </form>
</div>

</body>
</html>