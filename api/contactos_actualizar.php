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

$id_contacto = $_POST["id_contacto"] ?? "";
$nombre = trim($_POST["nombre"] ?? "");
$apellidos = trim($_POST["apellidos"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$email = trim($_POST["email"] ?? "");
$empresa = trim($_POST["empresa"] ?? "");
$id_categoria = $_POST["id_categoria"] ?? null;
$notas = trim($_POST["notas"] ?? "");

if ($id_contacto === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió el contacto a editar"
    ]);
    exit;
}

if ($nombre === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El nombre es obligatorio"
    ]);
    exit;
}

if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El email no tiene un formato válido"
    ]);
    exit;
}

try {
    $sql = "UPDATE contactos
            SET nombre = :nombre,
                apellidos = :apellidos,
                telefono = :telefono,
                email = :email,
                empresa = :empresa,
                id_categoria = :id_categoria,
                notas = :notas
            WHERE id_contacto = :id_contacto
            AND id_usuario = :id_usuario
            AND eliminado = 0";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":telefono" => $telefono,
        ":email" => $email,
        ":empresa" => $empresa,
        ":id_categoria" => $id_categoria !== "" ? $id_categoria : null,
        ":notas" => $notas,
        ":id_contacto" => $id_contacto,
        ":id_usuario" => $id_usuario
    ]);

    // Registramos la actividad reciente
    $nombreCompleto = trim($nombre . " " . $apellidos);

    registrarActividad(
        $conexion,
        $id_usuario,
        "contacto",
        $nombreCompleto . " actualizado",
        "Contacto modificado",
        ""
    );

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Contacto actualizado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo actualizar el contacto"
    ]);
}
?>