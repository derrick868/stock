<?php
$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$password = getenv("DB_PASS");
$name = getenv("DB_NAME");

$connection = mysqli_connect($host, $user, $password, $name);
?>
