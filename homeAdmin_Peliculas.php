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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminHome</title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
</head>

<body>

<!-- BARRA DE NAVEGACIÓN  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="./img/alldaycinema2_blanco.png" alt="Logo de imagen" width="100px" >
    <a class="navbar-brand" style="padding-left: 20px;" href="./homeAdmin_Peliculas.php">AdminHome</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"></ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2 " name="search" id="search" type="search"
                placeholder="Título, clasificación, género..." aria-label="Search">
            <!-- <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button> -->
            <img src="./img/search.png" alt="Buscar" width="30px">
        </form>
        <a href="./logout.php" style="font-size: 0.9rem; margin-right: 10px; margin-left: 10px;" id="cerrar-sesionAd" class="btn btn-sm btn-danger">Cerrar sesión</a>
    </div>
</nav>

<div class="container">
    <div class="row p-4">
        <div class="col-md-5">
            <div class="card bg-secondary mb-3">
                <div class="card-body">
                    <a  href="#" style="font-size: 1.4rem; margin-right: 10px;" id="link-movies" class="btn btn-sm btn-primary"> Agregar Películas</a>
                    <a href="#" style="font-size: 1.4rem;" id="link-series" class="btn btn-sm btn-primary"> Agregar Series</a>
                    <!-- FORMULARIO PARA AGREGAR O EDITAR PELICULAS-->
                    <form id="movies-form">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="form-id"
                                placeholder="Id" readonly></li>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" id="form-title" onBlur=""
                                placeholder="Título" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="duration" id="form-duration" onBlur=""
                                placeholder="Duración" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="seasons" id="form-seasons" onBlur=""
                                placeholder="Número de temporadas" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="chapters" id="form-chapters" onBlur=""
                                placeholder="Total de capítulos" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="image" id="form-image" onBlur=""
                                placeholder="Ruta imagen" value ="/img/default.jpg" required>
                        </div>
                        <div class="form-group">
                            <select class="form-select form-control" aria-label="Default select example"
                                name="region" id="form-region" onBlur="" required>
                                <option hidden selected value="">Región</option>
                                <option value="1">0</option>
                                <option value="2">1</option>
                                <option value="3">2</option>
                                <option value="4">3</option>
                                <option value="5">4</option>
                                <option value="6">5</option>
                                <option value="7">6</option>
                                <option value="8">7</option>
                                <option value="9">8</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <!-- <input  list="genre" class="form-control" name="genre"  id="form-genre" onBlur="" placeholder="Género"/> -->
                            <select class="form-select form-control" aria-label="Default select example"
                                name="genre" id="form-genre" onBlur="" required>
                                <option hidden selected value="">Género</option>
                                <option value="1"> Ciencia Ficción </option>
                                <option value="2"> Acción </option>
                                <option value="3"> Comedia </option>
                                <option value="4"> Fantasía </option>
                                <option value="5"> Drama </option>
                                <option value="6"> Musical </option>
                                <option value="7"> Romantico </option>
                                <option value="8"> Suspenso </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="year" id="form-year" onBlur=""
                                placeholder="Lanzamiento" required>
                        </div>
                        <div class="form-group">
                            <!-- <input list="clasification" class="form-control" name="clasification" id="form-clasification" onBlur="" placeholder="Clasificación" require> -->
                            <select class="form-select form-control" aria-label="Default select example"
                                name="clasification" id="form-clasification" onBlur="" required>
                                <option hidden selected value="">Clasificación</option>
                                <option value="1">AA</option>
                                <option value="2">A</option>
                                <option value="3">B</option>
                                <option value="4">B15</option>
                                <option value="5">C</option>
                                <option value="6">D</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <input list="available" class="form-control" name="available" id="form-available" onBlur="" placeholder="Disponible"> -->
                            <select class="form-select form-control"
                                aria-label="Default select example" name="available" id="form-available"
                                onBlur="" required>
                                <option hidden selected value="">Disponible</option>
                                <option value="0"> Sí </option>
                                <option value="1"> No </option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block text-center" type="submit" onBlur=""
                            id="btn-agregar">
                            Agregar
                        </button>
                        <button class="btn btn-danger btn-block text-center" type="reset" onBlur=""
                        id="btn-cancelar">
                        Cancelar
                    </button>
                    </form>
                </div>
            </div>
        </div>

            <!-- TABLA  -->
            <div class="col-md-7">
                <div class="card my-4" id="status-bar">
                    <div class="card-body">
                        <!-- RESULTADO -->
                        <ul id="status"></ul>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Título</td>
                            <td>Descripción</td>
                        </tr>
                    </thead>
                    <tbody id="peliculas"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="./js/jquery.min.js"></script> -->
    <!-- Lógica del Frontend -->
    <script src="./js/homeAdmin.js"></script>
</body>

</html>