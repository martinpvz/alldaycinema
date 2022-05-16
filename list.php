<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
  header("location:./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>alldaycinema</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="header-main">
    <img src="./img/alldaycinema3_blanco.png" alt="Logo" class="img-logo__edit img-main">
    <a class="selector-main go-main" id="home-list">
      <img src="./img/home.png" alt="Inicio">
      <span>Home</span>
    </a>
    <a class="selector-main go-movies" id="peliculas-selector">
      <img src="./img/movies.png" alt="Peliculas">
      <span>Movies</span>
    </a>
    <a class="selector-main go-series" id="series-selector">
      <img src="./img/series.png" alt="Series">
      <span>Series</span>
    </a>
    <div class="selector-main go-search" id="buscador-div">
      <img src="./img/search.png" alt="Buscar">
      <!-- <span>Search</span> -->
      <input type="text" placeholder="Search" id="search-main">
    </div>
    <div class="profile-main" id="perfil-main">
      <span class="profile-name" id="nombre-perfil"></span>
      <img alt="" id="imagen-perfil">
    </div>
    <div class="profile-controlers" id="controles-main">
      <a href="./profiles.php" class="profile-controler">
        <p>Cambiar perfil</p>
      </a>
      <a href="./index.php" class="profile-controler">
        <p>Cerrar sesión</p>
      </a>
    </div>
  </header>
  <main>
    <h2 class="title-list" id="title-list">Movies</h2>
    <div class="list-container" id="list-container">
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="./js/catalogue.js"></script>

</body>
</html>