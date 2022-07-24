<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();
$user = new User();
echo $user->getIncoming($_POST["IDme"], $_POST["IDamigo"])[0];
