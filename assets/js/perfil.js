document.addEventListener("DOMContentLoaded", function () {

    cargarPerfil();
    cargarAccesos();

    var formulario =
        document.getElementById("form-perfil-completo");

    if (formulario) {

        formulario.addEventListener("submit", function (evento) {

            evento.preventDefault();

            guardarCambiosPerfil();
        });
    }

    var inputFoto =
        document.getElementById("foto_perfil");

    if (inputFoto) {

        inputFoto.addEventListener("change", function () {

            subirFotoPerfil();
        });
    }

    var botonEliminarFoto =
        document.getElementById("btn-eliminar-foto");

    if (botonEliminarFoto) {

        botonEliminarFoto.addEventListener("click", function () {

            eliminarFotoPerfil();
        });
    }

});

function formatearFecha(fechaOriginal) {

    if (!fechaOriginal) {
        return "";
    }

    var fecha =
        new Date(fechaOriginal.replace(" ", "T"));

    if (isNaN(fecha.getTime())) {
        return fechaOriginal;
    }

    return String(fecha.getDate()).padStart(2, "0") + "/" +
           String(fecha.getMonth() + 1).padStart(2, "0") + "/" +
           fecha.getFullYear();
}

function formatearFechaHora(fechaOriginal) {

    if (!fechaOriginal) {
        return "";
    }

    var fecha =
        new Date(fechaOriginal.replace(" ", "T"));

    if (isNaN(fecha.getTime())) {
        return fechaOriginal;
    }

    return String(fecha.getDate()).padStart(2, "0") + "/" +
           String(fecha.getMonth() + 1).padStart(2, "0") + "/" +
           fecha.getFullYear() + " " +
           String(fecha.getHours()).padStart(2, "0") + ":" +
           String(fecha.getMinutes()).padStart(2, "0");
}

function cargarPerfil() {

    fetch("../api/perfil_obtener.php")

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datos) {

            if (datos.estado === "ok") {

                document.getElementById("nombre").value =
                    datos.usuario.nombre;

                document.getElementById("perfil-email").textContent =
                    datos.usuario.email;

                document.getElementById("perfil-fecha").textContent =
                    formatearFecha(datos.usuario.fecha_registro);

                var inicial =
                    datos.usuario.nombre.charAt(0).toUpperCase();

                var contenedorFoto =
                    document.getElementById("preview-foto-perfil");

                if (contenedorFoto) {

                    if (datos.usuario.foto_perfil) {

                        contenedorFoto.innerHTML =
                            "<img src='../" +
                            datos.usuario.foto_perfil +
                            "' alt='Foto de perfil'>";

                    } else {

                        contenedorFoto.innerHTML =
                            "<span id='perfil-inicial'>" +
                            inicial +
                            "</span>";
                    }
                }

            }

        })

        .catch(function () {

            console.log("Error al cargar el perfil");

        });
}

function guardarCambiosPerfil() {

    limpiarErrores();

    var mensaje =
        document.getElementById("mensaje-formulario");

    var nombre =
        document.getElementById("nombre");

    var passwordActual =
        document.getElementById("password_actual");

    var passwordNueva =
        document.getElementById("password_nueva");

    var passwordRepetir =
        document.getElementById("password_repetir");

    var hayError = false;

    if (nombre.value.trim() === "") {

        mostrarErrorCampo(
            nombre,
            "Debes introducir un nombre"
        );

        hayError = true;
    }

    var quiereCambiarPassword =
        passwordActual.value.trim() !== "" ||
        passwordNueva.value.trim() !== "" ||
        passwordRepetir.value.trim() !== "";

    if (quiereCambiarPassword) {

        if (passwordActual.value.trim() === "") {

            mostrarErrorCampo(
                passwordActual,
                "Introduce tu contraseña actual"
            );

            hayError = true;
        }

        if (passwordNueva.value.trim() === "") {

            mostrarErrorCampo(
                passwordNueva,
                "Introduce una nueva contraseña"
            );

            hayError = true;

        } else if (passwordNueva.value.length < 6) {

            mostrarErrorCampo(
                passwordNueva,
                "Mínimo 6 caracteres"
            );

            hayError = true;
        }

        if (passwordRepetir.value.trim() === "") {

            mostrarErrorCampo(
                passwordRepetir,
                "Debes repetir la contraseña"
            );

            hayError = true;

        } else if (
            passwordNueva.value !== passwordRepetir.value
        ) {

            mostrarErrorCampo(
                passwordRepetir,
                "Las contraseñas no coinciden"
            );

            hayError = true;
        }
    }

    if (hayError) {
        return;
    }

    mensaje.className = "";
    mensaje.style.color = "#6B7280";
    mensaje.textContent = "Guardando cambios...";

    actualizarNombre(quiereCambiarPassword);
}

function actualizarNombre(cambiarPasswordDespues) {

    var mensaje =
        document.getElementById("mensaje-formulario");

    var datos = new FormData();

    datos.append(
        "nombre",
        document.getElementById("nombre").value.trim()
    );

    fetch("../api/perfil_actualizar.php", {
        method: "POST",
        body: datos
    })

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {

                if (cambiarPasswordDespues) {

                    actualizarPassword();

                } else {

                    mensaje.className = "mensaje-exito";
                    mensaje.style.color = "";

                    mensaje.textContent =
                        "Perfil actualizado correctamente";

                    setTimeout(function () {

                        window.location.reload();

                    }, 700);
                }

            } else {

                mensaje.className = "mensaje-error";
                mensaje.style.color = "";

                mensaje.textContent =
                    datosRespuesta.mensaje;
            }

        })

        .catch(function () {

            mensaje.className = "mensaje-error";
            mensaje.style.color = "";

            mensaje.textContent =
                "Error al conectar con el servidor";

        });
}

function actualizarPassword() {

    var mensaje =
        document.getElementById("mensaje-formulario");

    var datos = new FormData();

    datos.append(
        "password_actual",
        document.getElementById("password_actual").value
    );

    datos.append(
        "password_nueva",
        document.getElementById("password_nueva").value
    );

    datos.append(
        "password_repetir",
        document.getElementById("password_repetir").value
    );

    fetch("../api/perfil_password.php", {
        method: "POST",
        body: datos
    })

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {

                mensaje.className = "mensaje-exito";
                mensaje.style.color = "";

                mensaje.textContent =
                    "Contraseña actualizada correctamente";

                document.getElementById("password_actual").value = "";
                document.getElementById("password_nueva").value = "";
                document.getElementById("password_repetir").value = "";

                setTimeout(function () {

                    window.location.reload();

                }, 700);

            } else {

                mensaje.className = "mensaje-error";
                mensaje.style.color = "";

                mensaje.textContent =
                    datosRespuesta.mensaje;
            }

        })

        .catch(function () {

            mensaje.className = "mensaje-error";
            mensaje.style.color = "";

            mensaje.textContent =
                "Error al conectar con el servidor";

        });
}

function subirFotoPerfil() {

    var inputFoto =
        document.getElementById("foto_perfil");

    var mensajeFoto =
        document.getElementById("mensaje-foto");

    if (inputFoto.files.length === 0) {
        return;
    }

    var datos = new FormData();

    datos.append(
        "foto_perfil",
        inputFoto.files[0]
    );

    mensajeFoto.className = "";
    mensajeFoto.style.color = "#6B7280";
    mensajeFoto.textContent = "Subiendo foto...";

    fetch("../api/perfil_foto.php", {
        method: "POST",
        body: datos
    })

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {

                mensajeFoto.className = "mensaje-exito";
                mensajeFoto.style.color = "";

                mensajeFoto.textContent =
                    datosRespuesta.mensaje;

                setTimeout(function () {

                    window.location.reload();

                }, 700);

            } else {

                mensajeFoto.className = "mensaje-error";
                mensajeFoto.style.color = "";

                mensajeFoto.textContent =
                    datosRespuesta.mensaje;
            }

        })

        .catch(function () {

            mensajeFoto.className = "mensaje-error";
            mensajeFoto.style.color = "";

            mensajeFoto.textContent =
                "Error al subir la foto";

        });
}

function eliminarFotoPerfil() {

    var mensajeFoto =
        document.getElementById("mensaje-foto");

    fetch("../api/perfil_foto_eliminar.php", {
        method: "POST"
    })

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {

                mensajeFoto.className = "mensaje-exito";
                mensajeFoto.style.color = "";

                mensajeFoto.textContent =
                    datosRespuesta.mensaje;

                setTimeout(function () {

                    window.location.reload();

                }, 700);

            } else {

                mensajeFoto.className = "mensaje-error";
                mensajeFoto.style.color = "";

                mensajeFoto.textContent =
                    datosRespuesta.mensaje;
            }

        })

        .catch(function () {

            mensajeFoto.className = "mensaje-error";
            mensajeFoto.style.color = "";

            mensajeFoto.textContent =
                "Error al eliminar la foto";

        });
}

function cargarAccesos() {

    fetch("../api/perfil_accesos.php")

        .then(function (respuesta) {
            return respuesta.json();
        })

        .then(function (datos) {

            mostrarAccesos(datos);

        })

        .catch(function () {

            document.getElementById("lista-accesos").textContent =
                "Error al cargar accesos";

        });
}

function mostrarAccesos(datos) {

    var contenedor =
        document.getElementById("lista-accesos");

    if (datos.estado !== "ok") {

        contenedor.textContent =
            datos.mensaje;

        return;
    }

    if (datos.accesos.length === 0) {

        contenedor.textContent =
            "No hay accesos registrados";

        return;
    }

    var html = "";

    datos.accesos.forEach(function (acceso) {

        html +=
            "<div class='item-contacto-panel'>" +

                "<strong>" +
                    formatearFechaHora(acceso.fecha_hora) +
                "</strong>" +

                "<p>IP: " +
                    acceso.ip +
                "</p>" +

                "<p class='texto-suave'>" +
                    acceso.navegador +
                "</p>" +

            "</div>";
    });

    contenedor.innerHTML = html;
}

function mostrarErrorCampo(campo, texto) {

    campo.classList.add("campo-error");

    var ayuda = campo.nextElementSibling;

    if (ayuda && ayuda.classList.contains("ayuda-campo")) {

        if (!ayuda.dataset.textoOriginal) {
            ayuda.dataset.textoOriginal = ayuda.textContent;
        }

        ayuda.textContent = texto;

        ayuda.classList.add("error-inline");
    }
}

function limpiarErrores() {

    var campos =
        document.querySelectorAll(".campo-error");

    campos.forEach(function (campo) {
        campo.classList.remove("campo-error");
    });

    var ayudas =
        document.querySelectorAll(".ayuda-campo.error-inline");

    ayudas.forEach(function (ayuda) {

        if (ayuda.dataset.textoOriginal) {
            ayuda.textContent =
                ayuda.dataset.textoOriginal;
        }

        ayuda.classList.remove("error-inline");
    });
}