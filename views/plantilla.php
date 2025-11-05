<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Ghangi Notificaciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />

    <?php include "views/modules/css-link.php"; ?>

    <?php include "views/modules/js-script.php"; ?>

</head>

<body data-sidebar="dark" data-keep-enlarged="false" class="vertical-collpsed">

    <?php
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
        echo '<div id="layout-wrapper">';
        include "views/modules/menu.php";
        include "views/modules/header.php";

        if (isset($_GET["url"])) {
            if (
                $_GET["url"] == "usuarios" ||
                $_GET["url"] == "dashboard" ||
                $_GET["url"] == "padron" ||
                $_GET["url"] == "404" ||
                $_GET["url"] == "login" ||
                $_GET["url"] == "salir"
            ) {
                include "views/modules/" . $_GET['url'] . ".php";
            } else {
                include "views/modules/404.php";
            }
        } else {
            include "views/modules/inicio/dashboard.php";
        }

        include "views/modules/footer.php";
        echo '</div>';
    } else {
        include "views/modules/login.php";
    }
    ?>

    <?php include "views/modules/js_modules.php"; ?>


</body>

</html>