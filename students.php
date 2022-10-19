<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['professor_name'])){
    header('location:index.php'); // if not logged in, redirect and go back to home page
 }

    $select = "SELECT * FROM Users";
    $result = mysqli_query($conn, $select);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

    print_r($courses)
?>