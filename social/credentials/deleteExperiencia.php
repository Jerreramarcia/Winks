<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();



if (isset($_POST["id"])){

    $inicio =$_POST["id"];

    $qry3 = "DELETE FROM `experiencia_laboral` WHERE id = $inicio";

    mysqli_query($db, $qry3);
    header("location:../laboral-information.php");
}else{
    if (isset($_POST["idUser"]) and isset($_POST["userEdit"])){

        $inicio =$_POST["idUser"];
        $user = $_POST["userEdit"];
        $qry3 = "DELETE FROM `experiencia_laboral` WHERE id = $inicio";

        mysqli_query($db, $qry3);
        header("location:../laboral-informationUser.php?user=$user");
    }
}

