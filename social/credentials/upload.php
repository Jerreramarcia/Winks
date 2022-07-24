<?php

require_once("../class/database.php");
$db = new Database();
$db = $db->connect();
session_start();

$targetDir = "../usersImage/";
// File upload configuration
$allowTypes = array('jpg','png','jpeg','gif');

$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
$fileNames = array_filter($_FILES['file']['name']);
$message = $_POST["message"];
if(!empty($fileNames)){


    //IMAGEN + MENSAJE
    if($_POST["message"] != ""){
        $inserted = $db->query("INSERT INTO `publicacion`(`id_autor`, `contenido`) VALUES ($_SESSION[userID],'$message')");
        echo $inserted;
        //IMAGEN - MENSAJE

    }else{
        $inserted = $db->query("INSERT INTO `publicacion` (`id_autor`, `contenido`) VALUES ($_SESSION[userID],'')");
        echo $inserted;
    }

    $lastPublic = $db->insert_id;


    foreach($_FILES['file']['name'] as $key=>$val){
        // Ruta del archivo

        $sets = array_merge(range(0, 9), range('a', 'z'));
        $newName = '';
        for ($i = 0; $i < 9; $i++) {
            $newName .= $sets[array_rand($sets)];
        }

        $userName = strval($_SESSION["userID"]);
        $date = new DateTime();
        $dateName = strval($date->getTimestamp());
        $type = pathinfo($_FILES['file']['name'][$key],PATHINFO_EXTENSION);
        $fileName = $userName."_".$newName.".".$type;
        $targetFilePath = $targetDir . $fileName;
        // Comprobar el tipo de archivo
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Subimos la imagen al servidor
            if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){

                $insertValuesSQL .= "('".$fileName."', NOW()),";
            }else{
                $errorUpload .= $_FILES['file']['name'][$key].' | ';
            }
        }else{
            $errorUploadType .= $_FILES['file']['name'][$key].' | ';
        }


        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database
            $insert = $db->query("INSERT INTO imagen (nombre, direccion,id_usuario) VALUES ('".$fileName. "', 'usersImage/', $_SESSION[userID])");
            $lastImage = $db->insert_id;
            $insertImages = $db->query("INSERT INTO `imagen_publicacion` (`id_publicacion`, `id_imagen`) VALUES ($lastPublic,$lastImage)");
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }
}else{
//MENSAJE - SIN FOTOS
    if($_POST["message"]!= ""){
        $message = $_POST["message"];

        $insert = $db->query("INSERT INTO `publicacion`(`id_autor`, `contenido`) VALUES ($_SESSION[userID],'$message')");
    }
}

// Mensaje status
header("Location: ../default.php");

?>
