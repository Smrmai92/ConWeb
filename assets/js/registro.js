document.addEventListener("DOMContentLoaded", function () {

    var formulario = document.getElementById("form-registro");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        registrarUsuario();
    });

});

function registrarUsuario() {

    var formulario = document.getElementById("form-registro");
    var mensaje = document.getElementById("mensaje-formulario");

    var nombre = document.getElementById("nombre");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var password2 = document.getElementById("password2");
    var terminos = document.getElementById("terminos");

    var ayudaNombre = nombre.nextElementSibling;
    var ayudaEmail = email.nextElementSibling;
    var ayudaPassword = password.nextElementSibling;
    var ayudaPassword2 = password2.nextElementSibling;
    var ayudaTerminos = document.querySelector(".terminos-texto .ayuda-campo");

    var datosFormulario = new FormData(formulario);

    var nombreValor = nombre.value.trim();
    var emailValor = email.value.trim();
    var passwordValor = password.value.trim();
    var password2Valor = password2.value.trim();

    var hayErrores = false;

    mensaje.className = "";
    mensaje.textContent = "";

    nombre.classList.remove("campo-error");
    email.classList.remove("campo-error");
    password.classList.remove("campo-error");
    password2.classList.remove("campo-error");

    ayudaNombre.textContent = "Campo obligatorio";
    ayudaEmail.textContent = "Introduce un email válido";
    ayudaPassword.textContent = "Mínimo 6 caracteres";
    ayudaPassword2.textContent = "Debe coincidir con la contraseña anterior";
    ayudaTerminos.textContent = "Debes aceptar los términos y condiciones";

    ayudaNombre.classList.remove("error-inline");
    ayudaEmail.classList.remove("error-inline");
    ayudaPassword.classList.remove("error-inline");
    ayudaPassword2.classList.remove("error-inline");
    ayudaTerminos.classList.remove("error-inline");

    if (nombreValor === "") {
        nombre.classList.add("campo-error");
        ayudaNombre.textContent = "Debes introducir tu nombre";
        ayudaNombre.classList.add("error-inline");
        hayErrores = true;
    }

    if (emailValor === "") {
        email.classList.add("campo-error");
        ayudaEmail.textContent = "Debes introducir tu email";
        ayudaEmail.classList.add("error-inline");
        hayErrores = true;
    }

    if (passwordValor === "") {
        password.classList.add("campo-error");
        ayudaPassword.textContent = "Debes introducir una contraseña";
        ayudaPassword.classList.add("error-inline");
        hayErrores = true;
    }

    if (password2Valor === "") {
        password2.classList.add("campo-error");
        ayudaPassword2.textContent = "Debes repetir la contraseña";
        ayudaPassword2.classList.add("error-inline");
        hayErrores = true;
    }

    if (passwordValor !== "" && password2Valor !== "" && passwordValor !== password2Valor) {
        password2.classList.add("campo-error");
        ayudaPassword2.textContent = "Las contraseñas no coinciden";
        ayudaPassword2.classList.add("error-inline");
        hayErrores = true;
    }

    if (!terminos.checked) {
        ayudaTerminos.textContent = "Debes aceptar los términos y condiciones";
        ayudaTerminos.classList.add("error-inline");
        hayErrores = true;
    }

    if (hayErrores) {
        return;
    }

    mensaje.textContent = "Creando cuenta...";

    fetch("../api/registro.php", {
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
                mensaje.textContent = datos.mensaje;

                setTimeout(function () {
                    window.location.href = "login.php";
                }, 800);

            } else {

                email.classList.add("campo-error");

                ayudaEmail.textContent = datos.mensaje;
                ayudaEmail.classList.add("error-inline");

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