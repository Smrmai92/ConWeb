<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Login</title>

    <!-- CSS principal -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body class="body-login">

    <main class="login-contenedor">

        <section class="login-tarjeta">

            <div class="login-logo">
                <img src="../assets/img/LogoTitulo_Trans.png" alt="ConWeb">
            </div>

            <h1 class="titulo-login">
                Iniciar Sesión
            </h1>

            <form id="form-login">

                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <small class="ayuda-campo">Introduce tu email</small>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password">
                <small class="ayuda-campo">Introduce tu contraseña</small>

                <button type="submit" class="btn-principal">
                    Iniciar sesión
                </button>

                <p id="mensaje-formulario"></p>
                <p class="texto-enlace">
                    ¿No tienes cuenta?
                    <a href="registro.php">Regístrate</a>
                </p>

            </form>

            <div class="legal-links">
                <a href="politica_privacidad.php">Privacidad</a>
                <span>|</span>
                <a href="politica_cookies.php">Cookies</a>
            </div>

        </section>

    </main>

    <!-- JS del login -->
    <script src="../assets/js/login.js"></script>
    <script src="..assets/js/cookies.js"></script>

</body>
</html>