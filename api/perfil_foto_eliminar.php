<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");

if (!isset($_SESSION["id_usuario"])) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Sesión no iniciada"
    ]);
    exit;
}

require_once "../config/conexion.php";

$id_usuario = $_SESSION["id_usuario"];

try {

    $sql = "UPDATE usuarios
            SET foto_perfil = NULL
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_usuario" => $id_usuario
    ]);

    unset($_SESSION["foto_perfil"]);

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Foto eliminada correctamente"
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo eliminar la foto"
    ]);

}
?>