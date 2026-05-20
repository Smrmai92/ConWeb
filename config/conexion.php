<?php
// Datos necesarios para conectar con la base de datos del proyecto
$host = "localhost";
$dbname = "conweb";
$user = "root";
$password = "root";
$port = "8889";

try {
    // Creación de la conexión con PDO
    $conexion = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    // Activar el modo de errores para controlar mejor posibles fallos
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Respuesta en caso de que la conexión falle
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Error de conexión con la base de datos"
    ]);
    exit;
}
?>