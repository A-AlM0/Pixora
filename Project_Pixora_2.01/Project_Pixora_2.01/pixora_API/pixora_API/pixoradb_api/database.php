<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pixora';

$conn = mysqli_connect( $host, $username, $password, $dbname);

if(!$conn) die ("ERROR: cannot connect to the database");

 ?>
