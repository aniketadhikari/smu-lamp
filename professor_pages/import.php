<!-- This page is meant for professors to be able to import CSV files so that students
can be added to the database and later be grouped into project groups-->
<?php

@include 'config.php';

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

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Import Students</title>
    <style>
        body {
            background: url('images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
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
    <?php include 'templates/professor_nav.php' ?>
    <div class="container">
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>
        <div class="row center">
            <h4 class="center">Import Students</h4>
        </div>
        <div class="row center">
            <a href="import_students.php" class="btn">Import Students</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone #</th>
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
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row center">
            <h4 class="center">Import Courses</h4>
        </div>
        <div class="row center">
            <a href="import_courses.php" class="btn">Import Courses</a>
        </div>
    </div>
</body>

</html>