document.addEventListener("DOMContentLoaded", function () {

    cargarColoresUsados();

    var formulario = document.getElementById("form-nueva-categoria");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        crearCategoria();
    });

});

function cargarColoresUsados() {

    fetch("../api/categorias_listar.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                datos.categorias.forEach(function (categoria) {

                    var inputColor = document.querySelector(
                        "input[name='color_hex'][value='" + categoria.color_hex + "']"
                    );

                    if (inputColor) {

                        inputColor.disabled = true;

                        var label = inputColor.closest(".color-opcion");

                        if (label) {
                            label.classList.add("color-usado");

                            var texto = label.querySelector("small");

                            if (texto) {
                                texto.textContent = "Usado";
                            }
                        }
                    }

                });
            }

        })
        .catch(function () {
            console.log("Error al cargar colores usados");
        });
}

function crearCategoria() {

    limpiarErroresCategoria();

    var formulario = document.getElementById("form-nueva-categoria");
    var mensaje = document.getElementById("mensaje-formulario");
    var nombre = document.getElementById("nombre");
    var colorSeleccionado = document.querySelector("input[name='color_hex']:checked");

    var hayError = false;

    if (nombre.value.trim() === "") {
        mostrarErrorNombreCategoria("El nombre es obligatorio", 1);
        hayError = true;
    }

    if (!colorSeleccionado) {
        mostrarErrorColorCategoria("Debes seleccionar un color");
        hayError = true;
    }

    if (hayError) {
        mensaje.className = "";
        mensaje.style.color = "";
        mensaje.textContent = "";
        return;
    }

    var datosFormulario = new FormData(formulario);

    mensaje.className = "";
    mensaje.style.color = "#6B7280";
    mensaje.textContent = "Creando categoría...";

    fetch("../api/categorias_crear.php", {
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
                    window.location.href = "categorias.php";
                }, 800);

            } else {

                mensaje.className = "";
                mensaje.style.color = "";
                mensaje.textContent = "";

                if (datos.mensaje.toLowerCase().includes("color")) {
                    mostrarErrorColorCategoria(datos.mensaje);
                } else {
                    mostrarErrorNombreCategoria(datos.mensaje, 2);
                }
            }

        })
        .catch(function () {
            mensaje.className = "mensaje-error";
            mensaje.style.color = "";
            mensaje.textContent = "Error al conectar con el servidor";
        });
}

function mostrarErrorNombreCategoria(texto, ayudaNumero) {

    var nombre = document.getElementById("nombre");
    nombre.classList.add("campo-error");

    var ayudas = nombre.parentElement.querySelectorAll(".ayuda-campo");

    if (ayudas.length >= ayudaNumero) {
        var ayuda = ayudas[ayudaNumero - 1];

        if (!ayuda.dataset.textoOriginal) {
            ayuda.dataset.textoOriginal = ayuda.textContent;
        }

        ayuda.textContent = texto;
        ayuda.classList.add("error-inline");
    }
}

function mostrarErrorColorCategoria(texto) {

    var coloresGrid = document.querySelector(".colores-grid");

    if (!coloresGrid) {
        return;
    }

    var errorColor = document.getElementById("error-color-categoria");

    if (!errorColor) {
        errorColor = document.createElement("small");
        errorColor.id = "error-color-categoria";
        errorColor.className = "ayuda-campo error-inline";
        coloresGrid.insertAdjacentElement("afterend", errorColor);
    }

    errorColor.textContent = texto;
}

function limpiarErroresCategoria() {

    var nombre = document.getElementById("nombre");
    var mensaje = document.getElementById("mensaje-formulario");

    nombre.classList.remove("campo-error");

    var ayudas = nombre.parentElement.querySelectorAll(".ayuda-campo");

    ayudas.forEach(function (ayuda) {
        if (ayuda.dataset.textoOriginal) {
            ayuda.textContent = ayuda.dataset.textoOriginal;
        }

        ayuda.classList.remove("error-inline");
    });

    var errorColor = document.getElementById("error-color-categoria");

    if (errorColor) {
        errorColor.remove();
    }

    mensaje.className = "";
    mensaje.style.color = "";
    mensaje.textContent = "";
}