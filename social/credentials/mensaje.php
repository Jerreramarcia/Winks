<?php
require_once("../class/user.php");

if (isset($_POST["msg"]) and isset($_POST["receptor"])){
    $user = new User();
    session_start();
    $user->createMessage($_POST["receptor"],$_SESSION["userID"],$_POST["msg"]);
}




