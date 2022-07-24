<?php
session_start();
require_once("class/user.php");
$user = new User();
$friendship = true;
$friendshipAsked = true;
$db = new Database();
$db = $db->connect();
$userSerch = $_SESSION["userID"];

if (!isset($_SESSION["userID"])){
    header("Location: login.html");

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winks - La red social más fresca</title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logos/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/emoji.css">
    <link rel="stylesheet" href="css/publicacion.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/lightbox.css">

    <!-- JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <!--
        RTL version
    -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
</head>

<body class="color-theme-blue mont-font">

<div class="preloader"></div>


<div class="main-wrapper">

    <!-- navigation top-->
    <div class="nav-header bg-white shadow-xs border-0">
        <div class="nav-top">
            <a href="default.php"><img src="images/logos/logo.png" style="max-width: 20%"></img><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Winks </span> <?php if (isset($_SESSION["admin"])){?><div>plus</div><?php } ?> </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <button class="nav-menu me-0 ms-2"></button>
        </div>

        <form action="buscador.php" method="GET" class="float-left header-search">
            <div class="form-group mb-0 icon-input">
                <i class="feather-search font-sm text-grey-400"></i>
                <input type="text" name="user" id="buscador" placeholder="Buscar amigos.." class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
            </div>
        </form>

        <i  class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i class="feather-message-square font-xl text-current"></i></a>

        <a href="default-settings.php" class="p-0 ms-3 menu-icon"><img style="width:40px;height: 40px; object-fit: cover;" src=
            <?php
            $db = new Database();
            $db = $db->connect();
            $user = new User();
            $user->getUserImage($_SESSION["userID"],$db);

            ?>
            alt="user" class="w40 mt--1"></a>

    </div>
    <!-- navigation top -->

    <!-- navigation left -->
    <nav class="navigation scroll-bar">
        <div class="container ps-0 pe-0">
            <div class="nav-content">
                <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2">
                    <div class="nav-caption fw-600 font-xssss text-grey-500"><span>Feed </span></div>
                    <ul class="mb-1 top-content">
                        <li class="logo d-none d-xl-block d-lg-block"></li>
                        <li><a href="default.php" class="nav-content-bttn open-font" ><i class="feather-tv btn-round-md bg-blue-gradiant me-3"></i><span>Publicaciones</span></a></li>
                        <li><a href="profile.php" class="nav-content-bttn open-font"><i class="feather-user btn-round-md bg-primary-gradiant me-3"></i><span>Mi perfil </span></a></li>
                    </ul>
                </div>

                <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
                    <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Cuenta</div>
                    <ul class="mb-1">
                        <li class="logo d-none d-xl-block d-lg-block"></li>
                        <li><a href="default-settings.php" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-settings me-3 text-grey-500"></i><span>Ajustes</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- navigation left -->

    <script>
        var mostrar = 0;
        function showComments(mostrarCom){
            if (mostrar == 0){
                document.getElementById("comentarios-"+mostrarCom).removeAttribute("hidden");
                mostrar = 1;
            }else {
                document.getElementById("comentarios-"+mostrarCom).setAttribute("hidden","true");
                mostrar = 0;
            }
        }
    </script>
    <!-- main content -->
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">
                            <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3"></div>
                            <div class="card-body p-0 position-relative">
                                <figure class="avatar position-absolute w100 z-index-1" style="top:-40px; left: 30px;"><img style="width:100px;height: 100px; object-fit: cover;" src="
                                    <?php

                                    $user->getUserImage($_SESSION["userID"],$db);

                                    ?>
                                    " alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>

                                <h4 class="fw-700 font-sm mt-2 mb-lg-5 mb-4 pl-15"><?php $user->getName($_SESSION["userID"],$db)?><span class="fw-500 font-xssss text-grey-500 mt-1 mb-3 d-block"><?php echo $user->getUsername($_SESSION["userID"]);?></span></h4>
                                <div id="friendADD" class="d-flex align-items-center justify-content-center position-absolute-md right-15 top-0 me-2">



                                </div>
                            </div>
                            <script>
                                var formacion_in = true;
                                var experiencia_in = true;
                                function amigos(){
                                }

                                function formacion(){
                                    if (formacion_in == true) {
                                        document.getElementById("experiencia").setAttribute("hidden", true);
                                        document.getElementById("experienciaBtn").classList.remove("active");

                                        document.getElementById("formacion").removeAttribute("hidden");
                                        document.getElementById("formacionBtn").classList.add("active");
                                        formacion_in = true;
                                    }else{
                                        document.getElementById("formacion").setAttribute("hidden", true);
                                        document.getElementById("formacionBtn").classList.remove("active");

                                        formacion_in = false;
                                    }



                                }
                                function experiencia(){
                                    if(experiencia_in == true){
                                        document.getElementById("formacion").setAttribute("hidden", true);
                                        document.getElementById("formacionBtn").classList.remove("active");

                                        document.getElementById("experiencia").removeAttribute("hidden");
                                        document.getElementById("experienciaBtn").classList.add("active");
                                        experiencia_in = true;
                                    }else{
                                        document.getElementById("experiencia").setAttribute("hidden", true);
                                        document.getElementById("experienciaBtn").classList.remove("active");
                                        experiencia_in = false;
                                    }

                                }
                                function deletePub(val){
                                    $("#PubCom-"+val).fadeOut(300, function(){ $("#PubCom-"+val).remove();});
                                    $.ajax({
                                        type: "POST",
                                        url: "credentials/deletePost.php",
                                        data: {idPost : val},
                                        success: function (resolve) {
                                        }
                                    });
                                }


                            </script>

                            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                                    <li class="active list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" id="formacionBtn" href="#navtabs2" data-toggle="tab" onclick="formacion()">Formación</a></li>
                                    <li class="active list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" id="experienciaBtn" href="#navtabs3" data-toggle="tab" onclick="experiencia()">Experiencia Laboral</a></li>
                                    <li class="active list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="<?php if ($friendship){ echo "amigos.php?user=".$userSerch;}?>" data-toggle="tab" onclick="amigos()"><?php if ($friendship){echo $user->getNumFriends($userSerch);} ?> Amigos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">-->
                    <div style="width: 35%;">
                        <br>


                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <!--Mostrar About-->

                            <?php

                            if (isset($_SESSION["admin"])){
                                $friendship = true;
                            }

                            $formacion = $user->getFormacion($userSerch);

                            ?>

                            <div id="formacion" hidden>
                                <div class="card-body d-block p-4">
                                    <h4 class="fw-700 mb-3 font-xsss text-grey-900">Formacion</h4>
                                </div>
                                <?php
                                if ($friendship != true){
                                    ?>
                                    <div class="card-body d-flex pt-0">
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php if ($formacion){ echo $user->getTitulacion($formacion[0]["2"]);?> - <?php echo $user->getCentroFormativo($formacion[0]["3"]); }?></h4>
                                        <div style="margin-left: 10px;"></div>
                                        <h4 class="fw-500 text-grey-500 lh-24 font-xssss mb-0"><?php if ($formacion){ echo $formacion[0][4];?> - <?php if($formacion[0][5] != "0000-00-00"){echo $formacion[0][5];}else{echo " Presente";}; }?></h4>
                                    </div>
                                    <?php
                                }else{
                                    foreach ($formacion as $form){
                                        ?>

                                        <div class="card-body d-flex pt-0">
                                            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php if ($form){ echo $user->getTitulacion($form["2"]);?> - <?php echo $user->getCentroFormativo($form["3"]); }?></h4>
                                            <div style="margin-left: 10px;"></div>
                                            <h4 class="fw-500 text-grey-500 lh-24 font-xssss mb-0"><?php if ($form){ echo $form[4];?> - <?php if($form[5] != "0000-00-00"){echo $form[5];}else{echo " Presente";}; }?></h4>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <!--Fin About-->


                            <div id="experiencia" hidden>
                                <div class="card-body d-block p-4">
                                    <h4 class="fw-700 mb-3 font-xsss text-grey-900">Experiencia</h4>
                                </div>
                                <?php
                                $laboral = $user->getLaboral($userSerch);
                                if ($friendship != true){
                                    ?>
                                    <div class="card-body d-flex pt-0">
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php if ($laboral){ echo $user->getEmpresa($laboral[0]["4"]); ?> - <?php echo $user->getPuesto($laboral[0]["5"]); }?></h4>
                                        <div style="margin-left: 10px;"></div>
                                        <h4 class="fw-500 text-grey-500 lh-24 font-xssss mb-0"><?php if ($laboral){ echo $laboral[0][2];?> - <?php if($laboral[0][3] != "0000-00-00"){echo $laboral[0][3];}else{echo " Presente";}; }?></h4>
                                    </div>
                                    <?php
                                }else{

                                    foreach ($laboral as $lab){

                                        ?>
                                        <div class="card-body d-flex pt-0">
                                            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php if ($lab){ echo $user->getEmpresa($laboral[0]["4"]);?> - <?php echo $user->getPuesto($laboral[0]["5"]); }?></h4>
                                            <div style="margin-left: 10px;"></div>
                                            <h4 class="fw-500 text-grey-500 lh-24 font-xssss mb-0"><?php if ($laboral){ echo $lab[2];?> - <?php if($lab[3] != "0000-00-00"){echo $lab[3];}else{echo " Presente";};} ?></h4>
                                        </div>

                                        <?php

                                    }
                                }
                                ?>
                            </div>

                        </div>

                    </div>

                    <!--Mostrar publicaciones si hay amistad-->
                    <div class="col-lg-12">
                        <?php
                        if ($friendship == true){
                            ?>

                            <?php
                            $sentence ="";
                            $FriendsArray =  $user->mySelfFriend($userSerch);
                            //Obtenemos todos los amigos y sus respectivas publicaciones
                            $i = 0;
                            foreach ($FriendsArray as $friend){
                                $i++;
                                $sentence = $sentence. " publicacion.id_autor=".$friend[0]. " or";
                                //FIN BUCLE AMIGOS
                            }
                            if($i!=0) {
                                $sentence = substr($sentence, 0, -2);
                                $pubs = "SELECT * FROM `publicacion` where $sentence ORDER BY publicacion.fecha_publicacion DESC";
                                $salidaPubs = mysqli_query($db,$pubs);
                                $s=0;
                                while($salida = mysqli_fetch_array($salidaPubs)){
                                    $s = $s+1;

                                    ?>

                                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3"  id="PubCom-<?php echo $salida["id"]; ?>">
                                        <div class="card-body p-0 d-flex">
                                            <figure class="avatar me-3"><img style="width:45px;height: 45px; object-fit: cover;" src="<?php $user->getUserImage($salida["id_autor"],$db);?>" alt="image" class="shadow-sm rounded-circle w45"></figure>
                                            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php echo $user->getName($salida["id_autor"]);?>  <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                                                <!--Diferencia de horas-->
                                                    <?php

                                                    echo $salida["fecha_publicacion"];
                                                    //echo "<br/>";
                                                    //echo date("Y-m-d G:i:s");

                                                    ?>
                                                <!--Fin diferencia-->
                                            </span></h4>

                                            <!--Borrar publicacion-->
                                            <?php
                                            if ($salida["id_autor"] == $_SESSION["userID"] or isset($_SESSION["admin"])){
                                                ?>
                                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">
                                                    <div class="card-body p-0 d-flex mt-2">
                                                        <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                                        <button data-id="<?php echo $salida["id"]; ?>" style="border: none; background: transparent" onclick="deletePub(this.getAttribute('data-id'))"><h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Borrar publicación <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4></button>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <!--FIN Borrar publicacion-->
                                            <!--Contenido publicacion-->
                                        </div>
                                        <div class="card-body p-0 me-lg-5">
                                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                                                <?php echo $salida["contenido"]?>
                                            </p>
                                        </div>
                                        <!--FIN Contenido publicacion-->

                                        <div class="card-body d-block p-0">
                                            <div class="row ps-2 pe-2 <?php echo $salida["id"];?>">
                                                <?php
                                                $imagesPub = "SELECT * FROM imagen_publicacion WHERE id_publicacion = $salida[id];";
                                                $ExecImagesPub = mysqli_query($db,$imagesPub);
                                                $i = 0;
                                                while($img = mysqli_fetch_array($ExecImagesPub)){
                                                    $route = $user->getImgRoute($img["id_imagen"]);
                                                    if ($i == 0) {
                                                        ?>
                                                        <div class="col-xs-4 col-sm-4 p-1" style = "width: 100%" ><a href = "<?php echo "usersImage/".$route?>" data-lightbox= "roadtrip<?php echo $s;?>" ><img src = "<?php echo "usersImage/".$route?>" class="rounded-3 w-100" alt = "image" ></a ></div >
                                                        <?php
                                                        $i = $i +1;
                                                    }else{
                                                        if($i == 1){?>
                                                            <div class="col-xs-4 col-sm-4 p-1"><a href="<?php echo "usersImage/".$route?>" data-lightbox="roadtrip<?php echo $s;?>"><img src="<?php echo "usersImage/".$route?>" class="rounded-3 w-100" alt="image"></a></div>

                                                            <?php
                                                            $i = $i+1;
                                                        }else{
                                                            if($i == 2){
                                                                ?>
                                                                <div class="col-xs-4 col-sm-4 p-1"><a href="<?php echo "usersImage/".$route?>" data-lightbox="roadtrip<?php echo $s;?>" class="position-relative d-block"><img src="<?php echo "usersImage/".$route?>" class="rounded-3 w-100" alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>+</b></span></a></div>
                                                                <?php
                                                                $i = $i+1;
                                                            }else{
                                                                ?>
                                                                <div class="col-xs-4 col-sm-4 p-1" hidden="true"><a href="<?php echo "usersImage/".$route?>" data-lightbox="roadtrip<?php echo $s;?>"><img src="<?php echo "usersImage/".$route?>" class="rounded-3 w-100" alt="image"></a></div>
                                                                <?php
                                                            }
                                                        }
                                                    }?>
                                                    <?php
                                                    ?>
                                                    <?php

                                                }
                                                $i = 0;
                                                ?>
                                            </div>
                                        </div>
                                        <!--Mostrar comentarios-->
                                        <div class="card-body d-flex p-0 mt-3">
                                            <button style="background-color: transparent; border: none" onclick="showComments('<?php echo $salida[0]?>')" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss"><span id="com-<?php echo $salida[0]?>"> <?php echo $user->getNumComments($salida[0]);?></span> Comentario(s)</span></button>
                                        </div>
                                        <!--FIN Mostrar comentarios-->
                                        <!--Comentarios-->
                                        <div id="comentarios-<?php echo $salida[0]?>" hidden>
                                            <?php
                                            $comentarios = $user->getComments($salida[0]);
                                            foreach ($comentarios as $comPub){
                                                ?>
                                                <div id="comment-<?php echo $comPub[0];?>" class="card-body p-0 mt-3 position-relative" style=" margin-top: 0.7em !important;margin-bottom: -1em !important;">
                                                    <figure class="avatar position-absolute ms-2 mt-1 top-5"><img style="width:30px;height: 30px; object-fit: cover;" src="
                                        <?php
                                                        $user->getUserImage($comPub["2"],$db);

                                                        ?> " alt="image" class="shadow-sm rounded-circle w30"></figure>

                                                    <a href="user-page.php?user=<?php
                                                    echo $user->getUsername($comPub[2]);
                                                    ?>
                                        "><b style="margin-left: 3em; font-family: 'Open Sans', sans-serif;font-size: 15px;font-weight: 600;"><?php $user->getName($comPub[2])?></b></a>
                                                    <?php if ($comPub[2] == $_SESSION["userID"] || isset($_SESSION["admin"])){ ?>
                                                        <button style="border: none; background-color: transparent;float: right;" onclick="deleteComment<?php echo $salida[0];?>(<?php echo $comPub[0]?>)"><span style="font-size: 12px; color: red; font-weight: 600 !important;  font-family: 'Montserrat', sans-serif; ">
                                                Eliminar
                                            </span></button>
                                                    <?php }?>
                                                    <textarea disabled id="comment" name="commentPub" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="5" rows="10" style="height: 3.5em !important; border: none; background: aliceblue; color: dimgray !important; "><?php echo $comPub[3] ?></textarea>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--FIN comentarios-->
                                        <hr>
                                        <div class="card-body p-0 mt-3 position-relative">
                                            <figure class="avatar position-absolute ms-2 mt-1 top-5"><img style="width:30px;height: 30px; object-fit: cover;" src="
                                        <?php
                                                $user->getUserImage($_SESSION["userID"],$db);

                                                ?> " alt="image" class="shadow-sm rounded-circle w30"></figure>
                                            <input id="comentarPub-<?php echo $salida[0];?>" name="commentarPub" data-pub="<?php echo $salida[0];?>" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="5" rows="10" style="height: 4em !important;" placeholder="Comenta!"></input>
                                        </div>
                                    </div>
                                    <script>
                                        function deleteComment<?php echo $salida[0];?>(idComment){
                                            $.ajax({
                                                type: "POST",
                                                url: "credentials/deleteComment.php",
                                                data: {comment: idComment},
                                                success: function (resolve){
                                                    $("#comment-"+idComment).fadeOut(300, function(){ $("#comment-"+idComment).remove();});
                                                    var value = parseInt(document.getElementById("com-<?php echo $salida[0];?>").innerHTML);
                                                    value--;
                                                    console.log("vale<?php echo $salida[0];?>")
                                                    document.getElementById("com-<?php echo $salida[0];?>").innerHTML = value;

                                                }
                                            });
                                        }

                                        document.getElementById("comentarPub-<?php echo $salida[0];?>").addEventListener("keypress", function(event) {

                                            if (event.key === "Enter") {
                                                // Cancel the default action, if needed
                                                event.preventDefault();
                                                var publicacion = document.getElementById("comentarPub-<?php echo $salida[0];?>").getAttribute("data-pub");
                                                var mensaje = document.getElementById("comentarPub-<?php echo $salida[0];?>").value;

                                                $.ajax({
                                                    type: "POST",
                                                    url: "credentials/comentar.php",
                                                    data: {idPub :publicacion, msg:mensaje },
                                                    success: function (resolve) {
                                                        document.getElementById("comentarPub-<?php echo $salida[0];?>").value = "";
                                                        $("#comentarios-<?php echo $salida[0];?>").append("<div id=\"comment-"+resolve+"\" class=\"card-body p-0 mt-3 position-relative\" style=\" margin-top: 0.7em !important;margin-bottom: -1em !important;\">"
                                                            +"<figure class=\"avatar position-absolute ms-2 mt-1 top-5\">"+
                                                            "<img style='width:30px;height: 30px; object-fit: cover;' src=\"<?php $user->getUserImage($_SESSION["userID"], $db); ?>\" alt=\"image\" class=\"shadow-sm rounded-circle w30\">"+
                                                            "</figure>"+
                                                            "<a href=\"user-page.php?user=<?php $user->getUsername($_SESSION["userID"]); ?>\"><b style=\"margin-left: 3em; font-family: 'Open Sans', sans-serif;font-size: 15px;font-weight: 600;\"><?php $user->getName($_SESSION["userID"])?></b></a>"+
                                                            "<button style=\"border: none; background-color: transparent;float: right;\" onclick=\"deleteComment<?php echo $salida[0];?>("+resolve+")\"><span style=\"font-size: 12px; color: red; font-weight: 600 !important;  font-family: 'Montserrat', sans-serif; \">" +
                                                            "Eliminar"+
                                                            "</span></button>"+
                                                            "<textarea disabled=\"\" id=\"comment\" name=\"commentPub\" class=\"h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg\" cols=\"5\" rows=\"10\" style=\"height: 3.5em !important; border: none; background: aliceblue; color: dimgray !important; \">"+mensaje+"</textarea>"+
                                                            "</div>")
                                                        var value = parseInt(document.getElementById("com-<?php echo $salida[0];?>").innerHTML);
                                                        value++;
                                                        document.getElementById("com-<?php echo $salida[0];?>").innerHTML = value;
                                                    }
                                                });
                                            }
                                        });
                                    </script>

                                    <!--FIN Publicacion -->                                        <!--FIN Publicacion -->
                                    <?php
                                }
                            }
                            ?>

                        <?php } ?>

                        <!--Fin mostrar publicaciones -->

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- main content -->        <div class="right-chat nav-wrap mt-2 right-scroll-bar">
        <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

            <!-- loader wrapper -->
            <div class="preloader-wrap p-3">
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer mb-3">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
            </div>
            <!-- loader wrapper -->

            <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
                <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTOS</h4>
                <ul class="list-group list-group-flush">
                    <?php
                    $FriendsChat =  $user->FriendsChat($_SESSION["userID"]);

                    foreach ($FriendsChat as $friend){
                        ?>


                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img style="width:35px;height: 35px; object-fit: cover;" src="<?php $user->getUserImage($friend[0], $db);?>" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#"><?php echo $user->getName($friend[0]);?></a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>

                        <?php
                    }
                    ?>

                </ul>
            </div>
            <br/>
        </div>
    </div>


    <!-- right chat -->

    <div class="app-footer border-0 shadow-lg bg-primary-gradiant">
        <a href="default.php" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
        <a href="default-settings.php" class="nav-content-bttn"><img src="
            <?php
            $user = new User();

            $user->getUserImage($_SESSION["userID"],$db);


            ?>" alt="user" class="w30 shadow-xss"></a>
    </div>

    <div class="app-header-search">
        <form class="search-form">
            <div class="form-group searchbox mb-0 border-0 p-1">
                <input type="text" class="form-control border-0" placeholder="Search...">
                <i class="input-icon">
                    <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline"></ion-icon>
                </i>
                <a href="#" class="ms-1 mt-1 d-inline-block close searchbox-close">
                    <i class="ti-close font-xs"></i>
                </a>
            </div>
        </form>
    </div>

</div>

<div class="modal bottom side fade" id="Modalstries" tabindex="-1" role="dialog" style=" overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 bg-transparent">
            <button type="button" class="close mt-0 position-absolute top--30 right--10" data-dismiss="modal" aria-label="Close"><i class="ti-close text-white font-xssss"></i></button>
            <div class="modal-body p-0">
                <div class="card w-100 border-0 rounded-3 overflow-hidden bg-gradiant-bottom bg-gradiant-top">
                    <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                        <div class="item"><img src="https://via.placeholder.com/450x800.png" alt="image"></div>
                        <div class="item"><img src="https://via.placeholder.com/450x800.png" alt="image"></div>
                        <div class="item"><img src="https://via.placeholder.com/450x800.png" alt="image"></div>
                        <div class="item"><img src="https://via.placeholder.com/450x800.png" alt="image"></div>

                    </div>
                </div>
                <div class="form-group mt-3 mb-0 p-3 position-absolute bottom-0 z-index-1 w-100">
                    <input type="text" class="style2-input w-100 bg-transparent border-light-md p-3 pe-5 font-xssss fw-500 text-white" value="Write Comments">
                    <span class="feather-send text-white font-md text-white position-absolute" style="bottom: 35px;right:30px;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/plugin.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.easypiechart.min.js"></script>
<script>
    $('.chart').easyPieChart({
        easing: 'easeOutElastic',
        delay: 3000,
        barColor: '#3498db',
        trackColor: '#aaa',
        scaleColor: false,
        lineWidth: 5,
        trackWidth: 5,
        size: 50,
        lineCap: 'round',
        onStep: function(from, to, percent) {
            this.el.children[0].innerHTML = Math.round(percent);
        }
    });

</script>

</body>

</html>
