<?php session_start(); ?>
<?php
$_SESSION['user_id'] = null;
$_SESSION['username'] = null;


header("Location:index.php");
?>