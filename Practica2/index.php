<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
// 1. Esto le dice a PHP que use la librería que acabas de subir
require_once('nusoap.php'); 

// 2. Quitamos el ";" que tenías pegado a curl_init
$curl = curl_init("http://luisledezmalara24408.atwebpages.com/practica2/webservice_SOAP.php"); 

// 3. Agregamos los paréntesis y la URL correcta al cliente
$cliente = new nusoap_client("http://luisledezmalara24408.atwebpages.com/practica2/webservice_SOAP.php?wsdl", true);

$planetas = $cliente->call("muestraPlanetas");

echo "<h2>Los Planetas</h2>";
echo "<p>" . $planetas . "</p>";
?>