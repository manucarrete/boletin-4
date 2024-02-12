<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Listado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "user_dwes";
    $password = "userUSER2";
    $dbname = "dwes";

    try{
        $conn = new PDO('mysql:host=' . $servername .';dbname=' . $dbname, $username, $password);

    }catch (PDOException $ex){
        ?>
        <p>Se ha producido el error:
            <?php echo $ex; ?>.
        </p>
        <?php
        exit();
    }


    // Obtener la lista de productos
    $sql = "SELECT COD, NOMBRE FROM FAMILIA";
    $result = $conn->query($sql);

    // Manejar el envío del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el código del producto seleccionado
        $productoSeleccionado = $_POST["producto"];

        // Obtener el stock por tienda para el producto seleccionado
        $sqlStock = "SELECT `PVP`, `NOMBRE_CORTO`,`COD` FROM `producto` 
                        WHERE `FAMILIA` = '$productoSeleccionado'";

        $resultStock = $conn->query($sqlStock);
    }

    ?>

    <h2>Consulta de Stock</h2>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="producto">Selecciona una familia:</label>
        <select name="producto" id="nameProducto" selected="as">
            <?php
            // Mostrar la lista de productos en el cuadro de selección
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $selected = isset($_POST["producto"]) && $_POST["producto"] == $row["COD"] ? 'selected' : '';
                ?>
                <option value="<?php echo $row["COD"]; ?>" <?php echo $selected; ?>>
                <?php echo $row["NOMBRE"]; ?>
            </option>
                <?php
            }
            ?>
        </select>
        <input type="submit" value="Consultar Stock">
    </form>

    <?php
    // Mostrar el stock si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $resultStock->rowCount() > 0) {
        ?>
        <h3>Productos de la familia seleccionada:</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>PVP</th>
                <th>Acciones</th>
            </tr>

            <?php
            while ($rowStock = $resultStock->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td>
                        <?php echo $rowStock["NOMBRE_CORTO"]?>
                    </td>
                    <td>
                        <?php echo $rowStock["PVP"] . "€" ?>
                    </td>
                    <td>
                    <form action="editar.php" method="post">
                            <input type="hidden" name="COD" value="<?php echo $rowStock["COD"]; ?>">
                            <input type="hidden" name="producto" value="<?php echo $rowStock["NOMBRE_CORTO"]; ?>">
                            <button type="submit">Editar</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>

</body>

</html>