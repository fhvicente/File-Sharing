<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "repositorio";

$conn = mysqli_connect($host, $user, $pass, $db);

if($conn === false) {
    echo "Ocorreu um erro com a conexão";
} 
