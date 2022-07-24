<?php
require_once "database.php";
class friendship
{
    function createFriendship($idUserAsk, $idUserAsked){
        $qry = "INSERT INTO `peticion_amistad`(`id_solicitante`, `id_receptor`) VALUES ($idUserAsk,$idUserAsked)";
        $db = new Database();
        $db = $db->connect();
        $petition = mysqli_query($db,$qry);
        if ($petition){
            return true;
        }else{
            return false;
        }

    }
    function deleteFriendship($idUserAsk, $idUserAsked){

    }
    function deletePeticion($idUserAsk, $idUserAsked){

    }
    function denegateFriendship($idUserAsk, $idUserAsked){
        $db = new Database();
        $db = $db->connect();
        $date =getdate();
        $date2 = $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"];

        $qry = "UPDATE `peticion_amistad` SET `f_rechazo`= '$date2' WHERE `id_solicitante`= $idUserAsk AND `id_receptor`= $idUserAsked";
        $setter = mysqli_query($db,$qry);
        if ($setter){
            return "true";
        }else{
            return "false";
        }
    }
    function acceptFriendship($idUserAsk, $idUserAsked){
        $db = new Database();
        $db = $db->connect();
        $date =getdate();
        $date2 = $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"];

        $qry = "UPDATE `peticion_amistad` SET `f_aceptado`= '$date2' WHERE `id_solicitante`= $idUserAsk AND `id_receptor`= $idUserAsked";
        $setter = mysqli_query($db,$qry);
        if ($setter){
            return "true";
        }else{
            return "false";
        }
    }

    function DeleteFriendshipAsk($idUserAsk, $idUserAsked){
        $db = new Database();
        $db = $db->connect();

        $qry = "DELETE FROM `peticion_amistad` WHERE `id_solicitante`= $idUserAsk AND `id_receptor`= $idUserAsked";
        $qry2 = "DELETE FROM `peticion_amistad` WHERE `id_receptor`= $idUserAsk AND `id_solicitante`= $idUserAsked";
        $setter = mysqli_query($db,$qry);
        $setter2 = mysqli_query($db,$qry2);
        if ($setter and $setter2){
            return $qry;
        }else{
            return "false";
        }
    }



}