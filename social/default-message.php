<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winks - La red social más fresca </title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logos/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">

</head>
<?php


require_once("class/user.php");
require_once("class/database.php");

$user = new User();
$db = new Database();
$db = $db->connect();
session_start();
if (!isset($_SESSION["userID"])){
    header("Location: login.html");
}




?>
<body class="color-theme-blue mont-font">

    <div class="preloader"></div>

    
    <div class="main-wrapper">

        <!-- navigation top-->
        <div class="nav-header bg-white shadow-xs border-0">
            <div class="nav-top">
                <a href="default.php"><img src="images/logos/logo.png" style="max-width: 20%"></img><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Winks </span> <?php if (isset($_SESSION["admin"])){?><div>plus</div><?php } ?> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="sadsa" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
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
        <div class="main-content right-chat-active" style="padding-right: 0px;">
            
            <div class="middle-sidebar-bottom">
                <div class="middle-sidebar-left pe-0 ps-lg-3 ms-0 me-0" style="max-width: 100%;">
                    <div class="row">
                        <script>
                            mensajes = new Array();
                            numMsg = 0;
                            function messages(){
                                $.ajax({
                                    type: "POST",
                                    url: "credentials/getMensajes.php",
                                    data: {userID :<?php echo $_SESSION["userID"];?>, usuarioAmigo:<?php echo $_GET["user"]?> },
                                    dataType:"json",
                                    success: function (resolve) {
                                        mensajes = resolve;
                                        mensajes.slice(numMsg).forEach(element => reorganice(element))
                                    }
                                });
                            }

                            function reorganice(mensaje){
                                numMsg++;
                                var idLast = document.getElementById("chatroom").lastElementChild.getAttribute("data-id");

                                if (mensaje[1] != "<?php $user->getName($_SESSION["userID"])?>") {

                                    if (idLast != mensaje[1]) {
                                        $("#chatroom").append(
                                            "<div class=\"message-item\" data-id=\""+mensaje[1]+"\">" +
                                            "<div class=\"message-user\">" +
                                            "<figure class=\"avatar\">" +
                                            "<img style=\"width:40px;height: 40px; object-fit: cover;\" src=\" <?php $user->getUserImage($_GET["user"], $db)?>\" alt=\"image\">" +
                                            "</figure>" +
                                            "<div>" +
                                            "<h5>" + mensaje[1] + "</h5>" +
                                            "<div class=\"time\">01:35 PM</div>" +
                                            "</div>" +
                                            "</div>" +
                                            "<div class=\"message-wrap\" style='margin-right: 63px;'>" +
                                            "" + mensaje[3] + "</div>" +
                                            "</div>")
                                    }else{
                                        $("#chatroom").append(
                                            "<div data-id=\""+ mensaje[1]+"\" class=\"message-item\">" +
                                            "<div class=\"message-user\">" +
                                            "<div>" +
                                            "<div class=\"time "+mensaje[1]+"\">01:35 PM</div>" +
                                            "</div>" +
                                            "</div>" +
                                            "<div data-cls = \""+ mensaje[1]+"\" class=\"message-wrap\" style='margin-right: 63px;'>" +
                                            ""+mensaje[3] +"</div>" +
                                            "</div>")
                                    }

                                    var elem = document.getElementById("scroll");
                                    elem.scrollTop = elem.scrollHeight;
                                }else{

                                    if (idLast != mensaje[1]){

                                        $("#chatroom").append(
                                            "<div data-id=\""+ mensaje[1]+"\" class=\"message-item outgoing-message\">" +
                                            "<div class=\"message-user\">" +
                                            "<figure class=\"avatar\">" +
                                            "<img style=\"width:40px;height: 40px; object-fit: cover;\" src=\"<?php $user->getUserImage($_SESSION["userID"],$db)?>\" alt=\"image\">" +
                                            "</figure>" +
                                            "<div>" +
                                            "<h5>"+ mensaje[1]+"</h5>" +
                                            "<div class=\"time\">01:35 PM</div>" +
                                            "</div>" +
                                            "</div>" +
                                            "<div class=\"message-wrap\" style=\"margin-left: 63px;\">" +
                                            ""+ mensaje[3]+"</div>" +
                                            "</div>")
                                    }else{
                                        $("#chatroom").append(
                                            "<div data-id=\""+ mensaje[1]+"\" class=\"message-item outgoing-message\">" +
                                            "<div class=\"message-user\">" +
                                            "<div>" +
                                            "<div class=\"time "+mensaje[1]+"\">01:35 PM</div>" +
                                            "</div>" +
                                            "</div>" +
                                            "<div data-cls = \""+ mensaje[1]+"\" class=\"message-wrap\">" +
                                            ""+mensaje[3] +"</div>" +
                                            "</div>")

                                    }
                                    repage();
                                }
                            }


                        </script>
                        <div class="col-lg-12 position-relative">
                            <div id="scroll" class="chat-wrapper pt-0 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                                <div class="chat-body p-3 ">
                                    <div id="chatroom" class="messages-content pb-5">

                                        <div class="clearfix"></div>


                                    </div>
                                </div>
                            </div>
                            <div class="chat-bottom dark-bg p-3 shadow-none theme-dark-bg" style="width: 98%;">
                                <div class="chat-form">

                                    <input id="inputMSG" class="form-group" type="text" style="background-color: aliceblue; color: black">
                                    <button class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                </div>
                            </div> 
                        </div>

                    </div>
                </div>
                 
            </div>            
        </div>
        <!-- main content -->


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
 

    <div class="modal-popup-chat">
        <div class="modal-popup-wrap bg-white p-0 shadow-lg rounded-3">
            <div class="modal-popup-header w-100 border-bottom">
                <div class="card p-3 d-block border-0 d-block">
                    <figure class="avatar mb-0 float-left me-2">
                        <img src="https://via.placeholder.com/50x50.png" alt="image" class="w35 me-1">
                    </figure>
                    <h5 class="fw-700 text-primary font-xssss mt-1 mb-1">Hendrix Stamp</h5>
                    <h4 class="text-grey-500 font-xsssss mt-0 mb-0"><span class="d-inline-block bg-success btn-round-xss m-0"></span> Available</h4>
                    <a href="#" class="font-xssss position-absolute right-0 top-0 mt-3 me-4"><i class="ti-close text-grey-900 mt-2 d-inline-block"></i></a>
                </div>
            </div>
            <div class="modal-popup-body w-100 p-3 h-auto">
                <div class="message"><div class="message-content font-xssss lh-24 fw-500">Hi, how can I help you?</div></div>
                <div class="date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2">Mon 10:20am</div>
                <div class="message self text-right mt-2"><div class="message-content font-xssss lh-24 fw-500">I want those files for you. I want you to send 1 PDF and 1 image file.</div></div>
                <div class="snippet pt-3 ps-4 pb-2 pe-3 mt-2 bg-grey rounded-xl float-right" data-title=".dot-typing"><div class="stage"><div class="dot-typing"></div></div></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-popup-footer w-100 border-top">
                <div class="card p-3 d-block border-0 d-block">
                    <div class="form-group icon-right-input style1-input mb-0"><input type="text" placeholder="Start typing.." class="form-control rounded-xl bg-greylight border-0 font-xssss fw-500 ps-3"><i class="feather-send text-grey-500 font-md"></i></div>
                </div>
            </div>
        </div> 
    </div>


    <script src="js/plugin.js"></script>
    <script src="js/scripts.js"></script>
    
</body>
<script>
    var un = 0;
    $(function() {
        var intervalId = window.setInterval(function(){
            messages();

        }, 1000);
    });

    function repage(){

        var elem = document.getElementById("scroll");
        elem.scrollTop = elem.scrollHeight;
    }

    document.querySelector('#inputMSG').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            var recep = "<?php echo $_GET["user"] ?>";
            var mensaje = document.getElementById("inputMSG").value
            $.ajax({
                type: "POST",
                url: "credentials/mensaje.php",
                data: {receptor :recep, msg:mensaje },
                success: function (resolve) {
                    document.getElementById("inputMSG").value = ""

                }
            });
        }
    });
</script>
</html>