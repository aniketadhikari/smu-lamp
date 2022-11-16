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
$total_score = 0;
if(isset($_POST['submit'])) {
    $dmk = intval(mysqli_real_escape_string($conn, $_POST['dmk']));
    $ic = intval(mysqli_real_escape_string($conn, $_POST['ic']));
    $ip = intval(mysqli_real_escape_string($conn, $_POST['ip']));
    $gc = intval(mysqli_real_escape_string($conn, $_POST['gc']));
    $pm = intval(mysqli_real_escape_string($conn, $_POST['pm']));
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['evaluatee']));
    $submitted_date = date("Y-m-d");

    // calculate the total score
    $total_score = $dmk + $ic + $ip + $gc + $pm;
    $update = "UPDATE PeerAssessment SET SubmittedDate='$submitted_date', DMKScore=$dmk, ICScore=$ic, IPScore=$ip, GCScore=$gc, PMScore=$pm WHERE StudentID=$student_id";
    mysqli_query($conn, $update);
    header('location:list_eval.php');
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
    <title><?php echo $_SESSION['student_name'] ?>'s Evaluations</title>
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
        select {
            display: inline;
        }
        label {
            font-size: 16px;
            color: white;
        }
        input, textarea {
            color: white;
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
    <div class="container" style="background-color: #151c55; padding: 20px;">
        <form action="" method="post">
            <!-- Pick Student -->
            <label for="evaluatee">Student to Evaluate: </label>
            <select name="evaluatee" id="evaluatee">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']) . ', ' . htmlspecialchars($student['EmailAddress']); ?></option>
                <?php } ?>
            </select><br><br>
            <!-- DMK Score -->
            <label for="dmk">Enter DMK Score</label>
            <input type="number" id="dmk" name="dmk" min="1" max="5" required>
            <!-- ICScore -->
            <label for="ic">Enter IC Score</label>
            <input type="number" id="ic" name="ic" min="1" max="5" required>
            <!-- IPScore -->
            <label for="ip">Enter IP Score</label>
            <input type="number" id="ip" name="ip" min="1" max="5" required>
            <!-- GCScore -->
            <label for="gc">Enter GC Score</label>
            <input type="number" id="gc" name="gc" min="1" max="5" required>
            <!-- PMScore -->
            <label for="pm">Enter PM Score</label>
            <input type="number" id="pm" name="pm" min="1" max="5" required>

            <input class="btn indigo" type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>