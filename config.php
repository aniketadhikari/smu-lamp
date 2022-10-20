<?php
// $serverName = "DESKTOP-SBLDPJ4\SQLEXPRESS";
// $connectionInfo = array("Database"=>"SMU", "UID"=>"aniketsmu", "PWD"=>"aniketsmu");
// $conn = sqlsrv_connect($serverName, $connectionInfo);


// connect to localhost server, using username root and blank password to connect to 
// database called login_sample_db

$conn = mysqli_connect('localhost','root','','login_sample_db');

if (!$conn) {
    echo "Connection could not be established";
}

?>


