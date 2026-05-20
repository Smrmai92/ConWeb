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
require_once "../config/registrar_actividad.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

$id_categoria = $_POST["id_categoria"] ?? "";
$nombre = trim($_POST["nombre"] ?? "");
$color_hex = trim($_POST["color_hex"] ?? "");

$colores_permitidos = [
    "#74D9A7",
    "#6FAEF2",
    "#F5C45E",
    "#9B7CF3",
    "#E91E63",
    "#7AD7F0",
    "#E57ACD",
    "#C65A00"
];

if ($id_categoria === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió la categoría a editar"
    ]);
    exit;
}

if ($nombre === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El nombre es obligatorio"
    ]);
    exit;
}

if ($color_hex === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Debes seleccionar un color"
    ]);
    exit;
}

if (!in_array($color_hex, $colores_permitidos)) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El color seleccionado no es válido"
    ]);
    exit;
}

try {
    // Comprobamos que el color no esté usado por otra categoría del mismo usuario
    $sqlColor = "SELECT id_categoria
                 FROM categorias
                 WHERE color_hex = :color_hex
                 AND id_usuario = :id_usuario
                 AND id_categoria != :id_categoria";

    $stmtColor = $conexion->prepare($sqlColor);

    $stmtColor->execute([
        ":color_hex" => $color_hex,
        ":id_usuario" => $id_usuario,
        ":id_categoria" => $id_categoria
    ]);

    if ($stmtColor->fetch()) {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Este color ya está usado por otra categoría"
        ]);
        exit;
    }

    // Actualizamos la categoría
    $sql = "UPDATE categorias
            SET nombre = :nombre,
                color_hex = :color_hex
            WHERE id_categoria = :id_categoria
            AND id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":nombre" => $nombre,
        ":color_hex" => $color_hex,
        ":id_categoria" => $id_categoria,
        ":id_usuario" => $id_usuario
    ]);

    // Registramos la actividad reciente
    registrarActividad(
        $conexion,
        $id_usuario,
        "categoria",
        "Categoría " . $nombre . " actualizada",
        $nombre,
        $color_hex
    );

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Categoría actualizada correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo actualizar la categoría"
    ]);
}
?>