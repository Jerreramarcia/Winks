<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();


$inicio = $_POST["inicio"];
$titulacion = $_POST["titulacion"];
$centro = $_POST["centro"];
session_start();
$location="";
if (isset($_POST["fin"])){
    $fin =  $_POST["fin"];

}else{$fin = "";}
if (!isset($_POST["IDuser"])){
    if (isset($inicio) and isset($titulacion) and isset($centro)){
        $qry1 = "INSERT INTO `titulacion`(`nombre`) VALUES ('$titulacion')";
        mysqli_query($db, $qry1);
        $idTitulacion = $db->insert_id;

        $qry2 = "INSERT INTO `centro_formativo`(`nombre`) VALUES ('$centro')";
        mysqli_query($db, $qry2);
        $idCentro = $db->insert_id;
        $user = $_SESSION['userID'];

        $qry3 = "INSERT INTO `formacion`(`id_usuario`, `anio_inicio`, `anio_fin`, `id_titulacion`, `id_centro`) VALUES ($user, '".$inicio."', '".$fin."', '".$idTitulacion."', '".$idCentro."')";

        mysqli_query($db, $qry3);
        header("location:../formacion-information.php");
    }
}else{

    if (isset($inicio) and isset($titulacion) and isset($centro)){
        $qry1 = "INSERT INTO `titulacion`(`nombre`) VALUES ('$titulacion')";
        mysqli_query($db, $qry1);
        $idTitulacion = $db->insert_id;

        $qry2 = "INSERT INTO `centro_formativo`(`nombre`) VALUES ('$centro')";
        mysqli_query($db, $qry2);
        $idCentro = $db->insert_id;
        $user = $_POST["IDuser"];

        $qry3 = "INSERT INTO `formacion`(`id_usuario`, `anio_inicio`, `anio_fin`, `id_titulacion`, `id_centro`) VALUES ($user, '".$inicio."', '".$fin."', '".$idTitulacion."', '".$idCentro."')";

        mysqli_query($db, $qry3);
        header("location:../formacion-informationUser.php?user=$user");
    }
}
