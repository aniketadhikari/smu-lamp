<?php

@include 'config.php';

session_start();

$select = "SELECT * FROM Student";
$result = mysqli_query($conn, $select);

$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if (isset($_POST['submit'])) {

    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_name']));
    $group_id = intval(mysqli_real_escape_string($conn, $_POST['group_id']));

    // Make sure student exists otherwise update the table
    $find_student = "SELECT * FROM Student WHERE StudentID = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    if (mysqli_num_rows($find_student_result) == 0) {
        $error[] = 'Student does not exist';
    } else {
        $update = "UPDATE Student SET GroupID=$group_id WHERE StudentID = $student_id;";
        mysqli_query($conn, $update);
    }
    header('location:groups.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <link rel="stylesheet" href="css/groups.css">
    <title>Student Groups</title>
</head>

<body>
    <div class="container" style="background-color:rgba(150, 150, 150, 0.4); padding: 10px">
        <div class="row center">
            <a href="logout.php" class="btn indigo">Logout</a>
            <a href="student_welcome.php" class="btn indigo">Dashboard</a>
            <a href="students.php" class="btn indigo">Students</a>
            <a href="import.php" class="btn indigo">Import Students</a>
            <a href="groups.php" class="btn indigo">Assign Groups</a>
            <h4 class="center">Assign Student Groups</h4>
            <?php foreach ($students as $student) { ?>
                <!-- create a card for each Student -->
                <div class="col s6 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center" >
                            <div class="card-title">
                                <h5><?php echo htmlspecialchars($student['FirstName']); ?></h5>
                            </div>
                            <div class="card-content">
                                <p>Student ID: <?php echo htmlspecialchars($student['StudentID']); ?></p>
                                <p>Group: <?php
                                            if ($student['GroupID'] == 0) {
                                                echo "Unassigned";
                                            } else {
                                                echo htmlspecialchars($student['GroupID']);
                                            }
                                            ?></p>
                                <p>Email: <?php echo htmlspecialchars($student['EmailAddress']); ?></p>
                                <p>Phone: <?php echo htmlspecialchars($student['PhoneNumber']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <form action="" method="post">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };
                ?>
                
                <div>
                    <label for="group_id" style="color: black;">Enter Group ID:</label>
                    <br>
                    <input type="" minlength="1" maxlength="2" name="group_id" required placeholder="Enter Number">
                </div>

                <label for="student_name" style="color: black" >Select Student:</label>
                <select name="student_name" id="student_name" style="display: block;">
                    <?php foreach ($students as $student) { ?>
                        <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                    <?php } ?>
                </select>
                <br>
                <input class="submit" type="submit" name="submit" value="Assign Group">
            </form>
        </div>
    </div>
</body>

</html>