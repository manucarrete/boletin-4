<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="vista/layout/layout.css">
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
