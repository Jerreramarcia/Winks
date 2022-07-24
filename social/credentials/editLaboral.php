<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();




$location="";
if (isset($_POST["fin"])){
    $fin =  $_POST["fin"];

}else{$fin = "";}
    if (isset($_POST["inicio"]) and isset($_POST["empresa"]) and isset($_POST["puesto"]) and isset($_POST["id"])){
        $inicio = $_POST["inicio"];
        $inicioAntigua =$_POST["inicioAntigua"];
        $empresa = $_POST["empresa"];
        $empresaAntigua = $_POST["empresaAntigua"];
        $puesto = $_POST["puesto"];
        $puestoAntigua = $_POST["puestoAntigua"];
        $id = $_POST["id"];
        $qry1 = "UPDATE `empresa` SET `nombre` = '$empresa' WHERE id = '$empresaAntigua'";
        mysqli_query($db, $qry1);

        $qry2 = "UPDATE `puesto` SET `nombre` = '$puesto' WHERE id = '$puestoAntigua'";
        mysqli_query($db, $qry2);
        session_start();
        $user = $_SESSION['userID'];

        $qry3 = "UPDATE `experiencia_laboral` SET `anio_inicio` =  '".$inicio."', `anio_fin` =  '".$fin."' WHERE id = $id";

        mysqli_query($db, $qry3);
        header("location:../laboral-information.php");
}else{
        if (isset($_POST["inicio"]) and isset($_POST["empresa"]) and isset($_POST["puesto"]) and isset($_POST["idUser"]) and isset($_POST["userEdit"])){
            $inicio = $_POST["inicio"];
            $inicioAntigua =$_POST["inicioAntigua"];
            $empresa = $_POST["empresa"];
            $empresaAntigua = $_POST["empresaAntigua"];
            $puesto = $_POST["puesto"];
            $puestoAntigua = $_POST["puestoAntigua"];
            $id = $_POST["idUser"];
            $user = $_POST["userEdit"];
            $qry1 = "UPDATE `empresa` SET `nombre` = '$empresa' WHERE id = '$empresaAntigua'";
            mysqli_query($db, $qry1);

            $qry2 = "UPDATE `puesto` SET `nombre` = '$puesto' WHERE id = '$puestoAntigua'";
            mysqli_query($db, $qry2);


            $qry3 = "UPDATE `experiencia_laboral` SET `anio_inicio` =  '".$inicio."', `anio_fin` =  '".$fin."' WHERE id = $id";

            mysqli_query($db, $qry3);
            header("location:../laboral-informationUser.php?user=$user");
        }
    }
