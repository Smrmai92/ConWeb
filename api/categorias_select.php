<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo json_encode([
        "estado" => "error"
    ]);
    exit;
}

$id_usuario = $_SESSION["id_usuario"];

header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";

try {

    $sql = "SELECT id_categoria, nombre
            FROM categorias
            WHERE id_usuario = :id_usuario
            ORDER BY nombre ASC";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_usuario" => $id_usuario
    ]);

    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "estado" => "ok",
        "categorias" => $categorias
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "estado" => "error"
    ]);

}
?>