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

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

$id_categoria = $_POST["id_categoria"] ?? "";

if ($id_categoria === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió la categoría a eliminar"
    ]);
    exit;
}

try {
    // Eliminamos la categoría solo si pertenece al usuario conectado
    $sql = "DELETE FROM categorias
            WHERE id_categoria = :id_categoria
            AND id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_categoria" => $id_categoria,
        ":id_usuario" => $id_usuario
    ]);

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Categoría eliminada correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo eliminar la categoría"
    ]);
}
?>