<?php
@include '../config.php';

session_start();
if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}

if (isset($_POST['submit'])) {
    // Course Name
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    // Program
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    // Day
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    // Section 
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    // ProfessorID
    $professor_id = intval(mysqli_real_escape_string($conn, $_POST['professor_id']));
    // Semester
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    // Year
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $insert = "INSERT INTO Course(CourseName, Program, Day, Section, ProfessorID, Semester, Year) VALUES('$course_name', '$program', '$day', '$section', '$professor_id', '$semester', '$year')";
    mysqli_query($conn, $insert);
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Import Courses</title>
</head>

<body class="professor-body">
    <?php include '../templates/professor_nav.php' ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Import Courtses</h4>
    </div>
    <div class="container">
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>

        <br>
        <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
            <form action="" method="post">
                <!-- Course Name -->
                <label for="course_name">Course Name: </label><br>
                <input type="text" id="course_name" name="course_name" placeholder="Ex. Computer Science" required></input><br>
                <!-- Program -->
                <label for="program">Program: </label><br>
                <input type="text" id="program" name="program" placeholder="Ex. Business Management" required></input><br>
                <!-- Day -->
                <label for="day">Day: </label><br>
                <input type="text" id="day" name="day" placeholder="Ex. Monday" required></input><br>
                <!-- Section -->
                <label for="section">Section: </label><br>
                <input type="text" id="section" name="section" placeholder="Ex. 10:30" required></input><br>
                <!-- ProfessorID -->
                <label for="professor_id">Professor ID: </label><br>
                <input type="text" id="professor_id" name="professor_id" placeholder="Ex. 1" required></input><br>
                <!-- Semester -->
                <label for="semester">Semester: </label><br><br>
                <select name="semester" id="semester" style="display: block;" required>
                    <option value="Fall">Fall</option>
                    <option value="Winter">Winter</option>
                    <option value="Spring">Spring</option>
                    <option value="Summer">Summer</option>
                </select><br>
                <!-- Year -->
                <label for="year">Year: </label><br>
                <input type="text" id="year" name="year" readonly value="2022" style="color: grey; cursor: not-allowed;"></input><br>
                <!-- Submit Button -->
                <input class="btn blue darken-4" type="submit" name="submit" value="Schedule">
            </form>
        </div>
    </div>
    <br>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>