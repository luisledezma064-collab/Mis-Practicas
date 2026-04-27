<?php
// Evitar avisos Deprecated
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

require_once "nusoap.php";

/* --- FUNCIONES --- */
function muestraPlanetas() {
    return "Los planetas son: Mercurio, Venus, Tierra, Marte, Júpiter, Saturno, Urano y Neptuno.";
}

function muestraImagen($categoria) {
    $imagen = (strtolower($categoria) === 'espacio') ? 'imagen.png' : 'imagen2.png';
    return '<img src="img/' . $imagen . '" width="300">';
}

/* --- CONFIGURACIÓN DEL SERVIDOR --- */
$server = new nusoap_server();
$namespace = "urn:infoBlog";
$server->configureWSDL("infoBlog", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

// Registro de muestraPlanetas
$server->register(
    "muestraPlanetas",
    array(),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Muestra planetas"
);

// Registro de muestraImagen - FIJATE QUE ESTÉ BIEN CERRADO EL PARENTESIS
$server->register(
    "muestraImagen",
    array("categoria" => "xsd:string"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Muestra imagen"
);

// PROCESAR PETICIÓN
$post = file_get_contents('php://input');
$server->service($post);
exit();
?>