<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
require_once "nusoap.php";

$wsdl = "http://luisledezmalara24408.atwebpages.com/practica4/webservice_SOAP.php?wsdl&v=" . time();

// Usamos el parámetro 'wsdl' explícitamente y desactivamos el caché interno
$cliente = new nusoap_client($wsdl, 'wsdl');
$cliente->useHTTPPersistentConnection();

// Verificar error al crear el cliente
$error = $cliente->getError();
if ($error) {
    die("Error en el cliente SOAP: " . $error);
}

/* ============================================================
   Llamada a muestraPlanetas
   ============================================================ */
$planetas = $cliente->call("muestraPlanetas");

echo "<h2>Los Planetas</h2>";

if ($cliente->fault) {
    echo "<p>Fallo en la operación muestraPlanetas</p>";
} else {
    $error = $cliente->getError();
    if ($error) {
        echo "<p>Error: $error</p>";
    } else {
        echo "<p>$planetas</p>";
    }
}

/* ============================================================
   Llamada a muestraImagen (CORREGIDO: "I" Mayúscula)
   ============================================================ */
// Cambiamos 'muestraimagen' por 'muestraImagen' para que coincida con el servidor
$imagen = $cliente->call("muestraImagen", array("categoria" => "espacio"));

echo "<h2>Imagen obtenida del servicio</h2>";

if ($cliente->fault) {
    echo "<p>Fallo en la operación muestraImagen</p>";
} else {
    $error = $cliente->getError();
    if ($error) {
        echo "<p>Error: $error</p>";
    } else {
        // Mostramos el HTML que devuelve el servidor
        echo $imagen;
    }
}
?>