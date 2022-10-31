<?php

@include 'config.php';

session_start();
$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}
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
    <link rel="stylesheet" href="css/groups.css">
    <title>Student Groups</title>
    <style>
        body { 
            background: url('images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
        }

        table{
            background-color: #151c55;
        }

        td, th {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container" style="padding: 10px;">
        <div class="row center">
            <a href="logout.php" class="btn indigo">Logout</a>
            <a href="student_welcome.php" class="btn indigo">Dashboard</a>
            <a href="students.php" class="btn indigo">Students</a>
            <a href="import.php" class="btn indigo">Import Students</a>
            <a href="groups.php" class="btn indigo">Assign Groups</a>
            <h3 class="center">Your Students</h4>
            <table>
                <tr>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Major</th>
                    <th>Grade Level</th>
                </tr>
                <?php 
                foreach ($students as $student) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['StudentID']); ?></td>
                        <td><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></td>
                        <td><?php echo htmlspecialchars($student['EmailAddress']); ?></td>
                        <td><?php echo htmlspecialchars($student['PhoneNumber']); ?></td>
                        <td><?php echo htmlspecialchars($student['Major']); ?></td>
                        <td><?php echo htmlspecialchars($student['GradeLevel']); ?></td>
                    </tr>
                <?php }
                ?>
            </table>
        </div>
    </div>
</body>

</html>