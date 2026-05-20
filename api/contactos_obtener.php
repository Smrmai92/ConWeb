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

$id_contacto = $_GET["id_contacto"] ?? "";

if ($id_contacto === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió el contacto"
    ]);
    exit;
}

try {
    $sql = "SELECT 
                id_contacto,
                nombre,
                apellidos,
                telefono,
                email,
                empresa,
                id_categoria,
                notas
            FROM contactos
            WHERE id_contacto = :id_contacto
            AND id_usuario = :id_usuario
            AND eliminado = 0";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_contacto" => $id_contacto,
        ":id_usuario" => $id_usuario
    ]);

    $contacto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contacto) {
        echo json_encode([
            "estado" => "ok",
            "contacto" => $contacto
        ]);
    } else {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Contacto no encontrado"
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo obtener el contacto"
    ]);
}
?>