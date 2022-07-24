<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


$inicio = $_POST["comment"];

if (isset($inicio)){

    $qry3 = "DELETE FROM `comentario` WHERE id = $inicio";

    mysqli_query($db, $qry3);
}

