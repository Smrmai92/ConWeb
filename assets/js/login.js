document.addEventListener("DOMContentLoaded", function () {

    var formulario = document.getElementById("form-login");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        iniciarSesion();
    });

});

function iniciarSesion() {

    var formulario = document.getElementById("form-login");
    var mensaje = document.getElementById("mensaje-formulario");

    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var ayudaEmail = email.nextElementSibling;
    var ayudaPassword = password.nextElementSibling;

    var datosFormulario = new FormData(formulario);

    var emailValor = email.value.trim();
    var passwordValor = password.value.trim();

    var hayErrores = false;

    mensaje.className = "";
    mensaje.textContent = "";

    email.classList.remove("campo-error");
    password.classList.remove("campo-error");

    ayudaEmail.textContent = "Introduce tu email";
    ayudaPassword.textContent = "Introduce tu contraseña";

    ayudaEmail.classList.remove("error-inline");
    ayudaPassword.classList.remove("error-inline");

    if (emailValor === "") {
        email.classList.add("campo-error");
        ayudaEmail.textContent = "Debes introducir tu email";
        ayudaEmail.classList.add("error-inline");
        hayErrores = true;
    }

    if (passwordValor === "") {
        password.classList.add("campo-error");
        ayudaPassword.textContent = "Debes introducir tu contraseña";
        ayudaPassword.classList.add("error-inline");
        hayErrores = true;
    }

    if (hayErrores) {
        return;
    }

    mensaje.textContent = "Iniciando sesión...";

    fetch("../api/login.php", {
        method: "POST",
        body: datosFormulario
    })
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                mensaje.className = "mensaje-exito";
                mensaje.style.color = "";
                mensaje.textContent = "Inicio de sesión correcto";

                setTimeout(function () {
                    window.location.href = "panel.php";
                }, 700);

            } else {
                email.classList.add("campo-error");
                password.classList.add("campo-error");

                ayudaEmail.textContent = "Revisa el email introducido";
                ayudaPassword.textContent = "Revisa la contraseña introducida";

                ayudaEmail.classList.add("error-inline");
                ayudaPassword.classList.add("error-inline");

                mensaje.className = "";
                mensaje.textContent = "";
            }

        })
        .catch(function () {
            mensaje.className = "mensaje-error";
            mensaje.style.color = "";
            mensaje.textContent = "Error al conectar con el servidor.";
        });
}