<?php
//Conexion

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_php';

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

//Inciar la sesion
if (!isset($_SESSION)) {
    session_start();
}
