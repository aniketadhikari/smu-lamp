<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
}else{
    $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Start of header -->
    <?php include 'components/user_header.php' ?>
    <!-- End of header -->
    

    <!-- Start of footer -->
    <?php include 'components/user_footer.php' ?>
    <!-- End of footer -->

    <script src="js/script.js"></script>
</body>
</html>