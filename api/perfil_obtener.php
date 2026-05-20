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

try {
    // Obtenemos los datos del usuario conectado
    $sql = "SELECT nombre, email, fecha_registro, foto_perfil
            FROM usuarios
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_usuario" => $id_usuario
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "estado" => "ok",
        "usuario" => $usuario
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo obtener el perfil"
    ]);
}
?>