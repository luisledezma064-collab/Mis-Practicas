<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
require_once "nusoap.php";

// URL corregida: debe incluir la carpeta /practica5/
$wsdl = "http://luisledezmalara24408.atwebpages.com/practica5/soap_server.php?wsdl";

// Cambiamos a true para que use WSDL
$cliente = new nusoap_client($wsdl, true);
$cliente->soap_defencoding = 'UTF-8';
$cliente->decode_utf8 = false;

$libros = $cliente->call("muestraLibros");

if ($cliente->fault) {
    echo "Fallo en el servicio";
} elseif ($cliente->getError()) {
    echo "Error SOAP: " . $cliente->getError();
} else {
    echo "<h2>Mis libros</h2><ul>";
    foreach ($libros as $item) {
        echo "<li><strong>".$item['autor']."</strong><br>".$item['titulo']."</li><br>";
    }
    echo "</ul>";
}
?>
