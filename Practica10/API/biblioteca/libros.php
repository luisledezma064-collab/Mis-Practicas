<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');

function conectar() {
    $dbHost = 'fdb1032.awardspace.net'; 
    $dbName = '4713728_luisledezmalara24phpws';
    $dbUser = '4713728_luisledezmalara24phpws';
    $dbPass = '12345678L'; // Reemplaza con tu clave real
    try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        return $pdo;
    } catch (Exception $e) {
        die(json_encode(["error" => $e->getMessage()]));
    }
}

$pdo = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $peticion = $_GET['peticion']; // 'titulo' o 'autor'
    
    if ($peticion == 'autor') {
        // Seleccionamos específicamente el autor para el botón de autores
        $sql = "SELECT id, autor FROM libros";
        $stmt = $pdo->query($sql);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
        $sql = "SELECT id, titulo FROM libros";
        $stmt = $pdo->query($sql);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>