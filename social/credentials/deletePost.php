<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


$post = $_POST["idPost"];

if (isset($post)){

    $qry3 = "DELETE FROM `publicacion` WHERE id = $post";

    mysqli_query($db, $qry3);
}
