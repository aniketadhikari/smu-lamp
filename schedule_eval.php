<?php
@include 'config.php';

session_start();
// Gather all respective students of professor logged in 
$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}

// INSERT into the PeerAssessments table when a new entry is made by a professor
if (isset($_POST['submit'])) {
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_name']));
    $evaluator_id = intval(mysqli_real_escape_string($conn, $_POST['evaluator_name']));
    if ($student_id == $evaluator_id) {
        $error[] = 'Student can not evaluate themselves!';
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Schedule Evaluations</title>
    <style>
        body {
            background: url('images/blurred-smu-admin.jpg');
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
        .error-msg {
            margin:10px 0;
            display: block;
            background: #846d2c;
            color:#fff;
            border-radius: 5px;
            font-size: 20px;
            padding:10px;
        }
        .error-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container" style="padding: 10px;">
        <div class="row center">
            <?php include 'templates/professor_nav.php' ?>
        </div>
    </div>
    <div class="container">
        
        <form action="" method="post">
            <label for="student_name">Select student to be <strong>evaluated</strong>, meaning they will be evaluated by another student in the class:</label>
            <select name="student_name" id="student_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="evaluator_name">Select student to be <strong>evaluator</strong>, meaning they will be evaluating the previously selected student:</label>
            <select name="evaluator_name" id="evaluator_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="due_date"><strong>Select</strong> due date for peer evaluations</label>
            <input type="date" id="due_date" name="due_date" style="background-color: white; padding: 5px; border-radius: 2px;" min="<?php echo htmlspecialchars(date("Y-m-d")) ?>">
            <br>
            <input class="submit" type="submit" name="submit" value="Schedule">
        </form>
    </div>
    <div class="error-container" >
        <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
    </div>
    
</body>

</html>