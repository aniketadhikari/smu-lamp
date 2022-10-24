<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   extract($_POST);

   $sql = " SELECT * FROM Users WHERE email = '$email' OR password = '$pass' ";
   $result = sqlsrv_query($conn, $sql) or die(print_r(sqlsrv_errors(),true));

   if(sqlsrv_has_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         if ($user_type == 'student') {
            $student_id = 5 . date("ymdH",time());
            $insert = "INSERT INTO Users(ID, FirstName, LastName, email, password, user_type) VALUES('$student_id', '$first_name', '$last_name', '$email','$pass','$user_type')";
            // echo $student_insert;
            sqlsrv_query($conn, "INSERT INTO Student(StudentID, FirstName, LastName, EmailAddress, PhoneNumber, Semester, GradeLevel, Major, GroupID) VALUES('$student_id', '$first_name', '$last_name', '$email', '', NULL, 0, '', 0)");
         }
         else {
            $professor_id = 7 . date("ymdH",time());
            $insert = "INSERT INTO Users(ID, FirstName, LastName, email, password, user_type) VALUES('$professor_id', '$first_name', '$last_name', '$email','$pass','$user_type')";
         }
         sqlsrv_query($conn, $insert);
         
      }
      header('location:index.php');
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">

</head>
<body>
<?php require("./templates/header.php"); ?>
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="first_name" required placeholder="enter your first name">
      <input type="text" name="last_name" required placeholder="enter your last name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type" style="display: inline;">
         <option value="student">Student</option>
         <option value="professor">Professor</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>

</div>

</body>
</html>