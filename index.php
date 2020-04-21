<?php
session_start();
//  require('catautenticado.php');
require('../conexion/bdd.php');
$bdd = new bdd;
$inst = $bdd->desencriptar($_GET['tituc'], $bdd->claveEncriptacion);
$ERROR = false;
if (isset($_SESSION['ERROR']) and isset($_SESSION['ERROR_USER'])) {
    $ERROR = true;
    if ($_SESSION['ERROR'] == "1") { //error de inicio de sesion
        $mensaje = "Error de inicio de sesi&oacute;n compruebe su nombre de usuario y contrase&ntilde;a";
    } else if ($_SESSION['ERROR'] == "2") { //su sesion ha expirado
        $mensaje = "Su sesi&oacute;n ha expirado, por favor inicie sesi&oacute;n nuevamente.";
    } else {
        $ERROR = false;
    }
    session_start();
    session_destroy();
}
//  require("cabeceracat.php");
//  require("menucat.php");
// require("pie.php");
//  $CATEDRATICO=$_SESSION['persona'];
//  $_SESSION['CICLOACTIVOCAT']=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/ghpages-materialize.css">
    <link rel="stylesheet" href="assets/css/materialize.css">
    <link rel="stylesheet" href="assets/css/mystyles.css">

    <!-- Compiled and minified JavaScript -->
    <?= getTitlePage() ?>
    <?= getRequiresCssJs() ?>
</head>
<body class="body-back">
<div class="container" style="width: 85%; height: 80%;">
    <?php
    if ((isset($_POST['login']) and $error) || $valor1 != "") {
        printMsgError($valor1);
        unset($_SESSION['MSG']);
    }
    ?>
    <section id="formlogin" style="padding-top: 18%;">
        <div class="row">
            <form class="col s12 transparent-background" method="post" action="userautenticado.php" style="max-width: 450px;">
                <h2>Inicio de Sesi&oacute;n</h2>
                <div class="row">
                    <div class="input-field col s12">
                        <input value="<?= $_POST['username'] ?>" type="text" placeholder="" required=""
                               id="username"
                               name="username" class="validate">
                        <label for="username">Usuario</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" placeholder="" required="" id="password" name="password"
                               class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <?php

                if ($ERROR) {
                    echo '<span style="color: #FF7B7B; ">' . $mensaje . '</span></br></br>';
                }
                ?>
                <div class="row">
                    <a style="float: left" class="lost-pwd" href="Recovery.php">Olvid&eacute; mi contrase&ntilde;a</a>
                    <input style="float: right" class="white-text waves-effect waves-green green darken-4 btn"
                           type="submit" name="login" value="Ingresar"/>
                </div>
            </form>
        </div>
        <div class="row" style="width: 100%;">
            <div class="col l6 m8 s12 transparent-background" style="float: right;">
                <img src="assets/img/name.png" style="float: right; height: auto; width: 100%">
            </div>
        </div>
    </section>
</div>

<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/materialize.min.js"></script>
<script src="utils/principal-menu.js"></script>

</body>
</html>