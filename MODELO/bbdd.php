<?php
function crear_conexion($servidor, $usuario, $contrasena, $base_datos)
{
    return new mysqli($servidor, $usuario, $contrasena, $base_datos);
}
function cerrar_conexion($conexion)
{
    $conexion->close();
}
function consulta_base_de_datos($consulta, $conexion)
{
    return $conexion->query($consulta);
}
function obtener_resultados($resultado)
{
    return $resultado->fetch_assoc();
}
