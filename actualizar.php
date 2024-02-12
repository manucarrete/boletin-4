<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Actualizar Producto</title>
</head>

<body>
    <?php
    // Recuperar datos del formulario anterior
    $codProducto = $_POST["COD"];
    $nombreProducto = $_POST["NOMBRE_CORTO"];

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

    // Obtener los datos del producto seleccionado
    $sqlProducto = "SELECT * FROM producto WHERE COD = '$codProducto'";
    $resultProducto = $conn->query($sqlProducto);

    if ($resultProducto->rowCount() > 0) {
        $rowProducto = $resultProducto->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "No se encontró el producto.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nombreCortoProductoNuevo = $_POST["NOMBRE_CORTO"];
        $nombreProductoNuevo = $_POST["NOMBRE"];
        $descripcionProductoNuevo = $_POST["DESCRIPCION"];
        $pvpProductoNuevo = $_POST["PVP"];

        $sqlActualizar = "UPDATE producto SET NOMBRE_CORTO = '$nombreCortoProductoNuevo', NOMBRE = '$nombreProductoNuevo', DESCRIPCION = '$descripcionProductoNuevo', PVP = '$pvpProductoNuevo' WHERE COD = '$codProducto'";
        $stmtActualizar = $conn->prepare($sqlActualizar);
        try{
            $stmtActualizar->execute();
            $mensaje = "Producto actualizado con éxito.";
            $tipoMensaje = "success-message";
        }
        catch(Exception $ex){
            $mensaje = "Error al actualizar el producto " . $ex;
            $tipoMensaje = "error-message";
        }
    }
    ?>

    <h2>Actualizar Producto</h2>

    <?php if (isset($mensaje)) { ?>
        <p class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></p>
    <?php } ?>

    <div class="button-container">
        <a href="listado.php" class="btn btn-primary return-button">Volver al Listado</a>
    </div>

</body>

</html>
