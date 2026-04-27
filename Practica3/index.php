<?php
// Evitar avisos Deprecated y Strict
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

// Cargar NuSOAP
require_once "nusoap.php";

// URL del WebService
$url = "http://luisledezmalara24408.atwebpages.com/practica3/webservice_SOAP.php?wsdl";

// Crear cliente SOAP
$cliente = new nusoap_client($url, true);

// Verificar error de conexión
$error = $cliente->getError();
if ($error) {
    die("<h2>Error de conexión</h2><pre>$error</pre>");
}

// Llamadas al servicio
$textoPlanetas = $cliente->call("muestraPlanetas");
$imagen1 = $cliente->call("muestraImagen", array("categoria" => "espacio"));
$imagen2 = $cliente->call("muestraImagen", array("categoria" => "otro"));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Servicio SOAP</title>
</head>
<body>

<h1>Resultado del Servicio SOAP</h1>

<?php
if ($cliente->fault) {
    echo "<h2>Error en la respuesta</h2>";
    print_r($textoPlanetas);
} else {
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>$error</pre>";
    } else {
        echo "<div style='border:1px solid #ccc; padding:15px; background:#f9f9f9;'>";
        echo "<strong>Información recibida:</strong><br><br>";
        echo $textoPlanetas;
        echo "</div>";
    }
}
?>

<hr>

<h2>Imágenes obtenidas del servicio</h2>

<img src="<?php echo $imagen1; ?>" width="300" style="margin:10px; border:2px solid #000;">
<img src="<?php echo $imagen2; ?>" width="300" sty
