<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();



session_start();
$location="";
if (isset($_POST["fin"])){
    $fin =  $_POST["fin"];

}else{$fin = "";}
if (isset($_POST["inicio"]) and isset($_POST["titulacion"]) and isset($_POST["centro"]) and isset($_POST["id"])){
    $inicio = $_POST["inicio"];
    $inicioAntigua =$_POST["inicioAntigua"];
    $titulacion = $_POST["titulacion"];
    $titulacionAntigua = $_POST["titulacionAntigua"];
    $centro = $_POST["centro"];
    $centroAntigua = $_POST["centroAntigua"];
    $id = $_POST["id"];
    $qry1 = "UPDATE `titulacion` SET `nombre` = '$titulacion' WHERE id = '$titulacionAntigua'";
    mysqli_query($db, $qry1);

    $qry2 = "UPDATE `centro_formativo` SET `nombre` = '$centro' WHERE id = '$centroAntigua'";
    mysqli_query($db, $qry2);
    $user = $_SESSION['userID'];

    $qry3 = "UPDATE `formacion` SET `anio_inicio` =  '".$inicio."', `anio_fin` =  '".$fin."' WHERE id = $id";

    mysqli_query($db, $qry3);
    header("location:../formacion-information.php");
}else{
    if (isset($_POST["inicio"]) and isset($_POST["titulacion"]) and isset($_POST["centro"]) and isset($_POST["idUser"])){
        $inicio = $_POST["inicio"];
        $inicioAntigua = $_POST["inicioAntigua"];
        $titulacion = $_POST["titulacion"];
        $titulacionAntigua = $_POST["titulacionAntigua"];
        $centro = $_POST["centro"];
        $centroAntigua = $_POST["centroAntigua"];
        $id = $_POST["idUser"];
        $user = $_POST["userEdit"];

        $qry1 = "UPDATE `titulacion` SET `nombre` = '$titulacion' WHERE id = '$titulacionAntigua'";
        mysqli_query($db, $qry1);

        $qry2 = "UPDATE `centro_formativo` SET `nombre` = '$centro' WHERE id = '$centroAntigua'";
        mysqli_query($db, $qry2);

        $qry3 = "UPDATE `formacion` SET `anio_inicio` =  '".$inicio."', `anio_fin` =  '".$fin."' WHERE id = $id";

        mysqli_query($db, $qry3);
        header("location:../formacion-informationUser.php?user=$user");
    }
}
