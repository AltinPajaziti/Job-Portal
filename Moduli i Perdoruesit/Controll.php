<?php
session_start();
include('config.php');
if (!isset($_SESSION['emri'])) {
    header("Location: index.php");
    exit();
}



?>