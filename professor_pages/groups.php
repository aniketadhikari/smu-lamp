<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}

$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}
mysqli_free_result($result);
if (isset($_POST['submit'])) {

    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_name']));
    $group_id = intval(mysqli_real_escape_string($conn, $_POST['group_id']));

    // Make sure student exists otherwise update the table
    $find_student = "SELECT * FROM Student WHERE StudentID = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    if (mysqli_num_rows($find_student_result) == 0) {
        $error[] = 'Student does not exist';
    } else {
        $update = "UPDATE Student SET GroupID=$group_id WHERE StudentID = $student_id;";
        mysqli_query($conn, $update);
    }

    header('location:groups.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Student Groups</title>
</head>

<body class="professor-body">
    <?php include '../templates/professor_nav.php' ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Assign Student Groups</h4>
    </div>
    <div class="container">
        <form action="" method="post">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <label for="student_name">Select Student:</label>
            <select name="student_name" id="student_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <div>
                <label for="group_id">Enter Group ID:</label>
                <br>
                <input type="" minlength="1" maxlength="2" name="group_id" required placeholder="Enter Number">
            </div>
            <br>
            <input class="btn blue darken-4" type="submit" name="submit" value="Assign Group">
        </form>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="row">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email <?php echo ' ' . ' '?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mailbox2" viewBox="0 0 16 16">
                                    <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z" />
                                    <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z" />
                                </svg> </th>
                        <th>Phone <?php echo ' ' . ' '?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($students as $student) {
                    ?>
                        <tr class="hoverable">
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
    </div>
</body>

</html>