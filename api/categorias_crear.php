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

// Indicamos que la respuesta será JSON
header("Content-Type: application/json; charset=UTF-8");

// Incluimos la conexión con la base de datos
require_once "../config/conexion.php";
require_once "../config/registrar_actividad.php";

// Comprobamos que los datos llegan por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Recogemos los datos enviados desde el formulario
$nombre = trim($_POST["nombre"] ?? "");
$color_hex = trim($_POST["color_hex"] ?? "");

// Lista de colores permitidos según el diseño del proyecto
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

// Validamos el nombre
if ($nombre === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El nombre de la categoría es obligatorio"
    ]);
    exit;
}

// Validamos que el color venga informado
if ($color_hex === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Debes seleccionar un color"
    ]);
    exit;
}

// Validamos que el color esté dentro de los colores permitidos
if (!in_array($color_hex, $colores_permitidos)) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El color seleccionado no es válido"
    ]);
    exit;
}

try {
    // Comprobamos si el color ya está usado por otra categoría del usuario
    $sqlColor = "SELECT id_categoria 
                 FROM categorias
                 WHERE color_hex = :color_hex
                 AND id_usuario = :id_usuario";

    $stmtColor = $conexion->prepare($sqlColor);
    $stmtColor->execute([
    ":color_hex" => $color_hex,
    ":id_usuario" => $id_usuario
    ]);

    if ($stmtColor->fetch()) {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Este color ya está usado por otra categoría"
        ]);
        exit;
    }

    // Insertamos la nueva categoría
    $sql = "INSERT INTO categorias (nombre, color_hex, id_usuario)
            VALUES (:nombre, :color_hex, :id_usuario)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
    ":nombre" => $nombre,
    ":color_hex" => $color_hex,
    ":id_usuario" => $id_usuario
    ]);

    // Registramos la actividad reciente
    registrarActividad(
        $conexion,
        $id_usuario,
        "categoria",
        "Categoría " . $nombre . " creada",
        $nombre,
        $color_hex
    );

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Categoría creada correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo crear la categoría. Puede que el nombre ya exista."
    ]);
}
?>