<?php
// Iniciamos sesión para guardar el usuario conectado
session_start();

// Indicamos que la respuesta será JSON
header("Content-Type: application/json; charset=UTF-8");

// Incluimos la conexión a la base de datos
require_once "../config/conexion.php";

// Comprobamos que los datos lleguen por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Recogemos los datos del formulario
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

// Validaciones básicas
if ($email === "" || $password === "") {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Debes introducir email y contraseña"
    ]);
    exit;
}

try {
    // Buscamos el usuario por email
    $sql = "SELECT id_usuario, nombre, email, password_hash, id_rol, foto_perfil
            FROM usuarios
            WHERE email = :email
            AND activo = 1";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Comprobamos usuario y contraseña
    if ($usuario && password_verify($password, $usuario["password_hash"])) {

        // Guardamos datos básicos del usuario en sesión
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["id_rol"] = $usuario["id_rol"];
        $_SESSION["foto_perfil"] = $usuario["foto_perfil"];

        // Guardamos el acceso del usuario en la tabla registro_acceso
        $ip = $_SERVER["REMOTE_ADDR"] ?? "";
        $navegador = $_SERVER["HTTP_USER_AGENT"] ?? "";

        $sqlAcceso = "INSERT INTO registro_acceso (id_usuario, ip, navegador)
                    VALUES (:id_usuario, :ip, :navegador)";

        $stmtAcceso = $conexion->prepare($sqlAcceso);

        $stmtAcceso->execute([
            ":id_usuario" => $usuario["id_usuario"],
            ":ip" => $ip,
            ":navegador" => $navegador
        ]);

        echo json_encode([
            "estado" => "ok",
            "mensaje" => "Login correcto"
        ]);

    } else {
        echo json_encode([
            "estado" => "error",
            "mensaje" => "Email o contraseña incorrectos"
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudo iniciar sesión"
    ]);
}
?>