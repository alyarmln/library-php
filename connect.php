<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost; dbname=onlinelibrary", "root", "");
$conn = mysqli_connect("localhost", "root", "", "onlinelibrary");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
// function p($x, $b = false) {
//     echo '<pre>';
//     print_r($x);
//     echo '</pre>';
//     if (!$b) {
//         die();
//     }
// }

// // display error of sql/ php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

?>