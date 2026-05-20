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

// Indicamos que la respuesta será en formato JSON
header("Content-Type: application/json; charset=UTF-8");

// Incluimos la conexión a la base de datos
require_once "../config/conexion.php";

try {
    // Consulta para obtener las categorías del usuario conectado
    $sql = "SELECT 
                cat.id_categoria,
                cat.nombre,
                cat.color_hex,
                COUNT(c.id_contacto) AS total_contactos
            FROM categorias cat
            LEFT JOIN contactos c
                ON cat.id_categoria = c.id_categoria
                AND c.eliminado = 0
            WHERE cat.id_usuario = :id_usuario
            GROUP BY cat.id_categoria
            ORDER BY cat.nombre ASC";

    // Preparamos y ejecutamos la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
    ":id_usuario" => $id_usuario
    ]);

    // Guardamos los resultados en un array asociativo
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos la respuesta en JSON
    echo json_encode([
        "estado" => "ok",
        "categorias" => $categorias
    ]);

} catch (PDOException $e) {
    // Si ocurre algún error, devolvemos un mensaje controlado
    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se pudieron obtener las categorías"
    ]);
}
?>