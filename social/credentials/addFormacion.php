<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();



$location="";
if (isset($_POST["fin"])){
    $fin =  $_POST["fin"];

}else{$fin = "";}
    if (!isset($_POST["IDuser"])){
        if (isset($_POST["inicio"]) and isset($_POST["empresa"]) and isset($_POST["puesto"])){
            $inicio = $_POST["inicio"];
            $empresa = $_POST["empresa"];
            $puesto = $_POST["puesto"];

            $qry1 = "INSERT INTO `empresa`(`nombre`) VALUES ('$empresa')";
            mysqli_query($db, $qry1);
            $idEmpresa = $db->insert_id;

            $qry2 = "INSERT INTO `puesto`(`nombre`) VALUES ('$puesto')";
            mysqli_query($db, $qry2);
            $idPuesto = $db->insert_id;
                session_start();
            $user = $_SESSION['userID'];

            $qry3 = "INSERT INTO `experiencia_laboral`(`id_usuario`, `anio_inicio`, `anio_fin`, `id_empresa`, `id_puesto`) VALUES ($user, '".$inicio."', '".$fin."', '".$idEmpresa."', '".$idPuesto."')";

            mysqli_query($db, $qry3);
            header("location:../laboral-information.php");
    }
}else{
        if (isset($_POST["inicio"]) and isset($_POST["empresa"]) and isset($_POST["puesto"]) and isset($_POST["IDuser"])){
            $inicio = $_POST["inicio"];
            $empresa = $_POST["empresa"];
            $puesto = $_POST["puesto"];
            $user = $_POST['IDuser'];

            $qry1 = "INSERT INTO `empresa`(`nombre`) VALUES ('$empresa')";
            mysqli_query($db, $qry1);
            $idEmpresa = $db->insert_id;

            $qry2 = "INSERT INTO `puesto`(`nombre`) VALUES ('$puesto')";
            mysqli_query($db, $qry2);
            $idPuesto = $db->insert_id;
            session_start();

            $qry3 = "INSERT INTO `experiencia_laboral`(`id_usuario`, `anio_inicio`, `anio_fin`, `id_empresa`, `id_puesto`) VALUES ($user, '".$inicio."', '".$fin."', '".$idEmpresa."', '".$idPuesto."')";

            mysqli_query($db, $qry3);
            header("location:../laboral-informationUser.php?user=$user");
        }
    }

