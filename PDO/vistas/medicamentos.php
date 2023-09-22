<?php
include '../conf/_con.php/'; // Incluye el archivo de configuración de la base de datos

$query = 'SELECT * FROM medicamentos';
$ejecutar = $pdo->prepare($query);
$ejecutar->execute();
$data = $ejecutar->fetchAll(PDO::FETCH_OBJ); // Obtiene los datos de la base de datos

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Medicamentos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .medicamento-imagen {
            width: 50px;
            height: 50px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .medicamento-imagen:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Medicamentos</h1>
        <a href="./agregar.php" class="btn btn-success">Agregar</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Existencia</th>
                    <th>Fecha de Registro</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $medicamento) : ?>
                    <tr>
                        <td><?php echo $medicamento->code; ?></td>
                        <td><?php echo $medicamento->nombre; ?></td>
                        <td><?php echo $medicamento->existencia; ?></td>
                        <td><?php echo $medicamento->fecha_registro; ?></td>
                        <td>
                            <img class="medicamento-imagen" src="../imagenes/<?php echo $medicamento->imagen; ?>" alt="<?php echo $medicamento->nombre; ?>">
                        </td>
                        <td><?php echo $medicamento->precio; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
