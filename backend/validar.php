<?php
include_once __DIR__.'/database.php';

$usuario = $_POST["email"];
$contraseña = $_POST["password"];

session_start();
$_SESSION['email'] = $usuario;



//Consulta
$sql = "SELECT * FROM usuario WHERE user='$usuario' and pass='$contraseña'";
$result = mysqli_query($conexion,$sql);

$filas = mysqli_num_rows($result);

if($filas){
    header("location:../profiles.html"); 
}
else{
    ?>
    <?php
    header("location:../index.php"); 
    ?>

    <h1 class="bad">ERROR DE AUTENTIFICACION</h1> <!-- Poner Bonito ese mensaje>
    <?php
}
mysqli_free_result($result);
mysqli_close($conexion);

