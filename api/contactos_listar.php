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
    $sql = "SELECT 
            c.id_contacto,
            c.nombre,
            c.apellidos,
            c.telefono,
            c.email,
            c.empresa,
            c.notas,
            c.fecha_creacion,
            cat.nombre AS categoria_nombre,
            cat.color_hex AS categoria_color
        FROM contactos c
        LEFT JOIN categorias cat ON c.id_categoria = cat.id_categoria
        WHERE c.id_usuario = :id_usuario
        AND c.eliminado = 0
        ORDER BY c.fecha_creacion DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
    ":id_usuario" => $id_usuario
    ]);


    $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "estado" => "ok",
        "contactos" => $contactos
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudieron obtener los contactos"
    ]);
}
?>