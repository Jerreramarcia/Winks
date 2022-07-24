<?php
require_once("../class/database.php");
require_once("../class/user.php");


$db = new Database();
$db = $db->connect();




if (isset($_POST["id"])){
    $inicio = $_POST["id"];
    $qry3 = "DELETE FROM `formacion` WHERE id = $inicio";

    mysqli_query($db, $qry3);
    header("location:../formacion-information.php");
}else{
    if (isset($_POST["idUser"])){
        $user = $_POST["userEdit"];
        $inicio = $_POST["idUser"];
        $qry3 = "DELETE FROM `formacion` WHERE id = $inicio";

        mysqli_query($db, $qry3);
        header("location:../formacion-informationUser.php?user=$user");
    }
}

