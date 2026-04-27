<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');

// Función centralizada para conectar a AwardSpace
function conectar() {
    $dbHost = 'fdb1032.awardspace.net'; 
    $dbName = '4713728_luisledezmalara24phpws';
    $dbUser = '4713728_luisledezmalara24phpws';
    $dbPass = '12345678L'; // Usa tu clave de base de datos
    
    try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (Exception $e) {
        die(json_encode(["error" => $e->getMessage()]));
    }
}

$pdo = conectar();
$metodo = $_SERVER['REQUEST_METHOD'];

// LÓGICA DE PETICIONES
if ($metodo == 'GET') {
    $peticion = $_GET['peticion']; // 'titulo' o 'autor'
    $detalle = $_GET['detalle'];   // 'lista' o un ID numérico

    $columna = ($peticion == 'titulo') ? 'titulo' : 'autor';
    $sql = "SELECT id, $columna FROM libros";

    if ($detalle !== "lista") {
        $sql .= " WHERE id = " . intval($detalle);
    }

    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

} else if ($metodo == 'POST') {
    // INSERTAR (Tu función guardar_nuevo_autor)
    if (!empty($_POST['autor']) && !empty($_POST['titulo'])) {
        $stmt = $pdo->prepare("INSERT INTO libros (autor, titulo) VALUES (?, ?)");
        $stmt->execute([$_POST['autor'], $_POST['titulo']]);
        header('location:../../../index.php'); // Regresa al index
    }

} else if ($metodo == 'DELETE') {
    // ELIMINAR: Se activa al recibir un ID en 'detalle'
    $id = intval($_GET['detalle']);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["mensaje" => "Eliminado"]);
    }

} else if ($metodo == 'PUT') {
    // ACTUALIZAR: Recibe datos JSON
    $datos = json_decode(file_get_contents("php://input"), true);
    $id = intval($_GET['detalle']);
    
    if ($id > 0 && !empty($datos['titulo'])) {
        $stmt = $pdo->prepare("UPDATE libros SET titulo = ? WHERE id = ?");
        $stmt->execute([$datos['titulo'], $id]);
        echo json_encode(["mensaje" => "Actualizado"]);
    }
}
?>