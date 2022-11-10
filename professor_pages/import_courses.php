<?php
@include '../config.php';

if(isset($_POST['submit'])){
    // Course Name

    // Program

    // Day

    // Section 

    // ProfessorID

    // Semester

    // Year
    // Check if student is not a duplicate
    $find_student = "SELECT * FROM Student WHERE StudentID = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    if (mysqli_num_rows($find_student_result) > 0) {
        $error[] = 'Student already in database!';
    }
    else { 
        $insert = "INSERT INTO Student(StudentID, FirstName, LastName, EmailAddress, PhoneNumber, Semester, GradeLevel, Major, GroupID) VALUES('$student_id', '$first_name', '$last_name', '$email_address', '$phone', '$semester', '$grade_level', '$major', $group_id)";
        mysqli_query($conn, $insert);
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
    <title>Import Courses</title>
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

        label {
            font-size: 16px;
            color: white;
        }

        .msg {
            margin: 10px 0;
            display: block;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }

        .error-container,
        .success-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: fit-content;
            margin: auto;
        }

        .error-container {
            background-color: tomato;
            padding: 10px;
            border-radius: 10px;
        }

        .success-container {
            background-color: lightgreen;
            padding: 10px;
            border-radius: 10px;
        }
        input, textarea {
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../templates/professor_nav.php' ?>
    <br>
    <div class="container">
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>
        <h4 class="center">Import Courses</h4>
        <br>
        <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
            <form action="" method="post">
                <!-- Course Name -->
                <label for="course_name">Course Name: </label><br>
                <input type="text" id="course_name" name="course_name" placeholder="Ex. Computer Science"></input><br>
                <!-- Program -->
                <label for="program">Program: </label><br>
                <input type="text" id="program" name="program" placeholder="Ex. Business Management"></input><br>
                <!-- Day -->
                <label for="day">Day: </label><br>
                <input type="text" id="day" name="day" placeholder="Ex. Monday"></input><br>
                <!-- Section -->
                <label for="section">Section: </label><br>
                <input type="text" id="section" name="section" placeholder="Ex. 10:30"></input><br>
                <!-- ProfessorID -->
                <label for="professor_id">Professor ID: </label><br>
                <input type="text" id="professor_id" name="professor_id" placeholder="Ex. 1"></input><br>
                <!-- Semester -->
                <!-- Year -->
                <label for="year">Year: </label><br>
                <input type="text" id="year" name="year" placeholder="Ex. 2022"></input><br>
                <!-- Submit Button -->
                <input class="btn indigo" type="submit" name="submit" value="Schedule">
            </form>
        </div>
    </div>
</body>

</html>