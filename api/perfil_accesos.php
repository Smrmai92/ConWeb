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
    $sql = "SELECT fecha_hora, ip, navegador
            FROM registro_acceso
            WHERE id_usuario = :id_usuario
            ORDER BY fecha_hora DESC
            LIMIT 3";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_usuario" => $id_usuario
    ]);

    $accesos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "estado" => "ok",
        "accesos" => $accesos
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo cargar el historial de accesos"
    ]);
}
?>