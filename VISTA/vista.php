<h1>Lista de productos</h1>
<select name="producto" id="nameProducto">
    <?php
    // Mostrar la lista de productos en el cuadro de selección
    foreach ($familias as $familia): ?>
        <option value="<?php echo $familia["COD"]; ?>"><?php echo $familia["NOMBRE"]; ?></option>
        <?php endforeach; ?>
</select>
<input class="btnConsultaStock" type="submit" value="Consultar Stock">
