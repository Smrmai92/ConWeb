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

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

$password_actual = trim($_POST["password_actual"] ?? "");
$password_nueva = trim($_POST["password_nueva"] ?? "");
$password_repetir = trim($_POST["password_repetir"] ?? "");

if ($password_actual === "" || $password_nueva === "" || $password_repetir === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Todos los campos de contraseña son obligatorios"
    ]);
    exit;
}

if ($password_nueva !== $password_repetir) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "La nueva contraseña no coincide"
    ]);
    exit;
}

if (strlen($password_nueva) < 6) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "La nueva contraseña debe tener al menos 6 caracteres"
    ]);
    exit;
}

try {
    $sql = "SELECT password_hash
            FROM usuarios
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_usuario" => $id_usuario
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || !password_verify($password_actual, $usuario["password_hash"])) {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "La contraseña actual no es correcta"
        ]);
        exit;
    }

    $nuevo_hash = password_hash($password_nueva, PASSWORD_DEFAULT);

    $sqlUpdate = "UPDATE usuarios
                  SET password_hash = :password_hash
                  WHERE id_usuario = :id_usuario";

    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ":password_hash" => $nuevo_hash,
        ":id_usuario" => $id_usuario
    ]);

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Contraseña actualizada correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo cambiar la contraseña"
    ]);
}
?>