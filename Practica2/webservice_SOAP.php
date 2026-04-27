<?php
// 1. Silenciamos los avisos "Deprecated" para que no ensucien la respuesta XML
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

// 2. Cargamos la librería (Asegúrate que nusoap.php esté en la misma carpeta)
require_once "nusoap.php";

function muestraPlanetas() {
    $planetas = "Segun la definicón, el sistema solar consta de 9 planetas esos planetas son los que generan y dan origen a nuestro sistema solar, el astro rey es una enana roja, una estrella que por su garvedad atare a los planetas y los pone a rodar atravez de el. Estos planetas son Mercurio, Venus, Tierra, Marte, Jupiter, Saturno, Urano, Neptuno y Pluton, que este ultimo por sus caracterizcas fue consideraro como no planeta poralgun tiempo.";
    
    return $planetas;
}

$server = new soap_server();

// 3. Configuramos el WSDL (esto ayuda a que el cliente entienda el servicio)
$server->configureWSDL("servicioplanetas", "urn:servicioplanetas");

$server->register("muestraPlanetas",
    array(), // parámetros de entrada
    array("return" => "xsd:string"), // parámetro de salida
    "urn:servicioplanetas",
    "urn:servicioplanetas#muestraPlanetas",
    "rpc",
    "encoded",
    "Retorna una cadena con información de los planetas"
);

// 4. Forma moderna de obtener los datos de la petición
$post = file_get_contents( 'php://input' );

$server->service($post);
?>