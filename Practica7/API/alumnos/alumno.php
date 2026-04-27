<?php
header('Content-Type: application/json');

// Función para conectar a la BD de AwardSpace
function conectarBD() {
    $dbHost = "fdb1032.awardspace.net"; 
    $dbName = "4713728_luisledezmalara24phpws";
    $dbUser = "4713728_luisledezmalara24phpws";
    $dbPass = "12345678L"; // Reemplaza con tu clave

    try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo json_encode(array("error" => "Error de conexión: " . $e->getMessage()));
        exit;
    }
}

// Función dinámica: Obtiene cursos (ahora desde la BD)
function mostrar_cursos(){
    // Si no tienes tabla de cursos, podemos seguir usando la estática 
    // o crear una tabla similar a la de libros.
    return array('Angular35', 'MongoDB', 'PHP', 'UX', 'Ruby');
}

// Función dinámica: Obtiene alumnos (ahora desde la BD)
function mostrar_alumnos(){
    $pdo = conectarBD();
    // Suponiendo que tienes una tabla alumnos, o usaremos la de libros como ejemplo
    $stmt = $pdo->query("SELECT autor FROM libros"); // Usamos tu tabla libros existente
    return $stmt->fetchAll(PDO::FETCH_COLUMN); // Devuelve solo los nombres
}

// Lógica de rutas (Solicitud viene del .htaccess)
if (isset($_GET['solicitud'])) {
    if ($_GET['solicitud'] == 'cursos') {
        $resultados = mostrar_cursos();
    } else if ($_GET['solicitud'] == 'lista') {
        $resultados = mostrar_alumnos();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(array("mensaje" => "Ruta no encontrada"));
        exit;
    }
    echo json_encode($resultados);
}
?>