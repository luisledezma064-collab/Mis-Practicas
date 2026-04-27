<?php

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

echo json_encode(mostrar_alumno());

?>