<table>
    <tr>
        <th>Producto</th>
        <th>PVP</th>
        <th>Acciones</th>
    </tr>

    <?php
    foreach ($articulos as $articulo): ?>
        <tr>
            <td>
                <?php echo $articulo["NOMBRE_CORTO"]?>
            </td>
            <td>
                <?php echo $articulo["PVP"] . "€" ?>
            </td>
            <td>
            <form action="editar.php" method="post">
                    <input type="hidden" name="COD" value="<?php echo $articulo["COD"]; ?>">
                    <input type="hidden" name="producto" value="<?php echo $articulo["NOMBRE_CORTO"]; ?>">
                    <button type="submit">Editar</button>
            </form>
            </td>
        </tr>
        <?php
     endforeach;
    ?>
</table>