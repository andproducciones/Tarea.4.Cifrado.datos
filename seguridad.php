<?php
// Rutas
$archivoOriginal = "archivos/ejemplo.txt";
$archivoCifrado = "backups/ejemplo.txt.enc";
$archivoHash = "hash/ejemplo.txt.hash";
$claveArchivo = "clave.key";

// Generar y guardar clave AES si no existe
if (!file_exists($claveArchivo)) {
    $clave = openssl_random_pseudo_bytes(32); // 256 bits
    file_put_contents($claveArchivo, $clave);
} else {
    $clave = file_get_contents($claveArchivo);
}

// Leer contenido original
$contenido = file_get_contents($archivoOriginal);

// Generar IV aleatorio (AES-256-CBC necesita 16 bytes)
$iv = openssl_random_pseudo_bytes(16);

// Cifrar con AES-256-CBC
$contenidoCifrado = openssl_encrypt($contenido, "aes-256-cbc", $clave, OPENSSL_RAW_DATA, $iv);

// Guardar archivo cifrado: IV + contenido cifrado
file_put_contents($archivoCifrado, $iv . $contenidoCifrado);

// Generar y guardar hash SHA-256
$hash = hash_file("sha256", $archivoOriginal);
file_put_contents($archivoHash, $hash);

echo "✅ Cifrado y backup realizados.\n";
echo "🔐 Clave AES almacenada en 'clave.key'\n";
echo "🧾 Hash generado: $hash\n";
?>
