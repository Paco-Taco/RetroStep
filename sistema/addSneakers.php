<?php
require_once "../conexion.php";

// Recibir datos del formulario
$modelo = $_POST["Modelo"];
$marca = $_POST["Marca"];
$precio = $_POST["Precio"];
$stock = $_POST["Stock"];
$size = $_POST["Size"];
$nombre_imagen = $_FILES['imagen']['name'];
$temporal = $_FILES['imagen']['tmp_name'];
$carpeta = "../img";
$ruta = $carpeta . '/' . $nombre_imagen;
move_uploaded_file($temporal, $carpeta . '/' . $nombre_imagen);

// Verificar si ya existe un registro con el mismo modelo y talla
$sql_verificar = "SELECT COUNT(*) AS count FROM sneakers WHERE Modelo = ? AND Size = ?";

if ($stmt_verificar = $connection->prepare($sql_verificar)) {
    // Vincular los parámetros
    $stmt_verificar->bind_param("si", $modelo, $size);

    // Ejecutar la consulta de verificación
    $stmt_verificar->execute();

    // Obtener el resultado
    $stmt_verificar->bind_result($count);
    $stmt_verificar->fetch();

    // Cerrar la consulta de verificación
    $stmt_verificar->close();

    // Si count es mayor que 0, ya existe un registro con los mismos valores
    if ($count > 0) {
        echo "Ya existe un registro con el mismo modelo y talla.";
    } else {
        // Si no existe, proceder con la inserción
        $sql_insertar = "INSERT INTO sneakers (Marca, Modelo, Precio, Stock, Size, imagen_url) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt_insertar = $connection->prepare($sql_insertar)) {
            // Vincular los parámetros usando consultas preparadas
            $stmt_insertar->bind_param("ssdiss", $marca, $modelo, $precio, $stock, $size, $ruta);

            // Ejecutar la consulta de inserción
            if ($stmt_insertar->execute()) {
                echo "Los datos se han agregado correctamente.";
                header("Location: main.php");
            } else {
                echo "Error al agregar los datos: " . $stmt_insertar->error;
            }

            // Cerrar la consulta de inserción
            $stmt_insertar->close();
        } else {
            echo "Error en la preparación de la consulta de inserción: " . $connection->error;
        }
    }
} else {
    echo "Error en la preparación de la consulta de verificación: " . $connection->error;
}

// Cerrar la conexión a la base de datos
$connection->close();

?>