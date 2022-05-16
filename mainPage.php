<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
  header("location:./index.php"); 
}
// $profile = $_SESSION['profile'];
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
    <a href="./mainPage.php" class="selector-main go-main" id="home-selector">
      <img src="./img/home.png" alt="Inicio">
      <span>Home</span>
    </a>
    <a href="./list.php" class="selector-main go-movies" id="peliculas-selector">
      <img src="./img/movies.png" alt="Peliculas">
      <span>Movies</span>
    </a>
    <a href="./list.php" class="selector-main go-series" id="series-selector">
      <img src="./img/series.png" alt="Series">
      <span>Series</span>
    </a>
    <div class="selector-main go-search" id="buscador-div">
      <img src="./img/search.png" alt="Buscar">
      <!-- <span>Search</span> -->
      <input type="text" placeholder="Search" id="search-main">
      <div class="resultados-busqueda" id="resultados"></div>
    </div>
    <!-- <div class="resultados-busqueda" id="resultados"></div> -->
    <div class="profile-main" id="perfil-main">
      <span class="profile-name" id="nombre-perfil"></span>
      <img alt="" id="imagen-perfil">
    </div>
    <div class="profile-controlers" id="controles-main">
      <a href="./profiles.php" class="profile-controler">
        <p>Cambiar perfil</p>
      </a>
      <a href="./logout.php" class="profile-controler" id="cerrar-sesion">
        <p>Cerrar sesión</p>
      </a>
    </div>
  </header>
  <main>
    <section class="carousel-main">
      <div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
        <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner relative w-full overflow-hidden rounded-2xl shadow-md">
          <div class="carousel-item active relative float-left w-full">
            <img
              src="./img/batmanPoster.jpg"
              class="block w-full"
              alt="..."
            />
            <div class="carousel-caption hidden md:block absolute text-center">
              <h5 class="text-5xl mb-2">The Batman</h5>
              <p class="text-2xl mb-6">Batman ventures into Gotham City's underworld when a sadistic killer leaves behind a trail of cryptic clues.</p>
            </div>
          </div>
          <div class="carousel-item relative float-left w-full">
            <img
              src="./img/gotPoster.jpg"
              class="block w-full"
              alt="..."
            />
            <div class="carousel-caption hidden md:block absolute text-center">
              <h5 class="text-5xl mb-2">Game of Thrones</h5>
              <p class="text-2xl mb-6">Nine noble families wage war against each other in order to gain control over the mythical land of Westeros.</p>
            </div>
          </div>
          <div class="carousel-item relative float-left w-full">
            <img
              src="./img/mrrobotPoster.jpg"
              class="block w-full"
              alt="..."
            />
            <div class="carousel-caption hidden md:block absolute text-center">
              <h5 class="text-5xl mb-2">Mr. Robot</h5>
              <p class="text-2xl mb-6">Elliot, a cyber-security engineer suffering from anxiety, works for a corporation and hacks felons by night.</p>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <section class="generos-main">
      <a href="./list.php" class="genero-card" id="accion-card">
        <img src="./img/accion.webp" alt="">
      </a>
      <a href="./list.php" class="genero-card" id="ciencia-card">
        <img src="./img/ciencia.jpg" alt="" >
      </a>
      <a href="./list.php" class="genero-card" id="drama-card">
        <img src="./img/drama.jpg" alt="" >
      </a>
      <a href="./list.php" class="genero-card" id="misterio-card">
        <img src="./img/suspenso.jpg" alt="" >
      </a>
    </section>

    <section class="carousel2">
      <p class="title-main">Acción</p>
      <div class="carousel2__container" id="carousel-accion"></div>
    </section>

    <section class="carousel2">
      <p class="title-main">Comedia</p>
      <div class="carousel2__container" id="carousel-comedy"></div>
    </section>

    <section class="carousel2">
      <p class="title-main">Musical</p>
      <div class="carousel2__container" id="carousel-musical"></div>
    </section>

    <section class="carousel2">
      <p class="title-main">Fantasia</p>
      <div class="carousel2__container" id="carousel-fantasy"></div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>
  <script src="./js/search.js"></script>
</body>
</html>