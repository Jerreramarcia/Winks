<?php
require_once "database.php";

class User extends Database
{
    function checkCredentials($username,$password, Database $db){
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT password,id,fecha_baja FROM users WHERE username = '$username' or correo = '".$username."'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);

            if(!is_null($result[2])){
                return "baja";
            }
            if(password_verify($password, $result[0])){
                return $result[1];
            }
        }
        return false;
    }
    function checkDown($username){
        $db = new Database();
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT password,id,fecha_baja FROM users WHERE username = '$username'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);

            if(!is_null($result[2])){
                return "false";
            }
            return "true";
        }
        return "false";

    }
    function checkAdmin($username){
        $db = new Database();
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT rol FROM users WHERE username = '$username' or correo = '$username'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);
            if($result[0] == 1){
                return true;
            }
        }
        return false;

    }

    function createUser($userInfo,$username,$email,$passwd,$birthdate, Database $db,$isAdmin){
        $db = new  Database();
        $db = $db->connect();
        $hash = password_hash($passwd,PASSWORD_DEFAULT);

        $query = "INSERT INTO `users`(`correo`, `username`, `nombre`, `nacimiento`,`password`, `rol`) VALUES ('$email','$username','$userInfo','$birthdate','$hash',$isAdmin)";
        mysqli_query($db, $query);

        return $query;

    }
    function checkCredentialsRegister($username, $email, Database $db){
        $db = new Database();
        $db = $db->connect();

        $query = "SELECT `id` FROM `users` WHERE `username` = '$username' OR `correo` = '$email' AND `fecha_baja`";
        $sameUser = mysqli_query($db, $query);
        $sameUser = mysqli_fetch_array($sameUser);
        if (is_null($sameUser)){
            return true;
        }

            return false;

    }


    function getUserID($username, $db){

        $db = new Database();
        $db = $db->connect();

        $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
        $userID = mysqli_query($db,$query);
        $userID = mysqli_fetch_array($userID);

        if(is_null($userID)){
            return false;
        }else{
            return $userID[0];
        }

    }

    function getUserImage($userID, $db){
        $query1 = "SELECT imagen_perfil FROM users WHERE id = $userID";
        $image = mysqli_query($db,$query1);
        $idImg = mysqli_fetch_array($image);
        $query2 = "SELECT `direccion`,`nombre` FROM `imagen` WHERE `id` = $idImg[0]";
        $image2 = mysqli_query($db,$query2);
        $idImg = mysqli_fetch_array($image2);


        echo $idImg["direccion"].$idImg["nombre"];

    }

    function getName($userID){
        $query = "SELECT `nombre` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }
    function getName2($userID){
        $query = "SELECT `nombre` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            return $userName[0];
        }
    }
    function getUsername($userID){
        $query = "SELECT `username` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getEmail($userID){
        $query = "SELECT `correo` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }
    function getBirthdate($userID){
        $query = "SELECT `nacimiento` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getPais($userID)
    {
        $query = "SELECT `pais` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName) {
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getProvincia($userID){
        $query = "SELECT `provincia` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }
    function getLocalidad($userID){
        $query = "SELECT `localidad` FROM `users` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function  getFriendship($userID, $userSearchID): bool
    {
        $qry = "SELECT `id` FROM `peticion_amistad` WHERE id_solicitante = $userID AND id_receptor = $userSearchID AND f_aceptado IS NOT NULL or id_solicitante = $userSearchID AND id_receptor = $userID AND f_aceptado IS NOT NULL";
        $db = new Database();
        $db = $db->connect();
    
        $friendship = mysqli_query($db,$qry);
        $friendship2 = mysqli_fetch_array($friendship);
    
        if ($friendship2){
            return true;
        }else{return false;}

    }
    function getFriendshipAsked($userID,$userSearchID): bool
    {
        $qry = "SELECT `id` FROM `peticion_amistad` WHERE id_solicitante = $userID AND id_receptor = $userSearchID AND f_aceptado IS NULL or id_solicitante = $userSearchID AND id_receptor = $userID AND f_aceptado IS NULL";
        $db = new Database();
        $db = $db->connect();
        $friendshipAsked = mysqli_query($db,$qry);
        $friendshipAsked2 = mysqli_fetch_array($friendshipAsked);
        if ($friendshipAsked2){
            return true;
        }else{return false;}

    }

    function getFriends($userID){
        $friends = null;

        $qry = "SELECT `id_receptor` FROM `peticion_amistad` WHERE id_solicitante = $userID AND f_aceptado IS NOT NULL";
        $db = new Database();
        $db = $db->connect();
        $friends1= mysqli_query($db, $qry);
        $friends_1 = mysqli_fetch_array($friends1);
        $qry2 = "SELECT `id_solicitante` FROM `peticion_amistad` WHERE id_receptor = $userID AND f_aceptado IS NOT NULL";

        $friends2 = mysqli_query($db, $qry2);
        $friends_2= mysqli_fetch_array($friends2);

        if($friends_1 and $friends_2){
            $friends = array_merge($friends_1,$friends_2);
        }else{
            if ($friends_2 and !$friends_1){
                return $friends_2;
            }else{
                return $friends_1;
            }
        }
        return $friends;
    }

    function mySelfFriend($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT users.id as amistad FROM users WHERE users.id =$userID;";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }
    function PublicacionAmigos($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT peticion_amistad.id_solicitante as amistad FROM peticion_amistad WHERE peticion_amistad.id_receptor = $userID AND peticion_amistad.f_aceptado IS NOT NULL UNION SELECT peticion_amistad.id_receptor as amistad FROM peticion_amistad WHERE peticion_amistad.id_solicitante = $userID AND peticion_amistad.f_aceptado IS NOT NULL UNION SELECT users.id as amistad FROM users WHERE users.id =$userID;";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }
    function FriendsChat($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT peticion_amistad.id_solicitante as amistad FROM peticion_amistad WHERE peticion_amistad.id_receptor = $userID AND peticion_amistad.f_aceptado IS NOT NULL UNION SELECT peticion_amistad.id_receptor as amistad FROM peticion_amistad WHERE peticion_amistad.id_solicitante = $userID AND peticion_amistad.f_aceptado IS NOT NULL;";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }
    function getImgRoute($imgID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT * FROM imagen WHERE id = $imgID";
        $friends = mysqli_query($db, $qry);
        $data = mysqli_fetch_array($friends);
        return $data["nombre"];
    }

    function getFriendRequest($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT peticion_amistad.id_solicitante as amistad FROM peticion_amistad WHERE peticion_amistad.id_receptor = $userID AND peticion_amistad.f_aceptado IS NULL AND peticion_amistad.f_rechazo IS NULL";
        $exec = mysqli_query($db, $qry);
        return mysqli_fetch_all($exec);
    }

    function getMessages($IDamigo, $IDme){
        $db = new Database();
        $db = $db->connect();
        $qry1 = "SELECT * FROM mensaje WHERE id_receptor = $IDme AND id_emisor= $IDamigo UNION SELECT *  FROM mensaje WHERE id_receptor = $IDamigo AND id_emisor=$IDme ORDER BY fecha_envio ASC";

        $exec = mysqli_query($db, $qry1);
        $qry1 = "SELECT * FROM mensaje WHERE id_receptor = $IDme AND id_emisor= $IDamigo UNION SELECT *  FROM mensaje WHERE id_receptor = $IDamigo AND id_emisor=$IDme ORDER BY fecha_envio ASC";
        $pc = mysqli_query($db,$qry1);
        $data = mysqli_fetch_all($pc);
        foreach ($data as $message){
            $newqry = "UPDATE mensaje SET fecha_llegada = '".date("Y-m-d h:i:s")."' WHERE id = ".$message[0]." AND fecha_llegada IS NULL AND id_receptor = $IDme";
            mysqli_query($db,$newqry);
        }

        return mysqli_fetch_all($exec);

    }
    function getIncoming($IDme, $IDamigo){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT COUNT(id) as msj FROM mensaje WHERE id_receptor = $IDme AND id_emisor= $IDamigo AND fecha_llegada IS NULL";
        $salida = mysqli_query($db,$qry);
        return mysqli_fetch_array($salida);
    }

    function createMessage($IDamigo, $IDme, $mensaje){
        $db = new Database();
        $db = $db->connect();
        $qry = "INSERT INTO `mensaje`(`id_emisor`, `id_receptor`, `mensaje`) VALUES ($IDme,$IDamigo,'$mensaje')";
        mysqli_query($db, $qry);
        return $qry;
    }

    function getLaboral($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT * FROM experiencia_laboral WHERE id_usuario = $userID";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }
    function getFormacion($userID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT * FROM formacion WHERE id_usuario = $userID";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }
    function getComments($pubID){
        $db = new Database();
        $db = $db->connect();
        $qry = "SELECT * FROM comentario WHERE id_publicacion = $pubID";
        $friends = mysqli_query($db, $qry);
        return mysqli_fetch_all($friends);
    }

    function getEmpresa($userID){
        $query = "SELECT `nombre` FROM `empresa` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }
    function getImageID($id){
        $query = "SELECT `imagen_perfil` FROM `users` WHERE `id` = $id";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getPuesto($userID){
        $query = "SELECT `nombre` FROM `puesto` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getTitulacion($userID){
        $query = "SELECT `nombre` FROM `titulacion` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getCentroFormativo($userID){
        $query = "SELECT `nombre` FROM `centro_formativo` WHERE `id` = $userID";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getNumComments($idPub){
        $query = "SELECT COUNT(id) as comments from comentario WHERE `id_publicacion` = $idPub";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_array($userName);
            echo $userName[0];
        }
    }

    function getNumFriends($idUser){
        $query = "SELECT count(peticion_amistad.id_solicitante) as amistad FROM peticion_amistad WHERE peticion_amistad.id_receptor = $idUser AND peticion_amistad.f_aceptado IS NOT NULL UNION SELECT count(peticion_amistad.id_solicitante) as amistad FROM peticion_amistad WHERE peticion_amistad.id_solicitante = $idUser AND peticion_amistad.f_aceptado IS NOT NULL;";
        $db = new Database();
        $db = $db->connect();

        $userName = mysqli_query($db, $query);

        if ($userName){
            $userName = mysqli_fetch_all($userName);
            $count = 0;
            foreach ($userName as $user){
                $count +=$user[0];
            }
            return $count;
        }
    }

    function comentar($mensaje, $idPublicacion, $idUsuario){
        $query = "INSERT INTO `comentario`(`id_publicacion`, `id_usuario`, `texto`) VALUES ($idPublicacion,$idUsuario,'$mensaje')";
        $db = new Database();
        $db = $db->connect();
        mysqli_query($db,$query);
        return $db->insert_id;
    }

    function checkAdminCode($code){
        $query = "SELECT count(id) as admin FROM admincodes WHERE adminCode='".$code."'";
        $db = new Database();
        $db = $db->connect();

        $admin = mysqli_query($db, $query);
        $admin2 = mysqli_fetch_array($admin);
        if ($admin2[0] >=1){
            return "true";
        }
        return "false";
    }
    function checkAlias($username){
        $db = new Database();
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT count(id) as numUs FROM users WHERE username = '$username'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);
            if($result[0] == 0){
                return "false";
            }
        }
        return "true";
    }
    function checkPassword($id, $password){
        $db = new Database();
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT password as numUs FROM users WHERE id = '$id'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);
            if(password_verify($password, $result[0])){
                return "true";
            }
        }
        return "false";
    }
    function checkEmail($email){
        $db = new Database();
        $db = $db->connect();
        $userInfo = mysqli_query($db,"SELECT count(id) as numUs FROM users WHERE correo = '$email'");
        if ($userInfo){
            $result = mysqli_fetch_array($userInfo);
            if($result[0] == 0){
                return "false";
            }
        }
        return "true";
    }

}

