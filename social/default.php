<?php
session_start();

if (!isset($_SESSION["userID"])){
    header("Location: login.html");

}
require_once("class/user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .hide {
            display: none;
        }

        .mensaje:hover .hide {
            display: block;
            color: red;
        }
    </style>
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
<style>
    textarea { resize: none; }
</style>
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

            <i class="p-2 text-center ms-auto menu-icon" id="" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i class="feather-message-square font-xl text-current"></i></a>

            <a href="default-settings.php" class="p-0 ms-3 menu-icon"><img style="height: 40px; object-fit: cover;" src=
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
                    <div class="row feed-body">
                        <div class="col-xl-8 col-xxl-9 col-lg-8">
                            <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">

                            <form action="credentials/upload.php" method="post" enctype="multipart/form-data">
                                <label for="submitButton" class="fw-600 mont-font "> Publicar</label>
                                <button id="submitButton" type="submit" name='submit' value='Upload' style="right: auto" hidden> Publicar</button>
                                <div class="card-body p-0 mt-3 position-relative">
                                    <figure class="avatar position-absolute ms-2 mt-1 top-5"><img style="width: 30px; height: 30px; object-fit: cover;" src="
                                        <?php
                                        $user->getUserImage($_SESSION["userID"],$db);

                                        ?> " alt="image" class="shadow-sm rounded-circle w30"></figure>
                                    <textarea name="message" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="Comparte tus pensamientos!"></textarea>
                                </div>
                                <div class="card-body d-flex p-0 mt-0">

                                        <label for="file" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center">Subir fotos
                                            <input type="file" name="file[]" id="file" multiple hidden>
                                        </label>

                                    <!--Fin publicacion -->
                                </div>
                            </form>


                            </div>
                            <!--publicacion usuario-->
                            <script>
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
                            <?php
                            $sentence ="";
                            $FriendsArray =  $user->PublicacionAmigos($_SESSION["userID"]);
                            //Obtenemos todos los amigos y sus respectivas publicaciones
                            $i = 0;
                            foreach ($FriendsArray as $friend){
                                $i++;
                                $sentence = $sentence. " publicacion.id_autor=".$friend[0]. " or";
                                //FIN BUCLE AMIGOS
                            }

                            ?>

                            <script>

                            </script>
                            <div id="publicaciones">
                            <?php
                            if($i!=0) {
                                $sentence = substr($sentence, 0, -2);
                                $pubs = "SELECT * FROM `publicacion` where $sentence ORDER BY publicacion.fecha_publicacion DESC";
                                $salidaPubs = mysqli_query($db,$pubs);
                                $salidaPubs2 = mysqli_query($db,$pubs);
                                $s=0;
                                $pb =0;
                                while($salida2 = mysqli_fetch_array($salidaPubs2)){
                                    $pb +=1;
                                }
                                ?>
                                <script>
                                    var num = <?php echo $pb ?>;
                                    var pubs = new Array(num);
                                </script>
                                <?php
                                while($salida = mysqli_fetch_array($salidaPubs)){

                            ?>
                            <script>
                                pubs[<?php echo $s; ?>] = "<?php  echo "PubCom-".$salida["id"];?>";
                            </script>
                            <?php $s = $s+1; ?>
                            <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3" id="PubCom-<?php echo $salida["id"]; ?>" hidden>
                                    <div class="card-body p-0 d-flex">
                                        <figure class="avatar me-3"><img style="height: 45px; object-fit: cover;" src="<?php $user->getUserImage($salida["id_autor"],$db);?>" alt="image" class="shadow-sm rounded-circle w45"></figure>
                                        <h4  class="fw-700 text-grey-900 font-xssss mt-1"><a style="color: black;" href="user-page.php?user=<?php echo $user->getUsername($salida["id_autor"]);?>"><?php echo $user->getName($salida["id_autor"]);?> </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
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
                                <!--Fin Contenido publicacion-->
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
                                                        <div class="col-xs-4 col-sm-4 p-1"><a href="<?php echo "usersImage/".$route?>" data-lightbox="roadtrip<?php echo $s;?>" class="position-relative d-block"><img src="<?php echo "usersImage/".$route?>" class="rounded-3 w-100" alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>...</b></span></a></div>
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
                                    <div class="card-body d-flex p-0 mt-3" style="  margin-bottom: -1em;">
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
                                        <figure class="avatar position-absolute ms-2 mt-1 top-5"><img style="height: 30px; object-fit: cover;" src="
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
                                <!--Fin comentarios-->
                                <hr>
                                <div class="card-body p-0 mt-3 position-relative">
                                    <figure class="avatar position-absolute ms-2 mt-1 top-5"><img style="height: 30px;width: 30px; object-fit: cover;" src="
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
                                                        "<img style=\"height: 30px;height: 30px; object-fit: cover;\" src=\"<?php $user->getUserImage($_SESSION["userID"], $db); ?>\" alt=\"image\" class=\"shadow-sm rounded-circle w30\">"+
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

                            <!--FIN Publicacion -->
                            <?php
                                }
                            }
                            ?>

                            </div>
                            <div class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                                <div class="snippet mt-2 ms-auto me-auto" data-title=".dot-typing">
                                    <div class="stage">
                                        <div class="dot-typing"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="paginas">
                                <?php
                                $pags = ceil($s/10);

                                for ($i = 0; $i<$pags; $i++){
                                    ?>
                                    <button style="color: white;" class="btn btn-primary" onclick="showPub('<?php echo $i+1; ?>')"> <?php echo $i+1;?></button>
                                <?php } ?>
                            </div>
                            <script type="application/javascript">
                                function cancelFriendship(a){
                                    var user = a.getAttribute("id");
                                    var selec = "#peticion" + user;
                                    $(selec).fadeOut(300, function(){ $(this).remove();});
                                    $.ajax({
                                        type: "POST",
                                        url: "credentials/friendshipCreation.php",
                                        data: {userIDCancel : user},
                                        success: function (resolve) {
                                        }
                                    });
                                }
                                function acceptFriendship(a){
                                    var user = a.getAttribute("id");
                                    var selec = "#peticion" + user;
                                    $(selec).fadeOut(300, function(){ $(this).remove();});
                                    $.ajax({
                                        type: "POST",
                                        url: "credentials/friendshipCreation.php",
                                        data: {userIDAccept : user},
                                        success: function (resolve) {
                                        }
                                    });
                                }

                            </script>
                        </div>               
                        <div class="col-xl-4 col-xxl-3 col-lg-4 ps-md-0">
                            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                                <div class="card-body d-flex align-items-center p-4">
                                    <h4 class="fw-700 mb-0 font-xssss text-grey-900">Peticiones de amistad</h4>
                                </div>
                                <?php
                                $NotFriendsYet = $user->getFriendRequest($_SESSION["userID"]);
                                foreach ($NotFriendsYet as $friend){
                                ?>
                                <div id="peticion<?php echo $friend[0]?>">
                                    <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0">
                                        <figure class="avatar me-3"><img style="width:45px;height: 45px; object-fit: cover;" src="<?php $user->getUserImage($friend[0],$db)?>" alt="image" class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?php $user->getName($friend[0]);?> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">@<?php $user->getUsername($friend[0]);?></span></h4>
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <button style="border: none" class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl" id="<?php echo $friend[0];?>"  onclick="acceptFriendship(this)">Aceptar</button>
                                        <button style="border: none" class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl" id="<?php echo $friend[0];?>" onclick="cancelFriendship(this)">Rechazar</button>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>



                            </div>

                        </div>

                    </div>
                </div>
                
            </div>            
        </div>
        <!-- main content -->

        <!-- right chat -->
        <div class="right-chat nav-wrap mt-2 right-scroll-bar">
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
                                        <img style="height: 35px;width: 35px; object-fit: cover;" src="<?php $user->getUserImage($friend[0], $db);?>" alt="image" class="w35">
                                    </figure>
                                    <h3 class="fw-700 mb-0 mt-0">
                                        <a id="<?php echo $friend[0];?>" class="font-xssss text-grey-600 d-block text-dark model-popup-chat" onclick="onChat<?php echo $friend[0]?>();repage<?php echo $friend[0]?>() " href="#"><?php echo $user->getName($friend[0]);?></a>
                                    </h3>

                                    <div href="default-message.php" class="nav-content-bttn open-font h-auto pt-2 pb-2">

                                        <span id="mensajes<?php echo $friend[0];?>" class="circle-count bg-warning mt-0 circle-count" style="padding: 6px 6px 6px;margin-left: 10px;border-radius: 7px;color: #fff;font-size: 13px;">0
                                        </span></div>

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
            <a href="default-settings.php" class="nav-content-bttn"><img style="height: 40px; object-fit: cover;" src="
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
                    <a href="buscador.php?user=sad" class="ms-1 mt-1 d-inline-block close searchbox-close">
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



    <?php foreach ($FriendsChat as $friend){?>


        <script>
            mensajes<?php echo $friend[0]?> = new Array();
            numMsg<?php echo $friend[0]?> = 0;
            //Obtener mensajes
            function messages<?php echo $friend[0]?>(){
                $.ajax({
                    type: "POST",
                    url: "credentials/getMensajes.php",
                    data: {userID :<?php echo $_SESSION["userID"];?>, usuarioAmigo:<?php echo $friend[0];?>},
                    dataType:"json",
                    success: function (resolve) {
                        mensajes<?php echo $friend[0]?> = resolve;
                        mensajes<?php echo $friend[0]?>.slice(numMsg<?php echo $friend[0]?>).forEach(element => reorganice<?php echo $friend[0]?>(element))
                    }
                });
            }
            var un = 0;
            $(function() {
                var intervalId<?php echo $friend[0]?> = window.setInterval(function(){
                    $.ajax({
                        type: "POST",
                        url: "credentials/checkMSG.php",
                        data: {IDme:"<?php echo $_SESSION['userID']?>",IDamigo: "<?php echo $friend[0]?>"},
                    success: function (resolve) {
                            if (resolve > 0){
                                document.getElementById("mensajes<?php echo $friend[0];?>").innerHTML = resolve;
                                document.getElementById("mensajes<?php echo $friend[0];?>").removeAttribute("hidden");

                            }else{
                                document.getElementById("mensajes<?php echo $friend[0];?>").setAttribute("hidden","true");
                            }
                    }
                })

                }, 1000);
            });
var intervalId<?php echo $friend[0]?>;
            function onChat<?php echo $friend[0]?>(){

                     intervalId<?php echo $friend[0]?> = window.setInterval(function () {

                        document.getElementById("mensajes<?php echo $friend[0];?>").innerHTML = 0;
                        messages<?php echo $friend[0]?>();
                    }, 1000);
            }

            //Insertar mensajes
            function reorganice<?php echo $friend[0]?>(mensaje){
                numMsg<?php echo $friend[0]?>++;
                if (mensaje[1] != "<?php $user->getName($_SESSION["userID"])?>") {
                    $("#chatr-<?php echo $friend[0]?>").append("<div class='message'><div class='message-content font-xssss lh-24 fw-500'>"+mensaje[3]+"</div></div>"+
                        "<div class=\"date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2\">"+mensaje[4]+"</div>"
                    );
                    var elem = document.getElementById("chatr-<?php echo $friend[0]?>");
                    elem.scrollTop = elem.scrollHeight;
                }else{
                    $("#chatr-<?php echo $friend[0]?>").append("<div class='message self text-right mt-2'><div class='message-content font-xssss lh-24 fw-500 mensaje'>"+ mensaje[3]+"<div class='date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2 hide'>"+mensaje[4]+"<br/></div></div></div>");
                    var elem = document.getElementById("chatr-<?php echo $friend[0]?>");
                    elem.scrollTop = elem.scrollHeight;

                }
                repage<?php echo $friend[0]?>();
            }
            //Parar de limpiar los mensajes
            function stopinter<?php echo $friend[0]?>(){
                window.clearInterval(intervalId<?php echo $friend[0]?>);
            }
            function repage<?php echo $friend[0]?>(){

                var elem = document.getElementById("chatr-<?php echo $friend[0]?>");
                elem.scrollTop = elem.scrollHeight;
            }

        </script>


        <div class="modal-popup-chat" id="chat-<?php echo $friend[0];?>">
        <div class="modal-popup-wrap bg-white p-0 shadow-lg rounded-3">
            <div class="modal-popup-header w-100 border-bottom">
                <div class="card p-3 d-block border-0 d-block">
                    <figure class="avatar mb-0 float-left me-2">
                        <img style="height: 35px; width: 35px; object-fit: cover;" src="<?php $user->getUserImage($friend[0],$db)?>" alt="image" class="w35 me-1">
                    </figure>
                    <h5 class="fw-700 text-primary font-xssss mt-1 mb-1"><?php echo $user->getName($friend[0]);?></a></h5>
                    <h4 class="text-grey-500 font-xsssss mt-0 mb-0"><span class="d-inline-block bg-success btn-round-xss m-0"></span>&nbsp;&nbsp;<?php echo $user->getUsername($friend[0]);?> </h4>
                    <a href="#" class="font-xssss position-absolute right-0 top-0 mt-3 me-4" onclick="stopinter<?php echo $friend[0]?>();"><i class="ti-close text-grey-900 mt-2 d-inline-block"></i></a>
                </div>
            </div>
            <div class="modal-popup-body w-100 p-3 h-auto">
                <div class="scrollbar scroll" style="height: 200px;
overflow-x: hidden;
overflow-y: auto;
text-align: justify;
" id="chatr-<?php echo $friend[0]?>">

                    <div class="clearfix"></div>
                </div>
                <!--Fin conversacion interna-->

            </div>
            <div class="modal-popup-footer w-100 border-top">
                <div class="card p-3 d-block border-0 d-block">
                    <div class="form-group icon-right-input style1-input mb-0" id="textMensaje">
                        <input id="<?php echo 'mensaje-'.$friend[0]; ?>" type="text" placeholder="Empieza a escribir.." class="form-control rounded-xl bg-greylight border-0 font-xssss fw-500 ps-3">
                        <i class="feather-send text-grey-500 font-md"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            var input = document.getElementById("<?php echo 'mensaje-'.$friend[0]; ?>");
            input.addEventListener("keypress", function(event) {
                // If the user presses the "Enter" key on the keyboard
                if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    var recep = "<?php echo $friend[0]; ?>";
                    var mensaje = document.getElementById("<?php echo 'mensaje-'.$friend[0]; ?>").value;
                    $.ajax({
                        type: "POST",
                        url: "credentials/mensaje.php",
                        data: {receptor :recep, msg:mensaje },
                        success: function (resolve) {
                            document.getElementById("<?php echo 'mensaje-'.$friend[0]; ?>").value = "";
                            repage<?php echo $friend[0];?>();

                        }
                    });
                }
            });

        </script>

                <?php } ?>
        <script>
            function paginate(array, page_size, page_number) {
                // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
                return array.slice((page_number - 1) * page_size, page_number * page_size);
            }
            showPub(1);

            function showPub(pag){

                for (var a = 0; a < Math.ceil(pubs.length/10); a++){
                    if (a != pag){
                        ocultar(a);
                    }
                }
                paginate(pubs,10,pag).forEach(element =>Muestra(element));

                const scrollToTop = () => {
                    const c = document.documentElement.scrollTop || document.body.scrollTop;
                    if (c > 0) {
                        window.requestAnimationFrame(scrollToTop);
                        window.scrollTo(0, c - c / 20);
                    }
                };

                scrollToTop();
            }


            function Muestra(el){

                var dif = pubs.filter(p=> !el.includes(p))
                dif.forEach(items => {
                    document.getElementById(el).removeAttribute("hidden");
                });
            }
            function ocultar(pag){
                paginate(pubs,10,pag).forEach(element => document.getElementById(element).setAttribute("hidden","true"));
            }


        </script>


</body>
<script>

</script>


    <script src="js/plugin.js"></script>

    <script src="js/lightbox.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>