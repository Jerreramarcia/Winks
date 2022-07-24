<?php
require_once("../class/user.php");

if (isset($_POST["userID"]) and isset($_POST["usuarioAmigo"])){
    $user = new User();
    $array = $user->getMessages($_POST["usuarioAmigo"],$_POST["userID"]);
    foreach ($array as &$msg){

        $msg[1] = $user->getName2($msg[1]);
        $msg[2] = $user->getName2($msg[2]);
    }
    echo json_encode($array);
}




