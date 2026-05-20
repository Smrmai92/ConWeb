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

$id_usuario = $_SESSION["id_usuario"];

require_once "../config/conexion.php";

if (!isset($_FILES["foto_perfil"])) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió ninguna imagen"
    ]);
    exit;
}

$foto = $_FILES["foto_perfil"];

if ($foto["error"] !== UPLOAD_ERR_OK) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Error al recibir la imagen"
    ]);
    exit;
}

/* Extensión de la imagen */
$extension = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));

/* Formatos permitidos */
$extensiones_permitidas = ["jpg", "jpeg", "png", "webp"];

if (!in_array($extension, $extensiones_permitidas)) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "Formato no permitido. Usa JPG, PNG o WEBP"
    ]);

    exit;
}

/* Tamaño máximo: 10 MB */
$tamano_maximo = 10 * 1024 * 1024;

if ($foto["size"] > $tamano_maximo) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "La imagen es demasiado grande. Máximo 10 MB"
    ]);

    exit;
}

/* Carpeta destino */
$carpeta_destino = "../assets/img/usuarios/";

/* Comprobar carpeta */
if (!is_dir($carpeta_destino)) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "No existe la carpeta de usuarios"
    ]);

    exit;
}

/* Comprobar permisos */
if (!is_writable($carpeta_destino)) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "La carpeta no tiene permisos de escritura"
    ]);

    exit;
}

/* Nombre único */
$nombre_archivo = "usuario_" . $id_usuario . "_" . time() . "." . $extension;

/* Ruta física */
$ruta_destino = $carpeta_destino . $nombre_archivo;

/* Ruta para guardar en BD */
$ruta_bd = "assets/img/usuarios/" . $nombre_archivo;

/* Mover archivo */
if (!move_uploaded_file($foto["tmp_name"], $ruta_destino)) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo guardar la imagen"
    ]);

    exit;
}

try {

    $sql = "UPDATE usuarios
            SET foto_perfil = :foto_perfil
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":foto_perfil" => $ruta_bd,
        ":id_usuario" => $id_usuario
    ]);

    /* Actualizar sesión */
    $_SESSION["foto_perfil"] = $ruta_bd;

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Foto actualizada",
        "foto_perfil" => $ruta_bd
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "La foto se guardó pero no se pudo actualizar en la base de datos"
    ]);
}
?>