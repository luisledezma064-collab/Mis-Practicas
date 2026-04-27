<?php
// Evitar avisos Deprecated y Strict
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

// Cargar NuSOAP
require_once "nusoap.php";

/* ===============================
   FUNCIONES DEL SERVICIO
   =============================== */

function muestraPlanetas() {
    return "Según la definición, el sistema solar está conformado por ocho planetas que orbitan alrededor del Sol, el cual es una estrella de tipo enana amarilla. 
    Los planetas del sistema solar son: Mercurio, Venus, Tierra, Marte, Júpiter, Saturno, Urano y Neptuno. 
    Plutón fue reclasificado como planeta enano.";
}

function muestraImagen($categoria) {
    $url_base = "http://luisledezmalara24408.atwebpages.com/practica3/img/";

    if ($categoria === "espacio") {
        return $url_base . "imagen.png";
    } else {
        return $url_base . "imagen2.png";
    }
}

/* ===============================
   SERVIDOR SOAP
   =============================== */

$server = new nusoap_server();

// Namespace
$namespace = "urn:practica3_service";

// Configurar WSDL
$server->configureWSDL("practica3_service", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

// Registrar funciones
$server->register(
    "muestraPlanetas",
    array(),
    array("return" => "xsd:string"),
    $namespace
);

$server->register(
    "muestraImagen",
    array("categoria" => "xsd:string"),
    array("return" => "xsd:string"),
    $namespace
);

// Procesar solicitud
$server->service(file_get_contents("php://input"));
?>
