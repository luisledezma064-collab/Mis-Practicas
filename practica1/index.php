<?php
// Usar la URL completa del servidor real
$curl = curl_init("http://luisledezmalara24408.atwebpages.com/practica1/base.txt");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($curl);
$info = curl_getinfo($curl);

// Usar comillas simples estándar para 'http_code'
if ( $info['http_code'] == 200 ) {
    $datos = explode(",", $respuesta);
    echo "<h1>Frutas en mi tienda</h1>";

    foreach($datos as $fruta){
        echo "-> " . $fruta . "<br>";
    }
} else {
    echo "Error: " . curl_error($curl);
}

curl_close($curl);
?>