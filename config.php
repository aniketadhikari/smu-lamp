<?php

// connect to localhost server, using username root and blank password to connect to 
// database called login_sample_db
// $conn = mysqli_connect('localhost', 'root', '', 'login_sample_db');
// $conn = mysqli_connect('127.0.0.1','root','EMRslAL8Q8Mj','SMU');

// if (!$conn) {
//     echo "Connection could not be established";
// }
// else if ($conn) {
//     echo "Connection established";
// }

// try {
//     $conn = new PDO("sqlsrv:server = tcp:sqlserver898.database.windows.net,1433; Database = SMU", "azureroot", "smuproject$9");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch (PDOException $e) {
//     print("Error connecting to SQL Server.");
//     die(print_r($e));
// }

// SQL Server Extension Sample Code:


$connectionInfo = array("UID" => "azureroot", "pwd" => "smuproject$9", "Database" => "SMU", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sqlserver898.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

// if (!$conn) {
//     echo "Connection could not be established";
// }
// else if ($conn) {
//     echo "Connection established";
// }

// $server = 'sqlserver898.database.windows.net';
// $port = 1433;
// $user = 'azureroot';
// $pass = 'smuproject$9';
// $db_name = 'SMU';

// $conn = mysqli_init();

// mysqli_real_connect($conn, $server, $user, $pass, $db_name, $port);
// if (mysqli_connect_errno())
// {
//     die('Failed to connect to MySQL: '.mysqli_connect_error());
// }
// ?> 

