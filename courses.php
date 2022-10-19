<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['student_name'])) {
    header('location:index.php'); // if not logged in, redirect and go back to home page
}

// query for all of the courses in the Courses table 
$select = "SELECT * FROM Courses";
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
    <title>SMU Courses</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3 class="center">Course Names</h3>
            <?php foreach ($courses as $course) { ?>
                <!-- create a card for each course -->
                <div class="col s4 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center">
                            <h6><?php echo htmlspecialchars($course['CourseName']); ?></h6>
                            <h6><?php echo htmlspecialchars($course['Program']); ?></h6>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

</body>

</html>