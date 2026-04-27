<?php
// URL corregida a minúsculas para evitar el error 404
$urlBase = "http://luisledezmalara24408.atwebpages.com/practica8/API/biblioteca";

// Lógica para enviar datos (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
    $nuevo = ["autor" => $_POST['autor'], "titulo" => $_POST['titulo']];
    $opciones = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n",
            'content' => json_encode($nuevo)
        ]
    ];
    $contexto = stream_context_create($opciones);
    @file_get_contents($urlBase . "/libros.php", false, $contexto);
    // Redirigir para limpiar el formulario y ver el nuevo registro
    header("Location: index.php");
    exit;
}

// Lógica para leer datos (GET) usando el .htaccess
$json = @file_get_contents($urlBase . "/titulo/lista");
$libros = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 8 - Biblioteca</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; display: inline-block; }
        .libro-item { margin-bottom: 8px; padding: 5px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <h2>Registrar Libro en AwardSpace</h2>
    <form method="POST">
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="text" name="titulo" placeholder="Título" required>
        <button type="submit">Enviar (POST)</button>
    </form>

    <h2>Libros Actuales</h2>
    <div>
        <?php 
        if (is_array($libros) && !empty($libros)) {
            foreach ($libros as $l) {
                $a = htmlspecialchars($l['autor'] ?? 'Anónimo');
                $t = htmlspecialchars($l['titulo'] ?? 'Sin título');
                echo "<div class='libro-item'><strong>$a</strong> - $t</div>";
            }
        } else {
            echo "<p>No hay libros o error al conectar con la API.</p>";
        }
        ?>
    </div>
</body>
</html>