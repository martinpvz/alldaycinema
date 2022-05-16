<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
  header("location:./index.php"); 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfiles</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="header-profiles">
    <img src="./img/alldaycinema2_blanco.png" alt="Logo de imagen" class="img-logo__profiles">
    <button class="edit-profiles" onclick="editarPerfil()" id="editarPerfil">Editar perfiles</button>
  </header>

  <main class="main-login">
    <h2 class="create-text" id="create-text">¿Quién eres?</h2>
    <div class="profiles" id="profiles-list">
      <a href="./createProfile.php" class="add-profile" id="add-profile">
        <img src="./img/add.png" alt="Añadir perfil">
      </a>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  <script src="./js/profiles.js"></script>
</body>
</html>