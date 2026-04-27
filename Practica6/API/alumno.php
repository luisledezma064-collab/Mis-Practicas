<?php
// Indicamos al navegador/cliente que la respuesta es un JSON
header('Content-Type: application/json');

function mostrar_alumno(){
    $alumno = array(
        "nombre"=>"Ignacio",
        "apellido"=>"Díaz",
        "pais"=>"Chile",
        "cursos"=>"5",
        "usuario"=>"zapato123"
    );
    return $alumno;
}

// Convertimos el arreglo de PHP a formato JSON
echo json_encode(mostrar_alumno());
?>