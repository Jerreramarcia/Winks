<?php
require_once("../class/user.php");

$user = new User();
session_start();
echo $user->comentar($_POST["msg"],$_POST["idPub"], $_SESSION["userID"]);


