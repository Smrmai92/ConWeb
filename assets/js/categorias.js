var listaCategorias = [];
var categoriasFiltradas = [];
var paginaActualCategorias = 1;
var categoriasPorPagina = 4;

document.addEventListener("DOMContentLoaded", function () {

    cargarCategorias();

    var buscador = document.getElementById("buscar-categoria");

    if (buscador) {
        buscador.addEventListener("input", function () {
            paginaActualCategorias = 1;
            filtrarCategorias();
        });
    }

});

function obtenerCategoriasPorPagina() {

    if (window.innerWidth <= 768) {
        return 8;
    }

    return 4;
}

function cargarCategorias() {

    fetch("../api/categorias_listar.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                listaCategorias = datos.categorias;

                listaCategorias.sort(function (a, b) {
                    return a.nombre.toLowerCase().localeCompare(b.nombre.toLowerCase());
                });

                categoriasFiltradas = listaCategorias;

                var parametros = new URLSearchParams(window.location.search);
                var busquedaInicial = parametros.get("buscar");

                if (busquedaInicial) {

                    var buscador = document.getElementById("buscar-categoria");

                    if (buscador) {
                        buscador.value = busquedaInicial;
                        filtrarCategorias();
                        mostrarVistaPreviaCategorias();
                        return;
                    }
                }

                mostrarCategoriasPaginadas();
                mostrarVistaPreviaCategorias();

            } else {

                document.getElementById("mensaje").textContent =
                    "No se pudieron obtener las categorías";
            }

        })
        .catch(function () {

            document.getElementById("mensaje").textContent =
                "Error al cargar las categorías";

        });
}

function filtrarCategorias() {

    var texto = document.getElementById("buscar-categoria").value.toLowerCase();

    categoriasFiltradas = listaCategorias.filter(function (categoria) {
        return categoria.nombre.toLowerCase().includes(texto);
    });

    mostrarCategoriasPaginadas();
}

function mostrarCategoriasPaginadas() {

    categoriasPorPagina = obtenerCategoriasPorPagina();

    var inicio = (paginaActualCategorias - 1) * categoriasPorPagina;
    var fin = inicio + categoriasPorPagina;

    var categoriasPagina = categoriasFiltradas.slice(inicio, fin);

    mostrarCategorias(categoriasPagina);
    mostrarPaginacionCategorias();
}

function mostrarCategorias(categorias) {

    var tabla = document.getElementById("tabla-categorias");
    var mensaje = document.getElementById("mensaje");
    var contenedorMobile = document.getElementById("categorias-mobile");

    tabla.innerHTML = "";

    if (contenedorMobile) {
        contenedorMobile.innerHTML = "";
    }

    if (categoriasFiltradas.length === 0) {
        mensaje.textContent = "No hay categorías para mostrar";
        return;
    }

    mensaje.textContent = "";

    categorias.forEach(function (categoria) {

        var fila = document.createElement("tr");

        fila.innerHTML =
            "<td>" + crearEtiquetaCategoria(categoria) + "</td>" +

            "<td>" +
                "<span class='color-categoria' style='background-color:" +
                    categoria.color_hex +
                    "'></span>" +
            "</td>" +

            "<td><span class='badge-contador'>" +
                categoria.total_contactos +
            "</span></td>" +

            "<td>" +
                "<a class='btn-editar' href='editar_categoria.php?id_categoria=" +
                    categoria.id_categoria +
                    "'>Editar</a>" +

                "<button class='btn-eliminar' onclick='eliminarCategoria(" +
                    categoria.id_categoria +
                    ")'>Eliminar</button>" +
            "</td>";

        tabla.appendChild(fila);

        if (contenedorMobile) {

            var tarjeta = document.createElement("article");
            tarjeta.className = "categoria-card-mobile";

            tarjeta.innerHTML =
                "<div class='categoria-card-header'>" +

                    "<div class='categoria-card-info'>" +
                        crearEtiquetaCategoria(categoria) +

                        "<span class='categoria-card-contactos'>" +
                            categoria.total_contactos +
                            " contactos" +
                        "</span>" +
                    "</div>" +

                    "<div class='categoria-card-botones'>" +
                        "<a class='btn-editar' href='editar_categoria.php?id_categoria=" +
                            categoria.id_categoria +
                            "'>Editar</a>" +

                        "<button class='btn-eliminar' onclick='eliminarCategoria(" +
                            categoria.id_categoria +
                            ")'>Eliminar</button>" +
                    "</div>" +

                "</div>";

            contenedorMobile.appendChild(tarjeta);
        }

    });
}

function crearEtiquetaCategoria(categoria) {

    return "<span class='etiqueta-categoria' style='background-color:" +
        categoria.color_hex +
        "22; color:" +
        categoria.color_hex +
        "'>" +
        categoria.nombre +
        "</span>";
}

function mostrarVistaPreviaCategorias() {

    var contenedor = document.getElementById("preview-categorias");

    if (!contenedor) {
        return;
    }

    if (listaCategorias.length === 0) {
        contenedor.innerHTML = "<p class='texto-suave'>Sin categorías</p>";
        return;
    }

    var html = "";

    listaCategorias.forEach(function (categoria) {

        html +=
            "<span class='etiqueta-categoria preview-categoria' style='background-color:" +
                categoria.color_hex +
                "22; color:" +
                categoria.color_hex +
                "'>" +
                categoria.nombre +
            "</span>";

    });

    contenedor.innerHTML = html;
}

function mostrarPaginacionCategorias() {

    var contenedor = document.getElementById("paginacion-categorias");

    if (!contenedor) {
        return;
    }

    if (window.innerWidth <= 768) {
        contenedor.innerHTML = "";
        return;
    }

    var total = categoriasFiltradas.length;

    if (total === 0) {
        contenedor.innerHTML = "";
        return;
    }

    var inicio = (paginaActualCategorias - 1) * categoriasPorPagina + 1;
    var fin = Math.min(paginaActualCategorias * categoriasPorPagina, total);
    var totalPaginas = Math.ceil(total / categoriasPorPagina);

    contenedor.innerHTML =
        "<span>Mostrando " + inicio + " - " + fin + " de " + total + " categorías</span>" +
        "<div class='paginacion-botones'>" +
            "<button onclick='paginaAnteriorCategorias()' " +
                (paginaActualCategorias === 1 ? "disabled" : "") +
                ">Anterior</button>" +

            "<button onclick='paginaSiguienteCategorias()' " +
                (paginaActualCategorias === totalPaginas ? "disabled" : "") +
                ">Siguiente</button>" +
        "</div>";
}

function paginaAnteriorCategorias() {

    if (paginaActualCategorias > 1) {
        paginaActualCategorias--;
        mostrarCategoriasPaginadas();
    }
}

function paginaSiguienteCategorias() {

    var totalPaginas = Math.ceil(categoriasFiltradas.length / categoriasPorPagina);

    if (paginaActualCategorias < totalPaginas) {
        paginaActualCategorias++;
        mostrarCategoriasPaginadas();
    }
}

function eliminarCategoria(idCategoria) {

    var confirmar = confirm("¿Seguro que quieres eliminar esta categoría?");

    if (!confirmar) {
        return;
    }

    var datos = new FormData();
    datos.append("id_categoria", idCategoria);

    fetch("../api/categorias_eliminar.php", {
        method: "POST",
        body: datos
    })
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {
                cargarCategorias();
            } else {
                alert(datosRespuesta.mensaje);
            }

        })
        .catch(function () {
            alert("Error al conectar con el servidor");
        });
}