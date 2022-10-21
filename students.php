<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['professor_name'])){
    header('location:index.php'); // if not logged in, redirect and go back to home page
 }

    $select = "SELECT * FROM students";
    $result = mysqli_query($conn, $select);
    
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
</head>

<body style="
    background-image: url('https://wallpapercrafter.com/desktop/294113-books-education-school-literature-know-reading.jpg');
    background-size: cover;">
    <div class="container">
    <div class="row center">
            <a href="logout.php" class="btn indigo">Logout</a>
            <a href="student_welcome.php" class="btn indigo">Dashboard</a>
            <a href="students.php" class="btn indigo">Students</a>
            <a href="import.php" class="btn indigo">Import Students</a>
            <a href="groups.php" class="btn indigo">Assign Groups</a>
            <h3 class="center">Student Names</h3>
            <?php foreach ($students as $student) { ?>
                <!-- create a card for each course -->
                <div class="col s6 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center" style="background-color: #151c55; color: white;">
                            <span class="card-title"><h4><?php echo htmlspecialchars($student['name']); ?></h4></span>
                            <h6>Email: <?php echo htmlspecialchars($student['email']); ?></h6>
                            <h6>Student ID: <?php echo htmlspecialchars($student['student_id']); ?></h6>
                        </div>
                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>