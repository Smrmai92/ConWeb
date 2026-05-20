<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../pages/login.php");
    exit;
}

$id_usuario = $_SESSION["id_usuario"];

// Incluimos la conexión con la base de datos
require_once "../config/conexion.php";
require_once "../config/registrar_actividad.php";

try {

    // Consulta para obtener los contactos no eliminados
    $sql = "SELECT 
                c.nombre,
                c.apellidos,
                c.telefono,
                c.email,
                c.empresa,
                cat.nombre AS categoria,
                c.notas
            FROM contactos c
            LEFT JOIN categorias cat ON c.id_categoria = cat.id_categoria
            WHERE c.id_usuario = :id_usuario
            AND c.eliminado = 0
            ORDER BY c.nombre ASC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
    ":id_usuario" => $id_usuario
    ]);

    $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Registramos la actividad reciente
    registrarActividad(
        $conexion,
        $id_usuario,
        "csv",
        "Exportación CSV realizada",
        "Contactos exportados",
        ""
    );

    // Indicamos que el archivo será un CSV descargable
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=contactos_conweb.csv');

    // Abrimos la salida del archivo
    $salida = fopen('php://output', 'w');

    // Primera fila del CSV (cabeceras)
    fputcsv($salida, [
        'Nombre',
        'Apellidos',
        'Teléfono',
        'Email',
        'Empresa',
        'Categoría',
        'Notas'
    ]);

    // Recorremos los contactos y los añadimos al CSV
    foreach ($contactos as $contacto) {

        fputcsv($salida, [
            $contacto["nombre"],
            $contacto["apellidos"],
            $contacto["telefono"],
            $contacto["email"],
            $contacto["empresa"],
            $contacto["categoria"] ?? "Sin categoría",
            $contacto["notas"]
        ]);
    }

    fclose($salida);

} catch (PDOException $e) {

    echo "Error al exportar los contactos.";

}
?>