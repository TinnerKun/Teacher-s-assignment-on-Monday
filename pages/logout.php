<?php
// start session
session_start();

// check session
if(!isset($_SESSION['id'])) return header('Location: login.php');

// destroy session
session_destroy();

// redirect to login
header('Location: login.php');
?>
