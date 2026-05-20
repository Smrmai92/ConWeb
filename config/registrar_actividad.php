<?php
// Función reutilizable para guardar acciones recientes del usuario
function registrarActividad($conexion, $id_usuario, $tipo, $texto, $detalle = "", $color = "") {

    $sql = "INSERT INTO actividad (id_usuario, tipo, texto, detalle, color)
            VALUES (:id_usuario, :tipo, :texto, :detalle, :color)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_usuario" => $id_usuario,
        ":tipo" => $tipo,
        ":texto" => $texto,
        ":detalle" => $detalle,
        ":color" => $color
    ]);
}
?>