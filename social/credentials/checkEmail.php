<?php
require_once "../class/user.php";
require_once "../class/database.php";


$user = new User();
echo "".$user->checkEmail($_POST["emailUser"]);
