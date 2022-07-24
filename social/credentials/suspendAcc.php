<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


if (isset($_POST["idUser"])){

    $qry3 = "UPDATE `users` SET `fecha_baja`='".date("Y-m-d")."' WHERE `id` = ".$_POST["idUser"];

    mysqli_query($db, $qry3);

}
