<?php
    // Incluir la lógica del modelo
    require_once('./MODELO/modelo.php');
    // Obtener la lista de artículos
    $articulos = getNombresProductos();
    $familias = getNombreFamilias();
    // Incluir la lógica de la vista
    $data = array();
    $data['title'] = "Tienda Online";
    $data['body'] = 'E:\DAW2\VSCode\desarrollo-servidor\practicasPHP\tema-3\boletin-4\VISTA\vista.php';
    require('./VISTA/layout/layout.php');