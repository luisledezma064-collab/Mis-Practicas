<?php
    // URLs actualizadas a tu servidor AwardSpace
    $baseURL = 'http://luisledezmalara24408.atwebpages.com/practica7/API/alumnos';
    $cursosURL = $baseURL . '/cursos';
    $alumnosURL = $baseURL . '/lista';

    // Obtener datos
    $cursosJSON = file_get_contents($cursosURL);
    $alumnosJSON = file_get_contents($alumnosURL);

    $cursos = json_decode($cursosJSON);
    $alumnos = json_decode($alumnosJSON);

    echo '<h1>Alumnos (Desde Base de Datos)</h1>';
    echo '<ul>';
    if ($alumnos) {
        foreach ($alumnos as $alumno) {
            echo "<li>".htmlspecialchars($alumno)."</li>";
        }
    }
    echo '</ul>';

    echo '<h2>Cursos Disponibles</h2>';
    if ($cursos) {
        foreach ($cursos as $curso) {
            echo "->".htmlspecialchars($curso)."<br>";
        }
    }
?>