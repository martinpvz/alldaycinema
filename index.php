<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="./cs/style.css">
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
        <form action="./backend/validar.php" method="post" class="form-login">
            <div class="user-data user">
                <p>Usuario</p>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="user-data password">
                <p>Contraseña</p>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" value="Iniciar sesión" class="login-button">
        </form>

        <div class="register">
            <span>¿Aún no tienes cuenta?</span>
            <a href="registro.html" class="register-link">Regístrate</a>
        </div>
    </main>
</body>

</html>