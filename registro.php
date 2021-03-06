<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="header-login">
    <img src="./img/alldaycinema_blanco.png" alt="Logo de imagen" class="img-logo__login">
  </header>

  <main class="main-login">
    <h2 class="create-text">Crear cuenta</h2>
    <form action="./backend/account/newaccount.php" method="post" class="form-register">
      <div class="user-data__form name">
        <p>Nombre</p>
        <input type="text" name="name" id="name" required>
      </div>
      <div class="user-data__form lastname">
        <p>Apellidos</p>
        <input type="text" name="lastname" id="lastname" required>
      </div>
      <div class="user-data__form email">
        <p>Correo</p>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="user-data__form">
        <p class="choose">Tipo de cuenta</p>
          <div class="dropdown">
            <div class="select">
              <span>Selecciona tipo de cuenta</span>
              <i class="fa fa-chevron-left"></i>
            </div>
            <input type="hidden" name="account">
            <ul class="dropdown-menu">
              <li id="0">Free</li>
              <li id="1">Premium</li>
              <li id="2">Familiar</li>
            </ul>
          </div>
      <span class="msg"></span>
      </div>
      <div class="user-data__form">
        <p class="choose">País</p>
          <div class="dropdown">
            <div class="select">
              <span>Selecciona país</span>
              <i class="fa fa-chevron-left"></i>
            </div>
            <input type="hidden" name="country">
            <ul class="dropdown-menu">
              <li id="mx">México</li>
              <li id="us">Estados Unidos</li>
              <li id="ca">Canadá</li>
            </ul>
          </div>
      <span class="msg"></span>
      </div>
      <div class="user-data__form card">
        <p>Número de tarjeta</p>
        <input type="text" name="card" id="card" required>
      </div>
      <div class="user-data__form">
        <p class="choose">Suscripción</p>
          <div class="dropdown">
            <div class="select">
              <span>Selecciona suscripción</span>
              <i class="fa fa-chevron-left"></i>
            </div>
            <input type="hidden" name="suscription">
            <ul class="dropdown-menu">
              <li id="0">Mensual</li>
              <li id="1">Anual</li>
            </ul>
          </div>
      <span class="msg"></span>
      </div>
      <div class="user-data__form user">
        <p>Usuario</p>
        <input type="text" name="user" id="user" required>
      </div>
      <div class="user-data__form password">
        <p>Contraseña</p>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="control-buttons">
        <input type="submit" value="Guardar" class="button-register register-button" name="guardar" id="addAccount">
        <button type="button" class="button-register cancel-button" onclick="location.href = './index.php'">Cancelar</button>
      </div>
    </form>

  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>
</body>
</html>