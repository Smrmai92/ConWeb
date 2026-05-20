<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Sesión no iniciada"
    ]);
    exit;
}

$id_usuario = $_SESSION["id_usuario"];

header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";

// Función sencilla para mostrar fechas de forma más limpia
function formatearFecha($fecha) {

    if (!$fecha) {
        return "Sin accesos";
    }

    $timestamp = strtotime($fecha);

    if (date("Y-m-d", $timestamp) === date("Y-m-d")) {
        return "Hoy, " . date("H:i", $timestamp) . "h";
    }

    return date("d/m/Y H:i", $timestamp);
}

try {
    // Total de contactos activos del usuario
    $sqlContactos = "SELECT COUNT(*) AS total
                     FROM contactos
                     WHERE id_usuario = :id_usuario
                     AND eliminado = 0";

    $stmtContactos = $conexion->prepare($sqlContactos);
    $stmtContactos->execute([
        ":id_usuario" => $id_usuario
    ]);

    $totalContactos = $stmtContactos->fetch(PDO::FETCH_ASSOC)["total"];

    // Total de categorías del usuario
    $sqlCategorias = "SELECT COUNT(*) AS total
                      FROM categorias
                      WHERE id_usuario = :id_usuario";

    $stmtCategorias = $conexion->prepare($sqlCategorias);
    $stmtCategorias->execute([
        ":id_usuario" => $id_usuario
    ]);

    $totalCategorias = $stmtCategorias->fetch(PDO::FETCH_ASSOC)["total"];

    // Último acceso del usuario
    $sqlAcceso = "SELECT fecha_hora
                  FROM registro_acceso
                  WHERE id_usuario = :id_usuario
                  ORDER BY fecha_hora DESC
                  LIMIT 1";

    $stmtAcceso = $conexion->prepare($sqlAcceso);
    $stmtAcceso->execute([
        ":id_usuario" => $id_usuario
    ]);

    $ultimoAcceso = $stmtAcceso->fetch(PDO::FETCH_ASSOC);

    $ultimoAccesoTexto = $ultimoAcceso
        ? formatearFecha($ultimoAcceso["fecha_hora"])
        : "Sin accesos";

    // Últimas actividades reales del usuario
    $sqlActividad = "SELECT tipo, texto, detalle, color, fecha_hora
                     FROM actividad
                     WHERE id_usuario = :id_usuario
                     ORDER BY fecha_hora DESC
                     LIMIT 4";

    $stmtActividad = $conexion->prepare($sqlActividad);
    $stmtActividad->execute([
        ":id_usuario" => $id_usuario
    ]);

    $actividadReciente = $stmtActividad->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "estado" => "ok",
        "total_contactos" => $totalContactos,
        "total_categorias" => $totalCategorias,
        "ultimo_acceso" => $ultimoAccesoTexto,
        "actividad_reciente" => $actividadReciente
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo cargar el resumen"
    ]);
}
?>