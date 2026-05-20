// Cuando carga la página, obtenemos la categoría y activamos el formulario
document.addEventListener("DOMContentLoaded", function () {
    cargarCategoria();

    var formulario = document.getElementById("form-editar-categoria");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        actualizarCategoria();
    });
});

// Función para leer el id_categoria que viene en la URL
function obtenerIdCategoria() {
    var parametros = new URLSearchParams(window.location.search);
    return parametros.get("id_categoria");
}

// Función que pide los datos de la categoría seleccionada
function cargarCategoria() {
    var idCategoria = obtenerIdCategoria();
    var mensaje = document.getElementById("mensaje-formulario");

    if (!idCategoria) {
        mensaje.style.color = "red";
        mensaje.textContent = "No se recibió la categoría a editar";
        return;
    }

    fetch("../api/categorias_obtener.php?id_categoria=" + idCategoria)
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {
            if (datos.estado === "ok") {
                rellenarFormulario(datos.categoria);
                cargarColoresUsados(datos.categoria.id_categoria);
            } else {
                mensaje.style.color = "red";
                mensaje.textContent = datos.mensaje;
            }
        })
        .catch(function () {
            mensaje.style.color = "red";
            mensaje.textContent = "Error al cargar la categoría";
        });
}

// Función que coloca los datos de la categoría en el formulario
function rellenarFormulario(categoria) {
    document.getElementById("id_categoria").value = categoria.id_categoria;
    document.getElementById("nombre").value = categoria.nombre;

    var inputColor = document.querySelector(
        "input[name='color_hex'][value='" + categoria.color_hex + "']"
    );

    if (inputColor) {
        inputColor.checked = true;
    }
}

// Función que marca como usados los colores de otras categorías
function cargarColoresUsados(idCategoriaActual) {

    fetch("../api/categorias_listar.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                datos.categorias.forEach(function (categoria) {

                    if (categoria.id_categoria == idCategoriaActual) {
                        return;
                    }

                    var inputColor = document.querySelector(
                        "input[name='color_hex'][value='" + categoria.color_hex + "']"
                    );

                    if (inputColor) {

                        inputColor.disabled = true;

                        var label = inputColor.closest(".color-opcion");

                        if (label) {
                            label.classList.add("color-usado");
                        }
                    }

                });
            }

        })
        .catch(function () {
            console.log("Error al cargar colores usados");
        });
}

// Función que envía los cambios al backend
function actualizarCategoria() {

    limpiarErroresCategoria();

    var formulario = document.getElementById("form-editar-categoria");
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
    mensaje.textContent = "Guardando cambios...";

    fetch("../api/categorias_actualizar.php", {
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