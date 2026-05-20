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
require_once "../config/registrar_actividad.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

$nombre = trim($_POST["nombre"] ?? "");

if ($nombre === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El nombre no puede estar vacío"
    ]);
    exit;
}

try {
    $sql = "UPDATE usuarios
            SET nombre = :nombre
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":nombre" => $nombre,
        ":id_usuario" => $id_usuario
    ]);

    $_SESSION["nombre"] = $nombre;

    // Registramos la actividad reciente
    registrarActividad(
        $conexion,
        $id_usuario,
        "perfil",
        "Perfil de usuario actualizado",
        $nombre,
        ""
    );

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Perfil actualizado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo actualizar el perfil"
    ]);
}
?>