<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


$nacimiento = $_POST["nacimiento"];
$username = $_POST["username"];
$nombre = $_POST["nombre"];
$email = $_POST["email"];
session_start();
$location="";
if (isset($_POST["municipio"])){
    $provincia = $_POST["provincia"];
    $municipio = $_POST["municipio"];
    $pais =  $_POST["pais"];

    $location = "   , `localidad`='$municipio',`provincia`='$provincia',`pais`='$pais' ";
}

$qry = "UPDATE `users` SET `correo`='$email',`username`='$username',`nombre`='$nombre',`nacimiento`='$nacimiento'". $location." WHERE id= ".$_SESSION["userID"];
mysqli_query($db, $qry);

header("location:../account-information.php");