<?php
    use API\Crear\Crear;
    require_once './API/CrearCuenta/CrearCuenta.php';
    $Cuenta = new Crear();
    $Cuenta->crear($_POST);
    
    echo "<script type=\"text/javascript\">alert(\"probando\");</script>";
    header("Location:../index.html");
?>