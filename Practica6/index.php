<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🔹 CAMBIO CLAVE: Cambiamos localhost por tu URL real de AwardSpace
$url = "http://luisledezmalara24408.atwebpages.com/practica6/API/alumnos/alumno.php";

// Obtenemos el contenido JSON
$JSON = file_get_contents($url);

if ($JSON === FALSE) {
    die("Error: No se pudo conectar con la API en AwardSpace.");
}

// Decodificamos el JSON para convertirlo en un objeto de PHP
$datos = json_decode($JSON);

// Mostramos la información
echo "<h2>Datos del Alumno (API REST)</h2>";
echo "Nombre: " . $datos->nombre . " " . $datos->apellido . "<br>";
echo "País: " . $datos->pais . "<br>";
echo "Cursos Activos: " . $datos->cursos . "<br>";
echo "Usuario: " . $datos->usuario . "<br>";
?>