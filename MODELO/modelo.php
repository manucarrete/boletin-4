<?php
require_once('config.php');
require_once('bbdd.php');
function getNombresProductos()
{
    // Conectar con la base de datos
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Ejecutar la consulta SQL
    $resultado = consulta_base_de_datos('SELECT NOMBRE_CORTO, COD, PVP FROM PRODUCTO',$conexion);
    // Crear el array de elementos para la capa de la vista
    $articulos = array();
    while ($fila = obtener_resultados($resultado)) {
        $articulos[] = $fila;
    }
    // Cerrar la conexión
    cerrar_conexion($conexion);
    return $articulos;
}

function getNombreFamilias(){
    $conexion = crear_conexion(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Ejecutar la consulta SQL
    $resultado = consulta_base_de_datos('SELECT NOMBRE, COD FROM FAMILIA',$conexion);
    // Crear el array de elementos para la capa de la vista
    $familia = array();
    while ($fila = obtener_resultados($resultado)) {
        $familia[] = $fila;
    }
    // Cerrar la conexión
    cerrar_conexion($conexion);
    return $familia;
}