<?php
require_once "../class/user.php";
require_once "../class/database.php";

$jsondata = array();

//login usuarios
if(isset($_POST["username"]) and isset($_POST["password"])){
    $db = new Database();
    $user = new User();

    $confirmation = $user->checkCredentials($_POST["username"],$_POST["password"],$db);
    $isAdmin = $user->checkAdmin($_POST["username"]);

    if($confirmation != false){
        session_start();
        $_SESSION["userID"] = $confirmation;
        if ($isAdmin == true){
            $_SESSION["admin"] = true;
        }

        if ($confirmation == "baja"){
            echo $confirmation;
        }else{
            echo "true";
        }

    }else{
        echo "ERROR!";
    }

}else{//Creacion de usuariose

    if (isset($_POST["user_name"]) && isset($_POST["user_username"]) && isset($_POST["user_email"]) && isset($_POST["user_passwd"]) && isset($_POST["user_birthdate"])){

        $userInfo = $_POST["user_name"];
        $username = $_POST["user_username"];
        $email = $_POST["user_email"];
        $passwd = $_POST["user_passwd"];
        $birthdate = $_POST["user_birthdate"];
        $code = $_POST["code"];

        $user = new User();
        $db = new Database();
        $createUser = $user->checkCredentialsRegister($username,$email,$db);
        $admin = $user->checkAdminCode($code);
        if ($admin == "true"){
            $isAdmin = 1;
        }else{$isAdmin = 0;}

        if ($createUser == true) {
            $createUser = $user->createUser($userInfo, $username, $email, $passwd, $birthdate, $db,$isAdmin);
            echo "true";
        }
        echo "false";

    }else{
        if (isset($_GET["closeSession"])){
            session_start();
            session_destroy();
            header("Location: ../../");
        }else{
            echo "false";
        }
    }

}

?>