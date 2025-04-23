<?php
$archivoCifrado = "backups/ejemplo.txt.enc";
$claveArchivo = "clave.key";

// Leer clave
$clave = file_get_contents($claveArchivo);

// Leer contenido cifrado
$contenidoCifradoTotal = file_get_contents($archivoCifrado);

// Separar IV y datos cifrados
$iv = substr($contenidoCifradoTotal, 0, 16); // primeros 16 bytes = IV
$datosCifrados = substr($contenidoCifradoTotal, 16);

// Descifrar
$contenidoDescifrado = openssl_decrypt($datosCifrados, "aes-256-cbc", $clave, OPENSSL_RAW_DATA, $iv);

// Mostrar o guardar
echo "🔓 Contenido descifrado:\n";
echo "---------------------------\n";
echo $contenidoDescifrado . "\n";
?>