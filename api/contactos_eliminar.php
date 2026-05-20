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

// Comprobamos que la petición llega por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Recogemos el id del contacto que queremos eliminar
$id_contacto = $_POST["id_contacto"] ?? "";

// Validamos que el id no esté vacío
if ($id_contacto === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió el contacto a eliminar"
    ]);
    exit;
}

try {
    // Borrado lógico:
    // No eliminamos el contacto de la tabla, solo lo marcamos como eliminado
    $sql = "UPDATE contactos
            SET eliminado = 1
            WHERE id_contacto = :id_contacto
            AND id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
    ":id_contacto" => $id_contacto,
    ":id_usuario" => $id_usuario
    ]);

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Contacto eliminado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo eliminar el contacto"
    ]);
}
?>