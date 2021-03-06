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
  <title>Editar</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="header-edit">
    <img src="./img/alldaycinema3_blanco.png" alt="Logo de imagen" class="img-logo__edit">
  </header>

  <main class="main-login edit-profile">
    <h2 class="create-text">Editar perfil</h2>
    <div class="form-edit">
      <form action="./backend/profile/profile-edit.php" method="post" class="form-register--edit">
        <div class="user-data__form user" hidden>
          <p>idCuenta</p>
          <input type="text" name="idaccount" id="idaccount">
        </div>
        <div class="user-data__form user" hidden>
          <p>idPerfil</p>
          <input type="text" name="idprofile" id="idprofile">
        </div>
        <div class="user-data__form user">
          <p>Usuario</p>
          <input type="text" name="user" id="user" required>
        </div>
        <div class="user-data__form">
          <p class="choose">Idioma</p>
            <div class="dropdown">
              <div class="select">
                <span>Selecciona idioma</span>
                <i class="fa fa-chevron-left"></i>
              </div>
              <input type="hidden" name="language">
              <ul class="dropdown-menu">
                <li id="es">Español</li>
                <li id="en">Inglés</li>
              </ul>
            </div>
        <span class="msg"></span>
        </div>
        <div class="user-data__form card">
          <p>Edad</p>
          <input type="text" name="age" id="age">
        </div>
        <div class="user-data__form card">
          <p>Imagen</p>
          <input type="text" name="image" id="image">
        </div>
        <div class="control-buttons">
          <input type="submit" value="Guardar" class="button-register register-button">
          <button type="button" class="button-register cancel-button" onclick="location.href = './profiles.php'">Cancelar</button>
          <button id="eliminar-perfil" type="button" class="button-register delete-button">Eliminar perfil</button>
        </div>
      </form>
      <div class="image-edit__container">
        <img src="./img/perfil.png" alt="Imagen de perfil" class="image-edit" id="image-edit">
      </div>
    </div>

  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>
  <script src="./js/editProfile.js"></script>
</body>
</html>