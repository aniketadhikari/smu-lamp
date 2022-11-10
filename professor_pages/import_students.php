<?php
@include '../config.php';

if(isset($_POST['submit'])){
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_id']));
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);;
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);;
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);;
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);;
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);;
    $major = mysqli_real_escape_string($conn, $_POST['major']);;
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);

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
// StudentID 
// First Name
// Last Name
// Email Address 


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
        <h4 class="center">Import Students</h4>
        <br>
        <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
            <form action="" method="post">
                <!-- Student ID -->
                <label for="student_id">Student ID: </label><br>
                <input type="number" id="student_id" name="student_id" minlength="9" placeholder="123456789" required></input><br>
                <!-- First Name -->
                <label for="first_name">First Name: </label><br>
                <input type="text" id="first_name" name="first_name" placeholder="John" required></input><br>
                <!-- Last Name -->
                <label for="last_name">Last Name: </label><br>
                <input type="text" id="last_name" name="last_name" placeholder="Appleseed" required></input><br>
                <!-- Email -->
                <label for="email_address">Email Address: </label><br>
                <input type="email" id="email_address" name="email_address" placeholder="johnappleseed@business.smu.edu.sg" required></input><br>
                <!-- Phone # -->
                <label for="phone_number">Phone #: </label><br>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required></input><br>
                <!-- Semester -->
                <label for="semester">Semester: </label><br><br>
                <select name="semester" id="semester" style="display: block;" required>
                    <option value="Term 1">Term 1</option>
                    <option value="Term 2"> Term 2</option>
                </select><br>
                <!-- Grade Level -->
                <label for="grade_level">Semester: </label><br><br>
                <select name="grade_level" id="grade_level" style="display: block;" required>
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Sophomore">Junior</option>
                    <option value="Sophomore">Senior</option>
                </select><br>
                <!-- Major -->
                <label for="major">Major: </label><br>
                <input type="text" id="major" name="major" placeholder="Computer Science" required></input><br>
                <!-- Group ID -->
                <label for="group_id">Group ID: </label><br><br>
                <select name="group_id" id="group_id" style="display: block;" required>
                    <?php
                    $select_groups = "SELECT * FROM SMU.Groups";
                    $result = mysqli_query($conn, $select_groups);
                    $number_of_groups = mysqli_num_rows($result);
                    for ($i = 1; $i <= $number_of_groups; $i++) {
                    ?>
                        <option value="<?php $i ?>"> Group <?php echo $i ?></option>
                    <?php } ?>

                </select><br>
                <!-- Submit Button -->
                <input class="btn indigo" type="submit" name="submit" value="Schedule" required>
            </form>
        </div>
    </div>
</body>

</html>