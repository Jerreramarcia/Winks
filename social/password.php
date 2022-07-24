<?php
require_once ("class/user.php");

session_start();
if (!isset($_SESSION["userID"])){
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

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

        <i class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <i class="p-2 text-center ms-3 menu-icon chat-active-btn"></i>

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
    <!-- main content -->
    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                            <a href="default-settings.php" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Cambia la contraseña</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Contraseña actual</label>
                                            <i id="errorPass1" style="font-size: 12px; color: red" hidden> Contraseña incorrecta</i>
                                            <input id="password" type="password" name="comment-name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Contraseña nueva</label>
                                            <i id="errorPass1" style="font-size: 12px; color: red" hidden> Las contraseñas no coinciden</i>
                                            <input id="newPassword" type="password" name="comment-name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Confirma la contraseña</label>
                                            <input id="confirmNewPassword" type="password" name="comment-name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-0">
                                        <button class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" onclick="checkValues()">Guardar</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- <div class="card w-100 border-0 p-2"></div> -->
                </div>
            </div>

        </div>
    </div>

<script>
    function checkValues(){
        oldPassword = document.getElementById("password").value;
        newPassword = document.getElementById("newPassword").value;
        confirmNewPassword = document.getElementById("confirmNewPassword").value;
        var passOK = false;
        var oldPassOk = false;
        if (newPassword != confirmNewPassword ||newPassword == "" || confirmNewPassword == ""){
            document.getElementById("errorPass1").removeAttribute("hidden");
        }else {
            document.getElementById("errorPass1").setAttribute("hidden","true");
            passOK = true;
        }
        if (passOK){
            $.ajax({
                type: "POST",
                url: "credentials/checkPassword.php",
                data: {password: oldPassword},
            success: function (resolve) {
                    if (resolve =="true"){
                        oldPassOk = true;
                        document.getElementById("errorPass1").setAttribute("hidden", "true");
                    }else {
                        document.getElementById("errorPass1").removeAttribute("hidden");
                    }
            },
            async : false
            })
        }
        if (oldPassOk){
            $.ajax({
                type: "POST",
                url: "credentials/changePass.php",
                data: {password:newPassword},
            success: function (resolve) {
                alertify.success("Contraseña modificada");
            }
        })
        }

    }
</script>


    <div class="app-header-search">
        <form class="search-form" method="get" action="buscador.php">
            <div class="form-group searchbox mb-0 border-0 p-1">
                <input type="text" name="user" class="form-control border-0" placeholder="Search...">
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


<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>

</body>

</html>