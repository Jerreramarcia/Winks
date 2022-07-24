<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


$idImagen = $_POST["id"];
session_start();
if (isset($idImagen)){

    $qry3 = "UPDATE `users` SET `imagen_perfil`='".$idImagen."' WHERE `id` = ".$_SESSION["userID"];

    mysqli_query($db, $qry3);

}
