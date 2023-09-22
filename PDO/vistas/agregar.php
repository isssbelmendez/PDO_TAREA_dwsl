<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Archivo de configuración de la base de datos
    include '../conf/_con.php';

    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $existencia = $_POST["existencia"];
    $fecha_registro = $_POST["fechar_registro"];
    $precio = $_POST["precio"];

    // Procesar la imagen
    $imagen_tmp = $_FILES["imagen"]["tmp_name"];
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);
    $imagen_nueva_nombre = uniqid() . "." . $imagen_extension; // Nombre único para la imagen
    $ruta_destino = "../public/img/" . $imagen_nueva_nombre; // Ruta donde se guardará la imagen en el servidor

    if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
        // Insertar datos en la base de datos
        $query = "INSERT INTO medicamentos (nombre, existencia, fecha_registro, imagen, precio) VALUES (:nombre, :existencia, :fecha_registro, :imagen, :precio)";
        $ejecutar = $pdo->prepare($query);
        $ejecutar->bindParam(':nombre', $nombre);
        $ejecutar->bindParam(':existencia', $existencia);
        $ejecutar->bindParam(':fecha_registro', $fecha_registro);
        $ejecutar->bindParam(':imagen', $imagen_nueva_nombre); // Guardar solo el nombre de la imagen en la base de datos
        $ejecutar->bindParam(':precio', $precio);

        if ($ejecutar->execute()) {
            echo "Medicamento agregado con éxito.";
            header('Location: ./medicamentos.php');
            exit;
        } else {
            echo "Error al agregar el medicamento.";
            header('Location: ./agregar.php');
            exit;
        }
    } else {
        echo "Error al subir la imagen.";
        header('Location: ./agregar.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos CSS aquí */
    </style>
    <title>Agregar</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Agregar Medicamento</h2>
        <form action="./agregar.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre Medicamento:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="existencia">Existencia:</label>
                <input type="number" class="form-control" id="existencia" name="existencia" required min=0>
            </div>
            <div class="form-group">
                <label for="fecharegistro">Fecha de Registro:</label>
                <input type="date" class="form-control" id="fecharegistro" name="fechar_registro" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required min=0>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Medicamento</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
