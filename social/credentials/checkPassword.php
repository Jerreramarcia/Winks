<?php
require_once "../class/user.php";
require_once "../class/database.php";


$user = new User();
session_start();
echo "".$user->checkPassword($_SESSION["userID"], $_POST["password"]);
