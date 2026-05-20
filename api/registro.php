<?php
// Respuesta en formato JSON
header("Content-Type: application/json; charset=UTF-8");

// Conexión con la base de datos
require_once "../config/conexion.php";

// Solo permitimos peticiones POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Recogemos datos del formulario
$nombre = trim($_POST["nombre"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$password2 = trim($_POST["password2"] ?? "");

// Validaciones básicas
if ($nombre === "" || $email === "" || $password === "" || $password2 === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Todos los campos son obligatorios"
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "El email no tiene un formato válido"
    ]);
    exit;
}

if ($password !== $password2) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Las contraseñas no coinciden"
    ]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "La contraseña debe tener al menos 6 caracteres"
    ]);
    exit;
}

try {
    // Comprobamos si ya existe un usuario con ese email
    $sqlExiste = "SELECT id_usuario FROM usuarios WHERE email = :email";
    $stmtExiste = $conexion->prepare($sqlExiste);
    $stmtExiste->execute([
        ":email" => $email
    ]);

    if ($stmtExiste->fetch()) {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Ya existe un usuario con ese email"
        ]);
        exit;
    }

    // Ciframos la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertamos el usuario como Usuario normal
    // id_rol = 2 corresponde a Usuario
    $sql = "INSERT INTO usuarios (nombre, email, password_hash, id_rol)
            VALUES (:nombre, :email, :password_hash, 2)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":nombre" => $nombre,
        ":email" => $email,
        ":password_hash" => $password_hash
    ]);

    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Usuario registrado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo registrar el usuario"
    ]);
}
?>