<?php
// Periksa apakah konstanta sudah didefinisikan sebelumnya, untuk mencegah error duplikasi
if (!defined('HOST_NAME')) {
    define('HOST_NAME', 'localhost');
}
if (!defined('USER_NAME')) {
    define('USER_NAME', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'hotel');
}

// Membuat koneksi ke database
$koneksi = new mysqli(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);

// Periksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
