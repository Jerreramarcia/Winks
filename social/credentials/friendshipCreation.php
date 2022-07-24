<?php
require_once "../class/friendship.php";
if(isset($_POST["userIDCancel"])){
    $friend = new friendship();
    session_start();
    echo $friend->denegateFriendship($_POST["userIDCancel"],$_SESSION["userID"]);


}else{
    if(isset($_POST["userIDAccept"])) {
        $friend = new friendship();
        session_start();
        echo $friend->acceptFriendship($_POST["userIDAccept"], $_SESSION["userID"]);
    }else{
        if (isset($_POST["userAskID"]) and isset($_POST["userAskedID"])){

            $userAskID   = $_POST["userAskID"];
            $userAskedID = $_POST["userAskedID"];
            $friend = new friendship();
            $friend->createFriendship($userAskID,$userAskedID);

            echo "true";
        }else{
            echo "false";
        }
    }
}
    if (isset($_POST["deleteFriend"]) and isset($_POST["FriendUser"])){
        session_start();
        $deleteFrom = $_SESSION["userID"];
        $deleteTo = $_POST["FriendUser"];
        $friend = new friendship();
        echo $friend->DeleteFriendshipAsk($deleteFrom,$deleteTo);

    }


?>
