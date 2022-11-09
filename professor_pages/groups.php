<?php

@include '../config.php';

session_start();

if(!isset($_SESSION['professor_name'])){
    header('location:../index.php');
 }
 
$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}
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
    <title>Student Groups</title>
    <style>
        body {
            background: url('../images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
        }

        .submit {
            background: #151c55;
            color: rgb(255, 255, 255);
            text-transform: capitalize;
            font-size: 20px;
            cursor: pointer;
            padding: 10px;
            border-radius: 15px;
        }

        .card-panel {
            background-color: #151c55;
            color: white;
        }

        #student-selection {
            display: block;
        }

        label {
            font-size: 16px;
            color: white;
        }

        table {
            background-color: #151c55;
            color: white;
            border: #151c55 solid 20px;
        }

        th,
        td {
            text-align: center;
        }

        .mail-link {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include '../templates/professor_nav.php' ?>
    <h4 class="center">Assign Student Groups</h4>
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
            <label for="student_name">Select Student:</label>
            <select name="student_name" id="student_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <div>
                <label for="group_id">Enter Group ID:</label>
                <br>
                <input type="" minlength="1" maxlength="2" name="group_id" required placeholder="Enter Number">
            </div>
            <br>
            <input class="submit" type="submit" name="submit" value="Assign Group">
        </form>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="row center">
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Group ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($students as $student) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['StudentID']); ?></td>
                            <td><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></td>
                            <td><a class="mail-link" href="mailto:"><?php echo htmlspecialchars($student['EmailAddress']); ?></a></td>
                            <td><?php echo htmlspecialchars($student['PhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($student['GroupID']); ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
    </div>
</body>

</html>