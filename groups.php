<?php

@include 'config.php';

session_start();

$select = "SELECT * FROM students";
$result = mysqli_query($conn, $select);

if(isset($_POST['submit'])) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_id']));
    $group_id = intval(mysqli_real_escape_string($conn, $_POST['group_id']));
    
    // $sql = "UPDATE `students` SET `group_id`= 1 WHERE student_id = 221020051117;";
    $find_student = "SELECT * FROM students WHERE student_id = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    echo mysqli_num_rows($find_student_result); 
    if (mysqli_num_rows($find_student_result) == 0) {
        $error[] = 'Student does not exist';
    }
    else {
        $update = "UPDATE students SET group_id=$group_id WHERE student_id = $student_id;";
        mysqli_query($conn, $update);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <title>Student Groups</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <a href="logout.php" class="btn">Logout</a>
            <a href="student_welcome.php" class="btn">Dashboard</a>
            <h3 class="center">Students</h3>
            <?php foreach ($students as $student) { ?>
                <!-- create a card for each Student -->
                <div class="col s6 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center" style="background-color: #151c55; color: white;">
                            <div class="card-title">
                                <h5><?php echo htmlspecialchars($student['name']); ?></h5>
                            </div>
                            <div class="card-content">
                                <p>Student ID: <?php echo htmlspecialchars($student['student_id']); ?></p>
                                <p>Group: <?php
                                            if ($student['group_id'] == 0) {
                                                echo "Unassigned";
                                            } else {
                                                echo htmlspecialchars($student['group_id']);
                                            }
                                            ?></p>
                                <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
                                <p>Phone: <?php echo htmlspecialchars($student['phone_number']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <form action="" method="post">
                <h5>Specify Student ID of student being assigned a group and the Group ID to assign the student to</h5>
                <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
                ?>
                <div>
                    <p>Student ID</p>
                    <input type="" minlength="12" max-length="12" name="student_id" required placeholder="Enter Student ID">
                </div>
                <div>
                    <p>New Group #</p>
                    <input type="" minlength="1" maxlength="2" name="group_id" required placeholder="Enter New Group #">
                </div>
                <br>
                <input type="submit" name="submit" value="Assign Group" style="
                background: #151c55;
                color:rgb(255, 255, 255);
                text-transform: capitalize;
                font-size: 20px;
                cursor: pointer;
                padding: 10px;
                border-radius: 15px;
                ">
            </form>
        </div>
    </div>
</body>
</html>

