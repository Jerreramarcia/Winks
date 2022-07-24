<?php
require_once "../class/user.php";
require_once "../class/database.php";


$user = new User();
session_start();

$me = $_SESSION["userID"];
$pass = $_POST["password"];
$db = new Database();
$db = $db->connect();
$hash = password_hash($pass,PASSWORD_DEFAULT);
$qry = "UPDATE `users` SET `password`='$hash' WHERE `id` = '$me'";
$db->query($qry);
return true;