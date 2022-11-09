<?php
@include 'config.php';

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

        .submit {
            background: #5f4d1e;
            color: rgb(255, 255, 255);
            text-transform: capitalize;
            font-size: 20px;
            cursor: pointer;
            padding: 10px;
            border-radius: 15px;
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
    <?php include 'templates/professor_nav.php' ?>
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
                <input type="number" id="student_id" name="student_id" maxlength="9" placeholder="123456789"></input><br>
                <!-- First Name -->
                <label for="first_name">First Name: </label><br>
                <input type="text" id="first_name" name="first_name" placeholder="John"></input><br>
                <!-- Last Name -->
                <label for="last_name">Last Name: </label><br>
                <input type="text" id="last_name" name="last_name" placeholder="Appleseed"></input><br>
                <!-- Email -->
                <label for="email_address">Email Address: </label><br>
                <input type="email" id="email_address" name="email_address" placeholder="johnappleseed@business.smu.edu.sg"></input><br>
                <!-- Phone # -->
                <label for="phone_number">Phone #: </label><br>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{3}[0-9]{2}-[0-9]{3}" placeholder="123-456-7890"></input><br>
                <!-- Semester -->
                <label for="semester">Semester: </label><br><br>
                <select name="semester" id="semester" style="display: block;">
                    <option value="Term 1">Term 1</option>
                    <option value="Term 2"> Term 2</option>
                </select><br>
                <!-- Grade Level -->
                <label for="grade_level">Semester: </label><br><br>
                <select name="grade_level" id="grade_level" style="display: block;">
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Sophomore">Junior</option>
                    <option value="Sophomore">Senior</option>
                </select><br>
                <!-- Major -->
                <label for="major">Major: </label><br>
                <input type="text" id="major" name="major" placeholder="Computer Science"></input><br>
                <!-- Group ID -->
                <label for="group_id">Group ID: </label><br><br>
                <select name="group_id" id="group_id" style="display: block;">
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
                <input class="submit" type="submit" name="submit" value="Schedule">
            </form>
        </div>
    </div>
</body>

</html>