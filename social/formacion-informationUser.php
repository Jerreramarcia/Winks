<?php
require_once("class/user.php");
session_start();

if (!isset($_SESSION["userID"])){
    header("Location: login.html");
}

if (!isset($_GET["user"])){
    header("Location: default.php");
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

        <a href="default-settings.php" class="p-0 ms-3 menu-icon"><img style="width:40px;height: 40px; object-fit: cover;" src=
            <?php
            $db = new Database();
            $db = $db->connect();
            $user = new User();
            $user->getUserImage($_GET["user"],$db);

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
                            <a href="user-page.php?user=<?php $user->getName($_GET["user"]) ?>" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Formación</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 text-center">
                                    <figure class="avatar ms-auto me-auto mb-0 mt-2 w100"><img style="width: 100px; height: 100px; object-fit: cover;" src="<?php
                                        $user->getUserImage($_GET["user"],$db);
                                        ?>"
                                                                                               alt="image" class="shadow-sm rounded-3 w-100"></figure>
                                    <h2 class="fw-700 font-sm text-grey-900 mt-3"><?php
                                        $user->getName($_GET["user"],$db);
                                        ?></h2>
                                    <h4 class="text-grey-500 fw-500 mb-3 font-xsss mb-4">@<?php $user->getUsername($_GET["user"]);?></h4>
                                    <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                                </div>
                            </div>
                            <?php

                            $laboral = $user->getFormacion($_GET["user"]);

                            ?>
                            <?php
                            foreach ($laboral as $lab){
                                ?>
                                <form method="post" action="credentials/editFormacion.php">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">Titulación</label>
                                                <input type="text" class="form-control" name="titulacion" value="<?php $user->getTitulacion($lab["2"]);?>">
                                                <input type="text" class="form-control" name="titulacionAntigua" hidden value="<?php  echo $lab["2"];?>">

                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">Centro Formativo</label>
                                                <input type="text" class="form-control" name="centro" value="<?php $user->getCentroFormativo($lab["3"]);?>">
                                                <input type="text" class="form-control" hidden name="centroAntigua" value="<?php echo $lab["3"];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">Año inicio</label>
                                                <input type="date" class="form-control" name="inicio" value="<?php echo $lab["4"]?>">
                                                <input type="date" class="form-control" hidden name="inicioAntigua" value="<?php echo $lab["4"]?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">Año final</label>
                                                <input type="date" class="form-control" name="fin" value="<?php echo $lab["5"]?>">
                                                <input type="date" class="form-control" hidden name="finAntigua" value="<?php echo $lab["5"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" name="userEdit" value="<?php echo $_GET['user'];?>" hidden>
                                        <button class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" name="idUser" value="<?php echo $lab["0"]?>">Editar</button>
                                    </div>
                                </form>
                                <form method="post" action="credentials/deleteFormacion.php">
                                    <div class="col-lg-12">
                                        <input type="text" name="userEdit" value="<?php echo $_GET['user'];?>" hidden>
                                        <button style="margin-left: 52%;margin-top: -61px;" class="bg-instagram text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-block" name="idUser" value="<?php echo $lab["0"]?>">Eliminar</button>
                                    </div>
                                </form>
                                <hr>

                                <?php
                            }
                            ?>

                            <form action="credentials/addLaboral.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Titulación</label>
                                            <input type="text" required class="form-control" name="titulacion">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Centro Formativo</label>
                                            <input type="text" required class="form-control" name="centro">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Año inicio</label>
                                            <input type="date" required class="form-control" name="inicio">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Año final</label>
                                            <input type="date" class="form-control" name="fin">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br/>
                        <div class="col-lg-12">
                            <button name="IDuser" value="<?php echo $_GET["user"];?>" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Añadir</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- <div class="card w-100 border-0 p-2"></div> -->
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

    </div>
</div>


<!-- right chat -->

<div class="app-footer border-0 shadow-lg bg-primary-gradiant">
    <a href="default.php" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
    <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
    <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i class="feather-layout"></i></a>
    <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>
    <a href="default-settings.php" class="nav-content-bttn"><img src="https://via.placeholder.com/50x50.png" alt="user" class="w30 shadow-xss"></a>
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


<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>

</body>

</html>