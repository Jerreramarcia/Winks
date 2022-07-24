<?php
require_once("class/user.php");
session_start();

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
        <script type="text/javascript">
            function fetch_select(val)
            {
                $.ajax({
                    method: "POST",
                    url: "credentials/fetch_location.php",
                    data: {
                        get_option:val
                    },

                    success: function (response) {
                        console.log(response);
                        document.getElementById("new_select").innerHTML=response;
                    }
                });
            }

        </script>

        <script type="text/javascript">
            function fetch_municipio(val)
            {
                $.ajax({
                    type: 'post',
                    url: 'credentials/fetch_municipio.php',
                    data:{
                        get_municipio:val
                    },
                    success:function(response){
                        console.log(response);
                        document.getElementById("municipio").innerHTML=response
                    }
                });

            }
        </script>

        <!-- navigation left -->

        <!-- main content -->
        <div class="main-content bg-lightblue theme-dark-bg right-chat-active">
            
            <div class="middle-sidebar-bottom">
                <div class="middle-sidebar-left">
                    <div class="middle-wrap">
                        <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                            <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                                <a href="default-settings.php" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                                <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Detalles de la cuenta</h4>
                            </div>
                            <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 text-center">
                                    <figure class="avatar ms-auto me-auto mb-0 mt-2 w100"><img src="<?php
                                        $user->getUserImage($_SESSION["userID"],$db);
                                    ?>"
                                    alt="image" class="shadow-sm rounded-3 w-100" style="object-fit: cover; height: 100px"></figure>
                                    <h2 class="fw-700 font-sm text-grey-900 mt-3"><?php
                                        $user->getName($_SESSION["userID"],$db);
                                        ?></h2>
                                    <h4 class="text-grey-500 fw-500 mb-3 font-xsss mb-4">@<?php $user->getUsername($_SESSION["userID"]);?></h4>
                                    <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                                </div>
                            </div>
                            <script>
                                var emailError = false;
                                var usernameError = false;
                                function isValidForm(){

                                    var username = document.getElementById("username").value;
                                    var email = document.getElementById("email").value;
                                    var oldUsername = document.getElementById("oldUsername").value;
                                    var oldEmail = document.getElementById("oldEmail").value;
                                    console.log(username +" "+ oldUsername);
                                    console.log(email +" "+ oldEmail);
                                    if (username === oldUsername){
                                        usernameError = false;
                                    }
                                    if (email == oldEmail){
                                        emailError = false;
                                    }
                                    if (username == oldUsername && email == oldEmail){
                                        document.getElementById("usernameError").setAttribute("hidden", "true");
                                        document.getElementById("emailError").setAttribute("hidden", "true");

                                        return true;
                                    }
                                    if (username != oldUsername){
                                        $.ajax({
                                            type: "POST",
                                            url: "credentials/checkAlias.php",
                                            data: {alias:username},
                                            success: function (resolve) {
                                                console.log("alias error" + resolve);
                                                if (resolve != "false"){
                                                    usernameError = true;
                                                    document.getElementById("usernameError").removeAttribute("hidden");

                                                }else {
                                                    usernameError = false;
                                                    document.getElementById("usernameError").setAttribute("hidden", "true");
                                                }
                                            },
                                            async: false
                                        })
                                    }


                                    if (email != oldEmail){
                                        $.ajax({
                                            type: "POST",
                                            url: "credentials/checkEmail.php",
                                            data: {emailUser:email},
                                            success: function (resolve) {
                                                console.log(resolve)
                                                if (resolve != "false"){
                                                    document.getElementById("emailError").removeAttribute("hidden");
                                                    emailError = true;
                                                }else
                                                {
                                                    emailError = false;
                                                    document.getElementById("emailError").setAttribute("hidden", "true");

                                                }
                                            },
                                            async: false
                                        })
                                    }
                                    if (emailError || usernameError){
                                        return false;
                                    }else {
                                        return true;
                                    }
                                }
                            </script>
                            <form action="credentials/information.php" method="post" onsubmit="return isValidForm()">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" value="<?php $user->getName($_SESSION["userID"])?>">
                                        </div>        
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Nombre de usuario</label>
                                            <i id="usernameError" style="font-size: 12px; color: red" hidden> Nombre de usuario en uso</i>
                                            <input type="text"  id="username" class="form-control" name="username" value="<?php $user->getUsername($_SESSION["userID"]);?>">
                                            <input type="text"  id="oldUsername" class="form-control" name="oldUsername" hidden value="<?php $user->getUsername($_SESSION["userID"]);?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Fecha de Nacimiento</label>
                                            <input type="date" max="2005-01-01" class="form-control" name="nacimiento" value="<?php $user->getBirthdate($_SESSION["userID"])?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <?php $user->getPais($_SESSION["userID"]);?>

                                            <?php $user->getProvincia($_SESSION["userID"]);?>

                                            <?php $user->getLocalidad($_SESSION["userID"]);?>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                $db = new Database();
                                $db = $db->connect();
                                $query = "SELECT * from pais";
                                $select = mysqli_query($db,$query);
                                ?>
                                <div class="row">
                                <div id="select_box">
                                    <select onchange="fetch_select(this.value);" class="select_Location form-select" name="pais">
                                        <option disabled selected value="">Selecciona Pais</option>
                                        <?php
                                        while($row=mysqli_fetch_array($select))
                                        {
                                            echo "<option id=".$row["id"].">".$row["nombre"]."</option>";
                                        }
                                        ?>
                                    </select>
                                    <select id="new_select" class="form-select" name="provincia" onchange="fetch_municipio(this.value);" >
                                        <option disabled selected value="">Selecciona provincia</option>
                                    </select>
                                    <select id="municipio" name="municipio" class="form-select">
                                        <option disabled selected value="">Selecciona municipio</option>
                                    </select>

                                </div>

                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Email</label>
                                            <i id="emailError" style="font-size: 12px; color: red" hidden> Email en uso</i>
                                            <input type="text" id="email" name="email" class="form-control" value="<?php $user->getEmail($_SESSION["userID"]);?>">
                                            <input type="text" id="oldEmail" name="oldEmail" class="form-control" hidden value="<?php $user->getEmail($_SESSION["userID"]);?>">
                                        </div>
                                    </div>

                                </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="card mt-3 border-0">
                                            <div class="card-body d-flex justify-content-between align-items-end p-0">
                                                <div class="form-group mb-0 w-100" onclick="dat()">
                                                    <label for="file" class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">
                                                    <i class="ti-cloud-down large-icon me-3 d-block"></i>
                                                    <span class="js-fileName">Avatar</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12">
                                        <button class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Guardar</button>
                                    </div>
                            </form>
                            </div>

                            </div>
                        </div>
                    <script type="text/javascript">
                        function openwindow (url) {
                            var win = window.open(url, "window1", "width=600,height=400,status=yes,scrollbars=yes,resizable=yes");
                            win.focus();
                        }
                    </script>

                    <script>
                            function dat(){
                                window.openwindow('avatar.php') ;

                            }
                        </script>

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

                <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTS</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                            </h3>
                            <span class="badge badge-primary text-white badge-pill fw-500 mt-0">2</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Victor Exrixon</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Surfiya Zakir</a>
                            </h3>
                            <span class="bg-warning ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Goria Coast</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">4:09 pm</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">David Goria</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 days</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Seary Victor</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Ana Seary</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        
                    </ul>
                </div>
                <div class="section full pe-3 ps-4 pt-4 pb-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">GROUPS</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Studio Express</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 min</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Design</a>
                            </h3>
                            <span class="bg-warning ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-mini-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">De fabous</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                    </ul>
                </div>
                <div class="section full pe-3 ps-4 pt-0 pb-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">Pages</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Seary</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Entropio Inc</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        
                    </ul>
                </div>

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