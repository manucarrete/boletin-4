<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            width: 500px;
            height: 100%;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        textarea{
            width: 100%;
            height: 400px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .cancel-button {
            width: 100%;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
        }

        .cancel-button:hover {
            background-color: #5a6268;
        }
    </style>
    <title>Editar Producto</title>
</head>
<body>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "user_dwes";
$password = "userUSER2";
$dbname = "dwes";

try {
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);

} catch (PDOException $ex) {
    ?>
    <p>Se ha producido el error:
        <?php echo $ex; ?>.
    </p>
    <?php
    exit();
}

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Obtener el ID del producto a editar
        $idProducto = $_POST["COD"];

        // Obtener los datos del producto seleccionado
        $sqlEditar = "SELECT `NOMBRE_CORTO`, `NOMBRE`, `DESCRIPCION`, `PVP` FROM `producto` WHERE `COD` = '$idProducto'";
        $resultEditar = $conn->query($sqlEditar);

        // Mostrar datos del producto en el formulario
        if ($resultEditar->rowCount() > 0) {
            $rowEditar = $resultEditar->fetch(PDO::FETCH_ASSOC);
            $nombreCorto = $rowEditar["NOMBRE_CORTO"];
            $nombre = $rowEditar["NOMBRE"];
            $descripcion = $rowEditar["DESCRIPCION"];
            $pvp = $rowEditar["PVP"];
        } else {
            ?>
            <p>Error al recuperar el producto</p>
            <?php
            exit();
        }
    }
?>
        <h2><?php echo $nombreCorto ?></h2>
        <form method="post" action="actualizar.php">
            <input type="hidden" name="COD" value="<?php echo $idProducto; ?>">

            <label for="nombreCorto">Nombre Corto:</label>
            <input type="text" name="NOMBRE_CORTO" value="<?php echo $nombreCorto; ?>"><br>

            <label for="nombre">Nombre:</label>
            <input type="text" name="NOMBRE" value="<?php echo $nombre; ?>"><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="DESCRIPCION"><?php echo $descripcion; ?></textarea><br>

            <label for="pvp">PVP:</label>
            <input type="text" name="PVP" value="<?php echo $pvp; ?>"><br>

            <input type="submit" value="Actualizar Producto" class="btn btn-success">
            <a href="listado.php" class="btn btn-secondary cancel-button">Cancelar</a>
        </form>

    </body>
</html>
