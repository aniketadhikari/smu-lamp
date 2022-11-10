<?php

@include '../config.php';
session_start();

if(!isset($_SESSION['student_name'])){
    header('location:../index.php');
 }
 
$student_id = $_SESSION['student_id'];

$select = "SELECT * FROM PeerAssessment INNER JOIN Student ON PeerAssessment.StudentID=Student.StudentID WHERE EvaluatorStudentID='$student_id'";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No evals assigned to you!';
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <link rel="stylesheet" href="css/groups.css">
    <title>Complete Evaluations</title>
    <style>
        body {
            background: url('../images/blurred-smu-admin.jpg');
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
    <?php include '../templates/student_nav.php' ?>
    <div class="row center">
        <h4 class="center">Complete Evaluations</h4>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="row center">
            <table>
                <thead>
                    <tr>
                        <th>Student to Evaluate</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Grade Level</th>
                        <th>Major</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($students as $student) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></td>
                            <td><a class="mail-link" href="mailto:"><?php echo htmlspecialchars($student['EmailAddress']); ?></a></td>
                            <td><?php echo htmlspecialchars($student['PhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($student['GradeLevel']); ?></td>
                            <td><?php echo htmlspecialchars($student['Major']); ?></td>
                            <td><?php echo date('F j, Y', strtotime($student['DueDate'])) ?></td>
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