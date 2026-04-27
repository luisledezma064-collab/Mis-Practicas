<?php
    // URLs reales de tu servidor
    $baseURL = 'http://luisledezmalara24408.atwebpages.com/practica9/API/biblioteca';
    
    $autorJSON = @file_get_contents($baseURL . '/autor/lista');
    $titulosJSON = @file_get_contents($baseURL . '/titulo/lista');

    $autores = json_decode($autorJSON);
    $titulos = json_decode($titulosJSON);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Práctica 9 - CRUD Completo</title>
    <script>
        // Función para eliminar usando el método DELETE
        async function eliminar(id) {
            if(confirm('¿Seguro que deseas eliminar?')) {
                await fetch(`API/biblioteca/autor/${id}`, { method: 'DELETE' });
                location.reload();
            }
        }
    </script>
</head>
<body>
    <h1>Gestión de Libros (API REST)</h1>
    <ul>
    <?php if($titulos): foreach ($titulos as $t): ?>
        <li>
            <?php echo $t->titulo; ?> 
            <button onclick="eliminar(<?php echo $t->id; ?>)">Borrar</button>
        </li>
    <?php endforeach; endif; ?>
    </ul>

    <form action="API/biblioteca/autor/nuevo" method="post">
        <h3>Agregar Nuevo</h3>
        <label>Autor:</label> <input type="text" name="autor" required><br>
        <label>Libro:</label> <input type="text" name="titulo" required><br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>