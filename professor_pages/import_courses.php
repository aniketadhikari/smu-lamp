<?php
@include '../config.php';

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
                <input type="text" id="course_name" name="course_name" placeholder="Computer Science"></input><br>
                <!-- Submit Button -->
                <input class="submit" type="submit" name="submit" value="Schedule">
            </form>
        </div>
    </div>
</body>

</html>