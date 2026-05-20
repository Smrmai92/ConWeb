var listaContactos = [];
var contactosFiltrados = [];
var paginaActual = 1;
var contactosPorPagina = 4;

function obtenerContactosPorPagina() {
    if (window.innerWidth <= 768) {
        return 3;
    }

    return 4;
}

document.addEventListener("DOMContentLoaded", function () {

    cargarContactos();

    var buscador = document.getElementById("buscar-contacto");

    if (buscador) {
        buscador.addEventListener("input", function () {
            paginaActual = 1;
            filtrarContactos();
        });
    }

});

function cargarContactos() {

    fetch("../api/contactos_listar.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                listaContactos = datos.contactos;

                listaContactos.sort(function (a, b) {

                    var nombreA = (a.nombre + " " + a.apellidos).toLowerCase();
                    var nombreB = (b.nombre + " " + b.apellidos).toLowerCase();

                    return nombreA.localeCompare(nombreB);
                });

                contactosFiltrados = listaContactos;

                var parametros = new URLSearchParams(window.location.search);
                var busquedaInicial = parametros.get("buscar");

                if (busquedaInicial) {
                    filtrarContactosDesdeTopbar(busquedaInicial);
                    return;
                }

                mostrarContactosPaginados();

            } else {
                document.getElementById("mensaje").textContent =
                    "No se pudieron obtener los contactos";
            }

        })
        .catch(function () {
            document.getElementById("mensaje").textContent =
                "Error al cargar los contactos";
        });
}

function filtrarContactos() {

    var texto = document
        .getElementById("buscar-contacto")
        .value
        .toLowerCase();

    aplicarFiltroContactos(texto);
}

function filtrarContactosDesdeTopbar(texto) {

    var buscadorInterno = document.getElementById("buscar-contacto");

    if (buscadorInterno) {
        buscadorInterno.value = texto;
    }

    aplicarFiltroContactos(texto);
}

function aplicarFiltroContactos(texto) {

    paginaActual = 1;

    var textoBusqueda = texto.toLowerCase();

    contactosFiltrados = listaContactos.filter(function (contacto) {

        var nombre = (contacto.nombre || "").toLowerCase();
        var apellidos = (contacto.apellidos || "").toLowerCase();
        var nombreCompleto = (nombre + " " + apellidos).trim();
        var telefono = (contacto.telefono || "").toLowerCase();
        var categoria = (contacto.categoria_nombre || "").toLowerCase();

        return nombre.includes(textoBusqueda) ||
               apellidos.includes(textoBusqueda) ||
               nombreCompleto.includes(textoBusqueda) ||
               telefono.includes(textoBusqueda) ||
               categoria.includes(textoBusqueda);
    });

    mostrarContactosPaginados();
}

function mostrarContactosPaginados() {

    contactosPorPagina = obtenerContactosPorPagina();

    var inicio = (paginaActual - 1) * contactosPorPagina;
    var fin = inicio + contactosPorPagina;

    var contactosPagina = contactosFiltrados.slice(inicio, fin);

    mostrarContactos(contactosPagina);
    mostrarPaginacion();
}

function mostrarContactos(contactos) {

    var tabla = document.getElementById("tabla-contactos");
    var mensaje = document.getElementById("mensaje");
    var contenedorMobile = document.getElementById("contactos-mobile");

    tabla.innerHTML = "";

    if (contenedorMobile) {
        contenedorMobile.innerHTML = "";
    }

    if (contactosFiltrados.length === 0) {
        mensaje.textContent = "No hay contactos para mostrar";
        return;
    }

    mensaje.textContent = "";

    contactos.forEach(function (contacto) {

        var fila = document.createElement("tr");

        fila.innerHTML =
            "<td>" + contacto.nombre + " " + contacto.apellidos + "</td>" +
            "<td>" + (contacto.telefono || "") + "</td>" +
            "<td>" + (contacto.email || "") + "</td>" +
            "<td>" + (contacto.empresa || "") + "</td>" +
            "<td>" + mostrarCategoria(contacto) + "</td>" +
            "<td>" + mostrarNota(contacto) + "</td>" +
            "<td>" +
                "<a class='btn-editar' href='editar_contacto.php?id_contacto=" + contacto.id_contacto + "'>Editar</a>" +
                "<button class='btn-eliminar' onclick='eliminarContacto(" + contacto.id_contacto + ")'>Eliminar</button>" +
            "</td>";

        tabla.appendChild(fila);

        if (contenedorMobile) {

            var tarjeta = document.createElement("article");
            tarjeta.className = "contacto-card-mobile";

            tarjeta.innerHTML =
                "<div class='contacto-card-header'>" +

                    "<div class='contacto-card-info'>" +
                        "<strong>" + contacto.nombre + " " + contacto.apellidos + "</strong>" +
                        "<p>" + (contacto.email || "Sin email") + "</p>" +
                        "<p>" + (contacto.empresa || "Sin empresa") + "</p>" +
                        "<p>" + (contacto.telefono || "Sin teléfono") + "</p>" +
                    "</div>" +

                    "<div class='contacto-card-lateral'>" +
                        mostrarCategoria(contacto) +
                        mostrarNota(contacto) +

                        "<div class='contacto-card-botones'>" +
                            "<a class='btn-editar' href='editar_contacto.php?id_contacto=" + contacto.id_contacto + "'>Editar</a>" +
                            "<button class='btn-eliminar' onclick='eliminarContacto(" + contacto.id_contacto + ")'>Eliminar</button>" +
                        "</div>" +
                    "</div>" +

                "</div>";

            contenedorMobile.appendChild(tarjeta);
        }

    });
}

function mostrarCategoria(contacto) {

    if (!contacto.categoria_nombre) {
        return "<span class='texto-suave texto-tabla-pequeno'>Sin categoría</span>";
    }

    return "<span class='etiqueta-categoria' style='background-color:" +
        contacto.categoria_color +
        "22; color:" +
        contacto.categoria_color +
        "'>" +
        contacto.categoria_nombre +
        "</span>";
}

function mostrarNota(contacto) {

    if (!contacto.notas || contacto.notas.trim() === "") {
        return "<span class='sin-notas'>Sin notas</span>";
    }

    return "<button class='btn-ver-nota' onclick='verNota(\"" +
        encodeURIComponent(contacto.notas) +
        "\")'>Ver nota</button>";
}

function verNota(notaCodificada) {

    var nota = decodeURIComponent(notaCodificada);

    document.getElementById("texto-modal-nota").textContent = nota;
    document.getElementById("modal-nota").classList.remove("oculto");
}

function cerrarNota() {
    document.getElementById("modal-nota").classList.add("oculto");
}

function mostrarPaginacion() {

    var contenedor = document.getElementById("paginacion-contactos");

    if (!contenedor) {
        return;
    }

    var total = contactosFiltrados.length;

    if (total === 0) {
        contenedor.innerHTML = "";
        return;
    }

    var inicio = (paginaActual - 1) * contactosPorPagina + 1;
    var fin = Math.min(paginaActual * contactosPorPagina, total);
    var totalPaginas = Math.ceil(total / contactosPorPagina);

    contenedor.innerHTML =
        "<span>Mostrando " + inicio + " - " + fin + " de " + total + " contactos</span>" +
        "<div class='paginacion-botones'>" +
            "<button onclick='paginaAnterior()' " + (paginaActual === 1 ? "disabled" : "") + ">Anterior</button>" +
            "<button onclick='paginaSiguiente()' " + (paginaActual === totalPaginas ? "disabled" : "") + ">Siguiente</button>" +
        "</div>";
}

function paginaAnterior() {

    if (paginaActual > 1) {
        paginaActual--;
        mostrarContactosPaginados();
    }
}

function paginaSiguiente() {

    var totalPaginas = Math.ceil(contactosFiltrados.length / contactosPorPagina);

    if (paginaActual < totalPaginas) {
        paginaActual++;
        mostrarContactosPaginados();
    }
}

function eliminarContacto(idContacto) {

    var confirmar = confirm("¿Seguro que quieres eliminar este contacto?");

    if (!confirmar) {
        return;
    }

    var datos = new FormData();
    datos.append("id_contacto", idContacto);

    fetch("../api/contactos_eliminar.php", {
        method: "POST",
        body: datos
    })
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datosRespuesta) {

            if (datosRespuesta.estado === "ok") {
                cargarContactos();
            } else {
                alert(datosRespuesta.mensaje);
            }

        })
        .catch(function () {
            alert("Error al conectar con el servidor");
        });
}