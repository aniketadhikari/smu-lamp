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

   $select = " SELECT * FROM Users WHERE EmailAddress = '$email' && Password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['UserType'] == 'professor'){

         $_SESSION['professor_name'] = $row['FirstName'];
         header('location:professor_welcome.php');

      }elseif($row['UserType'] == 'student'){

         $_SESSION['student_name'] = $row['FirstName'];
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
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
</head>
<body>
<?php require("./templates/header.php"); ?>
<div class="form-container">
   <form action="" method="post">
      
         <h3>Login Now</h3>
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