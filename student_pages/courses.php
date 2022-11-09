<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['student_name'])) {
    header('location:../index.php'); // if not logged in, redirect and go back to home page
}

// query for all of the courses in the Courses table 
$select = "SELECT * FROM Course";
$result = mysqli_query($conn, $select);


$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>SMU Courses</title>
    <style>
        body {
            background: url('../images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
        }
    </style>

</head>

<body>
    <?php include '../templates/student_nav.php' ?>
    <div class="row center">
        <h3 class="center">Course Names</h3>
    </div>
    <div class="container">
        <div class="row center">

            <?php foreach ($courses as $course) { ?>
                <!-- create a card for each course -->
                <div class="col s6 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center" style="background-color: #151c55; color: white;">
                            <div class="card-title">
                                <h5><?php echo htmlspecialchars($course['CourseName']); ?></h5>
                            </div>
                            <div class="card-content">
                                <p><?php echo htmlspecialchars($course['Program']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

</body>

</html>