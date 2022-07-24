<?php
session_start();
require_once("class/user.php");

if (!isset($_SESSION["userID"])){
    header("Location: login.html");
}
$db = new Database();
$db = $db->connect();
$user = new User();
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

</head>

<body class="color-theme-blue mont-font">

<div class="preloader"></div>


<div class="main-wrapper">

    <!-- navigation top-->
    <div class="nav-header bg-white shadow-xs border-0">
        <div class="nav-top">
            <img src="images/logos/logo.png" style="max-width: 20%"></img><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Winks </span> <?php if (isset($_SESSION["admin"])){?><div>plus</div><?php } ?>
        </div>


    </div>
    <!-- navigation top -->



    <!-- main content -->
    <div class="main-content right-chat-active" style="padding-left: 0px !important;">
        <div class="row " style="position: fixed; float: right; margin-left: 77em; margin-top: 8em;">
            <div class="col-lg-4 text-center">
                <figure class="avatar ms-auto me-auto mb-0 mt-2 "><img id="avatar" src="<?php
                    $user->getUserImage($_SESSION["userID"],$db);
                    ?>" alt="image" class="shadow-sm rounded-3 avatar" data-id="<?php echo $user->getImageID($_SESSION["userID"]);?>" style="object-fit: cover; height: 100px; width: 100px"></figure>
                <h2 class="fw-700 font-sm text-grey-900 mt-3"><?php
                    $user->getName($_SESSION["userID"],$db);
                    ?></h2>
                <h4 class="text-grey-500 fw-500 mb-3 font-xsss mb-4">@<?php $user->getUsername($_SESSION["userID"]);?></h4>
                <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                <button type="button" class="btn btn-success fw-600 font-sm text-grey-900 mt-3" style="max-width: 300px" onclick="genial()">¡Genial!</button>
            </div>
        </div>

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

<script>
    function useThis(img,name){
        document.getElementById("avatar").setAttribute("src",name);
        document.getElementById("avatar").setAttribute("data-id",img);
    }
    function genial(){
        var idIMG = document.getElementById("avatar").getAttribute("data-id")
        $.ajax({
            method: "POST",
            url: "credentials/changeAvatar.php",
            data: {id: idIMG},
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>
                <!-- Usuarios-->
                <div class="row feed-body">
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        <?php
                        $me = $_SESSION["userID"];
                        $query = "SELECT * FROM `imagen` WHERE `id_usuario` = '".$_SESSION['userID']."'";
                        $imagenes = $db->query($query);

                            while ($imagen = mysqli_fetch_array($imagenes)) {

                                ?>
                                <div class="card shadow-xss rounded-xxl border-0 p-4 mb-3" style="display: inline-block">
                                    <div class="">
                                        <figure class=""><img id="<?php echo $imagen["id"];?>" data-name="<?php echo $imagen["direccion"]. $imagen["nombre"]?>" src=
                                            <?php echo $imagen["direccion"]. $imagen["nombre"] ?> alt="image" class="shadow-sm " style="max-height: 200px" onclick="useThis(this.id,this.getAttribute('data-name'))"></figure>

                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!-- Fin usuarios-->
                        <div class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                            <div class="snippet mt-2 ms-auto me-auto" data-title=".dot-typing">
                                <div class="stage">
                                    <div class="dot-typing"></div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- main content -->

    <!-- right chat -->


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


</body>

</html>