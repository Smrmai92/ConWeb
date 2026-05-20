<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Registro</title>

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body class="body-login">

    <main class="login-contenedor">

        <section class="login-tarjeta">

            <div class="login-logo">
                <img src="../assets/img/LogoTitulo_Trans.png" alt="ConWeb">
            </div>

            <h1 class="titulo-login">
                Nuevo Registro
            </h1>
            <form id="form-registro">

                <label for="nombre">Nombre*</label>
                <input type="text" id="nombre" name="nombre">
                <small class="ayuda-campo">Campo obligatorio</small>

                <label for="email">Email*</label>
                <input type="email" id="email" name="email">
                <small class="ayuda-campo">Introduce un email válido</small>

                <label for="password">Contraseña*</label>
                <input type="password" id="password" name="password">
                <small class="ayuda-campo">Mínimo 6 caracteres</small>

                <label for="password2">Repetir contraseña*</label>
                <input type="password" id="password2" name="password2">
                <small class="ayuda-campo">Debe coincidir con la contraseña anterior</small>

                <div class="checkbox-terminos">

                    <input type="checkbox" id="terminos" name="terminos">

                    <div class="terminos-texto">

                        <label for="terminos">
                            Acepto los términos y condiciones
                        </label>

                        <small class="ayuda-campo">
                            Debes aceptar los términos y condiciones
                        </small>

                    </div>

                </div>

                <button type="submit" class="btn-principal">
                    Regístrarse
                </button>

                <p id="mensaje-formulario"></p>

                <p class="texto-enlace">
                    ¿Ya tienes cuenta?
                    <a href="login.php">Inicia Sesión</a>
                </p>

            </form>

        </section>

    </main>

    <script src="../assets/js/registro.js"></script>

</body>
</html>