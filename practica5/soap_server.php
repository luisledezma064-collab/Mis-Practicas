<?php
// Desactivar cualquier salida de errores que pueda corromper el XML del WSDL
ini_set('display_errors', 0);
error_reporting(0);

// Cargar la librería NuSOAP
require_once "nusoap.php";

/**
 * Función que consulta la base de datos en AwardSpace
 * y retorna un arreglo con los libros.
 */
function muestraLibros() {
    // 🔹 DATOS DE CONEXIÓN SEGÚN TU PANEL
    $dbHost = "fdb1032.awardspace.net"; 
    $dbName = "4713728_luisledezmalara24phpws";
    $dbUser = "4713728_luisledezmalara24phpws";
    
    // ⚠️ REEMPLAZA ESTO CON TU CONTRASEÑA REAL DE AWARDSPACE
    $dbPass = "12345678L"; 

    try {
        // Establecer conexión con PDO
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta a la tabla que importaste (id, autor, titulo)
        $stmt = $pdo->query("SELECT autor, titulo FROM libros");
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si hay resultados los enviamos, si no, un arreglo vacío
        return $resultados ? $resultados : array();

    } catch (PDOException $e) {
        // En caso de error, devolvemos el mensaje para debug en el cliente
        return array(
            array("autor" => "Error de Conexión", "titulo" => $e->getMessage())
        );
    }
}

/* --- CONFIGURACIÓN DEL SERVIDOR SOAP --- */

$server = new nusoap_server();
$namespace = "urn:ServidorLibros";

// Configurar el WSDL
$server->configureWSDL("ServidorLibros", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

// Registrar la operación
$server->register(
    "muestraLibros",
    array(),                            // No recibe parámetros de entrada
    array("return" => "xsd:Array"),      // Retorna un arreglo (lista de libros)
    $namespace,                         // Namespace
    "urn:ServidorLibros#muestraLibros", // Acción SOAP
    "rpc",                              // Estilo
    "encoded",                          // Uso
    "Retorna la lista de libros desde la base de datos MySQL"
);

// Procesar la solicitud SOAP
$post = file_get_contents("php://input");
$server->service($post);
exit();
?>