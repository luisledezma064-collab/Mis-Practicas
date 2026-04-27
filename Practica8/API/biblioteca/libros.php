<?php
header('Content-Type: application/json');

// Función única para conexión para evitar repetir código
function conectar() {
    $dbHost = 'fdb1032.awardspace.net'; 
    $dbName = '4713728_luisledezmalara24phpws';
    $dbUser = '4713728_luisledezmalara24phpws';
    $dbPass = '12345678L'; // Usa la de tu panel
    
  try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
        exit;
    }
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // INSERTAR NUEVO LIBRO
    $pdo = conectar();
    $datos = json_decode(file_get_contents('php://input'), true);

    if (isset($datos['autor']) && isset($datos['titulo'])) {
        $stmt = $pdo->prepare("INSERT INTO libros (autor, titulo) VALUES (?, ?)");
        $stmt->execute([$datos['autor'], $datos['titulo']]);
        echo json_encode(["res" => "Guardado con éxito"]);
    } else {
        echo json_encode(["res" => "Faltan datos"]);
    }
} else if ($method == 'GET') {
    // CONSULTAR LIBROS
    $pdo = conectar();
    // Seleccionamos ambas columnas para que no salga "Sin título"
    $sql = "SELECT autor, titulo FROM libros";
    
    if (isset($_GET['detalle']) && $_GET['detalle'] != 'lista') {
        $sql .= " WHERE id = " . intval($_GET['detalle']);
    }

    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
?>