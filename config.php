<?php
// $serverName = "DESKTOP-SBLDPJ4\SQLEXPRESS";
// $connectionInfo = array("Database"=>"SMU", "UID"=>"aniketsmu", "PWD"=>"aniketsmu");
// $conn = sqlsrv_connect($serverName, $connectionInfo);


// connect to localhost server, using username root and blank password to connect to 
// database called login_sample_db
// $conn = mysqli_connect('localhost', 'root', '', 'login_sample_db');
$conn = mysqli_connect('127.0.0.1','root','EMRslAL8Q8Mj','SMU');

if (!$conn) {
    echo "Connection could not be established";
}
// else if ($conn) {
//     echo "Connection established";
// }

?>


