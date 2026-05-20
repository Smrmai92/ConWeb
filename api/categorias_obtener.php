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

$id_categoria = $_GET["id_categoria"] ?? "";

if ($id_categoria === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió la categoría"
    ]);
    exit;
}

try {
    $sql = "SELECT id_categoria, nombre, color_hex
            FROM categorias
            WHERE id_categoria = :id_categoria
            AND id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_categoria" => $id_categoria,
        ":id_usuario" => $id_usuario
    ]);

    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categoria) {
        echo json_encode([
            "estado" => "ok",
            "categoria" => $categoria
        ]);
    } else {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Categoría no encontrada"
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo obtener la categoría"
    ]);
}
?>