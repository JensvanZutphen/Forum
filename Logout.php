<?php
session_start();
$_SESSION['loggedin'] = false;
$_SESSION['Administrator'] = false;
header("Location: Login.php");
?>