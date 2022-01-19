<?php
session_start();
unset($_SESSION['Username']);
header("Location: index.php");
?>